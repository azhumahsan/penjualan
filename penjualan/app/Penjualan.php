<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';

    protected $fillable = ['nama_barang', 'stok', 'jumlah_terjual', 'tanggal_transaksi', 'jenis_barang'];

    protected $guarded = [];
}
