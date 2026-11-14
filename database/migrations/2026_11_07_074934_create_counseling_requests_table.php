<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('counseling_requests', function (Blueprint $table) {
            $table->id();

            // ID pengguna yang mengajukan konseling
            $table->foreignId('konseli_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // ID konselor yang dipilih
            $table->foreignId('konselor_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Topik konseling
            $table->string('topic');

            // Cerita atau masalah yang ingin dikonsultasikan
            $table->text('description');

            // Status pengajuan konseling
            $table->enum('status', [
                'pending',
                'accepted',
                'rejected',
                'completed'
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('counseling_requests');
    }
};