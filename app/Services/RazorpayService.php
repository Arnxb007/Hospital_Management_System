<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\PaymentTransaction;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class RazorpayService
{
    protected Api $api;
    protected string $keyId;
    protected string $keySecret;
    protected string $currency;

    public function __construct()
    {
        $this->keyId     = config('razorpay.key_id');
        $this->keySecret = config('razorpay.key_secret');
        $this->currency  = config('razorpay.currency', 'INR');

        $this->api = new Api($this->keyId, $this->keySecret);
    }

    /**
     * Create a Razorpay order for the given appointment.
     * Returns the order array or throws on failure.
     */
    public function createOrder(Appointment $appointment): array
    {
        $options = [
            'amount'          => $appointment->amountInPaise(),
            'currency'        => $this->currency,
            'receipt'         => 'appt_' . $appointment->id,
            'payment_capture' => config('razorpay.payment_capture', 1),
            'notes'           => [
                'appointment_id'   => $appointment->id,
                'patient_name'     => $appointment->patient_name,
                'patient_phone'    => $appointment->patient_phone,
                'appointment_date' => $appointment->appointment_date->format('d M Y'),
                'doctor_id'        => $appointment->doctor_id,
            ],
        ];

        $order = $this->api->order->create($options);

        // Persist order ID on the appointment
        $appointment->update(['razorpay_order_id' => $order['id']]);

        // Create pending transaction record
        PaymentTransaction::create([
            'appointment_id'    => $appointment->id,
            'user_id'           => $appointment->user_id,
            'razorpay_order_id' => $order['id'],
            'amount'            => $appointment->consultation_fee,
            'currency'          => $this->currency,
            'status'            => 'created',
            'gateway_response'  => $order->toArray(),
        ]);

        return $order->toArray();
    }

    /**
     * Verify the payment signature sent by Razorpay after checkout.
     * Throws SignatureVerificationError on mismatch.
     */
    public function verifyPayment(
        string $orderId,
        string $paymentId,
        string $signature
    ): void {
        $this->api->utility->verifyPaymentSignature([
            'razorpay_order_id'   => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature'  => $signature,
        ]);
    }

    /**
     * Fetch payment details from Razorpay.
     */
    public function fetchPayment(string $paymentId): array
    {
        return $this->api->payment->fetch($paymentId)->toArray();
    }

    /**
     * Handle a successful payment: verify signature, update appointment & transaction.
     * Returns the updated appointment.
     */
    public function handleSuccess(
        Appointment $appointment,
        string $paymentId,
        string $signature
    ): Appointment {
        // 1. Verify signature
        $this->verifyPayment($appointment->razorpay_order_id, $paymentId, $signature);

        // 2. Fetch full payment details from Razorpay
        $paymentDetails = $this->fetchPayment($paymentId);

        // 3. Update appointment
        $appointment->markAsPaid($paymentId, $signature);

        // 4. Update transaction record
        PaymentTransaction::where('razorpay_order_id', $appointment->razorpay_order_id)
            ->update([
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature'  => $signature,
                'status'              => 'paid',
                'method'              => $paymentDetails['method'] ?? null,
                'bank'                => $paymentDetails['bank'] ?? null,
                'wallet'              => $paymentDetails['wallet'] ?? null,
                'vpa'                 => $paymentDetails['vpa'] ?? null,
                'gateway_response'    => $paymentDetails,
            ]);

        Log::info('Razorpay payment success', [
            'appointment_id' => $appointment->id,
            'payment_id'     => $paymentId,
            'amount'         => $appointment->consultation_fee,
        ]);

        return $appointment->fresh(['doctor', 'user']);
    }

    /**
     * Handle a failed payment: log and update transaction.
     */
    public function handleFailure(
        Appointment $appointment,
        array $error
    ): void {
        $appointment->update(['payment_status' => 'failed']);

        PaymentTransaction::where('razorpay_order_id', $appointment->razorpay_order_id)
            ->update([
                'status'            => 'failed',
                'error_code'        => $error['code'] ?? null,
                'error_description' => $error['description'] ?? null,
                'gateway_response'  => $error,
            ]);

        Log::warning('Razorpay payment failed', [
            'appointment_id' => $appointment->id,
            'error'          => $error,
        ]);
    }

    /**
     * Verify Razorpay webhook signature.
     */
    public function verifyWebhookSignature(string $payload, string $signature): bool
    {
        try {
            $this->api->utility->verifyWebhookSignature(
                $payload,
                $signature,
                config('razorpay.webhook_secret')
            );
            return true;
        } catch (\Exception $e) {
            Log::error('Razorpay webhook signature mismatch', ['error' => $e->getMessage()]);
            return false;
        }
    }

    public function getKeyId(): string
    {
        return $this->keyId;
    }
}
