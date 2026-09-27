<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->setIconColumnLength(255);
    }

    public function down(): void
    {
        $this->setIconColumnLength(24);
    }

    private function setIconColumnLength(int $length): void
    {
        $definitions = [
            'krong_pali_icon' => 'sun',
            'hair_cutting_icon' => 'scissors',
            'knot_tying_icon' => 'heart',
            'evening_reception_icon' => 'glass',
        ];

        if (DB::getDriverName() === 'mysql') {
            foreach ($definitions as $column => $default) {
                DB::statement("ALTER TABLE wedding_settings MODIFY {$column} VARCHAR({$length}) NOT NULL DEFAULT '{$default}'");
            }
        } elseif (DB::getDriverName() === 'pgsql') {
            foreach ($definitions as $column => $default) {
                DB::statement("ALTER TABLE wedding_settings ALTER COLUMN {$column} TYPE VARCHAR({$length})");
            }
        }
    }
};
