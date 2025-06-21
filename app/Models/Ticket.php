<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

    protected $primaryKey = 'id';

    protected $fillable = ['name', 'type','mode_of_transport','product','product_condition','country_origin','country_destination','status'];

    public function statuses(){
        return $this->hasMany(TicketStatus::class);
    }

    public function documents(){
        return $this->hasMany(DocumentationTicket::class);
    }

    public function agentNotifications(){
        return $this->hasMany(NotificationAgent::class, 'ticket_id');
    }

    public function agentCustomTicketNotification($id){
        $query = NotificationAgent::where('ticket_id',$id)->get();

        return $query;
    }

    public function userNotifications(){
        return $this->hasMany(NotificationUser::class);
    }

    public function docTickets(){
        return $this->hasMany(DocumentationTicket::class);
    }
}
