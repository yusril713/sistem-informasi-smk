<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriInformasi extends Model
{
    use HasFactory;
    protected $table = 'tb_kategori_info';

    public static function get(){
        return self::all();
    }

    public function informasi() {
        return $this->hasMany(Informasi::class, 'kategori_id', 'id');
    }

    public function limit() {
        return $this->informasi()->orderBy('created_at', 'desc')->limit(3);
    }
}
