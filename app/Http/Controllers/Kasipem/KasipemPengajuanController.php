<?php

namespace App\Http\Controllers\Kasipem;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan;
use Illuminate\Http\Request;

class KasipemPengajuanController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $pengajuan = Pengajuan::whereIn('status', ['Menunggu Persetujuan Kasipem', 'Disetujui'])
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where('nama', 'LIKE', "%$query%");
            })->orderBy('created_at', 'desc')->paginate(20);

        return view('kasipem.pengajuanpermohonankasipem.index', compact('pengajuan'));
    }


    public function approve($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'Disetujui';
        $pengajuan->save();

        return redirect()->route('kasipem.pengajuan.index')->with('success', 'Pengajuan telah disetujui.');
    }

    public function reject(Request $request, $id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'Ditolak oleh Kasipem';
        $pengajuan->keterangan = $request->input('reason');
        $pengajuan->save();

        return redirect()->route('kasipem.pengajuan.index')->with('success', 'Pengajuan telah ditolak dengan alasan: ' . $request->input('reason'));
    }
}
