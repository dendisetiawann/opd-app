<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aplikasi_web', function (Blueprint $table) {
            $table->string('jenis_aplikasi')->nullable()->after('alamat_tautan');
        });
    }

    public function down(): void
    {
        Schema::table('aplikasi_web', function (Blueprint $table) {
            $table->dropColumn('jenis_aplikasi');
        });
    }
};
