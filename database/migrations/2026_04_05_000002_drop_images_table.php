<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // First drop foreign key on users table
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'ktp_id')) {
                $table->dropForeign(['ktp_id']);
                $table->dropColumn('ktp_id');
            }
        });

        // Then drop the images table
        Schema::dropIfExists('images');
    }

    public function down(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('path');
            $table->integer('size');
            $table->boolean('is_vr')->default(false);
            $table->unsignedBigInteger('room_id')->nullable();
            $table->unsignedBigInteger('tipe_room_id')->nullable();
            $table->timestamps();
        });
    }
};
