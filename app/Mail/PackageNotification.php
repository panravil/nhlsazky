<?php

namespace App\Mail;

use App\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PackageNotification extends Mailable
{
    use Queueable, SerializesModels;

    private $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $template = EmailTemplate::findOrFail(3);
        $subject = $template->subject . $this->details['package'];
        $greeting = 'Dobrý den,';
        $level = 'success';
        $content = $template->html_template;
        $actionUrl = $this->details['actionURL'];
        $action = 'Zobrazit balíček';
        $introLines =  [];
        $outroLines =  ['Toto je automatický e-mail, neodpovídejte!'];
        return $this->markdown('vendor.notifications.email', compact(['subject','greeting' , 'level', 'content', 'action', 'actionUrl',  'introLines', 'outroLines']));
    }
}
