<?php

namespace App\Notifications;

use App\EmailTemplate;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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

        $template = EmailTemplate::findOrFail(1);
        return (new MailExtended)
            ->subject($template->subject)
                    ->greeting('Vítejte na NHLsazeni.cz,')
            ->level('success')
            //->content($template->html_template)
                    ->level('success')
                    ->action('PREMIUM TIPY', 'https://www.nhlsazeni.cz/premium-tipy')
                    ->line('Děkujeme za důvěru a přejeme hodně úspěchů.');
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
