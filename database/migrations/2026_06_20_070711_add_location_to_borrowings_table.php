<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('borrowings', 'location')) {
            Schema::table('borrowings', function (Blueprint $table) {
                $table->string('location')->nullable()->after('notes');
            });
        }
    }

    public function down(): void
    {
        Schema::table('borrowings', function (Blueprint $table) {
            $table->dropColumn('location');
        });
    }
};