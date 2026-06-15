@extends('layouts.dashboard')

@section('title', 'Add Specialization')

@section('content')

<div class="chat-card">

    <h2>Add Specialization</h2>

    <form method="POST" action="/admin/specializations/store">

        @csrf

        <input
            type="text"
            name="name"
            placeholder="Specialization Name"
            required
        >

        <textarea
            name="description"
            placeholder="Description"
        ></textarea>

        <button type="submit">
            Create Specialization
        </button>

    </form>

</div>

@endsection