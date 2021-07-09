<?php

namespace App\PHPMailDriver;

use Illuminate\Mail\MailServiceProvider;

class PHPMailServiceProvider extends MailServiceProvider
{
    function registerSwiftTransport()
    {
        $this->app->singleton('swift.transport', function ($app) {
            return new PHPMailTransportManager($app);
        });
    }
}
