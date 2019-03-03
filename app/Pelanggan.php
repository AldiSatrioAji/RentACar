<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model {
    public $table = "t_pelanggan";

    protected $fillable = [
        'nik','nama','alamat','tanggal_lahir','no_telp','jenkel'
    ];
}

?>