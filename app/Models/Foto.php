<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    public $table = "master.fotos";

    protected $fillabel = [
        "id",
        "judul",
        "deskripsi",
        "tanggal_unggah",
        "lokasi_file",
        "album_id"
    ];
}
