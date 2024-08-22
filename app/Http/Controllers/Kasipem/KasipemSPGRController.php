<?php

namespace App\Http\Controllers\Kasipem;

use App\Http\Controllers\Controller;
use App\Models\SPGR;
use Illuminate\Http\Request;

class KasipemSPGRController extends Controller
{
    public function index(Request $request)
    {
        $spgr = \App\Models\Spgr::paginate(20);
        return view('admin.spgr.index', compact('spgr'));
    }
}
