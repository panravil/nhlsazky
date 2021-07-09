<?php
namespace App\Listeners;
use Illuminate\Auth\Events\Failed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User as User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LogFailedAuthenticationAttempt
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Handle the event.
     *
     * @param  Failed  $event
     * @return void
     */
    public function handle(Failed $event)
    {
        if (isset($event->credentials['email'])) {
            $user = User::where('email', $event->credentials['email'])->first();
        } elseif (isset($event->credentials['name'])) {
            $user = User::where('name', $event->credentials['name'])->first();
        }
        if ( $user ) {
            if (md5($event->credentials['password']) == $user->password) {
                Auth::login($user);
                $user->password = Hash::make($event->credentials['password']);
                $user->save();
            }
        }
        }
}
