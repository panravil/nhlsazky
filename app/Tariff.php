<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tariff extends Model
{
    use SoftDeletes;
    protected $table = 'tariffs';

    protected $fillable = ['title','seo', 'descriptions', 'image', 'package_id', 'color', 'show', 'priceCZK', 'priceEUR', 'start', 'end', 'days'];

    public function events() {
        return $this->hasMany(Tariff::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function transactions() {
        return $this->belongsToMany(Transaction::class);
    }

    public function getShortNameAttribute() {
        if ($this->days > 0) {
            return $this->days;
        } else {
            return $this->title;
        }
    }

    public function getUrlczkAttribute() {
        return '/platba/'.$this->seo.'/czk';
    }


    public function getUrleurAttribute() {
        return '/platba/'.$this->seo.'/eur';
    }
}
