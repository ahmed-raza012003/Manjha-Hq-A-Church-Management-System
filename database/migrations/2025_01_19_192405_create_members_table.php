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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
    $table->string('first_name');
    $table->string('middle_name')->nullable();
    $table->string('nick_name')->nullable();
    $table->string('picture')->nullable();
    $table->enum('gender', ['male', 'female', 'other']);
    $table->date('date_of_birth')->nullable();
    $table->string('groups')->nullable();
    $table->date('baptism_date')->nullable();
    $table->enum('member_status', ['active', 'inactive']);
    $table->string('full_address');
    $table->string('city')->nullable();
    $table->string('email')->unique();
    $table->string('phone_number')->nullable();
    $table->string('job_title')->nullable();
    $table->string('employer')->nullable();
    $table->boolean('is_draft')->default(true);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
