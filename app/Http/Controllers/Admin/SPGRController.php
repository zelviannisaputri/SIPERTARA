<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SPGR;
use Illuminate\Http\Request;

class SPGRController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $spgr = Spgr::search($query)->orderBy('created_at', 'desc')->paginate(20);
        $message = $spgr->isEmpty() ? 'Data tidak ditemukan' : '';
        return view('admin.spgr.index', compact('spgr', 'message'));
    }

    public function create()
    {
        return view('admin.spgr.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nomorsurat' => 'required|string|max:255|unique:spgr',
            'noreg' => 'required|string|max:255|unique:spgr',
            'penjual' => 'required|string|max:255',
            'pembeli' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
            'utara' => 'required|string|max:255',
            'selatan' => 'required|string|max:255',
            'timur' => 'required|string|max:255',
            'barat' => 'required|string|max:255',
            'ukuranutara' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'ukuranselatan' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'ukurantimur' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'ukuranbarat' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'luas' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'dasar' => 'required|string|max:255',
            'letak' => 'required|string|max:255',
        ]);
        SPGR::create($validated);
        return redirect()->route('spgr.index')->with('success', 'Data SPGR berhasil ditambahkan');
    }

    public function show($id)
    {
        $spgr = SPGR::findOrFail($id);
        return view('admin.spgr.show', compact('spgr'));
    }

    public function edit($id)
    {
        $spgr = SPGR::findOrFail($id);
        return view('admin.spgr.edit', compact('spgr'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nomorsurat' => 'required|string|max:255|unique:spgr,nomorsurat,' . $id,
            'noreg' => 'required|string|max:255|unique:spgr,noreg,' . $id,
            'penjual' => 'required|string|max:255',
            'pembeli' => 'required|string|max:255',
            'kelurahan' => 'required|string',
            'rt' => 'required|string|max:255',
            'rw' => 'required|string|max:255',
            'utara' => 'required|string|max:255',
            'ukuranutara' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'selatan' => 'required|string|max:255',
            'ukuranselatan' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'timur' => 'required|string|max:255',
            'ukurantimur' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'barat' => 'required|string|max:255',
            'ukuranbarat' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'luas' => 'required|regex:/^\d+(\,\d{1,4})?$/',
            'dasar' => 'required|string|max:255',
            'letak' => 'required|string|max:255',
        ]);
        $spgr = SPGR::findOrFail($id);
        $spgr->update($request->all());
        return redirect()->route('spgr.index')->with('success', 'Data SPGR berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $spgr = SPGR::findOrFail($id);
        $spgr->delete();
        return redirect()->route('spgr.index')->with('success', 'Data SPGR berhasil dihapus');
    }
}
