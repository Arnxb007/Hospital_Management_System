@extends('layouts.error')

@section('title','500 Server Error')

@section('content')

<div
    class="table-card"
    style="text-align:center;padding:60px;">

    <h1
        style="
        font-size:80px;
        margin:0;
        color:#ef4444;
        ">

        500

    </h1>

    <h2>

        Something Went Wrong

    </h2>

    <p>

        An unexpected error occurred.

    </p>

    <a
        href="/"
        class="add-btn">

        Go Home


    </a>
    <a
        href="javascript:history.back()"
        class="add-btn"
        style="margin-left:10px;">
        Go Back
    </a>

</div>

@endsection