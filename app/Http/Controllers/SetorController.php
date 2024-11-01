<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Setor;
use Illuminate\Http\Request;
use App\Events\PendapatanDitTarik;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PendapatanDitTarikNotification;

class SetorController extends Controller
{
    public function index()
    {
        $setors = Setor::with(['karyawan', 'admin'])->get();

        return view('setors.index', compact('setors'));
    }

    public function create()
    {
        $karyawans = User::where('role', 'karyawan')->get();
        $admins = User::where('role', 'admin')->get();
    
        return view('setors.create', compact('karyawans', 'admins'));
    }
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'karyawan_id' => 'required|exists:users,id', // Validasi karyawan_id
            'admin_id' => 'required|exists:users,id', // Validasi admin_id
            'nominal' => 'required|numeric|min:0', // Validasi nominal
        ]);

        $karyawan = User::find($request->input('karyawan_id')); // Karyawan yang memiliki pendapatan
        $admin = User::find($request->input('admin_id')); // Admin yang akan menerima pendapatan
        $nominal = $request->input('nominal');

        // Cek apakah pendapatan karyawan mencukupi
        if ($karyawan->pendapatan >= $nominal) {
            // Kurangi pendapatan karyawan
            $karyawan->pendapatan -= $nominal;
            $karyawan->save();

            // Tambahkan nominal ke pendapatan admin
            $admin->pendapatan += $nominal;
            $admin->save();

            // Catat setoran di tabel setors dengan `tanggal_ditarik` otomatis saat ini
            Setor::create([
                'karyawan_id' => $karyawan->id,
                'admin_id' => $admin->id,
                'nominal' => $nominal,
                'tanggal_ditarik' => now(),
            ]);

            // Kirim notifikasi dan event ke karyawan
            $karyawan->notify(new PendapatanDitTarikNotification($nominal));
            event(new PendapatanDitTarik($karyawan, $nominal));

            return redirect()->route('setors.index')->with('success', 'Setoran berhasil!');
        } else {
            return redirect()->back()->withErrors('Pendapatan karyawan tidak mencukupi untuk jumlah yang ditarik.');
        }
    }


    
}
