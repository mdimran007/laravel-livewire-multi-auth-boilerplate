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
        // Main table
        Schema::create('committee_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('designation');
            $table->string('url')->nullable();
            $table->string('picture')->nullable();
            $table->tinyInteger('status')->default(STATUS_ACTIVE); // 1=Active, 0=Inactive
            $table->bigInteger('created_by')->nullable(); // optional: store creator
            $table->timestamps();
        });

        // Pivot table
        Schema::create('committee_member_goal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('committee_member_id')->constrained('committee_members')->onDelete('cascade');
            $table->foreignId('goal_id')->constrained('goals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('committee_member_goal');
        Schema::dropIfExists('committee_members');
    }
};
