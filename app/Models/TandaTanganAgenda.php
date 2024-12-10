<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaTanganAgenda extends Model
{
    use HasFactory;

    protected $table = 'tbl_pejabat_agenda';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'nama_jabatan_sub',
        'nama_pejabat_sub',
        'pangkat_sub',
        'nip_pejabat_sub',
        'nama_jabatan_bag',
        'pangkat_bag',
        'nama_pejabat_bag',
        'nip_pejabat_bag',
    ];

}
