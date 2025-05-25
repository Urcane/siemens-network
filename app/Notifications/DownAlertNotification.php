<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class DownAlertNotification extends Notification
{
    use Queueable;

    protected $item;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($site_item)
    {
        $this->item = $site_item;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['telegram'];
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
            //
        ];
    }

    public function toTelegram($notifiable)
    {
        $downtime = Carbon::parse($this->item->rxtime);

        return TelegramMessage::create()
            ->to($notifiable->routes['telegram'])
            ->content("Alert! Jaringan Down untuk Site {$this->item->site_name} ({$this->item->ip}), Lagi Down 😿 pada  {$downtime} WIB");
    }
}
