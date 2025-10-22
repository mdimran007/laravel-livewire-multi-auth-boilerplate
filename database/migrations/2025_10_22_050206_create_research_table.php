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
        Schema::create('research', function (Blueprint $table) {
            $table->id();
            $table->string('images')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->text('short_description');
            $table->longText('description')->nullable();
            $table->string('url')->nullable();
            $table->tinyInteger('status')->default(STATUS_ACTIVE);
            $table->bigInteger('created_by');
            $table->timestamps();
        });

        Schema::create('goal_research', function (Blueprint $table) {
            $table->id();
            $table->foreignId('research_id')->constrained('research')->onDelete('cascade');
            $table->foreignId('goal_id')->constrained('goals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research');
    }
};
