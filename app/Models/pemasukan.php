<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pemasukan extends Model
{
    use HasFactory;
    protected $table  = 'pemasukan';
    protected $fillable = [
        'donor_id',             'type_account',
        'donation_amount',      'bukti_transaksi',
        'donation_date',        'description',
        'jenis_pemasukan_id'
    ];

    /**
     * Get the user that owns the pemasukan
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function donor()
    {
        return $this->belongsTo(donor::class);
    }

    /**
     * Get the user that owns the jenis_pemasukan
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function jenis_pemasukan()
    {
        return $this->belongsTo(jenis_pemasukan::class);
    }

}
