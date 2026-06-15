<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 28px 30px 42px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #172033;
            font-size: 12px;
            line-height: 1.55;
        }

        h1,
        h2,
        h3,
        p {
            margin: 0;
        }

        .header {
            border-bottom: 3px solid #0f766e;
            padding-bottom: 14px;
            margin-bottom: 18px;
        }

        .brand {
            font-size: 25px;
            font-weight: 800;
            color: #0f3f3b;
        }

        .subtitle {
            color: #64748b;
            margin-top: 3px;
        }

        .meta {
            text-align: right;
            font-size: 11px;
            color: #475569;
        }

        .two-col {
            width: 100%;
            border-collapse: collapse;
        }

        .two-col td {
            vertical-align: top;
        }

        .section {
            margin-top: 16px;
            page-break-inside: avoid;
        }

        .section-title {
            margin-bottom: 8px;
            padding: 8px 10px;
            background: #e8f7f6;
            border-left: 4px solid #0f766e;
            color: #0f3f3b;
            font-size: 14px;
            font-weight: 800;
        }

        .card {
            border: 1px solid #dce7ee;
            border-radius: 8px;
            padding: 12px;
            background: #ffffff;
        }

        .patient-card {
            min-height: 116px;
        }

        .profile-photo {
            width: 92px;
            height: 92px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #dce7ee;
        }

        .profile-placeholder {
            width: 92px;
            height: 92px;
            border-radius: 8px;
            background: #e8f7f6;
            color: #0f766e;
            text-align: center;
            font-size: 34px;
            font-weight: 800;
            line-height: 92px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th,
        .data-table td {
            padding: 7px 8px;
            border: 1px solid #dce7ee;
            vertical-align: top;
        }

        .data-table th {
            width: 28%;
            background: #f5faf9;
            color: #475569;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .4px;
            text-align: left;
        }

        .value-box {
            min-height: 38px;
            padding: 9px 10px;
            border: 1px solid #dce7ee;
            background: #fbfdfe;
            border-radius: 6px;
            white-space: pre-line;
        }

        .summary-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 8px;
            margin: -8px;
        }

        .summary-cell {
            width: 25%;
            padding: 10px;
            background: #f5faf9;
            border: 1px solid #dce7ee;
            border-radius: 6px;
        }

        .summary-label {
            color: #64748b;
            font-size: 10px;
            text-transform: uppercase;
        }

        .summary-value {
            margin-top: 4px;
            color: #0f3f3b;
            font-weight: 800;
            font-size: 14px;
        }

        .record {
            margin-top: 12px;
            padding-top: 12px;
            border-top: 1px solid #dce7ee;
            page-break-inside: avoid;
        }

        .record:first-child {
            margin-top: 0;
            padding-top: 0;
            border-top: 0;
        }

        .record-heading {
            margin-bottom: 8px;
            color: #0f3f3b;
            font-weight: 800;
        }

        .badge {
            display: inline-block;
            padding: 3px 7px;
            border-radius: 999px;
            background: #e8f7f6;
            color: #0f766e;
            font-size: 10px;
            font-weight: 800;
        }

        .attachment-table td,
        .attachment-table th {
            font-size: 11px;
        }

        .report-image {
            max-width: 100%;
            max-height: 520px;
            margin-top: 8px;
            border: 1px solid #dce7ee;
            border-radius: 6px;
        }

        .muted {
            color: #64748b;
        }

        .small {
            font-size: 10px;
        }

        .footer {
            position: fixed;
            left: 30px;
            right: 30px;
            bottom: 16px;
            border-top: 1px solid #dce7ee;
            padding-top: 8px;
            color: #64748b;
            font-size: 9px;
        }

        .signature {
            margin-top: 34px;
            width: 230px;
            border-top: 1px solid #172033;
            padding-top: 6px;
            text-align: center;
            color: #475569;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    @php
        $user = $patient->user;
        $age = $patient->date_of_birth
            ? \Carbon\Carbon::parse($patient->date_of_birth)->age
            : null;
        $conditions = collect([
            'Diabetes' => $patient->has_diabetes,
            'Hypertension' => $patient->has_hypertension,
            'Heart Disease' => $patient->has_heart_disease,
            'Asthma' => $patient->has_asthma,
            'Smoker' => $patient->smoker,
            'Alcohol Consumer' => $patient->alcohol_consumer,
        ])->filter()->keys()->implode(', ');
        $allFiles = $records->flatMap->files;
    @endphp

    <div class="footer">
        HMS Hospital Medical File | Confidential patient document | Generated {{ now()->format('d M Y, h:i A') }}
    </div>

    <table class="two-col header">
        <tr>
            <td>
                <div class="brand">HMS Hospital</div>
                <div class="subtitle">Comprehensive Patient Medical File</div>
            </td>
            <td class="meta">
                File No: PT-{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}<br>
                Reference Record: MR-{{ str_pad($record->id, 5, '0', STR_PAD_LEFT) }}<br>
                Generated: {{ now()->format('d M Y') }}
            </td>
        </tr>
    </table>

    <div class="section">
        <div class="section-title">Patient Profile</div>
        <div class="card patient-card">
            <table class="two-col">
                <tr>
                    <td style="width: 112px;">
                        @if($profilePhoto)
                            <img src="{{ $profilePhoto }}" class="profile-photo" alt="Patient photo">
                        @else
                            <div class="profile-placeholder">
                                {{ strtoupper(substr($user->first_name, 0, 1)) }}
                            </div>
                        @endif
                    </td>
                    <td>
                        <table class="data-table">
                            <tr>
                                <th>Name</th>
                                <td>{{ $user->full_name }}</td>
                                <th>Patient ID</th>
                                <td>PT-{{ str_pad($patient->id, 5, '0', STR_PAD_LEFT) }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email ?? 'N/A' }}</td>
                                <th>Phone</th>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ $patient->gender ? ucfirst($patient->gender) : 'N/A' }}</td>
                                <th>Age / DOB</th>
                                <td>
                                    {{ $age ? $age . ' years' : 'N/A' }}
                                    @if($patient->date_of_birth)
                                        ({{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d M Y') }})
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td colspan="3">{{ $patient->address ?: 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Emergency Contact</th>
                                <td colspan="3">{{ $patient->emergency_contact ?: 'N/A' }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Clinical Snapshot</div>
        <table class="summary-grid">
            <tr>
                <td class="summary-cell">
                    <div class="summary-label">Blood Group</div>
                    <div class="summary-value">{{ $patient->blood_group ?: 'N/A' }}</div>
                </td>
                <td class="summary-cell">
                    <div class="summary-label">Height</div>
                    <div class="summary-value">{{ $patient->height ? $patient->height . ' cm' : 'N/A' }}</div>
                </td>
                <td class="summary-cell">
                    <div class="summary-label">Weight</div>
                    <div class="summary-value">{{ $patient->weight ? $patient->weight . ' kg' : 'N/A' }}</div>
                </td>
                <td class="summary-cell">
                    <div class="summary-label">Last Checkup</div>
                    <div class="summary-value">
                        {{ $patient->last_health_checkup ? \Carbon\Carbon::parse($patient->last_health_checkup)->format('d M Y') : 'N/A' }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Health History</div>
        <table class="data-table">
            <tr>
                <th>Known Conditions</th>
                <td>{{ $conditions ?: 'None reported' }}</td>
            </tr>
            <tr>
                <th>Allergies</th>
                <td>{{ $patient->allergies ?: 'None reported' }}</td>
            </tr>
            <tr>
                <th>Medical History</th>
                <td>{{ $patient->medical_history ?: 'Not provided' }}</td>
            </tr>
            <tr>
                <th>Current Medications</th>
                <td>{{ $patient->current_medications ?: 'Not provided' }}</td>
            </tr>
            <tr>
                <th>Past Surgeries</th>
                <td>{{ $patient->past_surgeries ?: 'Not provided' }}</td>
            </tr>
            <tr>
                <th>Family Medical History</th>
                <td>{{ $patient->family_medical_history ?: 'Not provided' }}</td>
            </tr>
            <tr>
                <th>Additional Notes</th>
                <td>{{ $patient->additional_notes ?: 'Not provided' }}</td>
            </tr>
        </table>
    </div>

    <div class="section page-break">
        <div class="section-title">Medical Record Timeline</div>
        <div class="card">
            @forelse($records as $medicalRecord)
                <div class="record">
                    <div class="record-heading">
                        MR-{{ str_pad($medicalRecord->id, 5, '0', STR_PAD_LEFT) }}
                        <span class="badge">{{ $medicalRecord->created_at->format('d M Y') }}</span>
                    </div>

                    <table class="data-table">
                        <tr>
                            <th>Doctor</th>
                            <td>Dr. {{ $medicalRecord->doctor->user->full_name ?? 'N/A' }}</td>
                            <th>Appointment</th>
                            <td>
                                @if($medicalRecord->appointment)
                                    {{ $medicalRecord->appointment->appointment_date }}
                                    {{ $medicalRecord->appointment->appointment_time }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    </table>

                    <h3 style="margin-top: 10px;">Diagnosis</h3>
                    <div class="value-box">{{ $medicalRecord->diagnosis ?: 'Not provided' }}</div>

                    <h3 style="margin-top: 10px;">Prescription / Treatment Plan</h3>
                    <div class="value-box">{{ $medicalRecord->prescription ?: 'Not provided' }}</div>

                    <h3 style="margin-top: 10px;">Doctor Notes</h3>
                    <div class="value-box">{{ $medicalRecord->notes ?: 'Not provided' }}</div>
                </div>
            @empty
                <p class="muted">No medical records available.</p>
            @endforelse
        </div>
    </div>

    <div class="section page-break">
        <div class="section-title">Uploaded Reports And Attachments</div>
        <div class="card">
            @if($allFiles->count())
                <table class="data-table attachment-table">
                    <tr>
                        <th>Record</th>
                        <th>File Name</th>
                        <th>Uploaded</th>
                        <th>PDF Inclusion</th>
                    </tr>
                    @foreach($records as $medicalRecord)
                        @foreach($medicalRecord->files as $file)
                            <tr>
                                <td>MR-{{ str_pad($medicalRecord->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $file->file_name }}</td>
                                <td>{{ $file->created_at?->format('d M Y') ?? 'N/A' }}</td>
                                <td>
                                    @if(!empty($attachmentImages[$file->id]))
                                        Image preview included below
                                    @else
                                        Original uploaded file stored in system
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>

                @foreach($records as $medicalRecord)
                    @foreach($medicalRecord->files as $file)
                        @if(!empty($attachmentImages[$file->id]))
                            <div class="record">
                                <div class="record-heading">
                                    Report Image: {{ $file->file_name }}
                                    <span class="badge">MR-{{ str_pad($medicalRecord->id, 5, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <img src="{{ $attachmentImages[$file->id] }}" class="report-image" alt="{{ $file->file_name }}">
                            </div>
                        @endif
                    @endforeach
                @endforeach
            @else
                <p class="muted">No uploaded reports or attachments found for this patient.</p>
            @endif

            <p class="muted small" style="margin-top: 12px;">
                Note: Uploaded image reports are rendered inside this PDF. Uploaded PDF, DOC and DOCX files are recorded
                in the attachment register and remain available in the hospital system as original source files.
            </p>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Certification</div>
        <div class="card">
            <p>
                This document was generated from the HMS Hospital Management System and summarizes patient profile,
                clinical records, diagnoses, prescriptions, doctor notes and uploaded report references available at
                the time of generation.
            </p>

           <div class="signature">

                @if(!empty($doctorSignature))
                    <img
                        src="{{ $doctorSignature }}"
                        style="
                            max-height:80px;
                            margin-bottom:10px;
                        ">
                @endif

                Dr. {{ $record->doctor->user->full_name ?? 'N/A' }}

                <br>

                {{ $record->doctor->specialization->name ?? '' }}

                <br><br>

                Authorized Doctor / Hospital Desk

            </div>
        </div>
    </div>
</body>
</html>
