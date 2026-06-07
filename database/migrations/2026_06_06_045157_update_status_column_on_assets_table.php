<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Update data existing: ubah 'maintenance' menjadi 'unavailable'
        DB::table('assets')->where('status', 'maintenance')->update(['status' => 'unavailable']);
        
        // Ubah struktur kolom status
        Schema::table('assets', function (Blueprint $table) {
            $table->enum('status', ['available', 'unavailable'])->default('available')->change();
        });
    }

    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->enum('status', ['available', 'maintenance', 'unavailable'])->default('available')->change();
        });
    }
};