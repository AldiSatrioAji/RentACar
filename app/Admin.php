<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Admin extends Model {
    public $table = "admin";

    protected $fillable = [
        'id_admin','nama','username','password'
    ];
}

?>