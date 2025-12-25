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
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('uuid')->primary();

            // DATA STUDENT
            $table->string('grade')->nullable();
            $table->string('class_name')->nullable();

            // RELASI KE TEACHERS (INI BOLEH)
            $table->foreignId('mentor_id')
                ->nullable()
                ->constrained('teachers')
                ->nullOnDelete();

            $table->enum('tier', ['tier_1', 'tier_2', 'tier_3'])->default('tier_1');
            $table->enum('progress', ['on_track', 'improving', 'needs_attention', 'not_assigned'])
                ->default('not_assigned');

            $table->date('next_update')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
