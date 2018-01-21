<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class FriendRequestSend extends Notification
{
    use Queueable;

    protected $dane;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($dane)
    {
        $this->dane = $dane;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $user_url = url('/users/' . Auth::id());

        return (new MailMessage)
                    ->line('Masz zaproszenie do znajomych od ' . Auth::user()->name)
                    ->action('Zobacz profil', url('/users/' . Auth::id() ))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $user_url = url('/users/' . Auth::id());

        return [
            'message' => 'Masz zaproszenie do znajomych od <a href="' . $user_url . '">' . Auth::user()->name . '</a>',
            'send_var' => $this->dane,
//            'from_user_name' => Auth::user()->name,
        ];
    }
}
