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
        Schema::create('verifikasi_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim');
            $table->string('room');
            $table->unsignedInteger('amount');
            $table->date("tanggal_dibayar");
            $table->string("no_invoice");
            $table->boolean("is_valid");
            $table->unsignedInteger("bukti_file")->nullable();
            $table->timestamps();

            $table->foreign("bukti_file")->references("id")->on("images")->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_pembayaran');
    }
};
