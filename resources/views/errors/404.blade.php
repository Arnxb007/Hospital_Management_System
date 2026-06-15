@extends('layouts.error')

@section('title','404 Not Found')

@section('content')

<div
    class="table-card"
    style="
    text-align:center;
    padding:60px;
    ">

    <h1
        style="
        font-size:80px;
        margin:0;
        color:var(--primary);
        ">

        404

    </h1>

    <h2>

        Page Not Found

    </h2>

<p
    style="
    color:#64748b;
    font-size:16px;
    margin-bottom:30px;
    ">
    The page you are looking for may have been moved,
    deleted, or never existed.
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