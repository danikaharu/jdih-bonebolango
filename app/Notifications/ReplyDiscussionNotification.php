<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReplyDiscussionNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $comments;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($comments)
    {
        $this->comments = $comments;
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
            ->subject('Notifikasi Balasan Komentar')
            ->greeting($this->comments['greeting'])
            ->line('Ini adalah balasan dari Admin JDIH')
            ->action('Lihat Komentar', $this->comments['actionURL'])
            ->line('Terima kasih atas partisipasi anda!');
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
