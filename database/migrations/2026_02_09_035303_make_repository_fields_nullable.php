<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('web_apps', function (Blueprint $table) {
            // Change git_repository from enum to nullable string
            $table->string('git_repository', 20)->nullable()->change();
            $table->string('penyedia_repository', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_apps', function (Blueprint $table) {
            $table->enum('git_repository', ['public', 'private'])->change();
            $table->string('penyedia_repository', 100)->change();
        });
    }
};
