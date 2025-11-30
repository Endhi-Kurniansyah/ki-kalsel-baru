<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    /**
     * Atribut yang boleh diisi secara massal.
     */
    protected $fillable = [
        'title',
        'description',
        'location',
        'start_time',
        'end_time',
        'category',
        'file_path',
    ];

    /**
     * Atribut yang harus di-cast.
     * Ini akan mengubah 'start_time' dan 'end_time' menjadi objek Tanggal (Carbon)
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
}
