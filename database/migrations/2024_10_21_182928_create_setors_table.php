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
        Schema::create('setors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (karyawan)
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade'); // Relasi ke tabel users (admin)
            $table->decimal('nominal', 15, 2); // Nominal yang ditarik
            $table->timestamp('tanggal_ditarik'); // Tanggal penarikan
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setors');
    }
};
