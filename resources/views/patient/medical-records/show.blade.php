@extends('layouts.dashboard')

@section('title','Medical Record')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>
            Medical Record
        </h1>

        <p>
            Detailed consultation report
        </p>

    </div>

</div>

<div class="profile-grid">

    <div class="info-card">

        <h3>
            Patient Information
        </h3>

        <p>
            <strong>Name:</strong>
            {{ $record->patient->user->full_name }}
        </p>

        <p>
            <strong>Record ID:</strong>
            MR-{{ str_pad($record->id,5,'0',STR_PAD_LEFT) }}
        </p>

    </div>

    <div class="info-card">

        <h3>
            Doctor Information
        </h3>

        <p>
            Dr.
            {{ $record->doctor->user->full_name }}
        </p>

        <p>
            Created:
            {{ $record->created_at->format('d M Y') }}
        </p>

    </div>

</div>

<div class="table-card">

    <h2>Diagnosis</h2>

    <div class="record-section">
        {{ $record->diagnosis }}
    </div>

    <h2>Prescription</h2>

    <div class="record-section">
        {{ $record->prescription }}
    </div>

    <h2>Doctor Notes</h2>

    <div class="record-section">
        {{ $record->notes }}
    </div>

</div>
<div class="attachments-section">

    <h2>📎 Attachments</h2>

    @if($record->files->count())

        <div class="attachments-list">

            @foreach($record->files as $file)

                <div class="attachment-item">

                    <a
                        href="{{ asset('storage/'.$file->file_path) }}"
                        target="_blank">

                        📄 {{ $file->file_name }}

                    </a>

                </div>

            @endforeach

        </div>

    @endif

</div>

<div class="action-buttons">

    <a
        href="/medical-records/{{ $record->id }}/pdf"
        class="add-btn">

        Download PDF

    </a>

    <button
        onclick="window.history.back()"
        class="search-btn">

        Back

    </button>

</div>
@endsection
