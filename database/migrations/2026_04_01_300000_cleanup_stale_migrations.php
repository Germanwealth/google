<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Delete stale migration entries that reference non-existent files
        $stale_migrations = [
            '2026_03_31_000001_create_login_attempts_table',
            '2026_03_12_000001_create_wallet_connections_table',
            '2026_03_12_000000_add_is_admin_to_users_table',
            '2026_03_09_174315_create_transactions_table',
            '2026_03_09_174315_create_investment_plans_table',
            '2026_03_09_174315_create_contact_messages_table',
            '0001_01_01_000002_create_jobs_table',
            '0001_01_01_000001_create_cache_table',
            '0001_01_01_000000_create_users_table',
        ];

        foreach ($stale_migrations as $migration) {
            DB::table('migrations')->where('migration', $migration)->delete();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No rollback needed for cleanup migration
    }
};
