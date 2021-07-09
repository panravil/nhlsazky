<?php

namespace App\Notifications;

use App\EmailTemplate;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PackageNotification extends Notification
{
    use Queueable;

    private $details;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }


    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $template = EmailTemplate::findOrFail(3);
        $htmll = $template->html_template;
        foreach ($this->details['packages'] as $package) {
            $tickets = $package->tickets->where('status', '<', 1)->where('match_start', '>', Carbon::now());
            if ($tickets->count() < 1)
                continue;

            $htmll .= '<h2>'.$package->title.'</h2>';
            $htmll .= '<hr>';
            foreach ($tickets as $t) {
                $htmll .= "<div><div>Datum: <b>" . $t->match_start . "</b></div>
                <div>Zápas: <b>" . $t->match_title . "</b></div>
                <div>Tip: <b>" . $t->tip . "</b></div>
                <div>Kurz: <b>" . $t->odd . "</b>   Vklad: <b>" . $t->cost . "/10" . "</b></div></div><br><hr>";
            }
            $htmll .= '<br>';
        }
        return (new MailExtended)
            ->subject($template->subject)
            ->greeting('')
            ->level('primary')
            ->content($htmll)
            ->action('Zobrazit balíček', $this->details['actionURL'])
            ->line('Toto je automatický e-mail, neodpovídejte!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
