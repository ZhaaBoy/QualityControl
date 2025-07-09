<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanHasilProduksi extends Model
{
    use HasFactory;
    
    protected $table = 'laporan_hasil_produksi';
    protected $guarded = ['id'];

    public function scopeWithMaster($query)
    {
        return $query
            ->join('master_produk', 'master_produk.id', '=', 'laporan_hasil_produksi.nama_produk');
    }
        public function masterProduk()
    {
        return $this->belongsTo(MasterProduk::class, 'nama_produk');
    }
}
