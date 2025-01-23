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
        Schema::create('contributions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id')->nullable(); // Nullable for anonymous contributions
            $table->string('payment_method');
            $table->date('date');
            $table->decimal('amount', 10, 2);
            $table->string('fund');
            $table->string('batch_id')->nullable(); // Grouping ID for batches
            $table->timestamps();
        
            $table->foreign('member_id')->references('id')->on('members')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contributions');
    }
};
