<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'nik',
        'tempat',
        'tanggallahir',
        'pekerjaan',
        'alamat',
        'phone',
        'email',
        'password',
        'role',
        'is_approved',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Query Halaman User
    public function scopeSearch($queryBuilder, $query)
    {
        return $queryBuilder->where('name', 'like', "%{$query}%")
            ->orWhere('email', 'like', "%{$query}%");
    }

    public static function countUnapprovedUsers()
    {
        return self::where('is_approved', false)->count();
    }

    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

    // Query Halaman Home
    public static function countCurrentMonthData($month, $year)
    {
        return self::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }
}
