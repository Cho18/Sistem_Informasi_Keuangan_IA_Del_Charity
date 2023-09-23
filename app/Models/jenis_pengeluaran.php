<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jenis_pengeluaran extends Model
{
    use HasFactory;
    protected $table  = 'jenis_pengeluaran';
    protected $fillable = [
        'name_of_type_expenditure',
        'description_of_type_expenditure',
    ];

    /**
     * Get all of the comments for the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function pengeluaran()
    {
        return $this->hasMany(pengeluaran::class);
    }
}
