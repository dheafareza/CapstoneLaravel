<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;

    protected $table = 'stok_barangs';

    // Primary Key
    protected $primaryKey = 'id';

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'ukuran',
        'stok_awal',
        'jumlah_masuk',
        'jumlah_keluar',
        'total_stok',
    ];

    public $timestamps = true;

    // Accessor/Mutator (Opsional, jika perlu melakukan format data)
    public function getTotalStokAttribute()
    {
        return $this->stok_awal + $this->jumlah_masuk - $this->jumlah_keluar;
    }
}
