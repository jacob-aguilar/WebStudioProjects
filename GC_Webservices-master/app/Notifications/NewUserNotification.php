<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewUserNotification extends Notification
{
    use Queueable;

    protected $contrasenia;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($contrasenia)
    {
        $this->contrasenia = $contrasenia;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Bienvenido al sistema de administración de Gym Control')
            ->greeting("Hola! ".$notifiable->name)
            ->line('Bienvenido al sistema de administración de Gym Control')
            ->line("Ingresa al sistema con tu correo y con la siguiente contraseña:" . $this->contrasenia)
            ->action('Ir al sitio', url(env("APP_URL")))
            ->line('Gracias por usar nuestra aplicación');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
