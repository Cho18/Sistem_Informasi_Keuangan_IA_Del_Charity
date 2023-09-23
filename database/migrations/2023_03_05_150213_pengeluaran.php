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
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_pengeluaran_id');
            $table->foreign('jenis_pengeluaran_id')->references('id')->on('jenis_pengeluaran')->onDelete('restrict'); 
            $table->unsignedBigInteger('penerima_beasiswa_id')->nullable();
            $table->foreign('penerima_beasiswa_id')->references('id')->on('penerima_beasiswa')->onDelete('restrict'); 
            $table->string('total_expenditure');
            $table->longtext('expenditure_description')->nullable();
            $table->date('expenditure_date');
            $table->string('proof_of_expenditure')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran');
    }
};