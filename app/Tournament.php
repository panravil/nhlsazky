<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tournament extends Model
{
    use SoftDeletes;
    protected $table = 'tournament';

    protected $fillable = ['name', 'icon','from','to', 'location', 'season', 'description', 'show'];

    public function teams(){
        return $this->hasMany(Team::class);
    }

    public function matches(){
        return $this->hasMany(Match::class);
    }
}
