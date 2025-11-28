<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelangganFile extends Model
{
    use HasFactory;

    protected $table = 'pelanggan_files';
    protected $primaryKey = 'id';

    protected $fillable = [
        'pelanggan_id',
        'file_name',
        'file_path',
        'original_name',
        'file_size',
        'file_type'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'pelanggan_id');
    }
}
