<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan',
        'tahun_ajaran',
    ];

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
}   

    public function getTingkatRomawiAttribute()
    {
        return match((string)$this->tingkat) {
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
            default => $this->tingkat,
        };
    }
}
