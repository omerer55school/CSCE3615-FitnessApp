<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cardio_activities', function (Blueprint $table) {
            $table->float('calories_burned')->nullable()->after('time');
        });
    }

    public function down(): void
    {
        Schema::table('cardio_activities', function (Blueprint $table) {
            $table->dropColumn('calories_burned');
        });
    }
};
