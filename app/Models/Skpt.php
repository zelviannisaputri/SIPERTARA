<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpt extends Model
{
    protected $table = 'skpt';
    protected $fillable = [
        'tanggal',
        'nomorsurat',
        'noreg',
        'nama',
        'kelurahan',
        'rt',
        'rw',
        'utara',
        'ukuranutara',
        'selatan',
        'ukuranselatan',
        'timur',
        'ukurantimur',
        'barat',
        'ukuranbarat',
        'luas',
        'dasar',
        'letak',
    ];
    // Query Halaman SKPT
    public function scopeSearch($queryBuilder, $query)
    {
        return $queryBuilder->when($query, function ($qb) use ($query) {
            $qb->where('nama', 'like', "%$query%")
                ->orWhere('nomorsurat', 'like', "%$query%");
        });
    }

    // Query Halaman Laporan
    public function scopeFilterByDate($query, $month, $year)
    {
        return $query->when($month, function ($query, $month) {
            return $query->where('tanggal', 'like', "$month%");
        })->when($year, function ($query, $year) {
            return $query->whereYear('tanggal', $year);
        });
    }

    // Query Halaman Home
    public static function countCurrentMonthData($month, $year)
    {
        return self::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }
}
