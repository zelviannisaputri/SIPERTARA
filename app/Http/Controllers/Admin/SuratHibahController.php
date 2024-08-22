<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratHibah;
use Illuminate\Http\Request;

class SuratHibahController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $surathibah = SuratHibah::search($query)->orderBy('created_at', 'desc')->paginate(20);
        $message = $surathibah->isEmpty() ? 'Data tidak ditemukan' : '';
        return view('admin.surathibah.index', compact('surathibah', 'message'));
    }

    public function create()
    {
        return view('admin.surathibah.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nomorsurat' => 'required|string|max:255|unique:surathibah',
            'noreg' => 'required|string|max:255|unique:surathibah',
            'pemberi' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
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
        SuratHibah::create($validated);
        return redirect()->route('surathibah.index')->with('success', 'Data Surat Hibah berhasil ditambahkan');
    }

    public function show($id)
    {
        $surathibah = SuratHibah::findOrFail($id);
        return view('admin.surathibah.show', compact('surathibah'));
    }

    public function edit($id)
    {
        $surathibah = SuratHibah::findOrFail($id);
        return view('admin.surathibah.edit', compact('surathibah'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'nomorsurat' => 'required|string|max:255|unique:surathibah,nomorsurat,' . $id,
            'noreg' => 'required|string|max:255|unique:surathibah,noreg,' . $id,
            'pemberi' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'rt' => 'required|numeric',
            'rw' => 'required|numeric',
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
        $surathibah = SuratHibah::findOrFail($id);
        $surathibah->update($request->all());
        return redirect()->route('surathibah.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = SuratHibah::findOrFail($id);
        $data->delete();
        return redirect()->route('surathibah.index')->with('success', 'Data Surat Hibah berhasil dihapus');
    }
}
