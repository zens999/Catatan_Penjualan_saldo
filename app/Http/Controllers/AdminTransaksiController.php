<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setor;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Events\PendapatanDitTarik;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PendapatanDitTarikNotification;

class AdminTransaksiController extends Controller
{
    public function index()
    {
        $karyawans = User::where('role', 'karyawan')->get();
        return view('admin.transaksiLog.index', compact('karyawans'));
    }

    public function showlogs($karyawan_id)
    {
        $transaksis = Transaksi::where('user_id', $karyawan_id)->get();
        $karyawan = User::findOrFail($karyawan_id);
        return view('admin.transaksilog.show', compact('transaksis', 'karyawan'));
    }

    public function tarikSetor(User $karyawan)
{
    $admin = Auth::user();

    // Pastikan yang mengakses adalah admin
    if ($admin->role !== 'admin') {
        return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk melakukan aksi ini.');
    }

    // Ambil total pendapatan karyawan
    $nominal = $karyawan->pendapatan;

    if ($nominal <= 0) {
        return redirect()->back()->with('error', 'Tidak ada pendapatan yang bisa ditarik.');
    }
    if (!($admin instanceof User)) {
        return redirect()->back()->with('error', 'Admin tidak valid.');
    }
    
    // Tambahkan pendapatan ke admin
    $admin->pendapatan += $nominal;
    $admin->save();

    // Reset pendapatan karyawan
    $karyawan->pendapatan = 0;
    $karyawan->save();

    // Catat riwayat penarikan di tabel setors
    Setor::create([
        'karyawan_id' => $karyawan->id,
        'admin_id' => $admin->id,
        'nominal' => $nominal,
        'tanggal_ditarik' => now(),
    ]);

    // Kirim notifikasi ke karyawan bahwa pendapatan sudah ditarik
    // event(new PendapatanDitTarik($karyawan->id, $nominal));
    $karyawan->notify(new PendapatanDitTarikNotification($nominal));

    event(new PendapatanDitTarik($karyawan, $nominal));
   

    return redirect()->back()->with('success', 'Pendapatan berhasil ditarik.');
}
}
