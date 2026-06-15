@extends('layouts.dashboard')

@section('title','Medical Records')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>
            Medical Records
        </h1>

        <p>
            View all records created by you.
        </p>

    </div>

</div>

<div class="stats-grid">

    <div class="stat-card">

        <h3>
            Total Records
        </h3>

        <div class="stat-number">
            {{ $records->count() }}
        </div>

    </div>

</div>
<form method="GET" class="search-form">

    <input
        type="text"
        name="search"
        placeholder="Search patient..."
        value="{{ request('search') }}">

    <button
        type="submit"
        class="search-btn">

        Search

    </button>

</form>
@forelse($records as $record)

<div class="medical-record-card">

    <div class="record-header">

        <div>

            <h3>
                👤
                {{ $record->patient->user->full_name }}
            </h3>

            <small>
                📅
                {{ $record->created_at->format('d M Y') }}
            </small>

        </div>

        <span class="record-badge">

            MR-{{ str_pad($record->id,5,'0',STR_PAD_LEFT) }}

        </span>

    </div>

    <h4>
        Diagnosis
    </h4>

    <p>

        {{ \Illuminate\Support\Str::limit(
            $record->diagnosis,
            100
        ) }}

    </p>

    <div class="record-actions">

        <a
            href="/doctor/medical-records/{{ $record->id }}"
            class="add-btn">

            View Record

        </a>

        <a
            href="/medical-records/{{ $record->id }}/pdf"
            class="search-btn">

            PDF

        </a>

    </div>

</div>

@empty

<div class="table-card">

    No medical records found.

</div>

@endforelse

@endsection