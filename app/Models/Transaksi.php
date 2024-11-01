<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pembeli', 
        'nomor', 
        'jenis_transaksi', 
        'jumlah_beli', 
        'harga', 
        'metode_pembayaran', 
        'uang_masuk', 
        'kembalian', 
        'sisa_hutang', 
        'status'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
