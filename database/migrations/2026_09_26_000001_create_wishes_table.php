<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wishes', function (Blueprint $table) {
            $table->id();
            $table->string('guest_name', 100);
            $table->enum('attendance_status', ['Yes', 'No']);
            $table->text('message')->nullable();
            $table->string('receipt_image')->nullable();
            $table->timestamps();
            $table->index(['attendance_status', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wishes');
    }
};
