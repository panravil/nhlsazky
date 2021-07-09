<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    protected $table = 'contest';

    protected $fillable = ['datum', 'user_id', 'vyhra', 'tydenrok'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    protected $casts = [
        'datum' => 'datetime:d/m/Y'
    ];
}
