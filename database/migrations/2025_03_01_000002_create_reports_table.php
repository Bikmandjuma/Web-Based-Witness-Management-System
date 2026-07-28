<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigned_investigator_id')->nullable()
                  ->constrained('users')->nullOnDelete();
            $table->string('incident_type', 50);
            $table->string('location', 150);
            $table->text('description');
            $table->enum('status', ['submitted', 'under review', 'resolved'])->default('submitted');
            $table->timestamp('date_reported')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
