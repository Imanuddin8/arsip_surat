<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Arsip extends Model
{
    use HasFactory;

    protected  $table = 'arsip';

    protected $fillable = ['nomor', 'kategori_id', 'judul', 'waktu', 'filesurat'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
}
