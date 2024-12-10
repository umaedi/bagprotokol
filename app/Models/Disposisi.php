<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = 'tb_disposisi';
    protected $primaryKey = 'dis_id';
    const CREATED_AT = 'dis_created_at';
    const UPDATED_AT = 'dis_updated_at';
    protected $fillable = [
        'dis_qrid',
        'dis_no_surat',
        'dis_tgl',
        'dis_asal',
        'dis_tujuan',
        'dis_status',
        'dis_tgl_terima',
        'dis_catatan'
    ];

    public function tujuan() {
        return $this->belongsTo(OPD::class, 'dis_tujuan', 'id_opd');
    }

}
