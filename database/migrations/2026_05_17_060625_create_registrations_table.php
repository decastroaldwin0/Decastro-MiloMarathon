<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('age');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('phone', 11);
            $table->string('email')->unique();
            $table->text('address');
            $table->enum('marathon_category', ['3K', '5K', '10K', '21K']);
            $table->date('registration_date');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone', 11);
            $table->enum('experience_level', ['Beginner', 'Intermediate', 'Advanced'])->default('Beginner');
            $table->string('shirt_size')->default('M');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};