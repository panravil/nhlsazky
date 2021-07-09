<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{

    protected $table = 'subscriptions';

    protected $fillable = ['user_id', 'tariff_id', 'package_id', 'priceCZK','priceEUR', 'from','to','note', 'transaction_id'];


   public function user(){
        return $this->belongsTo(User::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

        public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
        public function tariff(){
        return $this->belongsTo(Tariff::class);
    }

    public function activated_by(){
        return $this->belongsTo(User::class);
    }

    public function getProfitAttribute() {
        if ($this->package->id == 4) {
            return Ticket::where([['created_at', '>=', $this->from],['created_at', '<=', $this->to],['status', '!=', 0],['show', '=', 1]])->sum('profit')*500;
        } else {
            return Ticket::where([['package_id', '=', $this->package_id],['created_at', '>=', $this->from],['created_at', '<=', $this->to],['status', '!=', 0],['show', '=', 1]])->sum('profit')*500;
        }
    }

    protected $casts = [
        'from' => 'datetime:d/m/Y',
        'to' => 'datetime:d/m/Y',
    ];
}
