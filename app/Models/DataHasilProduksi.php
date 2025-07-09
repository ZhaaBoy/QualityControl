<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHasilProduksi extends Model
{
    use HasFactory;
    
    protected $table = 'data_hasil_produksi';
    protected $guarded = ['id'];
    public $timestamps = true;

    public function masterProduk()
    {
        return $this->belongsTo(MasterProduk::class, 'nama_produk', 'id');
    }
}
