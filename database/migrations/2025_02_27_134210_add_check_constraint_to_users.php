<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared("
            CREATE TRIGGER check_super_user_before_insert
            BEFORE INSERT ON users
            FOR EACH ROW
            BEGIN
                IF NEW.is_super = 1 AND NEW.id != 1 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Apenas o usuário com ID 1 pode ser super usuário.';
                END IF;
            END
        ");

        DB::unprepared("
            CREATE TRIGGER check_super_user_before_update
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF NEW.is_super = 1 AND NEW.id != 1 THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Apenas o usuário com ID 1 pode ser super usuário.';
                END IF;
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS check_super_user_before_insert");
        DB::unprepared("DROP TRIGGER IF EXISTS check_super_user_before_update");
    }

};
