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
        <a href="{{ route('document.new',$ticket_id ) }}" class="btn btn-dark">
            + Add Documentation
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
        @if($doc_tickets)
        <div class="flex items-center gap-4">
            <h5>Documents List to {{$ticket_id}} - Status : {{$ticket_status}}</h5>
        </div>
        <div class="flex items-center gap-4">
            <ul>
                @foreach($doc_tickets as $doc)
                    <br/>
                    <li>
                        <a href="{{ Storage::url($doc->file_path) }}" target="_blank">
                            {{ basename($doc->file_path)}}
                        </a>    
                    </li>
                    
                @endforeach
            </ul>
        </div>
        @else
            <p> No Documentation</p>
        @endif
    </div> 
</div>
@endsection
