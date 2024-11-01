<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class PendapatanDitTarikNotification extends Notification
{
    use Queueable;

    protected $nominal;

    public function __construct($nominal)
    {
        $this->nominal = $nominal;
    }

    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'message' => "Pendapatan Anda sebesar Rp. {$this->nominal} telah ditarik oleh admin.",
            'nominal' => $this->nominal,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'message' => "Pendapatan Anda sebesar Rp. {$this->nominal} telah ditarik oleh admin.",
            'nominal' => $this->nominal,
        ]);
    }
}
