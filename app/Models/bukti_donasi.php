<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bukti_donasi extends Model
{
    use HasFactory;
    protected $table  = 'bukti_donasi';
    protected $fillable = [
        'donor_id',                 'description',
        'donation_amount',          'bukti_transaksi',
        'donation_date',            'status',
        'type_account',
    ];

    /**
     * Get all of the comments for the donator
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function donor()
    {
        return $this->belongsTo(donor::class);
    }
}
