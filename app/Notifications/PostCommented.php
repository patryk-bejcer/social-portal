<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class PostCommented extends Notification
{
    use Queueable;

    public $thread;
    public $post_id;
    public $comment_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post_id, $comment_id, $thread)
    {
        $this->post_id = $post_id;
        $this->comment_id = $comment_id;
        $this->thread=$thread;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
        return [
            'message' => 'Użytkownik <a href="' . url('/users/' . Auth::id()) . '">' . Auth::user()->name . '</a> skomentował Twój 
                <a href="'. url('/posts/' . $this->post_id ) . '">post</a> <br/> Kliknij <a href="'.url('/posts/' . $this->post_id . '/#comment_' . $this->comment_id ) . '">tutaj</a>
                aby zobaczyć komentarz',
        ];
    }

    public function toBroadcast($notifiable)
    {
        $user_url = url('/users/' . Auth::id());

        return new BroadcastMessage([
            'thread'=>$this->thread,
            'user'=>Auth::user(),
            'message' => 'Użytkownik <a href="' . url('/users/' . Auth::id()) . '">' . Auth::user()->name . '</a> skomentował Twój 
                <a href="'. url('/posts/' . $this->post_id ) . '">post</a> <br/> Kliknij <a href="'.url('/posts/' . $this->post_id . '/#comment_' . $this->comment_id ) . '">tutaj</a>
                aby zobaczyć komentarz',
        ]);
    }


}
