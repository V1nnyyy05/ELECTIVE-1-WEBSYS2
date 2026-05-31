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
       Schema::create('appointments', function (Blueprint $table) {
    $table->id();
    
    // The ONLY foreign key we need now!
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    
    $table->dateTime('appointment_time');
    $table->string('reason');
    $table->text('doctor_comment')->nullable();
    $table->enum('status', ['Pending', 'Approved', 'Completed', 'Cancelled', 'Expired'])->default('Pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
