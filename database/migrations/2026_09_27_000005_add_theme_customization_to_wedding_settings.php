<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('primary_color', 7)->default('#D4AF37');
            $table->string('secondary_color', 7)->default('#8B0000');
            $table->string('background_image')->nullable();
            $table->string('force_background_style', 24)->default('cover');
            $table->text('groom_bio_text')->nullable();
            $table->text('bride_bio_text')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->dropColumn([
                'primary_color',
                'secondary_color',
                'background_image',
                'force_background_style',
                'groom_bio_text',
                'bride_bio_text',
            ]);
        });
    }
};
