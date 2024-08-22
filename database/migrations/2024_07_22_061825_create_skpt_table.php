<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skpt', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('nomorsurat')->unique();
            $table->string('noreg')->unique();
            $table->string('nama');
            $table->string('kelurahan');
            $table->string('rt', 10);
            $table->string('rw', 10);
            $table->string('utara');
            $table->string('selatan');
            $table->string('timur');
            $table->string('barat');
            $table->string('ukuranutara', 10);
            $table->string('ukuranselatan', 10);
            $table->string('ukurantimur', 10);
            $table->string('ukuranbarat', 10);
            $table->string('luas');
            $table->string('dasar');
            $table->string('letak');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skpt');
    }
};
