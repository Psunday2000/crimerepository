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
        Schema::create('evidences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crime_id')->constrained('crimes')->onDelete('cascade');
            $table->string('evidence_type');
            $table->string('evidence_name');
            $table->text('evidence_content')->nullable();
            $table->date('date_collected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evidences');
    }
};
