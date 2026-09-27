<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wedding_settings', function (Blueprint $table) {
            $table->id();
            $table->string('groom_name_kh')->nullable();
            $table->string('groom_name_en')->nullable();
            $table->string('bride_name_kh')->nullable();
            $table->string('bride_name_en')->nullable();
            $table->string('wedding_date_kh')->nullable();
            $table->dateTime('wedding_datetime')->nullable();
            $table->string('location_name')->nullable();
            $table->text('location_map_url')->nullable();
            $table->string('bank_aba_account')->nullable();
            $table->string('bank_acleda_account')->nullable();
            $table->string('qr_code_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wedding_settings');
    }
};
