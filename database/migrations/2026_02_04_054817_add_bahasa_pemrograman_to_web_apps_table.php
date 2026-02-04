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
            $table->text('bahasa_pemrograman')->nullable()->after('email_narahubung');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('web_apps', function (Blueprint $table) {
            $table->dropColumn('bahasa_pemrograman');
        });
    }
};
