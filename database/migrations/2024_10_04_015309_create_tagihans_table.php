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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rented_room_id')->constrained('rented_rooms')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('amount');
            $table->boolean('is_settled')->default(false);
            $table->date('due_date');
            $table->date('tanggal_notif');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
