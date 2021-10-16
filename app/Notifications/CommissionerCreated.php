<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CommissionerCreated extends Notification
{
    use Queueable;

    private string $plainPassword;
    private string $email;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $plainPassword, string $email)
    {
        $this->plainPassword = $plainPassword;
        $this->email = $email;
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
        return (new MailMessage)
            ->line('Un compte magistrat a été créer')
            ->line('email: '. $this->email)
            ->line('mot de passe: '. $this->plainPassword)
            ->action('Se connecter', url('/login'));
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
