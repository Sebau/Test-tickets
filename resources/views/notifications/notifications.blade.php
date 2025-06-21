@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="mb-4">
        @if(auth()->user()->role === 'agent')
        <a href="{{ route('agent.panel') }}" class="btn btn-dark">
            Go Back
        </a>
        @elseif(auth()->user()->role === 'user')
        <a href="{{ route('user.panel') }}" class="btn btn-secondary">
            Go Back
        </a>
        <a href="{{ route('tickets.create') }}" class="btn btn-dark">
            + New Tickets
        </a>
        @elseif(auth()->user()->role === 'admin')
        <a href="{{ route('tickets.create') }}" class="btn btn-dark">
            + New Tickets
        </a>
        <a href="{{ route('agent.panel') }}" class="btn btn-dark">
            Go Back
        </a>
        @endif
    </div>
    <div class="flex items-center gap-4">
        <form method="GET" enctype="multipart/form-data">
            @csrf
            @if(auth()->user()->role === 'agent' ||  auth()->user()->role === 'admin')
            <div class="mb-3">
                @if ($notifications->isEmpty())
                        <p class="text-sm text-gray-600">No hay notificaciones para este ticket.</p>
                    @else
                        <ul class="list-disc pl-6">
                            @foreach ($notifications as $notif)
                                <li class="mb-2">Ticket ID: {{ $notif->ticket_id }} - {{ $notif->detail }} <span class="text-xs text-gray-500">({{ $notif->created_at->diffForHumans() }})</span></li>
                            @endforeach
                        </ul>
                    @endif
            </div>
            @elseif(auth()->user()->role === 'user')
            <div class="mb-3">
                @if ($notifications->isEmpty())
                        <p class="text-sm text-gray-600">No hay notificaciones para este ticket.</p>
                    @else
                        <ul class="list-disc pl-6">
                            @foreach ($notifications as $notif)
                                <li class="mb-2">Ticket ID: {{ $notif->ticket_id }} - {{ $notif->detail }} <span class="text-xs text-gray-500">({{ $notif->created_at->diffForHumans() }})</span></li>
                            @endforeach
                        </ul>
                    @endif
            </div>
            @endif
        </form>
    </div> 
</div>
@endsection