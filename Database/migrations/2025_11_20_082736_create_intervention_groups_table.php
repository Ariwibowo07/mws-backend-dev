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
        Schema::create('intervention_groups', function (Blueprint $table) {
            $table->char('uuid', 36)->primary();
            $table->string('group_name');
            $table->text('description')->nullable();

            // guru pembuat intervensi
            $table->char('created_by', 36)->nullable();
            $table->foreign('created_by')->references('id')->on('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intervention_groups');
    }
};
