<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');                    // Nama aset
            $table->enum('category', [
                'hp-smartphone', 
                'laptop', 
                'kamera', 
                'playstation'
            ]);
            $table->text('specification')->nullable(); // Spesifikasi detail
            $table->integer('stock')->default(0);      // Jumlah stok
            $table->enum('status', [
                'available', 
                'maintenance', 
                'unavailable'
            ])->default('available');
            $table->string('image')->nullable();        // Path gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};