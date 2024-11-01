<?php
namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PendapatanDitTarik implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $nominal;
    public $karyawan;

    public function __construct($karyawan, $nominal)
    {
        $this->karyawan = $karyawan;
        $this->nominal = $nominal;
        $this->message = "Pendapatan Anda sebesar Rp. " . number_format($nominal, 0, ',', '.') . " telah ditarik oleh admin.";
    }

    public function broadcastOn()
    {
        return new PrivateChannel('pesan');
    }
}
