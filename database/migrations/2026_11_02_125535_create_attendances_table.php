<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');
            $table->date('attendance_date');
            $table->integer('carpenter_mason_count')->default(0);
            $table->integer('welder_ironworker_count')->default(0);
            $table->integer('heavy_equipment_operator_count')->default(0);
            $table->integer('total_workers_present')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};