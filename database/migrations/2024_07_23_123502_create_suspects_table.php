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
        Schema::create('suspects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('crime_id')->constrained('crimes')->onDelete('cascade');
            $table->string('suspect_name');
            $table->string('mugshot')->nullable(); // Path to the mugshot image, nullable if not always provided
            $table->float('height')->nullable(); // Height in meters or feet, nullable
            $table->text('address')->nullable(); // Address of the suspect, nullable
            $table->date('date_of_birth');
            $table->date('date_created');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suspects');
    }
};
