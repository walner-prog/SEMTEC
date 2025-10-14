<?php

 namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificacionTutorDocente extends Notification
{
    use Queueable;

    public $titulo;
    public $mensaje;
    public $color;
    public $tutor_id;

    public function __construct($data)
    {
        $this->titulo = $data['titulo'] ?? 'Sin título';
        $this->mensaje = $data['mensaje'] ?? '';
      
        $this->tutor_id = $data['tutor_id'] ?? null;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'titulo' => $this->titulo,
            'mensaje' => $this->mensaje,
            
            'tutor_id' => $this->tutor_id,
        ];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Notificación del Tutor')
            ->line($this->mensaje);
    }
}

