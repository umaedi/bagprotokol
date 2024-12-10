<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'tbl_agenda';
    protected $primaryKey = 'agenda_id';
    const CREATED_AT = 'agenda_created_at';
    const UPDATED_AT = 'agenda_updated_at';
    protected $fillable = [
        'agenda_nama',
        'agenda_lokasi',
        'agenda_pejabat',
        'agenda_undangan',
        'agenda_tgl_mulai',
//        'agenda_tgl_akhir',
        'agenda_waktu',
        'agenda_pakaian',
    ];

    public static $rules = [
        'agenda_nama' => 'required|string',
        'agenda_pakaian' => 'required|string',
        'agenda_lokasi' => 'required|string',
        'agenda_pejabat' => 'required|string',
//        'agenda_undangan' => 'required|string',
        'agenda_tgl_mulai' => 'required',
//        'agenda_tgl_akhir' => 'required',
        'agenda_waktu' => 'required',
    ];

    public static $attributeRule = [
        'agenda_nama' => 'Nama Agenda',
        'agenda_pakaian' => 'Pakaian',
        'agenda_lokasi' => 'Lokasi Agenda',
        'agenda_pejabat' => 'Pejabat',
        'agenda_undangan' => 'Undangan',
        'agenda_tgl_mulai' => 'Tanggal Mulai',
        'agenda_tgl_akhir' => 'Tanggal Akhir',
        'agenda_waktu' => 'Waktu Agenda',
    ];

}
