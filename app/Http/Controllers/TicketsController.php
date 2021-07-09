<?php

namespace App\Http\Controllers;

use App\TicketVote;
use Illuminate\Support\Facades\Auth;

class TicketsController extends Controller
{


    public function upvote($id)
    {
        if (TicketVote::where([['user_id', Auth::user()->id], ['ticket_id', $id]])->count() < 1) {
            $vote = TicketVote::create(['user_id' => Auth::user()->id, 'vote' => 1, 'ticket_id' => $id]);
        }
        return back();
    }

    public function downvote($id)
    {
        if (TicketVote::where([['user_id', Auth::user()->id], ['ticket_id', $id]])->count() < 1) {
            $vote = TicketVote::create(['user_id' => Auth::user()->id, 'vote' => 0, 'ticket_id' => $id]);
        }
        return back();
    }
}
