<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Disposisis extends Model
{
    use HasFactory, NodeTrait;

    protected $table = 'tbl_disposisi';
    protected $primaryKey = 'dis_id';
    const CREATED_AT = 'dis_created_at';
    const UPDATED_AT = 'dis_updated_at';
    protected $fillable = [
        'dis_no_surat',
        'dis_tgl',
        'dis_tujuan',
        'dis_status',
        'dis_tgl_terima',
        'dis_catatan',
        '_lft',
        '_rgt'
    ];

    /*public function disposisi()
    {
        return $this->hasMany(Disposisis::class, 'dis_asal');
    }*/

    public function opd()
    {
        return $this->belongsTo(OPD::class, 'dis_tujuan', 'id_opd');
    }

}
