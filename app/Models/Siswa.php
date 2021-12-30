<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'tb_siswa';
    public const PAGINATE = 30;
    public const SISWA = 'siswa';
    public const ALUMNI = 'alumni';

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail_siswa() {
        return $this->hasMany(SiswaDetail::class, 'siswa_id');
    }
}
