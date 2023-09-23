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
        Schema::create('bukti_donasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('restrict');          
            $table->string('donation_amount');
            $table->date('donation_date');
            $table->enum('type_account', ['Bank BNI', 'Bank BRI', 'Bank BCA', 'Bank Mandiri', 'Bank Permata',
                                        'Bank SUMUT', 'Bank Syariah Indonesia',  'DANA']);
            $table->longtext('description')->nullable();
            $table->string('bukti_transaksi')->nullable();
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
        Schema::dropIfExists('bukti_donasi');
    }
};
