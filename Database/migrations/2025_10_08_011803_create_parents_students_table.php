<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('parents_students', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('parent_id');
            $table->uuid('student_id');

            $table->string('relationship')->nullable();
            $table->boolean('can_view_portfolio')->default(false);
            $table->boolean('can_receive_reports')->default(false);

            $table->timestamps();

            // FK HARUS EKSPLISIT
            $table->foreign('parent_id')
                ->references('uuid')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('student_id')
                ->references('uuid')
                ->on('students')
                ->cascadeOnDelete();

            $table->unique(['parent_id', 'student_id'], 'parents_students_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parents_students');
    }
};
