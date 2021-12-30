<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $table = 'tb_guru';
    public const PAGINATE = 30;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
