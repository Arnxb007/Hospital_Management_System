@extends('layouts.dashboard')

@section('title','Edit Medical Record')

@section('content')

<div class="dashboard-header">

    <div>

        <h1>
            Edit Medical Record
        </h1>

        <p>
            Update diagnosis and prescription.
        </p>

    </div>

</div>

<div class="table-card">

    <form
        method="POST"
        action="/doctor/medical-records/{{ $record->id }}">

        @csrf
        @method('PUT')

        <label>
            Diagnosis
        </label>

        <textarea
            name="diagnosis"
            rows="5"
            required>{{ $record->diagnosis }}</textarea>

        <label>
            Prescription
        </label>

        <textarea
            name="prescription"
            rows="5">{{ $record->prescription }}</textarea>

        <label>
            Notes
        </label>

        <textarea
            name="notes"
            rows="5">{{ $record->notes }}</textarea>

        <button
            type="submit"
            class="add-btn"
            style="margin-top:20px;">

            Save Changes

        </button>

    </form>

</div>

@endsection