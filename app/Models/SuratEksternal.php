<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratEksternal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_surat_eksternal';
    protected $primaryKey = 'eks_id';
    const CREATED_AT = 'eks_created_at';
    const UPDATED_AT = 'eks_updated_at';
    const DELETED_AT = 'eks_deleted_at';
    protected $fillable = [
        'eks_nosurat',
        'eks_tgl_surat',
        'eks_tgl_kirim',
        'eks_dari',
        'eks_pengirim',
        'eks_tertanda',
        'eks_teruskan',
        'eks_status',
        'eks_kategori',
        'eks_karakteristik',
        'eks_derajat',
        'eks_perihal',
        'eks_isi',
        'eks_file_lampiran',
        'eks_qrcode',
        'eks_id_opd',
        'eks_created_by'
    ];

    protected $dates = ['eks_deleted_at'];

    public static $rules = [
        'eks_nosurat' => 'required',
        'eks_tgl_surat' => 'required|date',
        'eks_tgl_kirim' => 'required|date',
        'eks_pengirim' => 'required',
        'eks_tertanda' => 'required',
        'eks_teruskan' => 'required',
        'eks_status' => 'required',
        'eks_karakteristik' => 'required',
        'eks_derajat' => 'required',
        'eks_perihal' => 'required',
        'eks_isi' => 'required',
        'eks_file_lampiran' => 'required|mimes:pdf,jpg,png|max:3096',
    ];


    public function opd()
    {
        return $this->belongsToMany(OPD::class, 'tbl_penerima_qrcode', 'no_surat', 'id_opd', 'eks_nosurat', 'id_opd');
    }

    //PAKAI TABLE LANGSUNG DISPOSISI
    public function opds() {
        return $this->hasMany(Disposisis::class, 'dis_no_surat', 'eks_nosurat')->whereNull('parent_id');
    }
    public function disposisi() {
        return $this->hasMany(Disposisis::class, 'dis_no_surat', 'eks_nosurat');
    }

    public function pengirim() {
        return $this->belongsTo(OPD::class, 'eks_id_opd', 'id_opd');
    }
    /*public function disposisi() {
        return $this->hasMany(Disposisi::class, 'dis_no_surat', 'eks_nosurat');
    }*/

    public  static function boot() {
        parent::boot();

        static::deleting(function($surat) {
            $surat->disposisi()->delete();
            return true;
        });
    }


    public static $attributeRule = [
        'eks_nosurat' => 'Nomor Surat',
        'eks_tgl_surat' => 'Tanggal Surat',
        'eks_tgl_kirim' => 'Tanggal Diterima',
        'eks_dari' => 'Dari',
        'eks_pengirim' => 'Pengirim',
        'eks_tertanda' => 'Tertanda',
        'eks_teruskan' => 'Tersukan',
        'eks_status' => 'Status',
        'eks_karakteristik' => 'Karakteristik',
        'eks_derajat' => 'Derajat',
        'eks_perihal' => 'Perihal',
        'eks_isi' => 'Isi',
        'eks_file_lampiran' => 'Lampiran',
        'eks_qrcode' => 'QRCode'
    ];

}
