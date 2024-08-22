<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $fillable = [
        'nomorpengajuan',
        'nama',
        'nik',
        'tempat',
        'tanggallahir',
        'alamat',
        'kelurahan',
        'pekerjaan',
        'jenissurat',
        'noreg',
        'tanggal',
        'surattanah',
        'suratpermohonan',
        'ktp',
        'status',
        'statussurat',
        'keterangan',
        'user_id',
    ];

    protected $attributes = [
        'statussurat' => 'Tidak Ter-Register',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->nomorpengajuan = 'KRB-' . strtoupper(uniqid());
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($queryBuilder, $query)
    {
        return $queryBuilder->when($query, function ($qb) use ($query) {
            $qb->where('nama', 'LIKE', "%$query%")
                ->orWhere('nik', 'LIKE', "%$query%")
                ->orWhere('noreg', 'LIKE', "%$query%");
        });
    }

    public static function countNewPengajuan()
    {
        return self::where('status', 'Menunggu')->count();
    }

    public static function findPengajuanById($id)
    {
        return self::findOrFail($id);
    }

    // Query Halaman Home
    public static function countCurrentMonthData($month, $year)
    {
        return self::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->count();
    }

    // Query Halaman Pengajuan User
    public static function getPengajuanByUserId($userId)
    {
        return self::where('user_id', $userId)->get();
    }

    public function getResiKeterangan()
    {
        if ($this->status === 'Disetujui') {
            return '<br>Pengajuan permohonan Anda telah disetujui. <br>Silakan ambil dokumen di kantor dengan membawa berkas berikut :<ul><li>Resi</li><li>KTP (Fotocopy)</li><li>Surat Tanah (Asli & Fotocopy)</li><li>Surat Permohonan (Asli & Fotocopy)</li></ul>';
        } elseif ($this->status === 'Ditolak oleh Admin') {
            return '<br>Pengajuan permohonan Anda ditolak dengan alasan ' . $this->keterangan . '.<br>Silakan kunjungi kantor camat Rumbai Barat untuk informasi lebih lanjut.';
        } else {
            return 'Menunggu persetujuan.';
        }
    }
}
