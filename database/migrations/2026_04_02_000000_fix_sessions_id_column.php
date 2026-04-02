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
        // If sessions table exists with wrong id column size, alter it
        if (Schema::hasTable('sessions')) {
            Schema::table('sessions', function (Blueprint $table) {
                // Check if id column needs to be extended
                // PostgreSQL: change the id column from varchar(40) to varchar(255)
                try {
                    // For PostgreSQL, we need to use raw SQL to modify the column
                    \Illuminate\Support\Facades\DB::statement('ALTER TABLE sessions ALTER COLUMN id TYPE varchar(255)');
                } catch (\Exception $e) {
                    // Column might already be correct length, continue
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback not needed
    }
};
