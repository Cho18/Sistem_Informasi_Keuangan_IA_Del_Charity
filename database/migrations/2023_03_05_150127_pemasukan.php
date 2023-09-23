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
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jenis_pemasukan_id');
            $table->foreign('jenis_pemasukan_id')->references('id')->on('jenis_pemasukan')->onDelete('restrict');          
            $table->unsignedBigInteger('donor_id')->nullable();
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('restrict');          
            $table->string('donation_amount');
            $table->date('donation_date');
            $table->enum('type_account', ['Bank BNI', 'Bank BRI', 'Bank BCA', 'Bank Mandiri', 'Bank Permata',
                                        'Bank SUMUT','Bank Syariah Indonesia',  'DANA']);
            $table->longtext('description')->nullable();
            $table->string('bukti_transaksi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};