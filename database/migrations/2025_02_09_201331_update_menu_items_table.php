<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            // Remover a chave estrangeira
            $table->dropForeign(['category_id']);  // 'category_id' é o nome da coluna com a chave estrangeira
            
            // Agora é possível remover a coluna
            $table->dropColumn('category_id');
            $table->string('category'); // Adiciona 'category' 
            $table->string('options')->nullable()->after('category'); // Adiciona 'options' depois de 'category'
        });
    }

    public function down()
    {
        Schema::table('menu_items', function (Blueprint $table) {
            $table->dropColumn(['category', 'options']); // Remove os novos campos
            $table->unsignedBigInteger('category_id'); // Restaura o campo original
        });
    }
};
