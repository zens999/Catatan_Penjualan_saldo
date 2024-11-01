<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::where('user_id', Auth::id())->get();
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        return view('transaksi.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_pembeli' => 'required|string|max:255',
            'nomor' => 'required|string',
            'jenis_transaksi' => 'required|in:saldo,pulsa,token,kuota',
            'jumlah_beli' => 'required|integer',
            'harga' => 'required|numeric',
            'metode_pembayaran' => 'required|in:cash,transfer,hutang',
            'uang_masuk' => 'nullable|numeric',
        ]);

        $user = Auth::user();
        $jumlah_beli = $request->input('jumlah_beli');
        
        if ($user->saldo < $jumlah_beli) {
            return redirect()->back()->with('error', 'Saldo tidak cukup untuk melakukan transaksi.');
        }
        if ($user instanceof \App\Models\User) {
            // Ini akan memastikan bahwa $user adalah instance dari User
            $user->saldo -= $jumlah_beli;
            $user->save();
        } else {
            // Jika bukan instance dari User, tampilkan pesan error atau lakukan tindakan lainnya
            return redirect()->back()->with('error', 'Terjadi kesalahan pada proses autentikasi pengguna.');
        }
        


        // Logika untuk perhitungan kembalian dan hutang
        $uang_masuk = intval($request->input('uang_masuk', 0)); // Default ke 0 jika null
        $harga = intval($request->input('harga'));
        $kembalian = 0;
        $sisa_hutang = 0;
        $status = 'belum_lunas';
    
        if ($uang_masuk >= $harga) {
            $status = 'lunas';
            $kembalian = intval($uang_masuk - $harga);
        } else {
            $sisa_hutang = intval($harga - $uang_masuk);
        }
    
        if ($request->input('metode_pembayaran') == 'hutang') {
            $sisa_hutang = intval($harga);
            $status = 'belum_lunas';
        }

        if ($user->role === 'karyawan') {
            $user->pendapatan += $request->input('harga');
            $user->save();
        }
    
        // Simpan data transaksi
        $transaksi = Transaksi::create([
            'user_id' => Auth::id(), // Gunakan Auth::id() untuk mendapatkan ID pengguna
            'nama_pembeli' => $request->input('nama_pembeli'),
            'nomor' => $request->input('nomor'),
            'jenis_transaksi' => $request->input('jenis_transaksi'),
            'jumlah_beli' => $request->input('jumlah_beli'),
            'harga' => $harga,
            'metode_pembayaran' => $request->input('metode_pembayaran'),
            'uang_masuk' => $uang_masuk,
            'kembalian' => $kembalian,
            'sisa_hutang' => $sisa_hutang,
            'status' => $status,
        ]);

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return view('transaksi.edit', compact('transaksi'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'uang_masuk' => 'required|numeric',
        ]);
    
        // Temukan transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);
    
        // Jumlah uang yang sudah masuk sebelumnya
        $uangMasukSebelumnya = $transaksi->uang_masuk;
    
        // Uang masuk baru dari input
        $uangMasukBaru = $request->input('uang_masuk');
    
        // Total uang masuk setelah pembayaran baru
        $totalUangMasuk = $uangMasukSebelumnya + $uangMasukBaru;
    
        // Hitung kembalian dan sisa hutang
        $harga = $transaksi->harga;
    
        if ($totalUangMasuk >= $harga) {
            $transaksi->kembalian = $totalUangMasuk - $harga;
            $transaksi->sisa_hutang = 0; // Atur sisa hutang ke 0
            $transaksi->status = 'lunas';
        } else {
            $transaksi->kembalian = 0;
            $transaksi->sisa_hutang = $harga - $totalUangMasuk; // Hitung sisa hutang
            $transaksi->status = 'belum_lunas';
        }
    
        // Simpan perubahan
        $transaksi->uang_masuk = $totalUangMasuk;
        $transaksi->save();
    
        return redirect()->route('transaksis.index')->with('success', 'Transaksi berhasil diperbarui.');
    }
}
