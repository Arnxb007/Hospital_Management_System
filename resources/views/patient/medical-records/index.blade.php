@extends('layouts.dashboard')

@section('title','Medical Records')

@section('content')

<div class="dashboard-header">

    <div>
        <h1>Medical Records</h1>
        <p>
            Your complete consultation history.
        </p>
    </div>

</div>
@forelse($records as $record)

<div class="medical-record-card">

    <div class="record-header">

        <div>

            <h3>
                👨‍⚕️ Dr.
                {{ $record->doctor->user->full_name }}
            </h3>

            <small>
                📅
                {{ $record->created_at->format('d M Y') }}
            </small>

        </div>

        <span class="record-badge">
            Record #{{ $record->id }}
        </span>

    </div>

    <div class="record-preview">

        <h4>🩺 Diagnosis</h4>

        <p>
            {{ Str::limit($record->diagnosis, 120) }}
        </p>

        <h4>💊 Prescription</h4>

        <p>
            {{ Str::limit($record->prescription, 120) }}
        </p>

    </div>

    <div class="record-actions">

        <a
            href="/patient/medical-records/{{ $record->id }}"
            class="add-btn">

            View Full Record

        </a>

        <a
            href="/medical-records/{{ $record->id }}/pdf"
            class="search-btn">

            Download PDF

        </a>

    </div>

</div>

@empty

<div class="table-card">

    <div style="text-align:center;padding:40px;">

        <h3>
            No Medical Records Found
        </h3>

        <p>
            Records created by doctors will appear here.
        </p>

    </div>

</div>

@endforelse
@endsection