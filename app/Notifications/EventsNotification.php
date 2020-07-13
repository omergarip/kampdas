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
        return ['database'];
    }

    public function toMail($notifiable)
    {
        $attendee = User::whereEmail($notifiable->getEmailForVerification())->first();
        return (new MailMessage)
                    ->subject("Kampdaş'tan 1 yeni bildiriminiz var!")
                    ->line( $attendee->username . ' adlı kullanıcı oluşturmuş olduğunuz ' . $this->event->title .  ' etkinliğine katıldı.')
                    ->action('Katılanları Görüntüle', url('/etkinlik/' . $this->event->slug))
                    ->markdown('vendor.notifications.notification', ['user' => $this->user] );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $attendee = User::whereEmail($notifiable->getEmailForVerification())->first();
        return [
            'photo' => $attendee->photo,
            'message' => $attendee->username . ' adlı kullanıcı oluşturmuş olduğunuz ' . $this->event->title .  ' etkinliğine katıldı.',
            'slug' => $this->event->slug
        ];
    }
}
