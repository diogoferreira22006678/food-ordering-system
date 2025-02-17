<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'categories';

    public $incrementing = true;  
    protected $keyType = 'int';

    protected $fillable = ['name'];
}
