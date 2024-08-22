<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use App\Models\SPGR;
use App\Models\Skpt;
use App\Models\SuratHibah;

class LaporanController extends Controller
{
    public function showReportPage()
    {
        $spgrData = SPGR::all();
        $surathibahData = SuratHibah::all();
        $skptData = Skpt::all();
        $noDataMessage = '';
        if ($spgrData->isEmpty() && $surathibahData->isEmpty() && $skptData->isEmpty()) {
            $noDataMessage = 'Tidak ada data yang tersedia untuk ditampilkan.';
        }
        return view('admin.laporan.index', compact('spgrData', 'surathibahData', 'skptData', 'noDataMessage'));
    }

    public function generateReportSPGR(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $spgrData = SPGR::filterByDate($month, $year)->get();
        $pdf = PDF::loadView('admin.laporan.spgr', compact('spgrData'))->setPaper('landscape');
        return $pdf->download('Surat Pernyataan Ganti Rugi (SPGR) Tanah.pdf');
    }

    public function generateReportSuratHibah(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $surathibahData = SuratHibah::filterByDate($month, $year)->get();
        $pdf = PDF::loadView('admin.laporan.suratHibah', compact('surathibahData'))->setPaper('landscape');
        return $pdf->download('Surat Hibah.pdf');
    }

    public function generateReportSKPT(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $skptData = Skpt::filterByDate($month, $year)->get();
        $pdf = PDF::loadView('admin.laporan.skpt', compact('skptData'))->setPaper('landscape');
        return $pdf->download('Surat Keterangan Pendaftaran Tanah (SKPT).pdf');
    }
}
