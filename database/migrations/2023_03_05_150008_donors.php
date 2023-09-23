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
        Schema::create('donors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bph_id');
            $table->foreign('bph_id')->references('id')->on('bph')->onDelete('restrict')->nullable();  
            $table->string('name');
            $table->string('code_name');
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->enum('religion', ['Kristen', 'Katholik', 'Islam', 'Hindu', 'Buddha',
                                        'Konghucu'])->nullable();
            $table->string('address')->nullable();
            $table->enum('study_program', ['S1 Informatika', 'S1 Sistem Informasi', 'S1 Teknik Elektro', 
                                            'S1 Teknik Bioproses', 'S1 Manajemen Rekayasa', 
                                            'D4 Teknologi Rekayasa Perangkat Lunak', 'D3 Teknologi Informasi', 
                                            'D3 Teknologi Komputer'])->nullable();
            $table->enum('faculty', ['Fakultas Informatika & Teknik Elektro', 'Fakultas Vokasi', 
                                        'Fakultas Bioteknologi', 'Fakultas Teknologi Industri'])->nullable();
            $table->integer('generation')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('phone_number')->nullable();
            $table->date('date_of_joining')->nullable();
            $table->enum('struktur_donator', ['Donator tetap', 'Donator tidak tetap']);
            $table->enum('alumni', ['IAD', 'NIAD'])->nullable();
            $table->longtext('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donors');
    }
};

?>