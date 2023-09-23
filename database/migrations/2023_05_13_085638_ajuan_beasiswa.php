<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ajuan_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penerima_beasiswa_id');
            $table->foreign('penerima_beasiswa_id')->references('id')->on('penerima_beasiswa')->onDelete('restrict');
            $table->string('total_bursar');
            $table->enum('semester', ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5',
                                        'Semester 6', 'Semester 7', 'Semester 8']);
            $table->string('deskripsi')->nullable();
            $table->enum('status', ['Sudah diproses', 'Belum diproses'])->default('Belum diproses');
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ajuan_beasiswa');
    }
};
