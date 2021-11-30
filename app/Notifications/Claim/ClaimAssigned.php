<?php

namespace App\Notifications\Claim;

use App\Models\Citizen\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ClaimAssigned extends Notification
{
    use Queueable;

    /**
     * @var Claim
     */
    private Claim $claim;

    /**
     * Create a new notification instance.
     *
     * @param Claim $claim
     */
    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
            'message' => 'شكوى',
            'claim' => $this->claim->toArray(),
            'icon' => 'printer',
        ];
    }
}
