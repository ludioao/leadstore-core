<?php

namespace LeadStore\Framework\User\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VerifiedUpdate extends Notification
{
    /**
     * The password reset token.
     *
     * @var string
     */
    public $verified;

    /**
     * Create a notification instance.
     *
     * @param  string $token
     * @return void
     */
    public function __construct($val)
    {
        $this->verified = $val;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = "Conta ";
        if ($this->verified) {
            $subject .= "Aprovada";
        } else {
            $subject .= "Reprovada!";
        }
        return (new MailMessage)
            ->greeting('Olá')
            ->subject($subject)
            ->line('Você está recebendo este e-mail, por que sua conta foi atualizada em nosso sistema.')
            ;
    }
}
