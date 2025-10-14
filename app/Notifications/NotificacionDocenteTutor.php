<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NotificacionDocenteTutor extends Notification
{
    use Queueable;

    public $mensaje;

    public function __construct($mensaje)
    {
        $this->mensaje = $mensaje;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'titulo' => 'Mensaje del docente',
            'mensaje' => $this->mensaje,
            'color' => 'text-green-500'
        ];
    }
}
