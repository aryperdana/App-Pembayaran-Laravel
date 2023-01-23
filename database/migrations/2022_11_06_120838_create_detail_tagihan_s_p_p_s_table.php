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
        Schema::create('detail_tagihan_spps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tagihan_spp');
            $table->unsignedBigInteger('id_siswa');
            $table->unsignedBigInteger('id_jenis_tagihan');
            $table->string('harga');
            $table->string('bayar')->nullable();
            $table->boolean('status_pembayaran');
            $table->boolean('tunai');
            $table->boolean('lainnya');
            $table->date('tenggat');
            $table->string('bank_transfer')->nullable();
            $table->foreign('id_tagihan_spp')->references('id')->on('tagihan_spps')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('id_jenis_tagihan')->references('id')->on('jenis_tagihans')->onDelete('cascade');
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
        Schema::dropIfExists('detail_tagihan_spps');
    }
};
