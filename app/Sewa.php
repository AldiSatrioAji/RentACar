<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Sewa extends Model {
    public $table = "sewa";

    protected $fillable = [
        'nik','id_admin','no_stnk','tanggal_peminjaman','tanggal_pengembalian','total_tarif'
    ];
}

?>