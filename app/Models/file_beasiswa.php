<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class file_beasiswa extends Model
{
    use HasFactory;
    protected $table  = 'file_beasiswa';
    protected $fillable = [
        'penerima_beasiswa_id',
        'file_beasiswa',
        'status',
        'dokumen_id',
        'tanggal_upload',
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

    /**
     * Get all of the comments for the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function dokumen()
    {
        return $this->belongsTo(dokumen::class);
    }

    /**
     * Get all of the comments for the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function User()
    {
        return $this->hasMany(User::class);
    }
}
