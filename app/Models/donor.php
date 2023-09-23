<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class donor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',                 'date_of_birth',
        'code_name',            'gender',
        'study_program',        'religion',
        'faculty',              'address',
        'generation',           'phone_number',
        'date_of_joining',      'bph_id',
        'place_of_birth',       'struktur_donator',
        'description',          'email',
        'alumni',
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

    /**
     * Get the user associated with the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function bph()
    {
        return $this->belongsTo(bph::class);
    }

    public function bukti_donasi()
    {
        return $this->hasMany(bukti_donasi::class);
    }
}
