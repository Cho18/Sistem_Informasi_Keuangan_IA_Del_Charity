<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bph extends Model
{
    use HasFactory;
    protected $table  = 'bph';
    protected $fillable = [
        'nama',                 
        'angkatan',
        'status',
        'divisi',
    ];

    public function donor()
    {
        return $this->hasMany(donor::class);
    }
}
