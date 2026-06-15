@extends('layouts.dashboard')

@section('title', 'Specializations')

@section('content')

<a href="/admin/specializations/create" class="btn-primary">
    Add Specialization
</a>

<br><br>

<div class="stats-grid">

@foreach($specializations as $specialization)

    <div class="stat-card">

        <h3>{{ $specialization->name }}</h3>

        <p>
            {{ $specialization->description }}
        </p>

    </div>

@endforeach

</div>

@endsection