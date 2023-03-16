<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = "suppliers";
    protected $fillable =['id_produk', 'nama_supplier', 'alamat', 'no_telp', 'id_admin'];
    protected $hidden = ['id_admin'];
}
