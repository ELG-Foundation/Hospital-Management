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
        Schema::create('patient_views', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
<<<<<<< Updated upstream
            $table->string('dob')->nullable();
            $table->string('blood_type')->nullable();
            $table->text('description')->nullable();
=======
            $table->date('dob')->nullable();
            $table->string('blood')->nullable();
            $table->string('desc')->nullable();
            $table->string('img')->nullable();
>>>>>>> Stashed changes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_views');
    }
};
