<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('case_files', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('crime_id')->unique(); // Add unique constraint here
            $table->string('case_number');
            $table->string('case_title');
            $table->timestamp('date_created')->useCurrent();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('crime_id')->references('id')->on('crimes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('case_files');
    }
};
