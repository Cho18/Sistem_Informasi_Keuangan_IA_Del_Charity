<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penerima_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('name_awarde');
            $table->string('nim_awarde')->unique()->nullable();
            $table->enum('study_program', ['S1 Informatika', 'S1 Sistem Informasi', 'S1 Teknik Elektro', 
                                            'S1 Teknik Bioproses', 'S1 Manajemen Rekayasa', 'D4 Teknologi Rekayasa Perangkat Lunak', 
                                            'D3 Teknologi Informasi', 'D3 Teknologi Komputer'])->nullable();
            $table->enum('faculty', ['Fakultas Informatika & Teknik Elektro', 'Fakultas Vokasi', 
                                        'Fakultas Bioteknologi', 'Fakultas Teknologi Industri'])->nullable();
            $table->integer('generation')->nullable();
            $table->string('email_academics_awarde')->unique()->nullable();
            $table->date('date_set_as_awardee');
            $table->date('end_date_as_awardee')->nullable();
            $table->string('total_spp_awarde');
            $table->enum('status', ['Masih aktif', 'Tidak aktif'])->nullable();

            $table->date('date_of_birth')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->enum('religion', ['Kristen', 'Katholik', 'Islam', 'Hindu', 'Buddha', 'Konghucu'])->nullable();
            $table->string('address')->nullable();
            $table->string('email_awarde')->unique()->nullable();
            $table->string('phone_number_awarde')->nullable();
            $table->integer('child_of_awarde')->nullable();
            $table->integer('number_of_siblings_awarde')->nullable();
            $table->enum('account_type_awarde', ['Bank BNI', 'Bank BRI', 'Bank BCA', 'Bank Mandiri', 'Bank Permata',
                                                'Bank SUMUT', 'Bank Syariah Indonesia',  'DANA'])->nullable();
            $table->unsignedBigInteger('account_number_awarde')->unique()->nullable();
            $table->string('name_owner_of_account')->nullable();
            $table->string('instagram_awarde')->nullable();
            $table->string('facebook_awarde')->nullable();
            $table->string('hobby')->nullable();

            $table->string('name_of_father_awarde')->nullable();
            $table->string('father_occupation_of_awarde')->nullable();
            $table->string('father_income_of_awarde')->nullable();
            $table->string('father_phone_number_awarde')->nullable();
            $table->string('name_of_mother_awarde')->nullable();
            $table->string('mother_occupation_of_awarde')->nullable();
            $table->string('mother_income_of_awarde')->nullable();
            $table->string('mother_phone_number_awarde')->nullable();
            $table->string('address_of_parents_awarde')->nullable();
            // $table->enum('dependents_of_parents_awarde', ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10']);
            $table->integer('dependents_of_parents_awarde')->nullable();

            $table->longtext('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_beasiswa');
    }
};