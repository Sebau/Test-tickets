<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentationTicket extends Model
{
    use HasFactory;

    protected $table = 'documentation_tickets';

    protected $fillable = ['ticket_id','file_path','uploaded_by'];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function user(){
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
