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
        $table ='patients';
        Schema::create($table, function (Blueprint $table) {
            $table->id();
            $table->string('patient_id')->unique();
            $table -> string('name');
            $table->string('phone_number');
            $table->string('location')->nullable();
            $table->year('year_of_birth')->nullable();
            $table->unsignedInteger('visit_count')->default(0);
            $table->timestamp('last_visit')->useCurrent();
            $table->string('email');
            $table->string('illness');
            $table->string('test');
            $table->string('department_name');
            $table->Integer('doctor_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};
