<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTSewa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_sewa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_sewa');
            $table->foreign('nik')->references('id')->on('t_pelanggan');
            $table->foreign('id_admin')->references('id_admin')->on('t_admin');
            $table->foreign('no_stnk')->references('id')->on('t_mobil');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_pengembalian');
            $table->integer('total_tarif');
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
        Schema::dropIfExists('t_sewa');
    }
}
