<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;


class NotificationController extends Controller
{
    public function markAsRead($id)
{
    $notification = DatabaseNotification::find($id);

    if ($notification && $notification->notifiable_id === Auth::id()) {
        $notification->markAsRead();
        return redirect()->back()->with('success', 'Notifikasi telah ditandai sebagai sudah dibaca.');
    }

    return redirect()->back()->with('error', 'Notifikasi tidak ditemukan atau Anda tidak memiliki akses.');
}
}
