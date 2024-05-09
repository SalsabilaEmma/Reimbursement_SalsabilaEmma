<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = "pengajuan";
    protected $primaryKey = 'id';
    protected $fillable = ['tgl', 'nama', 'fileType', 'deskripsi', 'file', 'status', 'statusReimburse'];


    public function karyawan(): BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'nama', 'nama');
    }
}
