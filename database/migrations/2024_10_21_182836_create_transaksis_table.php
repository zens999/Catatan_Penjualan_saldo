<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('nama_pembeli');
            $table->string('nomor');
            $table->enum('jenis_transaksi', ['saldo', 'pulsa', 'token', 'kuota']);
            $table->integer('jumlah_beli');
            $table->decimal('harga', 15, 2);
            $table->enum('metode_pembayaran', ['cash', 'transfer', 'hutang']);
            $table->decimal('uang_masuk', 15, 2)->nullable();
            $table->decimal('kembalian', 15, 2)->nullable();
            $table->decimal('sisa_hutang', 15, 2)->default(0);
            $table->enum('status', ['lunas', 'belum_lunas']);
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
