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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('student_id');
            $table->string('title', 200);
            $table->text('description')->nullable();
            $table->enum('visibility', ['private', 'parents', 'school', 'public'])->default('parents');
            $table->timestamps();
            $table->softDeletes();

            $table->index('student_id');

            $table->foreign('student_id')
                ->references('uuid')
                ->on('students')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
