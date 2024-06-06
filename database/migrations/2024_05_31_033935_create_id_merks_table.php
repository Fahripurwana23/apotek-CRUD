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
        Schema::create('id_merks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->boolean('status')->default(0); // 0 for Out of Stock, 1 for In Stock
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('id_merks');
    }
};
