<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique();
        });

        DB::table('wedding_settings')->orderBy('id')->get()->each(function (object $wedding): void {
            $baseSlug = Str::slug(implode('-', array_filter([
                $wedding->groom_name_en,
                $wedding->bride_name_en,
                substr((string) $wedding->wedding_datetime, 0, 4),
            ]))) ?: 'wedding';

            DB::table('wedding_settings')
                ->where('id', $wedding->id)
                ->update(['slug' => $baseSlug . '-' . $wedding->id]);
        });
    }

    public function down(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
