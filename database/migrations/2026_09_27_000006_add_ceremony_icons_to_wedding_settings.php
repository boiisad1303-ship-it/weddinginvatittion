<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('krong_pali_icon', 255)->default('sun');
            $table->string('hair_cutting_icon', 255)->default('scissors');
            $table->string('knot_tying_icon', 255)->default('heart');
            $table->string('evening_reception_icon', 255)->default('glass');
        });
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->dropColumn([
                'krong_pali_icon',
                'hair_cutting_icon',
                'knot_tying_icon',
                'evening_reception_icon',
            ]);
        });
    }
};
