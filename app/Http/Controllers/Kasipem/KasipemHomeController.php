<?php

namespace App\Http\Controllers\Kasipem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Spgr;
use App\Models\SuratHibah;
use App\Models\Skpt;
use App\Models\Pengajuan;
use App\Models\User;
use Carbon\Carbon;

class KasipemHomeController extends Controller
{
    public function index()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $spgr = Spgr::countCurrentMonthData($currentMonth, $currentYear);
        $surathibah = SuratHibah::countCurrentMonthData($currentMonth, $currentYear);
        $skpt = Skpt::countCurrentMonthData($currentMonth, $currentYear);
        $pengajuan = Pengajuan::countCurrentMonthData($currentMonth, $currentYear);
        $userCount = User::countCurrentMonthData($currentMonth, $currentYear);
        $monthName = Carbon::now()->locale('id')->monthName;
        return view('kasipem.home', compact('spgr', 'surathibah', 'skpt', 'pengajuan', 'userCount', 'monthName', 'currentYear'));
    }
}
