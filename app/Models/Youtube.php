<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    use HasFactory;

    protected $table = 'tbl_youtube';
    protected $primaryKey = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    protected $fillable = [
        'title',
        'url',
        'desc',
        'picture',
        'active',
    ];

    public static $rules = [
        'title' => 'required|string',
        'url' => 'required',
        'active' => 'required',
//        'picture' => 'required|mimes:png,jpg|max:1024',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', '1');
    }

    public function kategori() {
        return $this->belongsToMany(KategoriGaleri::class, 'kategori_of_yt', 'yt_id', 'kategori_id', 'id', 'id');
    }
}
