<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class log_donasi extends Model
{
    use HasFactory;
    /**
     * Get the user that owns the donator_donasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function donor()
    {
        return $this->belongsTo(donor::class);
    }

    /**
     * Get the user that owns the donator_donasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function donator_donasi()
    {
        return $this->belongsTo(donator_donasi::class);
    }
}
