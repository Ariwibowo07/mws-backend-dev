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
        Schema::create('mentors', function (Blueprint $table) {
            $table->uuid('user_id');
            $table->foreign('user_id')
                ->references('uuid')
                ->on('users')
                ->cascadeOnDelete();
            $table->string('role_description')->nullable();
            $table->integer('active_students')->default(0);
            $table->float('success_rate')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
