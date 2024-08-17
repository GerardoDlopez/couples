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
        Schema::table('couples', function (Blueprint $table) {
            $table->unsignedBigInteger('user1_id')->unique()->change();
            $table->unsignedBigInteger('user2_id')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('couple', function (Blueprint $table) {
            //
        });
    }
};
