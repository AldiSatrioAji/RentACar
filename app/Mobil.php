<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Mobil extends Model {
    public $table = "t_mobil";

    protected $fillable = [
        'no_stnk','merk','jenis','warna','tahun_buat','tarif_perhari'
    ];
}

?>