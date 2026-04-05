<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('verifikasi_pembayaran', function (Blueprint $table) {
            $table->dropForeign(['bukti_file']);
            $table->dropColumn('bukti_file');
        });

        Schema::table('verifikasi_pembayaran', function (Blueprint $table) {
            $table->string('bukti_file')->nullable()->after('is_valid');
        });
    }

    public function down(): void
    {
        Schema::table('verifikasi_pembayaran', function (Blueprint $table) {
            $table->dropColumn('bukti_file');
            $table->unsignedInteger('bukti_file')->nullable();
            $table->foreign('bukti_file')->references('id')->on('images')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }
};
