<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PedomanAdministrasi extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'nama', 'slug', 'deskripsi', 'status',
    ];

    public function persyaratans()
    {
        return $this->hasMany(PedomanPersyaratan::class, 'pedoman_administrasi_id')
            ->orderBy('sort_order');
    }
}
