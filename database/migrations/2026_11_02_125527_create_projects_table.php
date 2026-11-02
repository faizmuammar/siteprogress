<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // e.g. PRJ-TCS-001
            $table->string('title');
            $table->string('client_name');
            $table->string('location');
            $table->decimal('progress_percentage', 5, 2)->default(0.00);
            $table->enum('status', ['On Track', 'Delayed', 'Final Stage'])->default('On Track');
            $table->date('start_date');
            $table->date('target_completion_date');
            $table->foreignId('owner_user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('pic_user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};