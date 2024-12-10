<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OPD extends Model
{
    use HasFactory;

    protected $table = 'tbl_opd';
    protected $primaryKey = 'id_opd';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'nama_opd',
        'alias_opd',
        'alamat_opd',
        'email_opd',
        'notelepon_opd',
        'level_pj',
        'active',
        'id_user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function suratkeluar()
    {
        return $this->belongsToMany(SuratKeluar::class, 'tbl_penerima_qrcode', 'id_opd', 'id_qr');
    }

    public static $rules = [
        'nama_opd' => 'required|max: 50|string',
        'alias_opd' => 'required|max: 50|string',
        'email_opd' => 'required|max: 50|string',
    ];
}
