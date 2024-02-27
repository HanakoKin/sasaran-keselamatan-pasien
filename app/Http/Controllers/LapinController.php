<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lapin;
use App\Models\Lemkis;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LapinController extends Controller
{

    public function dashboard(){

        $title = 'Dashboard';

        $totalKasus = Lapin::count();

        $jumlahKNC = Lapin::where('jenis_insiden', 'Kejadian Nyaris Cedera / KNC')->count();
        $jumlahKTC = Lapin::where('jenis_insiden', 'Kejadian Tidak Cedera / KTC')->count();
        $jumlahKTD = Lapin::where('jenis_insiden', 'Kejadian Tidak Diharapkan / KTD')->count();
        $jumlahKPC = Lapin::where('jenis_insiden', 'Kondisi Potensial Cedera / KPC')->count();

        if ($jumlahKNC < 1){
            $prosentaseKNC = 0;
        } else {
            $prosentaseKNC = number_format(($jumlahKNC / $totalKasus) *100, 0);
        }

        if ($jumlahKTC < 1){
            $prosentaseKTC = 0;
        } else {
            $prosentaseKTC = number_format(($jumlahKTC / $totalKasus) *100, 0);
        }

        if ($jumlahKTD < 1){
            $prosentaseKTD = 0;
        } else {
            $prosentaseKTD = number_format(($jumlahKTD / $totalKasus) *100, 0);
        }

        if ($jumlahKPC < 1){
            $prosentaseKPC = 0;
        } else {
            $prosentaseKPC = number_format(($jumlahKPC / $totalKasus) *100, 0);
        }

        $verified = Lapin::where('status', 'Terverifikasi')->count();

        $gradeBiru = Lapin::where('grading_risiko', 'biru')->count();
        $gradeHijau = Lapin::where('grading_risiko', 'hijau')->count();
        $gradeKuning = Lapin::where('grading_risiko', 'kuning')->count();
        $gradeMerah = Lapin::where('grading_risiko', 'merah')->count();

        if ($gradeBiru < 1){
            $prosentaseBiru = 0;
        } else {
            $prosentaseBiru = number_format(($gradeBiru / $verified) *100, 0);
        }

        if ($gradeHijau < 1){
            $prosentaseHijau = 0;
        } else {
            $prosentaseHijau = number_format(($gradeHijau / $verified) *100, 0);
        }

        if ($gradeKuning < 1){
            $prosentaseKuning = 0;
        } else {
            $prosentaseKuning = number_format(($gradeKuning / $verified) *100, 0);
        }

        if ($gradeMerah < 1){
            $prosentaseMerah = 0;
        } else {
            $prosentaseMerah = number_format(($gradeMerah / $verified) *100, 0);
        }

        $colorClass = '';

        if ($prosentaseBiru >= 0 && $prosentaseBiru <= 25) {
            $colorClass = 'info';
        } elseif ($prosentaseBiru > 25 && $prosentaseBiru <= 50) {
            $colorClass = 'success';
        } elseif ($prosentaseBiru > 50 && $prosentaseBiru <= 75) {
            $colorClass = 'warning';
        } elseif ($prosentaseBiru > 75) {
            $colorClass = 'danger';
        }

        // $currentYear = Carbon::now()->year;

        // $dataKNC = [];
        // $dataKTC = [];
        // $dataKTD = [];
        // $dataKPC = [];
        // $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // foreach ($months as $index => $month) {
        //     // Ekstrak bulan dari $index + 1 (1 untuk Januari, 2 untuk Februari, dll.)
        //     $targetMonth = ($index % 12) + 1;

        //     // Query untuk mendapatkan data dari database berdasarkan bulan
        //     $monthlyKNC = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $currentYear, 'Kejadian Nyaris Cedera / KNC'])->pluck('tanggal_kejadian')->toArray();

        //     $monthlyKTC = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $currentYear, 'Kejadian Tidak Cedera / KTC'])->pluck('tanggal_kejadian')->toArray();

        //     $monthlyKTD = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $currentYear, 'Kejadian Tidak Diharapkan / KTD'])->pluck('tanggal_kejadian')->toArray();

        //     $monthlyKPC = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $currentYear, 'Kondisi Potensial Cedera / KPC'])->pluck('tanggal_kejadian')->toArray();

        //     $dataKNC[] = [
        //         'label' => 'Data KNC Bulan ' . ($index + 1),
        //         'data' => $monthlyKNC,
        //     ];

        //     $dataKTC[] = [
        //         'label' => 'Data KTC Bulan ' . ($index + 1),
        //         'data' => $monthlyKTC,
        //     ];

        //     $dataKTD[] = [
        //         'label' => 'Data KTD Bulan ' . ($index + 1),
        //         'data' => $monthlyKTD,
        //     ];

        //     $dataKPC[] = [
        //         'label' => 'Data KPC Bulan ' . ($index + 1),
        //         'data' => $monthlyKPC,
        //     ];
        // }
        // // dd(response()->json($chartData));

        return view('pages.dashboard', compact('title', 'jumlahKNC', 'jumlahKTC', 'jumlahKTD', 'jumlahKPC', 'prosentaseKNC', 'prosentaseKTC', 'prosentaseKTD', 'prosentaseKPC', 'gradeBiru', 'gradeHijau', 'gradeKuning', 'gradeMerah', 'prosentaseBiru', 'prosentaseHijau', 'prosentaseKuning', 'prosentaseMerah', 'colorClass'));

    }

    public function barChartLapin($year){
        // Logika untuk mengambil data dari database berdasarkan tahun
        // Jika $year null, gunakan tahun sekarang
        $targetYear = $year;

        // return response()->json($year);

        $dataKNC = [];
        $dataKTC = [];
        $dataKTD = [];
        $dataKPC = [];
        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach ($months as $index => $month) {
            $targetMonth = ($index % 12) + 1;

            $monthlyKNC = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $targetYear, 'Kejadian Nyaris Cedera / KNC'])->pluck('tanggal_kejadian')->toArray();
            $monthlyKTC = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $targetYear, 'Kejadian Tidak Cedera / KTC'])->pluck('tanggal_kejadian')->toArray();
            $monthlyKTD = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $targetYear, 'Kejadian Tidak Diharapkan / KTD'])->pluck('tanggal_kejadian')->toArray();
            $monthlyKPC = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $targetYear, 'Kondisi Potensial Cedera / KPC'])->pluck('tanggal_kejadian')->toArray();

            $dataKNC[] = [
                'label' => 'Data KNC Bulan ' . ($index + 1),
                'data' => $monthlyKNC,
            ];

            $dataKTC[] = [
                'label' => 'Data KTC Bulan ' . ($index + 1),
                'data' => $monthlyKTC,
            ];

            $dataKTD[] = [
                'label' => 'Data KTD Bulan ' . ($index + 1),
                'data' => $monthlyKTD,
            ];

            $dataKPC[] = [
                'label' => 'Data KPC Bulan ' . ($index + 1),
                'data' => $monthlyKPC,
            ];
        }

        return response()->json([
            'dataKNC' => $dataKNC,
            'dataKTC' => $dataKTC,
            'dataKTD' => $dataKTD,
            'dataKPC' => $dataKPC,
        ]);
    }

    public function lapin(){

        $title = 'Laporan Insiden';

        $lapins = Lapin::orderBy('created_at', 'desc')->get();

        return view('pages.lapin.lapin', compact('lapins', 'title'));

    }

    public function lapinTable(){

        $title = 'Tabel Laporan Insiden';

        $lapins = Lapin::orderBy('created_at', 'desc')->get();

        return view('pages.lapin.lapinTable', compact('lapins', 'title'));

    }

    public function addLapinPage(){

        $title = 'Laporan Insiden Form';

        $ruangan = Ruangan::all();

        return view('pages.lapin.addLapin', compact('title', 'ruangan'));

    }

    public function store(Request $request){

        $kasusInsidenString = implode(', ', $request->input('kasus_insiden', []));

        $jam_masuk = substr($request->jam_masuk, 0, 5);
        $jam_kejadian = substr($request->jam_kejadian, 0, 5);

        $request->merge(['kasus_insiden' => $kasusInsidenString]);
        $request->merge(['jam_masuk' => $jam_masuk]);
        $request->merge(['jam_kejadian' => $jam_kejadian]);

        // dd($request);

        $validatedData = $request->validate([
            'unit_kerja' => 'required|string',
            'pembuat_laporan' => 'required|string',
            'status' => 'required|string',
            'nama' => 'required|string',
            'noRM' => 'required|string|unique:lapins',
            'ruangan' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'umur' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'penjamin' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'tanggal_kejadian' => 'required|date',
            'jam_kejadian' => 'required|date_format:H:i',
            'insiden' => 'required|string',
            'kronologis' => 'required|string',
            'jenis_insiden' => 'required|string',
            'pelapor_insiden' => 'required|string',
            'korban_insiden' => 'required|string',
            'layanan_insiden' => 'required|string',
            'tempat_insiden' => 'required|string',
            'kasus_insiden' => 'required|string',
            'unit_insiden' => 'required|string',
            'dampak_insiden' => 'required|string',
            'tindakan_cepat' => 'required|string',
            'tindakan_insiden' => 'required|string',
            'kejadian_insiden' => 'required|string'
        ]);

        Lapin::create($validatedData);

        return redirect('/lapin')->with('success', 'LAPIN added successfully!');

    }

    public function edit($id){

        $title = 'Edit Laporan Insiden';

        $lapin = Lapin::findOrFail($id);
        $ruangan = Ruangan::all();

        // Tandai data sedang diedit
        $lapin->update(['proses_edit' => true]);

        if ($lapin->status !== "Belum terverifikasi") {
            // If it has been validated, only allow admins to update
            if (!Auth::user()->isAdmin()) {
                return redirect('/lapin')->with('error', 'UNAUTHORIZED ACTION');
            }
        }

        // Ambil data kasus_insiden
        $data_kasus_insiden = $lapin->kasus_insiden;

        // Pemisahan data
        $fixed_data_kasus_insiden = explode(', ', $data_kasus_insiden);

        if(count($fixed_data_kasus_insiden) === 1) {
            $fixed_data_kasus_insiden = [$data_kasus_insiden];
        }

        $fixed_kejadian_insiden = str_replace('Ya, terjadi pada ', '', $lapin->kejadian_insiden);

        return view('pages.lapin.editLapin', compact('lapin', 'fixed_data_kasus_insiden', 'fixed_kejadian_insiden', 'title', 'ruangan'));

    }

    public function update(Request $request, $id){

        $kasusInsidenString = implode(', ', $request->input('kasus_insiden', []));

        $jam_masuk = substr($request->jam_masuk, 0, 5);
        $jam_kejadian = substr($request->jam_kejadian, 0, 5);

        $request->merge(['kasus_insiden' => $kasusInsidenString]);
        $request->merge(['jam_masuk' => $jam_masuk]);
        $request->merge(['jam_kejadian' => $jam_kejadian]);

        // dd($request);

        $validatedData = $request->validate([
            'unit_kerja' => 'required|string',
            'nama' => 'required|string',
            'ruangan' => 'required|string',
            'umur' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'penjamin' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'jam_masuk' => 'required|date_format:H:i',
            'tanggal_kejadian' => 'required|date',
            'jam_kejadian' => 'required|date_format:H:i',
            'insiden' => 'required|string',
            'kronologis' => 'required|string',
            'jenis_insiden' => 'required|string',
            'pelapor_insiden' => 'required|string',
            'korban_insiden' => 'required|string',
            'layanan_insiden' => 'required|string',
            'tempat_insiden' => 'required|string',
            'kasus_insiden' => 'required|string',
            'unit_insiden' => 'required|string',
            'dampak_insiden' => 'required|string',
            'tindakan_cepat' => 'required|string',
            'tindakan_insiden' => 'required|string',
            'kejadian_insiden' => 'required|string'
        ]);

        Lapin::where('id', $id)->update($validatedData);
        // Hapus penanda sedang diedit setelah proses edit selesai
        Lapin::where('id', $id)->update(['proses_edit' => false]);

        return redirect('/lapin')->with('success', 'LAPIN updated successfully!');

    }

    public function resetEditStatus($id){

        $lapin = Lapin::findOrFail($id);

        // Hapus penanda sedang diedit dari database
        $lapin->update(['proses_edit' => false]);

        return response()->json(['message' => 'Status edit berhasil diperbarui']);
    }

    public function delete($id){

        $lemkis = Lemkis::where('lapin_id', '=', $id)->delete();
        $lapin = Lapin::where('id', '=', $id)->delete();

        return back()->with('success', 'LAPIN deleted successfully!');
    }

    public function print($id){

        $title = "Print Laporan Insiden";

        $lapin = Lapin::findOrFail($id);

        return view('pages.lapin.printLapin', compact('title', 'lapin'));
    }

    public function verifikasi($id){

        $title = "Verifikasi Laporan Insiden";

        $category = "Lapin";

        $data = Lapin::findOrFail($id);

        if ($data->proses_edit) {
            return redirect()->back()->with('error', 'Data sedang dalam proses edit. Verifikasi mungkin perlu ditunda.');
        }

        $data->tanggal_masuk = Carbon::parse($data->tanggal_masuk)->format('d-m-Y');
        $data->tanggal_kejadian = Carbon::parse($data->tanggal_kejadian)->format('d-m-Y');

        if ($data->tanggal_terima !== null) {
            $data->tanggal_terima = Carbon::parse($data->tanggal_terima)->format('d-m-Y');
        } else {
            $data->tanggal_terima = '';
        }


        $data->jam_masuk = substr($data->jam_masuk, 0, 5);
        $data->jam_kejadian = substr($data->jam_kejadian, 0, 5);

        return view('pages.lapin.verifikasiLapin', compact('title', 'data', 'category'));
    }

    public function grading(Request $request, $id){

        $lapin = Lapin::findOrFail($id);

        // dd($request);

        $validatedData = $request->validate([
            'status' => 'required|string',
            'penerima_laporan' => 'required|string',
            'tanggal_terima' => 'required|date',
            'grading_risiko' => 'required|string'
        ]);

        $statusMessage = ($validatedData['status'] !== 'Terverifikasi') ? 'Lapin verification removed!' : 'Lapin verified!';


        Lapin::where('id', $id)->update($validatedData);

        // return back()->with('success', 'LAPIN deleted successfully!');

        return redirect('/lapin')->with('success', $statusMessage);

        // return view('pages.verifikasiLapin', compact('title', 'lapin'));
    }

    public function addLemkisPage($id){

        $title = 'Lembar Kerja Investigasi Sederhana';

        $lapin = Lapin::findOrFail($id);

        return view('pages.lemkis.addLemkis', compact('title', 'lapin'));

    }

}
