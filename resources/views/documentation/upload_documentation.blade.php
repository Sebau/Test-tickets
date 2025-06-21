@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="mb-4">
        @if(auth()->user()->role === 'agent')
        <a href="{{ route('agent.notifications') }}" class="btn btn-success">
            🔔 All Notification
        </a>
        <a href="{{ route('agent.panel') }}" class="btn btn-dark">
            Go Back
        </a>
        @elseif(auth()->user()->role === 'user')
        <a href="{{ route('user.notifications') }}" class="btn btn-success">
            🔔 All Notification
        </a>
        <a href="{{ route('user.panel') }}" class="btn btn-secondary">
            Go Back
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
        <form method="POST" action="{{ route('document.save',$ticket_id) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="file" class="form-label">Documentation</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <div class="mb-3">
                <hr>
                <button type="submit" value="{{ route('document.save',$ticket_id ) }}" class="btn btn-primary">
                    Save
                </button>
            </div>
        </form>
    </div> 
</div>
@endsection