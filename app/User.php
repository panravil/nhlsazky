<?php

namespace App;

use App\Notifications\EmailVerificationNotification;
use App\Notifications\PasswordResetNotification;
use App\Notifications\SubscriptionNotification;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'jmeno', 'prijmeni', 'telefon',
        'last_login_at',
        'last_login_ip',
        'ip',
        'newsletter',
        'notifications',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ip'
    ];

    public function isAdmin()
    {
        return (\Auth::check() && $this->admin == 1);
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'notifications' => 'bool',
        'newsletter' => 'bool'
    ];

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function subscriptionsValid()
    {
        return $this->hasMany(Subscription::class)->where('to', '>=', date('Y-m-d'));
    }

    public function subscriptionValid($id)
    {
        return $this->hasMany(Subscription::class)->where('package_id', '=', $id)->where('to', '>=', date('Y-m-d'));
    }

    public function subscriptionsInValid()
    {
        return $this->hasMany(Subscription::class)->where('to', '<', date('Y-m-d'))->orderBy('id', 'desc');
    }

    public function contacts()
    {
        return $this->hasMany(Message::class);
    }

    public function isSubscribed($id)
    {
        return ($this->subscriptions()->where('to', '>=', date('Y-m-d'))->where('package_id', '=', $id)->count() > 0 or $this->subscriptions()->where('to', '>=', date('Y-m-d'))->where('package_id', '=', 4)->count() > 0);
    }

    public function subscriptionsIds()
    {
        $subs = $this->subscriptionsValid()->pluck('package_id')->toArray();
        if (in_array(4, $subs, TRUE)) {
            return Package::all()->pluck('id')->toArray();
        } else {
            return $subs;
        }
    }

    public function findSub($id)
    {
        return $this->subscriptions->where('to', '>=', date('Y-m-d'))->where('package_id', '=', $id)->first();
    }

    public function packagesAll()
    {
        return Package::all()->whereIn('id', $this->subscriptionsIds());
    }


    public function packagesRest()
    {
        return Package::all()->whereNotIn('id', $this->subscriptionsIds());
    }

    public function contestTips()
    {
        return $this->hasMany(ContestTip::class);
    }

    public function contestTipsWeek()
    {
        return $this->hasMany(ContestTip::class);
    }

    public function subscribePackage($package_id, $from, $to, $price = 0, $tarif = null, $transaction = null)
    {
        try {
            $to = new Carbon($to);
            $from = new Carbon($from);
            $sube = $this->findSub($package_id);
            if ($sube) {
                $difference = $from->startOfDay()->diff($to->startOfDay())->days;
                $sube->priceCZK += $price;
                $to = $sube->to->addDays($difference);
                $sube->to = $to;
                $sube->save();
            } else {
                $sub = new Subscription([
                    'from' => $from,
                    'to' => $to,
                    'user_id' => $this->id,
                    'package_id' => $package_id,
                    'tariff_id' => $tarif,
                    'transaction_id' => $transaction,
                    'priceCZK' => $price
                ]);
                $sub->save();
            }
            if ($transaction) {
                try {
                    $t = Transaction::findOrFail($transaction);
                    $t->activated_date = Carbon::now();
                    $t->active_to = $to;
                    $t->save();
                } catch (\Exception $e) {
                    Log::error('Predplatne error uzivatel:' . $this->email . ' balicek:' . $package_id, ['id' => $this->id, 'ip' => \Request::getClientIp(true)]);
                }
            }
            $package = Package::findOrFail($package_id);
            Log::info('Predplatne pridane uzivatel:' . $this->email . ' balicek:' . $package->title, ['id' => $this->id, 'ip' => \Request::getClientIp(true)]);
            $details = [
                'package' => $package->title,
                'to' => $sub->to->format('d.m.Y'),
                'actionURL' => url(route('premium'))
            ];
            try {

            $this->notify(new SubscriptionNotification($details));
            } catch (\Exception $e) {
                dd($e);
            }

            return true;
        } catch (\Exception $e) {
            $package = Package::findOrFail($package_id);
            Log::error('Predplatne selhalo uzivatel:' . $this->email . ' balicek:' . $package->title, ['id' => $this->id, 'ip' => \Request::getClientIp(true)]);
            return false;
        }
    }


    public function packagesActive()
    {
        return $this->subscriptionsValid()->pluck('package_id')->toArray();
    }

    public function ticketsAvalible()
    {
        return Ticket::where('show', 1)->whereIn('package_id', $this->subscriptionsIds())->orderBy('created_at', 'DESC')->limit(12)->get();
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new EmailVerificationNotification());
    }
}
