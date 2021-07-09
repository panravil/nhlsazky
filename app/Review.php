<?php

namespace App;

use Arcanedev\Support\Providers\Concerns\HasFactories;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactories;

    protected $table = 'reviews';
    protected $fillable = ['name', 'reviewdate', 'rating', 'content'];

    protected $dates = ['reviewdate'];
}
