<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->string('groom_photo')->nullable();
            $table->string('bride_photo')->nullable();
            $table->text('groom_bio')->nullable();
            $table->text('bride_bio')->nullable();
            $table->string('wedding_logo')->nullable();
            $table->string('krong_pali_time', 40)->nullable();
            $table->text('krong_pali_desc')->nullable();
            $table->string('hair_cutting_time', 40)->nullable();
            $table->text('hair_cutting_desc')->nullable();
            $table->string('knot_tying_time', 40)->nullable();
            $table->text('knot_tying_desc')->nullable();
            $table->string('evening_reception_time', 40)->nullable();
            $table->text('evening_reception_desc')->nullable();
            $table->json('additional_ceremonies')->nullable();
            $table->string('background_audio_file')->nullable();
            $table->string('flower_effect_style', 32)->default('rumdul_gold');
            $table->boolean('enable_aba')->default(false);
            $table->string('aba_account_usd', 100)->nullable();
            $table->string('aba_account_khr', 100)->nullable();
            $table->string('aba_account_name', 255)->nullable();
            $table->boolean('enable_acleda')->default(false);
            $table->string('acleda_account_usd', 100)->nullable();
            $table->string('acleda_account_khr', 100)->nullable();
            $table->string('acleda_account_name', 255)->nullable();
            $table->boolean('enable_wing')->default(false);
            $table->string('wing_account_usd', 100)->nullable();
            $table->string('wing_account_khr', 100)->nullable();
            $table->string('wing_account_name', 255)->nullable();
        });

        Schema::create('pre_wedding_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wedding_setting_id')->constrained()->cascadeOnDelete();
            $table->string('photo_path');
            $table->string('caption', 255)->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();
            $table->index(['wedding_setting_id', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pre_wedding_photos');

        Schema::table('wedding_settings', function (Blueprint $table) {
            $table->dropColumn([
                'groom_photo',
                'bride_photo',
                'groom_bio',
                'bride_bio',
                'wedding_logo',
                'krong_pali_time',
                'krong_pali_desc',
                'hair_cutting_time',
                'hair_cutting_desc',
                'knot_tying_time',
                'knot_tying_desc',
                'evening_reception_time',
                'evening_reception_desc',
                'additional_ceremonies',
                'background_audio_file',
                'flower_effect_style',
                'enable_aba',
                'aba_account_usd',
                'aba_account_khr',
                'aba_account_name',
                'enable_acleda',
                'acleda_account_usd',
                'acleda_account_khr',
                'acleda_account_name',
                'enable_wing',
                'wing_account_usd',
                'wing_account_khr',
                'wing_account_name',
            ]);
        });
    }
};
