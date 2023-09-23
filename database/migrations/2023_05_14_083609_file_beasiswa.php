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
        Schema::create('file_beasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penerima_beasiswa_id');
            $table->foreign('penerima_beasiswa_id')->references('id')->on('penerima_beasiswa')->onDelete('restrict');
            $table->unsignedBigInteger('dokumen_id');
            $table->foreign('dokumen_id')->references('id')->on('dokumen')->onDelete('restrict');
            $table->string('file_beasiswa');
            $table->date('tanggal_upload');
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
        Schema::dropIfExists('file_beasiswa');
    }
};
