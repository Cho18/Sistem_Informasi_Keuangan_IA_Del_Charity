<?php

namespace Database\Factories;

use Faker\Factory as faker;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\penerima_beasiswa>
 */
class penerima_beasiswaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = faker::create();
        return [
            'pengeluaran_id' => mt_rand(1, 9999),
            'name_awarde' => $faker->name(),
            'nim_awarde' => $faker->randomDigit(8),
            'study_program' => Arr::random(['S1 Informatika', 'S1 Sistem Informasi', 'S1 Teknik Elektro', 'S1 Teknik Bioproses', 
                                            'S1 Manajemen Rekayasa', 'D4 Teknologi Rekayasa Perangkat Lunak', 
                                            'D3 Teknologi Informasi', 'D3 Teknologi Komputer']),
            'faculty' => Arr::random(['Fakultas Informatika & Teknik Elektro', 'Fakultas Vokasi', 
                                        'Fakultas Bioteknologi', 'Fakultas Teknologi Industri']),
            'generation' => mt_rand(2013, 2023),
            'email_academics_awarde' => $faker->email(),
            'status_awarde' => Arr::random(['active', 'inactive', 'move']),
            'total_spp_awarde' => null,
            'date_of_birth' => $faker->dateTime(),
            'place_of_birth' => $faker->city(),
            'gender' => Arr::random(['male', 'female']),
            'religion' => Arr::random(['Kristen', 'Katholik', 'Islam', 'Hindu', 'Buddha', 'Konghucu']),
            'address' => $faker->address(),
            'email_awarde' => $faker->email(),
            'phone_number_awarde' => mt_rand("080000000000", "089999999999"),
            'child_of_awarde' => Arr::random(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']),
            'number_of_siblings_awarde' => Arr::random(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']),
            'account_type_awarde' => Arr::random(['Bank BNI', 'Bank BRI', 'Bank BCA', 'Bank Mandiri',
                                                    'Bank Syariah Indonesia', 'Bank Permata']),
            'account_number_awarde' => $faker->randomDigit(16),
            'name_owner_of_account' => 'name_awarde',
            'instagram_awarde' => 'name_awarde',
            'name_of_father_awarde' => $faker->name(),
            'father_occupation_of_awarde' => $faker->jobTitle(),
            'father_income_of_awarde' => null,
            'father_phone_number_awarde' => mt_rand("080000000000", "089999999999"),
            'name_of_mother_awarde' => $faker->name(),
            'mother_occupation_of_awarde' => $faker->jobTitle(),
            'mother_income_of_awarde' => null,
            'mother_phone_number_awarde' => mt_rand("080000000000", "089999999999"),
            'address_of_parents_awarde' => $faker->address(),
            'dependents_of_parents_awarde' => Arr::random(['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']),
            'description' => $faker->paragraph(),
        ];
    }
}
