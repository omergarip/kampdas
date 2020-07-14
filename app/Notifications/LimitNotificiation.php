<?php

namespace App\Notifications;

use App\Event;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LimitNotificiation extends Notification
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
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("Kampdaş'tan 1 yeni bildiriminiz var!")
            ->line( 'Oluşturmuş olduğunuz ' . $this->event->title . ' etkinliğinin kontenjanı dolmuştur. Dilerseniz kamp etkinliğinizi düzenleyerek kontenjanı artırabilir ve daha fazla kişinin kamp etkinliğinize katılmasını sağlayabilirsiniz')
            ->action('Etkinliği Düzenle', url('/etkinlik/' . $this->event->slug . '/duzenle'))
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
        return [
            //
        ];
    }
}
