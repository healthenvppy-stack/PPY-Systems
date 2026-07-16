<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE citizens
            ADD status_new ENUM('active', 'moved_out', 'deceased')
            NOT NULL DEFAULT 'active'
            AFTER email
        ");

        DB::statement("
            UPDATE citizens
            SET status_new = CASE
                WHEN status = 1 THEN 'active'
                ELSE 'moved_out'
            END
        ");

        DB::statement("
            ALTER TABLE citizens
            DROP COLUMN status
        ");

        DB::statement("
            ALTER TABLE citizens
            CHANGE status_new status
            ENUM('active', 'moved_out', 'deceased')
            NOT NULL DEFAULT 'active'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE citizens
            ADD status_old TINYINT(1)
            NOT NULL DEFAULT 1
            AFTER email
        ");

        DB::statement("
            UPDATE citizens
            SET status_old = CASE
                WHEN status = 'active' THEN 1
                ELSE 0
            END
        ");

        DB::statement("
            ALTER TABLE citizens
            DROP COLUMN status
        ");

        DB::statement("
            ALTER TABLE citizens
            CHANGE status_old status
            TINYINT(1)
            NOT NULL DEFAULT 1
        ");
    }
};
