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
        Schema::create('bph', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('angkatan')->nullable();
            $table->enum('status', ['Ketua', 'Sekretaris', 'Bendahara', 'Anggota']);
            $table->enum('divisi', ['Media Sosial', 'Recruiter', 'Remainder']);
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
        Schema::dropIfExists('bph');
    }
};
