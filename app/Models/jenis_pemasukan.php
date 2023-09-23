<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pemasukan extends Model
{
    use HasFactory;
    protected $table  = 'jenis_pemasukan';
    protected $fillable = [
        'name_of_type_income',
        'description_of_type_income',
    ];

    /**
     * Get all of the comments for the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function pemasukan()
    {
        return $this->hasMany(pemasukan::class);
    }
}
