<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tbl_user';
    protected $fillable = [
        'username',
        'name',
        'email',
        'no_hp',
        'password',
        'avatar',
        'active',
        'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function opd() {
        return $this->hasOne(OPD::class, 'id_user', 'id');
    }

    public static $rules = [
        'username' => 'required|unique:tbl_user',
        'name' => 'required',
        'email' => 'required|email|unique:tbl_user',
        'no_hp' => 'required|max:20',
        'avatar' => 'max:1024|mimes:jpg,png',
        'level' => 'required',
    ];
    public static $attributeRule = [
        'name' => 'Nama lengkap',
        'active'  => 'Status Pengguna',
        'no_hp'  => 'Nomor Handphone',
        'level'  => 'Role',
    ];
}
