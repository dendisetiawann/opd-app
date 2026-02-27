<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('health_check_batches', function (Blueprint $table) {
            if (!Schema::hasColumn('health_check_batches', 'scope')) {
                $table->string('scope')->default('all')->after('status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('health_check_batches', function (Blueprint $table) {
            $table->dropColumn('scope');
        });
    }
};
