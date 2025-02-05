<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableLayout extends Model
{
    use HasFactory;
    protected $primaryKey = 'table_id'; // Ou 'table_name' se for o identificador correto
    public $incrementing = true;  // Defina como false se a chave primária for uma string
    protected $keyType = 'int';   // Ou 'string' se não for um número
    
    
    protected $table = 'tables_layout'; // Ensure this matches your database table name

    protected $fillable = ['table_name', 'x_position', 'y_position', 'status'];
}
