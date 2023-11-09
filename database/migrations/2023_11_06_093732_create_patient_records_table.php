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
        Schema::create('patient_records', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_parents_id')->nullable()
                ->constrained('patient_parents');

            $table->foreignId('patients_id')->nullable()
                ->constrained('patients');

            $table->string('records')
                ->nullable();

            $table->string('status')
                ->nullable();

            $table->date('visit_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_records');
    }
};
