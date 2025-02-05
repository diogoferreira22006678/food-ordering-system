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
        Schema::create('tables_layout', function (Blueprint $table) {
            $table->id('table_id');
            $table->string('table_name'); // Name or number for the table
            $table->integer('x_position'); // X coordinate for table position
            $table->integer('y_position'); // Y coordinate for table position
            $table->enum('status', ['free', 'occupied'])->default('free'); // Status of the table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables_layout');
    }
};
