<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $table = 'redirects';
    protected $fillable = ['title', 'seo', 'desc','img', 'url',
        'broker_id', 'position_id'];
}
