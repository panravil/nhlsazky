<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestTip extends Model
{
    protected $table = 'contest_tips';

    protected $fillable = ['datum', 'user_id', 'match_id', 'tip','result'];


   public function user(){
        return $this->belongsTo(User::class);
    }

    public function match(){
        return $this->belongsTo(Match::class);
    }


    protected $casts = [
        'datum' => 'datetime:d/m/Y'
    ];
}
