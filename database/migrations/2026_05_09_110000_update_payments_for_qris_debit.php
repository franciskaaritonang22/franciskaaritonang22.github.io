<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change method column from enum to string for flexibility
        DB::statement("ALTER TABLE payments MODIFY COLUMN method VARCHAR(255) NOT NULL DEFAULT 'cash'");

        Schema::table('payments', function (Blueprint $table) {
            $table->string('bukti_bayar')->nullable()->after('jumlah_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('bukti_bayar');
        });

        DB::statement("ALTER TABLE payments MODIFY COLUMN method ENUM('cash', 'transfer') NOT NULL");
    }
};
