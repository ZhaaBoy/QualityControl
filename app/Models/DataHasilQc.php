<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHasilQc extends Model
{
    use HasFactory;
    
    protected $table = 'data_hasil_qc';
    protected $guarded = ['id'];

    public function masterProduk()
    {
        return $this->belongsTo(MasterProduk::class, 'nama_produk', 'id');
    }
}
