<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',                     'role_id',
        'email',                    'donor_id',
        'password',                 'penerima_beasiswa_id',
        'confirm_password',         'profile',
        'bph_id',
    ];
    
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the user that owns the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Get the user associated with the donator
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

    /**
     * Get the user that owns the donator_donasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function penerima_beasiswa()
    {
        return $this->belongsTo(penerima_beasiswa::class);
    }

    /**
     * Get the user that owns the donator_donasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function bph()
    {
        return $this->belongsTo(bph::class);
    }
}


