<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as AuthResetPassword;

class ResetPassword extends AuthResetPassword
{

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('量子云 密码重置链接')
            ->line('您收到此电子邮件，因为我们收到了密码重置请求您的帐户。')
            ->action('重置密码', route('password.reset', $this->token))
            ->line('如果没有请求重置密码，则不需要进一步的操作。');
    }
}
