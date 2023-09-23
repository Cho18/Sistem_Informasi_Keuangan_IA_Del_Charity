<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengeluaran extends Model
{
    use HasFactory;
    protected $table  = 'pengeluaran';
    protected $fillable = [
        'jenis_pengeluaran_id',     'expenditure_description',
        'total_expenditure',        'expenditure_date',
        'expenditure_name',         'penerima_beasiswa_id',
        'proof_of_expenditure',
    ];

    /**
     * Get the user that owns the donator_donasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function jenis_pengeluaran()
    {
        return $this->belongsTo(jenis_pengeluaran::class);
    }

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
