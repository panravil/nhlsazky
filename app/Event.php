<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';
    protected $fillable = ['title', 'seo', 'from', 'to', 'bigbanner', 'show', 'show_menu', 'tariff_id', 'note', 'html_template'];


    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }
}
