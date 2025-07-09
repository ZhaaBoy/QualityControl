<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaPermasalahan extends Model
{
    use HasFactory;
    
    protected $table = 'kelola_permasalahan';
    protected $guarded = ['id'];

    public function masterProduk()
    {
        return $this->belongsTo(MasterProduk::class, 'nama_produk', 'id');
    }
}
