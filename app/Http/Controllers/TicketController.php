<?php

namespace App\Http\Controllers;

use App\Models\ModelOfTransport;
use App\Models\NotificationAgent;
use App\Models\Ticket;
use App\Models\User;
use App\Models\DocumentationTicket;
use App\Models\NotificationUser;
use App\Models\TicketStatus;
use App\Models\TicketType;
use App\Notifications\TicketStatusChanged;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    // Solo los usuarios crean tickets
    // Solos agentes actualizan el estado del ticket
    public function index() {
       $tickets = Ticket::all();
       $tickets_type = TicketType::all();
       $tickets_status = TicketStatus::all();
        
      
       $notificaciones = Ticket::with('agentNotifications')->get();
       $user_notifications = Ticket::with('userNotifications')->get();

       return view('tickets.tickets')
       ->with('tickets', $tickets)
       ->with('notificaciones', $notificaciones)
       ->with('user_notifications', $user_notifications)
       ->with('tickets_type', $tickets_type)
       ->with('tickets_status', $tickets_status);
    }

    public function create(){
        $response = file_get_contents('https://restcountries.com/v3.1/all?fields=name,cca2');
        $countries = json_decode($response,true);

        $countries_name = array_map(function ($countries){
            return $countries['name']['common'];
        }, $countries);
        sort($countries_name, SORT_STRING | SORT_FLAG_CASE);
        
        $countryy = array();
        foreach($countries_name as $name){
             $countryy[]= $name;
        }


        $state = TicketStatus::all();
        $types = TicketType::all();
        $modeoftransport = ModelOfTransport::all();



        return view('tickets.create',compact('state','countryy','modeoftransport','types'));

    }

    public function store(Request $request){


        $validated = $request->validate([
            'file'                      => 'nullable|file|max:2048',
        ]);

        $ticket = new Ticket();

        $ticket->name                   = $request->get('name');
        $ticket->type                   = $request->get('ticket_type');
        $ticket->mode_of_transport      = $request->get('transport');
        $ticket->product                = $request->get('product');
        $ticket->product_condition      = $request->get('product_condition');
        $ticket->country_origin         = $request->get('country_origin');
        $ticket->country_destination    = $request->get('country_destination');

        $ticket->save();

        $userid = Auth::id();

        if($validated){

            $path = $request->file('file')->store('tickets_docs','public');

            $docreate = new DocumentationTicket();

            $docreate->ticket_id = $ticket->id;
            $docreate->file_path = $path;
            $docreate->uploaded_by = $userid;
            $docreate->save();

        }
       

        
        $ticket_id = $ticket->id;

        NotificationAgent::create([
            'ticket_id' => $ticket_id,
            'user_id'   => $userid,
            'detail'    => 'New Ticket'
        ]);

        $user = User::find($userid);
        $user = $user->notify(new TicketStatusChanged($ticket));
        
        $tickets = Ticket::all();

        return view('tickets.tickets')->with('tickets', $tickets);
    }

    public function updateStatus(Request $request, $ticketid){
        $ticket = Ticket::find($ticketid);
        
        $ticket->status = $request->get('status');

        $ticket->save();

        $userid = Auth::id();

        $tickets = Ticket::all();
        $tickets_type = TicketType::all();
        $tickets_status = TicketStatus::all();

        if($request->get('notification')){
            NotificationUser::create([
            'ticket_id' => $ticketid,
            'agent_id'   => $userid,
            'detail'    => 'notification'

            ]);
            $user = User::find($userid);
            $user = $user->notify(new TicketStatusChanged($ticket));
        }

        return redirect()->route('tickets.index')
        ->with('tickets', $tickets)
        ->with('tickets_type', $tickets_type)
        ->with('tickets_status', $tickets_status)
        ->with('success', 'Ticket Uploaded');
    }

    public function destroy($ticketid)
    {
        
        $ticket = Ticket::find($ticketid);
        $ticket->delete();

        $tickets = Ticket::all();
        return redirect()->route('tickets.index')->with('success', 'Ticket Deleted');
    }

    public function getAgentCustomNotification($id){
        $notification = NotificationAgent::agentCustomTicketNotification($id);

        return response()->json($notification);
    }
}
