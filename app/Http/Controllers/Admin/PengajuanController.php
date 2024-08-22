<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;

class PengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $pengajuan = Pengajuan::search($query)
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        $message = $pengajuan->isEmpty() ? 'Data tidak ditemukan' : '';
        $newPengajuanCount = Pengajuan::countNewPengajuan();
        return view('admin.pengajuanpermohonan.index', compact('pengajuan', 'newPengajuanCount', 'message'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'statussurat' => 'required|in:Ter-Register,Tidak Ter-Register,Belum Ditemukan',
        ]);
        $pengajuan = Pengajuan::findPengajuanById($id);
        $pengajuan->statussurat = $request->input('statussurat');
        $pengajuan->save();
        return redirect()->route('pengajuan.index')->with('success', 'Status surat berhasil diperbarui.');
    }

    public function approve($id)
    {
        $pengajuan = Pengajuan::findPengajuanById($id);
        $pengajuan->status = 'Menunggu Persetujuan Kasipem';
        $pengajuan->save();
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan disetujui dan menunggu persetujuan Kasipem.');
    }

    public function reject(Request $request, $id)
    {
        $pengajuan = Pengajuan::findPengajuanById($id);
        $pengajuan->status = 'Ditolak oleh Admin';
        $pengajuan->keterangan = $request->input('keterangan');
        $pengajuan->save();
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan telah ditolak dengan alasan: ' . $request->input('keterangan'));
    }

    public function print($id)
    {
        $pengajuan = Pengajuan::findPengajuanById($id);
        if ($pengajuan->status !== 'Disetujui') {
            abort(404);
        }
        Carbon::setLocale('id');
        $months = [
            'Januari' => 'January',
            'Februari' => 'February',
            'Maret' => 'March',
            'April' => 'April',
            'Mei' => 'May',
            'Juni' => 'June',
            'Juli' => 'July',
            'Agustus' => 'August',
            'September' => 'September',
            'Oktober' => 'October',
            'November' => 'November',
            'Desember' => 'December'
        ];
        foreach ($months as $indo => $english) {
            if (strpos($pengajuan->tanggal, $indo) !== false) {
                $pengajuan->tanggal = str_replace($indo, $english, $pengajuan->tanggal);
                break;
            }
        }
        $pengajuan->tanggal = Carbon::parse($pengajuan->tanggal)->format('d F Y');
        $tahunPengecekan = Carbon::parse($pengajuan->tanggal)->year;
        $html = view('admin.pengajuanpermohonan.print', compact('pengajuan', 'tahunPengecekan'))->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->download('Surat Keterangan.pdf');
    }
}
