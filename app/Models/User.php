<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users'; // Custom table name
    protected $primaryKey = 'user_id'; // Custom primary key

    protected $fillable = [
        'user_name',
        'user_pass',
        'user_super',
        'perm_id',
    ];

    protected $hidden = [
        'user_pass',
    ];

    public function getAuthPassword()
    {
        return $this->user_pass; // Tells Laravel which column stores the password
    }

    public function perm()
    {
        return $this->belongsTo(Perm::class, 'perm_id', 'perm_id');
    }
}
