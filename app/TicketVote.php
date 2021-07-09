<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketVote extends Model
{
    protected $table = 'ticket_votes';

    protected $fillable = ['user_id','ticket_id', 'vote'];


    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function user(){
        return $this->belongsTo(Ticket::class);
    }
}
