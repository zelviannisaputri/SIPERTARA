<?php

namespace App\Http\Controllers\Kasipem;

use App\Http\Controllers\Controller;
use App\Models\Skpt;
use Illuminate\Http\Request;

class KasipemSKPTController extends Controller
{
    public function index(Request $request)
    {
        $skpt = \App\Models\Skpt::paginate(20);
        return view('admin.skpt.index', compact('skpt'));
    }
}
