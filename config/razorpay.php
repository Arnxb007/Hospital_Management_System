<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Razorpay Configuration
    |--------------------------------------------------------------------------
    | Add these to your .env file:
    |   RAZORPAY_KEY_ID=rzp_test_xxxxxxxxxxxx
    |   RAZORPAY_KEY_SECRET=xxxxxxxxxxxxxxxxxxxxxxxx
    |   RAZORPAY_WEBHOOK_SECRET=your_webhook_secret
    */

    'key_id'         => env('RAZORPAY_KEY_ID'),
    'key_secret'     => env('RAZORPAY_KEY_SECRET'),
    'webhook_secret' => env('RAZORPAY_WEBHOOK_SECRET'),

    'currency' => env('RAZORPAY_CURRENCY', 'INR'),

    'payment_capture' => 1, // Auto-capture payments

    'appointment_fee_label' => 'Hospital Appointment Booking Fee',
];
