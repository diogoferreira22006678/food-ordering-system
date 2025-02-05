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

        Schema::create('perms', function (Blueprint $table) {
            $table->id('perm_id');
            $table->string('perm_name');
            $table->timestamps();
        });
        
        Schema::create('perms_relations', function (Blueprint $table) {
            $table->id('perm_relation_id');
            $table->unsignedBigInteger('perm_id');
            $table->string('perm_name');
            $table->foreign('perm_id')->references('perm_id')->on('perms')->onDelete('cascade');
            $table->timestamps();
        });
        
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('user_name');
            $table->string('user_pass');
            $table->integer('user_super');
            $table->unsignedBigInteger('perm_id')->nullable();
            $table->foreign('perm_id')->references('perm_id')->on('perms')->onDelete('cascade');
            $table->timestamps();
        });
        
        \DB::table('users')->insert([
            'user_name' => 'root',
            'user_pass' => \Hash::make('wo9384yjfrtw3978gnh89x04fng'),
            'user_super' => 1,
        ]);

        \DB::table('perms')->insert([
            'perm_name' => 'rooms',
        ]);

        \DB::table('perms_relations')->insert([
            'perm_id' => 1,
            'perm_name' => 'users',
        ]);

        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Table name (e.g., "Table 1")
            $table->string('qr_code')->nullable(); // Store QR Code
            $table->enum('status', ['available', 'occupied'])->default('available');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Category name (e.g., "Drinks", "Desserts")
            $table->timestamps();
        });

        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable(); // Store food images
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'preparing', 'ready', 'served'])->default('pending');
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_item_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
