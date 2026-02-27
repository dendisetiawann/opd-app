<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('health_check_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id', 36)->unique();
            $table->unsignedInteger('total')->default(0);
            $table->unsignedInteger('completed')->default(0);
            $table->enum('status', ['pending', 'running', 'completed', 'failed'])->default('pending');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('scope')->default('all'); // 'all' or opd_id
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('pengguna')->nullOnDelete();
        });

        Schema::create('health_check_results', function (Blueprint $table) {
            $table->id();
            $table->string('batch_id', 36)->index();
            $table->unsignedBigInteger('web_app_id')->nullable();
            $table->string('nama_web_app');
            $table->string('opd_nama');
            $table->string('alamat_tautan');
            $table->unsignedSmallInteger('http_code')->default(0);
            $table->string('status', 20)->default('pending'); // online, slow, offline, error, pending
            $table->unsignedInteger('response_time_ms')->default(0);
            $table->timestamp('checked_at')->nullable();

            $table->foreign('batch_id')->references('batch_id')->on('health_check_batches')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('health_check_results');
        Schema::dropIfExists('health_check_batches');
    }
};
