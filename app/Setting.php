<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    protected $fillable = ['live_enable', 'live_show', 'live_chat', 'topbar_enable', 'topbar_text'];
}
