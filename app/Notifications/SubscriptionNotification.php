<?php

namespace App\Notifications;

use App\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SubscriptionNotification extends Notification
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $template = EmailTemplate::findOrFail(7);
        return (new MailExtended)
            ->subject($template->subject . $this->details['package'])
            ->greeting('Dobrý den, ')
            ->level('primary')
            ->content($template->html_template)
                    ->line('Balíček je platný do: '. $this->details['to'])
                    ->action('Premium tipy', $this->details['actionURL'])
                    ->line('Toto je automatický e-mail, neodpovídejte!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
