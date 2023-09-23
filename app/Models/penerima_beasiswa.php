<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penerima_beasiswa extends Model
{
    use HasFactory;
    protected $table  = 'penerima_beasiswa';
    protected $fillable = [
        'name_awarde',              'gender',                       'instagram_awarde',                    
        'nim_awarde',               'religion',                     'name_of_father_awarde',        
        'study_program',            'address',                      'father_occupation_of_awarde',  
        'faculty',                  'email_awarde',                 'father_income_of_awarde',      
        'generation',               'phone_number_awarde',          'father_phone_number_awarde',
        'email_academics_awarde',   'child_of_awarde',              'name_of_mother_awarde',
        'date_set_as_awardee',      'number_of_siblings_awarde',    'mother_occupation_of_awarde',
        'total_spp_awarde',         'account_type_awarde',          'mother_income_of_awarde',
        'place_of_birth',           'account_number_awarde',        'mother_phone_number_awarde',
        'date_of_birth',            'name_owner_of_account',        'address_of_parents_awarde',
        'description',              'dependents_of_parents_awarde', 'end_date_as_awardee',
        'hobby',                    'facebook_awarde',              'status',
    ];

    /**
     * Get the user that owns the donator_donasi
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function pengeluaran()
    {
        return $this->hasMany(pengeluaran::class);
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

    public function ajuan_beasiswa()
    {
        return $this->hasMany(ajuan_beasiswa::class);
    }


}

?>