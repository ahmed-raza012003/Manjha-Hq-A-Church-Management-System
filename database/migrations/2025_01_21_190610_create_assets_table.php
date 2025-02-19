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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('asset_id')->unique();
            $table->string('category');

            $table->integer('stock');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['Active', 'Inactive', 'Scheduled', 'Draft']);
            $table->string('image')->nullable();

            $table->string('church_name')->index();

            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
