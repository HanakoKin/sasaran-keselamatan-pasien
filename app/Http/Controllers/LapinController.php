<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lapin;
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

        // dd($colorClass);

        return view('pages.dashboard', compact('title', 'jumlahKNC', 'jumlahKTC', 'jumlahKTD', 'jumlahKPC', 'prosentaseKNC', 'prosentaseKTC', 'prosentaseKTD', 'prosentaseKPC', 'gradeBiru', 'gradeHijau', 'gradeKuning', 'gradeMerah', 'prosentaseBiru', 'prosentaseHijau', 'prosentaseKuning', 'prosentaseMerah', 'colorClass'));

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
            'pembuat_laporan' => 'required|string',
            'status' => 'required|string',
            'nama' => 'required|string',
            'noRM' => 'required|string|unique:lapins',
            'ruangan' => 'required|string',
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
            'nama' => 'required|string',
            'ruangan' => 'required|string',
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

        Lapin::where('id', $id)->update($validatedData);

        return redirect('/lapin')->with('success', 'LAPIN updated successfully!');

    }

    public function delete($id){
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

}
