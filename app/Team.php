<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;
    protected $table = 'teams';

    protected $fillable = ['name', 'icon', 'tournament_id', 'show'];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function host_matches()
    {
        return $this->hasMany('Match', 'host_team');
    }

    public function guest_matches()
    {
        return $this->hasMany('Match', 'guest_team');
    }
}
