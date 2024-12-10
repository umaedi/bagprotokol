<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TandaTangan extends Model
{
    use HasFactory;

    protected $table = 'tbl_jenis_ttd';
    protected $primaryKey = 'id_jenis_ttd';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'jenis_ttd',
        'active',
    ];

    public static $rules = [
        'jenis_ttd' => 'required|max:100'
    ];

    public static $attributeRule = [
        'jenis_ttd' => 'Tanda Tangan'
    ];

}
