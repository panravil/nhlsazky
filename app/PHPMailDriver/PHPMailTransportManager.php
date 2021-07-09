<?php

namespace App\PHPMailDriver;

use Illuminate\Mail\TransportManager;

class PHPMailTransportManager extends TransportManager
{
    protected function createPHPMailDriver()
    {
        return new PHPMailTransport();
    }
}
