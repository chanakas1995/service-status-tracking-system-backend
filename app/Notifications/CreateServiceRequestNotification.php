<?php

namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateServiceRequestNotification extends Notification
{
    use Queueable;

    public $serviceRequest;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($serviceRequest)
    {
        $this->serviceRequest = $serviceRequest;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', SmsChannel::class];
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
            ->subject("Service Request Created")
            ->greeting("Hello " . $notifiable->name . ",")
            ->line('Your service request has been created successfully.')
            ->line('Reference code : ' . $this->serviceRequest->code)
            // ->action('Login', config('general.frontend_url') . '/login')
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

    public function toSms($notifiable)
    {
        return "Your service request has been created successfully.\nReference code:  "
            . $this->serviceRequest->code . ".\n\n" . env('APP_NAME');
    }
}
