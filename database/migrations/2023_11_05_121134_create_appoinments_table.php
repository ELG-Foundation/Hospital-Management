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
        Schema::create('appoinments', function (Blueprint $table) {
            $table->id();
            $table->string('parent_name')->nullable();
            $table->string('parent_mail')->nullable();
            $table->integer('parent_number')->nullable();
            $table->string('patient_name')->nullable();
            $table->foreignId('patient_parents_id')
                ->constrained('patient_parents');
            $table->date('appoinment_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appoinments');
    }
};
