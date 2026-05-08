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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade');
            $table->foreignId('paket_id')->constrained('paket_gym')->onDelete('cascade');
            $table->date('waktu_mulai');
            $table->date('waktu_berakhir');
            $table->decimal('total_harga', 15, 2);
            $table->enum('payment_method', ['tunai', 'e-wallet'])->default('tunai');
            $table->enum('status', ['pending', 'lunas'])->default('lunas');
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};