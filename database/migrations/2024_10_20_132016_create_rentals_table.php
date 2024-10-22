<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userId')->constrained('users')->onDelete('cascade'); // Foreign key to roles table
            $table->foreignId('carId')->constrained('cars')->onDelete('cascade'); // Foreign key to roles table
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('price'); // per day
            $table->enum('status', ['processing', 'booked', 'completed', 'canceled'])->default('processing');
            $table->enum('approve', ['ongoing', 'approved', 'declined'])->default('ongoing');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentals');
    }
};
