@extends('layouts.dashboard')

@section('title','Notifications')

@section('content')

<div class="notifications-page">

    <div class="dashboard-header">

        <div>

            <h1>
                Notifications
            </h1>

            <p>
                Stay updated with appointments and medical records.
            </p>

        </div>

    </div>

    <div class="notification-section">

        <h2>
            New
            ({{ $notifications->where('is_read',false)->count() }})
        </h2>

        @forelse(
            $notifications->where('is_read',false)
            as $notification
        )

        <div class="notification-card unread">

            <div class="notification-content">

                <div class="notification-title">

                    🔵
                    <a
                        href="/notifications/{{ $notification->id }}"
                        style="text-decoration:none;color:inherit;">

                        <h3>
                            {{ $notification->title }}
                        </h3>

                        <p>
                            {{ $notification->message }}
                        </p>

                    </a>

                </div>

                <div class="notification-message">

                    {{ $notification->message }}

                </div>

                <div class="notification-time">

                    {{ $notification->created_at->format('d M Y • h:i A') }}

                </div>

            </div>

            <form
                method="POST"
                action="/notifications/{{ $notification->id }}/read">

                @csrf

                <button
                    type="submit"
                    class="mark-read-btn">

                    ✓

                </button>

            </form>

        </div>

        @empty

        <div class="table-card">

            No new notifications.

        </div>

        @endforelse

    </div>

    <div class="notification-section">

        <h2>
            Earlier
            ({{ $notifications->where('is_read',true)->count() }})
        </h2>

        @forelse(
            $notifications->where('is_read',true)
            as $notification
        )

        <div class="notification-card">

            <div class="notification-content">

                <div class="notification-title">

                    {{ $notification->title }}

                </div>

                <div class="notification-message">

                    {{ $notification->message }}

                </div>

                <div class="notification-time">

                    {{ $notification->created_at->format('d M Y • h:i A') }}

                </div>

            </div>

        </div>

        @empty

        <div class="table-card">

            No previous notifications.

        </div>

        @endforelse

    </div>

</div>

@endsection