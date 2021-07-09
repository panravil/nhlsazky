<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;
    protected $table = 'messages';

    protected $fillable = ['id', 'name', 'email', 'text', 'read', 'user_id'];

        public function user(){
        return $this->belongsTo(User::class);
    }
}
