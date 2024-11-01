<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $saldo = $user->saldo;
        $today = Carbon::today();
        
        $pendapatanHariIni =  Transaksi::where('user_id', $user->id)
        ->whereDate('created_at', $today) 
        ->sum('uang_masuk');

        return view('dashboard', compact('saldo', 'pendapatanHariIni'));
    }

    public function addSaldo(Request $request)
    {
        // Validasi input saldo
        $request->validate([
            'saldo' => 'required|numeric|min:1',
        ]);
    
        $user = Auth::user();
    
        if ($user->role == 'admin') {
            // Update saldo menggunakan query builder
            User::where('id', $user->id)->update([
                'saldo' => $user->saldo + $request->input('saldo')
            ]);
    
            return redirect()->route('dashboard')->with('success', 'Saldo berhasil ditambahkan.');
        }
    
        return redirect()->route('dashboard')->with('error', 'Hanya admin yang dapat menambah saldo.');
    }
    

}
