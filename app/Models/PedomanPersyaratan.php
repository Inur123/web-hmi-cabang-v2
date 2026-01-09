<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedomanPersyaratan extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'pedoman_administrasi_id',
        'nama',
        'deskripsi',
        'download_url',
        'sort_order',
    ];

    public function pedoman()
    {
        return $this->belongsTo(PedomanAdministrasi::class, 'pedoman_administrasi_id');
    }
}
