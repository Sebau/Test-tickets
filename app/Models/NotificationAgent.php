<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationAgent extends Model
{
    use HasFactory;

    protected $table = 'notification_agents';

    protected $fillable = ['ticket_id','user_id','detail','is_read'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function agentCustomTicketNotification($id){
        $query = NotificationAgent::where('ticket_id',$id)->get();

        return $query;
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}
