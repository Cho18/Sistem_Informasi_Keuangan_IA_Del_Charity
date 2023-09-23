<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dokumen extends Model
{
    use HasFactory;
    protected $table  = 'dokumen';
    protected $fillable = [
        'name',
        'dokumen',
    ];

    /**
     * Get all of the comments for the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ajuan()
    {
        return $this->hasMany(ajuan::class);
    }
}
