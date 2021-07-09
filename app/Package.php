<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use SoftDeletes;
    protected $table = 'packages';

    protected $fillable = ['title','seo', 'desc', 'sport','color', 'show'];

    public function tariffs(){
        return $this->hasMany(Tariff::class);
    }

    public function stats(){
        return $this->hasMany(Stat::class);
    }

    public function activeTariffs() {
        return $this->hasMany(Tariff::class)->where([['show', '=', 1]])->orWhere([['start', '<=', date('Y-m-d')],['end', '>=', date('Y-m-d')]]);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketsAvalible()
    {
        return $this->hasMany(Ticket::class)->where('show', '=', 1)->orderByDesc('created_at');
    }

    public function ticketsOld()
    {
        return $this->hasMany(Ticket::class)->where([['show', '=', 1], ['status', '>', 0]])->orderByDesc('created_at');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscriptionsValid()
    {
        return $this->hasMany(Subscription::class)->where('to', '>=', date('Y-m-d'));
    }
}
