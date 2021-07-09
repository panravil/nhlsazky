<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Match extends Model
{
    use SoftDeletes;
    protected $table = 'matches';

    protected $fillable = ['start', 'host_team', 'guest_team', 'tournament_id', 'descriptions', 'winner', 'score_host', 'score_guest', 'week','gameId',
        'stream_url', 'show', 'notified', 'created_at'];

    public function contestTips()
    {
        return $this->hasMany(ContestTip::class);
    }

    public function evaluteTips()
    {
        foreach ($this->contestTips as $tip) {
            $tip->update(['result' => $this->winner == $tip->tip ? 2 : ($this->winner == 0 ? 0 : -2)]);
        }
    }

    protected $casts = [
        'start' => 'datetime',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function getFullnameAttribute()
    {
        return $this->host->name . ' - ' . $this->guest->name;
    }

    public function getFulllabelAttribute()
    {
        return $this->host->name . ' - ' . $this->guest->name . '(' . $this->start . ')';
    }


    public function getTimelabelAttribute()
    {
        $match_stav = "NEXT";
        if ($this->start < Carbon::now() AND Carbon::now() < $this->start->addHours(3)) {
            $match_stav = "LIVE";
        } elseif ($this->start->addHours(-1) < Carbon::now() AND Carbon::now() < $this->start->addHours(3)) {
            $match_stav = "EARLY";
        } elseif (Carbon::now() > $this->start->addHours(3)) {
            $match_stav = "END";
        }
        return $match_stav;
    }


    public function host()
    {
        return $this->belongsTo(Team::class, 'host_team');
    }

    public function guest()
    {
        return $this->belongsTo(Team::class, 'guest_team');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
