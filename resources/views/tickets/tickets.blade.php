@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-2xl font-bold mb-6">Tickets asignado</h2>

    {{-- Botón para ver todas las notificaciones del agente --}}
    <div class="mb-4">
        @if(auth()->user()->role === 'agent')
       <a href="{{ route('agent.notifications') }}" class="btn btn-success">
            🔔 All Notification
        </a>
        @elseif(auth()->user()->role === 'user')
        <a href="{{ route('user.notifications') }}" class="btn btn-success">
            🔔 All Notification
        </a>
        <a href="{{ route('tickets.create') }}" class="btn btn-dark">
            + New Tickets
        </a>
        @endif
    </div>

    @foreach ($tickets as $ticket)
        <div class="bg-white p-4 rounded shadow mb-4 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-semibold">{{ $ticket->id }}</h3>
                <h3 class="text-lg font-semibold">{{ $ticket->name }}</h3>
                <p class="text-sm text-gray-600">Producto: {{ $ticket->producto }} - Estado: <strong>{{ $ticket->status }}</strong></p>
            </div>

             @if(auth()->user()->role === 'agent' ||  auth()->user()->role === 'admin')
            <div class="flex items-center gap-4">
                {{-- Button status --}}
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editTicketModal{{ $ticket->id }}">
                    ✏️ Editar
                </button>
                <!--END-->
            @endif
                <div>
                    {{-- Icono de campana para ver notificaciones del ticket --}}
                    <button onclick="openModal({{ $ticket->id }})" class="text-yellow-500 hover:text-yellow-600 text-xl">
                        🔔
                    </button>
                    @if(auth()->user()->role)
                    <a href="{{ route('tickets.document', $ticket->id) }}" class="btn btn-primary">
                        Documentation
                    </a>
                    @endif
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('tickets.destroy', $ticket->id) }}" class="btn btn-dark">
                        DELETE
                    </a>
                </div>
            </div>
        </div>

        {{-- Modal para notificaciones del ticket --}}
        <div id="modal-{{ $ticket->id }}" class="fixed z-10 inset-0 hidden overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen bg-black bg-opacity-50">
                <div class="bg-white p-6 rounded shadow w-2/3 relative">
                    <h4 class="text-lg font-bold mb-4">Notificaciones del Ticket: {{ $ticket->name }}</h4>
                    @if(auth()->user()->role === 'agent' ||  auth()->user()->role === 'admin')
                    @if ($notificaciones->isEmpty())
                        <p class="text-sm text-gray-600">No hay notificaciones para este ticket.</p>
                    @else
                        <ul class="list-disc pl-6">
                            @foreach ($notificaciones as $notif)
                            <li class="list-group-item">
                                <h6>$notif->detail</h6>
                                {{ $notif->detail}}
                                <br>
                                <small class="text-muted">{{$notif->created_at}}</small>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                    @elseif(auth()->user()->role === 'user')
                    @if ($user_notifications->isEmpty())
                        <p class="text-sm text-gray-600">No hay notificaciones para este ticket.</p>
                    @else
                        <ul class="list-disc pl-6">
                            @foreach ($user_notifications as $notif)
                            <li class="list-group-item">
                                <h6>$notif->detail</h6>
                                {{ $notif->detail}}
                                <br>
                                <small class="text-muted">{{$notif->created_at}}</small>
                            </li>
                            @endforeach
                        </ul>
                    @endif
                    @endif

                    <button onclick="closeModal({{ $ticket->id }})" class="absolute top-2 right-2 text-red-600 text-xl">✖</button>
                </div>
            </div>
        </div>
        {{-- Modal para state del ticket --}}
        <!-- Modal -->
        <div class="modal fade" id="editTicketModal{{ $ticket->id }}" tabindex="-1" aria-labelledby="editTicketModalLabel{{ $ticket->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form method="PUT" action="{{ route('tickets.updateStatus', $ticket->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTicketModalLabel{{ $ticket->id }}">Editar Ticket #{{ $ticket->id }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <!-- Cambiar estado -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                    <option selected value="$ticket->state">{{$ticket->state}}</option>
                                    @foreach($tickets_status as $status)
                                    @if($ticket->state != $status->state)
                                    <option value="{{ $status->state }}">
                                        {{ $status->state }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Notificación opcional -->
                            <div class="mb-3">
                                <label for="notification" class="form-label">Document Solicitation</label>
                                <textarea name="notification" class="form-control" placeholder="..."></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <a href="{{ route('tickets.updateStatus', $ticket->id) }}" class="btn btn-dark">
                                DELETE
                            </a>
                            <button type="submit" class="btn btn-success">Guardar cambios</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('scripts')
<script>
    function openModal(id) {
        document.getElementById('modal-' + name + id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById('modal-' + id).classList.add('hidden');
    }
</script>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
