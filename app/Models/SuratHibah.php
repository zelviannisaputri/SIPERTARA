<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratHibah extends Model
{
    use HasFactory;
    protected $table = 'surathibah';
    protected $fillable = [
        'tanggal',
        'nomorsurat',
        'noreg',
        'pemberi',
        'penerima',
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

    // Query Halaman Surat Hibah
    public function scopeSearch($queryBuilder, $query)
    {
        return $queryBuilder->when($query, function ($qb) use ($query) {
            $qb->where('pemberi', 'LIKE', "%$query%")
                ->orWhere('penerima', 'LIKE', "%$query%")
                ->orWhere('nomorsurat', 'LIKE', "%$query%");
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
