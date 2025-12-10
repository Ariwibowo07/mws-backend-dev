<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('intervention_group_students', function (Blueprint $table) {
            $table->id();

            // UUID harus CHAR(36) agar compatible dengan MySQL
            $table->char('intervention_group_uuid', 36);
            $table->char('student_uuid', 36);

            // FK ke intervention_groups.uuid
            $table->foreign('intervention_group_uuid')
                ->references('uuid')
                ->on('intervention_groups')
                ->cascadeOnDelete();

            // FK ke students.uuid
            $table->foreign('student_uuid')
                ->references('uuid')
                ->on('students')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('intervention_group_students');
    }
};
