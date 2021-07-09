<?php

namespace App\PHPMailDriver;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;

class PHPMailTransport extends Transport
{
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);

        $to = implode(',', array_keys($message->getTo()));
        $subject = $message->getSubject();
        $headers = $message->getHeaders();
        $headers->remove('to');
        $headers->remove('subject');

        mail($to, $subject, $message->getBody(), $headers->toString());

        $this->sendPerformed($message);

        return $this->numberOfRecipients($message);
    }

}
