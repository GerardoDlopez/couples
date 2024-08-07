<?php

use App\Models\couple;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('couple_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('couple_id');
            $table->text('theme')->nullable();
            $table->text('color')->nullable();
            $table->text('background_color')->nullable();
            $table->timestamps();

            $table->foreign('couple_id')->references('id')->on('couples')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couple_profiles');
    }
};
