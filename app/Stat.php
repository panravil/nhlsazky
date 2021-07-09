<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stat extends Model
{

    protected $table = 'stats';

    protected $fillable = ['package_id', 'title', 'seo', 'season','from', 'to'];

    public function package(){
        return $this->belongsTo(Package::class);
    }


    protected $casts = [
        'from' => 'datetime:d/m/Y',
        'to' => 'datetime:d/m/Y',
    ];
}
