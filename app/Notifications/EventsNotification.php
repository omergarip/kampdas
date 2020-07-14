<?php

namespace App\Notifications;

use App\Event;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventsNotification extends Notification
{
    use Queueable;

    protected $user;
    protected $event;

    public function __construct(User $user, Event $event)
    {
        $this->user = $user;
        $this->event = $event;
    }

    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    public function toMail($notifiable)
    {
        $attendee = User::whereEmail($notifiable->getEmailForVerification())->first();
        return (new MailMessage)
                    ->subject("Kampdaş'tan 1 yeni bildiriminiz var!")
                    ->line( $this->user->username . ' adlı kullanıcı oluşturmuş olduğunuz ' . $this->event->title .  ' etkinliğine katıldı.')
                    ->action('Katılanları Görüntüle', url('/etkinlik/' . $this->event->slug))
                    ->markdown('vendor.notifications.notification', ['user' => $attendee] );
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
            'photo' => $this->user->photo,
            'message' => $this->user->username . ' adlı kullanıcı oluşturmuş olduğunuz ' . $this->event->title .  ' etkinliğine katıldı.',
            'slug' => $this->event->slug
        ];
    }
}
