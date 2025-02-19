<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Package name
            $table->decimal('price', 8, 2); // Package price
            $table->boolean('can_manage_members')->default(false); // Can manage members or not
            $table->integer('max_members')->nullable(); // Max number of members (NULL = unlimited)
            $table->integer('max_groups')->nullable(); // Max number of groups allowed
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('packages');
    }
};
