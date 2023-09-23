<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ajuan_beasiswa extends Model
{
    use HasFactory;
    protected $table  = 'ajuan_beasiswa';
    protected $fillable = [
        'penerima_beasiswa_id',
        'semester',
        'status',
        'total_bursar',
        'deskripsi',
    ];

    /**
     * Get all of the comments for the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function penerima_beasiswa()
    {
        return $this->belongsTo(penerima_beasiswa::class);
    }
}
