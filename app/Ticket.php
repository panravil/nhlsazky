<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $dates = ['match_start'];

    protected $fillable = ['type', 'package_id', 'match_id', 'match', 'match_start', 'tip', 'odds', 'cost', 'profit', 'status', 'note', 'show', 'notified', 'created_at'];

    public function votes()
    {
        return $this->hasMany(TicketVote::class);
    }

    public function hasVoted() {
        if ($this->votes()->where('user_id', Auth::user()->id)->count() > 0) {
            return true;
        }
        return false;
    }

    public function getVoteRatioAttribute()
    {
        return $this->votes()->where('vote', '=', true)->count()*100 / $this->votes()->count();
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function ticketsWaiting()
    {
        return Ticket::where('status' == null);
    }

    public function match()
    {
        return $this->belongsTo(Match::class);
    }

    public function x()
    {
        if ($this->match_id) {
            return $this->match->fullname;
        } else {
            return $this->match;
        }
    }

    public function getStavikAttribute()
    {
        $stavy = ['NEVYHODNOCENO', 'VÝHRA', 'PROHRA', 'VRACEN VKLAD'];
        return $stavy[$this->status];
    }

    public function getStavAttribute()
    {
        $stavy = ['nevyhodnocen', 'vyhra', 'prohra', 'vracen_vklad'];
        return $stavy[$this->status];
    }

}
