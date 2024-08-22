<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use PDF;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengajuanControllerUser extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mendapatkan data pengguna yang sedang login
        return view('user.pengajuan', compact('user'));
    }

    public function create()
    {
        $user = auth()->user();
        if (is_string($user->tanggallahir)) {
            $user->tanggallahir = Carbon::parse($user->tanggallahir);
        }
        return view('user.pengajuan', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'kelurahan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'jenissurat' => 'required|string|max:255',
            'noreg' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'surattanah' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'suratpermohonan' => 'required|file|mimes:pdf,jpg,jpeg,png',
            'ktp' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $suratTanahPath = $request->file('surattanah')->store('uploads', 'public');
        $suratPermohonanPath = $request->file('suratpermohonan')->store('uploads', 'public');
        $ktpPath = $request->file('ktp')->store('uploads', 'public');

        $user = auth()->user();
        if ($user) {
            Pengajuan::create([
                'nama' => $user->name,
                'nik' => $user->nik,
                'tempat' => $user->tempat,
                'tanggallahir' => $user->tanggallahir,
                'alamat' => $request->alamat,
                'kelurahan' => $request->kelurahan,
                'pekerjaan' => $request->pekerjaan,
                'jenissurat' => $request->jenissurat,
                'noreg' => $request->noreg,
                'tanggal' => $request->tanggal,
                'surattanah' => $suratTanahPath,
                'suratpermohonan' => $suratPermohonanPath,
                'ktp' => $ktpPath,
                'status' => 'Menunggu',
                'statussurat' => 'Tidak Ter-Register',
                'user_id' => $user->id,
            ]);

            return redirect()->route('user.home')->with('success', 'Pengajuan berhasil diajukan dan cek riwayat pengajuan secara berkala untuk mengetahui lebih lanjut.');
        } else {
            return redirect()->route('user.pengajuan')->with('error', 'Anda harus login untuk mengajukan permohonan.');
        }
    }

    public function show($id)
    {
        // Implement show logic if needed
    }

    public function edit($id)
    {
        // Implement edit logic if needed
    }

    public function update(Request $request, $id)
    {
        // Implement update logic if needed
    }

    public function destroy($id)
    {
        // Implement destroy logic if needed
    }

    public function statusPengajuan($id)
    {
        $pengajuan = Pengajuan::findPengajuanById($id);
        return view('user.status-pengajuan', compact('pengajuan'));
    }

    public function riwayat()
    {
        $pengajuan = Pengajuan::getPengajuanByUserId(auth()->user()->id);
        $message = $pengajuan->isEmpty() ? 'Data tidak ditemukan' : '';
        return view('user.riwayat-pengajuan', compact('pengajuan', 'message'));
    }

    public function printResi($id)
    {
        $pengajuan = Pengajuan::findPengajuanById($id);

        $keterangan = $pengajuan->getResiKeterangan();

        $tanggal = Carbon::parse($pengajuan->created_at);

        $bulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $tanggalFormat = $tanggal->format('d') . ' ' . $bulan[$tanggal->format('m')] . ' ' . $tanggal->format('Y');

        $pdf = PDF::loadView('user.resi', compact('pengajuan', 'keterangan', 'tanggalFormat'));

        return $pdf->download('Resi Pengajuan Permohonan.pdf');
    }
}