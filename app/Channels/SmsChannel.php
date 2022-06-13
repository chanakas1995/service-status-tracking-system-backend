<?php

namespace App\Channels;

use App\Models\User;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Http;

class SmsChannel
{
    private $userId, $password;

    /**
     * Create a new sms channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->userId = config('textit.user_id');
        $this->password = config('textit.password');
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return void
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSms($notifiable);

        $status = Http::get('https://www.textit.biz/sendmsg', [
            'id' => $this->userId,
            'pw' => $this->password,
            'to' => '+94' . $notifiable->customer->mobile,
            'text' => $message,
        ]);
    }
}
