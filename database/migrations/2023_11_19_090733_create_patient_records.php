<?php

use App\Models\PatientView;
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
            $table->foreignIdFor(PatientView::class, 'patient_id')
            ->nullable();
            $table->string('name')
            ->nullable();
            $table->string('number')
            ->nullable();
            $table->text('address')
            ->nullable();
            $table->string('doc_img')
            ->nullable();
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
