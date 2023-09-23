<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add extends Model
{
    use HasFactory;
    protected $table  = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'donor_id',
        'penerima_beasiswa_id',
    ];
}
