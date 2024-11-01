<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSisaHutangTypeInTransaksisTable extends Migration
{
    public function up()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->string('sisa_hutang')->change(); // Mengubah ke tipe data string
        });
    }

    public function down()
    {
        Schema::table('transaksis', function (Blueprint $table) {
            $table->decimal('sisa_hutang')->change(); // Kembali ke tipe data sebelumnya
        });
    }
}
