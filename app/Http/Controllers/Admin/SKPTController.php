<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skpt;
use Illuminate\Http\Request;

class SKPTController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $skpt = Skpt::search($query)->orderBy('created_at', 'desc')->paginate(20);
        $message = $skpt->isEmpty() ? 'Data tidak ditemukan' : '';
        return view('admin.skpt.index', compact('skpt', 'message'));
    }

    public function create()
    {
        return view('admin.skpt.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nomorsurat' => 'required|string|max:255|unique:skpt',
            'noreg' => 'required|string|max:255|unique:skpt',
            'nama' => 'required|string|max:255',
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
        Skpt::create($validated);
        return redirect()->route('skpt.index')->with('success', 'Data SKPT berhasil ditambahkan');
    }

    public function show($id)
    {
        $skpt = Skpt::findOrFail($id);
        return view('admin.skpt.show', compact('skpt'));
    }

    public function edit($id)
    {
        $skpt = Skpt::findOrFail($id);
        return view('admin.skpt.edit', compact('skpt'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'nomorsurat' => 'required|string|max:255|unique:skpt,nomorsurat,' . $id,
            'noreg' => 'required|string|max:255|unique:skpt,noreg,' . $id,
            'nama' => 'required|string|max:255',
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
        $skpt = Skpt::findOrFail($id);
        $skpt->update($request->all());
        return redirect()->route('skpt.index')->with('success', 'Data SKPT berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $skpt = Skpt::findOrFail($id);
        $skpt->delete();
        return redirect()->route('skpt.index')->with('success', 'Data SKPT berhasil dihapus');
    }
}
