<?php

namespace App\Http\Controllers;

use App\Models\Setor;
use Barryvdh\DomPDF\PDF;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Menampilkan laporan pada halaman view
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $user = Auth::user();
        $user_id = $user->id; // Mendapatkan ID pengguna yang sedang login

        // Ambil semua data transaksi yang lunas berdasarkan user_id
        $transaksis = Transaksi::where('user_id', $user_id)->get();

        // Ambil data setor berdasarkan user_id
        $setors = Setor::where('karyawan_id', $user_id)->get();

        return view('laporan.index', compact('transaksis', 'setors'));
    }

    // Menghasilkan dan mengunduh PDF
    public function exportPDF()
    {
        // Ambil semua data transaksi yang belum lunas
        $transaksis = Transaksi::where('status', 'belum lunas')->get();
        $setors = Setor::all();

        // Muat view untuk PDF
        $pdf = PDF::loadView('laporan.pdf', compact('transaksis', 'setors'));

        // Mengunduh PDF dengan nama file yang sesuai
        return $pdf->download('laporan-transaksi-belum-lunas.pdf');
    }
}
