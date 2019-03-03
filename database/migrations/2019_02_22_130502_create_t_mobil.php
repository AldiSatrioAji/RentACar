<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTMobil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_mobil', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_stnk');
            $table->string('merk');
            $table->string('jenis');
            $table->string('warna');
            $table->date('tahun_buat');
            $table->integer('tarif_perhari');
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
        Schema::dropIfExists('t_mobil');
    }
}
