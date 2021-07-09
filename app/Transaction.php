<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = ['payment_id', 'tariff_id', 'user_email', 'status', 'activated_date', 'activated_to', 'priceCZK', 'priceEUR'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class);
    }


    public function activate()
    {
        $from = Carbon::now();
        if ($this->tariff->days > 0) {
            $to = $from->copy()->addDays($this->tariff->days);
        } else {
            $to = $this->tariff->to;
        }
        if ($this->activated_date == null) {
            $user = User::where('email', '=', $this->user_email)->first(); // model or null
            if ($user) {
                $user->subscribePackage($this->tariff->package_id, Carbon::now(), $to, $this->tariff->priceCZK, $this->tariff->id, $this->id);
            }
        }
    }


    protected $casts = [
        'activated_date' => 'datetime:d/m/Y',
        'activated_to' => 'datetime:d/m/Y',
    ];
}
