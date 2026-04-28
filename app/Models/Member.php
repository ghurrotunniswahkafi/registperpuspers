<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
   protected $fillable = [
    'nama',
    'no_identitas',
    'asal_alamat',
    'tempat',
    'tanggal_lahir',
    'alamat',
    'no_hp',
    'email',
    'sosmed',
    'instansi',
    'alamat_instansi',
    'foto',
    'ktp',
    'status',
    'pengesahan_nama',
    'pengesahan_jabatan',
    'pengesahan_kenal'
];

   protected $casts = [
       'tanggal_lahir' => 'date',
       'pengesahan_kenal' => 'boolean',
   ];
}
