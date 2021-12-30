<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunAjaran extends Model
{
    use HasFactory;
    protected $table = 'tb_tahun_ajaran';
    public const AKTIF = 'Aktif';
    public const TIDAK_AKTIF = 'Tidak Aktif';

    public static function get() {
        $ta = self::where('status', self::AKTIF)->first();
        return 'TAHUN AJARAN ' . $ta->mulai . ' - ' . $ta->sampai;
    }

    public static function getId() {
        $ta = self::where('status', self::AKTIF)->first();
        return $ta->id;
    }

    public static function getTahun() {
        $ta = self::where('status', self::AKTIF)->first();
        return $ta->mulai;
    }

    public function detail_siswa() {
        return $this->hasMany(SiswaDetail::class, 'tahun_ajaran_id');
    }
}
