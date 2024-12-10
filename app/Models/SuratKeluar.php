<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = 'tbl_qrcode';
    protected $primaryKey = 'id_qr';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'no_surat',
        'tgl_surat',
        'tgl_dikirim',
        'kepada',
        'lampiran',
        'perihal',
        'id_jenis_ttd_fk',
        'berkas',
        'qrcode',
        'created_by'
    ];

    //Pakai TBL Penerima QRCODE
    public function opd()
    {
        return $this->belongsToMany(OPD::class, 'tbl_penerima_qrcode', 'no_surat', 'id_opd','no_surat', 'id_opd');
    }

    //PAKAI TABLE LANGSUNG DISPOSISI
    public function opds() {
        return $this->hasMany(Disposisis::class, 'dis_no_surat', 'no_surat')->whereNull('parent_id');
    }
    public function disposisi() {
        return $this->hasMany(Disposisis::class, 'dis_no_surat', 'no_surat');
    }

    public function ttd() {
        return $this->belongsTo(TandaTangan::class, 'id_jenis_ttd_fk', 'id_jenis_ttd');
    }

   /* public function disposisi() {
        return $this->hasMany(Disposisi::class, 'dis_no_surat', 'no_surat');
    }*/

    public static $rules = [
        'no_surat' => 'required|string',
        'tgl_surat' => 'required|date',
        'tgl_dikirim' => 'required|date',
        'kepada' => 'required|string',
        'lampiran' => 'required',
        'perihal' => 'required',
        'id_jenis_ttd_fk' => 'required',
        'berkas' => 'required|mimes:pdf|max:1024',
    ];
    public static $attributeRule = [
        'no_surat' => 'required|string',
        'tgl_surat' => 'Tanggal Surat',
        'tgl_dikirim' => 'Tanggal Dikirim',
        'id_jenis_ttd_fk' => 'Tanda Tangan',
    ];

    public  static function boot() {
        parent::boot();

        //Menghapus relationship pada tabel penerima qrcode
        static::deleting(function($surat) {
            $surat->disposisi()->delete();
            return true;
        });
    }

}
