<?php

namespace App\Http\Controllers\Kasipem;

use App\Http\Controllers\Controller;
use App\Models\SuratHibah;
use Illuminate\Http\Request;

class KasipemSuratHibahController extends Controller
{
    public function index(Request $request)
    {
        $surathibah = \App\Models\SuratHibah::paginate(20);
        return view('admin.surathibah.index', compact('surathibah'));
    }
}
