<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opsi_teknologi', function (Blueprint $table) {
            $table->id();
            $table->string('kategori', 20); // bahasa, framework, library, dbms
            $table->string('nama', 100);
            $table->string('versi', 50);
            $table->timestamps();

            $table->unique(['kategori', 'nama', 'versi']);
            $table->index('kategori');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opsi_teknologi');
    }
};
