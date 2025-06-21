<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\DocumentationTicket;
use App\Models\NotificationAgent;
use App\Models\Ticket;
use App\Models\User;
use App\Notifications\TicketStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    // Los documentos deben solicitarse por los agentes
    // Los usuarios deben cargar documentos
    // Los documentos deben verse por ambos 
    public function index($ticketId){
       

       $doc_ticket = DocumentationTicket::where('ticket_id', $ticketId)->get();

       $ticket     = Ticket::where('id', $ticketId)->first();
 
       
       return view('tickets.document')
       ->with('doc_tickets', $doc_ticket)
       ->with('ticket_id', $ticketId)
       ->with('ticket_status', $ticket->status)
       ->with('ticket', $ticket);
    }

    public function newDocument($ticketId){
                
        return view('documentation.upload_documentation')
       ->with('ticket_id', $ticketId);
    }

    public function store(Request $request, $ticketId){
        $userid = Auth::id();

        $path = $request->file('file')->store('tickets_docs','public');

        $docreate = new DocumentationTicket();

        $docreate->ticket_id = $ticketId;
        $docreate->file_path = $path;
        $docreate->uploaded_by = 1;
        $docreate->save();

        $ticket = Ticket::find($ticketId);
        NotificationAgent::create([
            'ticket_id' => $ticketId,
            'user_id'   => $userid,
            'detail'    => 'New Document'
        ]);

        $user = User::find($userid);
        $user = $user->notify(new TicketStatusChanged($ticket));

        $doc_ticket = DocumentationTicket::where('ticket_id', $ticketId)->get();
        $ticket     = Ticket::where('id', $ticketId)->first();

        return view('tickets.document')
        ->with('doc_tickets', $doc_ticket)
        ->with('ticket_id', $ticketId)
        ->with('ticket_status', $ticket->status)
        ->with('ticket', $ticket);
    }

    public function addDocNotifationSolicitation(Request $request, $ticketId){

    }
    
}
