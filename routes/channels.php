<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('pesan', function ($user) {
    return $user->role === 'karyawan';
});
