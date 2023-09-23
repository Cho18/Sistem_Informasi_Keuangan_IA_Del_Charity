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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
            $table->unsignedBigInteger('bph_id')->nullable();
            $table->foreign('bph_id')->references('id')->on('bph')->onDelete('restrict');
            $table->unsignedBigInteger('donor_id')->nullable();
            $table->foreign('donor_id')->references('id')->on('donors')->onDelete('restrict');
            $table->unsignedBigInteger('penerima_beasiswa_id')->nullable();
            $table->foreign('penerima_beasiswa_id')->references('id')->on('penerima_beasiswa')->onDelete('restrict');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
