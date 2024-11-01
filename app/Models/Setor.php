<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setor extends Model
{
    use HasFactory;

    protected $fillable = [
        'karyawan_id', 
        'admin_id', 
        'nominal', 
        'tanggal_ditarik'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function karyawan()
    {
        return $this->belongsTo(User::class, 'karyawan_id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
