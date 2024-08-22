<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('nomorpengajuan')->unique();
            $table->string('nama');
            $table->string('nik');
            $table->string('tempat');
            $table->date('tanggallahir');
            $table->string('alamat');
            $table->string('kelurahan');
            $table->string('pekerjaan');
            $table->string('jenissurat');
            $table->string('noreg')->unique();
            $table->date('tanggal');
            $table->string('surattanah');
            $table->string('suratpermohonan');
            $table->string('ktp');
            $table->string('status');
            $table->string('statussurat')->default('Tidak Ter-Register');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan');
    }
};
