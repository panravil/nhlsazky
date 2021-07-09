<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    protected $table = 'blog';
    protected $fillable = ['title', 'descriptions', 'image', 'seo', 'html_template', 'user_id', 'show'];
}
