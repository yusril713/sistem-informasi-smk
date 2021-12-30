<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriFile extends Model
{
    use HasFactory;
    protected $table = 'tb_kategori_file';

    public function file() {
        return $this->hasMany(File::class, 'kategori_id', 'id');
    }

    public static function get() {
        return self::all();
    }
}
