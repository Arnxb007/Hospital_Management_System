@extends('layouts.dashboard')

@section('title','Medical Record Details')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>
            Medical Record
        </h1>

        <p>
            Detailed patient consultation report.
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
            Consultation Details
        </h3>

        <p>
            <strong>Date:</strong>
            {{ $record->created_at->format('d M Y') }}
        </p>

        <p>
            <strong>Doctor:</strong>
            Dr. {{ auth()->user()->full_name }}
        </p>

    </div>

</div>

<div class="table-card">

    <h2>
        Diagnosis
    </h2>

    <div class="record-section">

        {{ $record->diagnosis }}

    </div>

    <h2>
        Prescription
    </h2>

    <div class="record-section">

        {{ $record->prescription }}

    </div>

    <h2>
        Doctor Notes
    </h2>

    <div class="record-section">

        {{ $record->notes }}

    </div>

</div>
<div class="table-card">

    <h2>
        Attachments
    </h2>

    <form
        method="POST"
        action="/doctor/medical-records/{{ $record->id }}/upload"
        enctype="multipart/form-data">

        @csrf

        <input
            type="file"
            name="attachment"
            required>

        <button
            type="submit"
            class="add-btn">

            Upload File

        </button>

    </form>
    @if($record->files->count())

    <div style="margin-top:20px;">

        @foreach($record->files as $file)

            <p>

                📄

                <a
                    href="{{ asset('storage/'.$file->file_path) }}"
                    target="_blank">

                    {{ $file->file_name }}

                </a>

            </p>

        @endforeach

    </div>

@endif

</div>
<div class="record-actions">

    <a
        href="/doctor/medical-records/{{ $record->id }}/edit"
        class="search-btn">

        Edit Record

    </a>

    <a
        href="/medical-records/{{ $record->id }}/pdf"
        class="add-btn">

        Download PDF

    </a>

    <a
        href="/doctor/medical-records"
        class="search-btn">

        Back

    </a>

</div>

@endsection
