@extends('layouts.error')

@section('title','403 Forbidden')

@section('content')

<div
    class="table-card"
    style="text-align:center;padding:60px;">

    <h1
        style="
        font-size:80px;
        margin:0;
        color:#f59e0b;
        ">

        403

    </h1>

    <h2>

        Access Denied

    </h2>

    <p>

        You do not have permission to access this page.

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