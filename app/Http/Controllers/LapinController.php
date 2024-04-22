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

    public function dashboard()
    {

        $title = 'Dashboard';

        if (Auth::user()->role === 'user') {
            $lapins = Lapin::Where('unit_kerja', Auth::user()->unit)->get();
        } else {
            $lapins = Lapin::orderBy('created_at', 'desc')->get();
        }

        $totalKasus = $lapins->count();

        $jumlahKPC = $lapins->where('jenis_insiden', 'Kondisi Potensial Cedera Signifikan / KPCS')->count();
        $jumlahKNC = $lapins->where('jenis_insiden', 'Kejadian Nyaris Cedera / KNC')->count();
        $jumlahKTC = $lapins->where('jenis_insiden', 'Kejadian Tidak Cedera / KTC')->count();
        $jumlahKTD = $lapins->where('jenis_insiden', 'Kejadian Tidak Diharapkan / KTD')->count();
        $jumlahSentinel = $lapins->where('jenis_insiden', 'Sentinel')->count();

        $verified = $lapins->where('status', 'Terverifikasi')->count();

        $gradeBiru = $lapins->where('grading_risiko', 'biru')->count();
        $gradeHijau = $lapins->where('grading_risiko', 'hijau')->count();
        $gradeKuning = $lapins->where('grading_risiko', 'kuning')->count();
        $gradeMerah = $lapins->where('grading_risiko', 'merah')->count();

        function calculatePercentage($jumlah, $total)
        {
            return ($total > 0) ? number_format(($jumlah / $total) * 100, 0) : 0;
        }

        $prosentaseKPC = calculatePercentage($jumlahKPC, $totalKasus);
        $prosentaseKNC = calculatePercentage($jumlahKNC, $totalKasus);
        $prosentaseKTC = calculatePercentage($jumlahKTC, $totalKasus);
        $prosentaseKTD = calculatePercentage($jumlahKTD, $totalKasus);
        $prosentaseSentinel = calculatePercentage($jumlahSentinel, $totalKasus);

        $prosentaseBiru = calculatePercentage($gradeBiru, $verified);
        $prosentaseHijau = calculatePercentage($gradeHijau, $verified);
        $prosentaseKuning = calculatePercentage($gradeKuning, $verified);
        $prosentaseMerah = calculatePercentage($gradeMerah, $verified);

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

        return view('pages.dashboard', compact('title', 'jumlahKNC', 'jumlahKTC', 'jumlahKTD', 'jumlahKPC', 'jumlahSentinel', 'prosentaseKPC', 'prosentaseKNC', 'prosentaseKTC', 'prosentaseKTD', 'prosentaseSentinel', 'gradeBiru', 'gradeHijau', 'gradeKuning', 'gradeMerah', 'prosentaseBiru', 'prosentaseHijau', 'prosentaseKuning', 'prosentaseMerah', 'colorClass', 'totalKasus'));
    }

    public function barChartLapinYear($year)
    {
        $targetYear = $year;
        $unit = Auth::user()->unit;

        $months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        $jenisInsiden = [
            'Kondisi Potensial Cedera Signifikan / KPCS',
            'Kejadian Nyaris Cedera / KNC',
            'Kejadian Tidak Cedera / KTC',
            'Kejadian Tidak Diharapkan / KTD',
            'Sentinel',
        ];

        $shortInsiden = [
            'KPC',
            'KNC',
            'KTC',
            'KTD',
            'Sentinel'
        ];

        foreach ($months as $index => $month) {
            $targetMonth = ($index % 12) + 1;

            foreach ($jenisInsiden as $index => $type) {
                $lapinQuery = Lapin::whereYear('tanggal_kejadian', $targetYear)
                    ->whereMonth('tanggal_kejadian', $targetMonth)
                    ->where('jenis_insiden', $type);

                if (!Auth::user()->role === 'user') {
                    $lapinQuery->where('unit_kerja', $unit);
                }

                $monthlyData = $lapinQuery->pluck('tanggal_kejadian')->toArray();

                $dataKey = 'data' . $shortInsiden[$index]; // Membuat nama kunci yang sesuai
                $data[$dataKey][] = [
                    'label' => "Data $shortInsiden[$index] Bulan " . ($index + 1),
                    'data' => $monthlyData,
                ];
            }
        }

        return response()->json($data);
    }

    public function barChartLapinMonth($year, $month)
    {
        $targetYear = $year;
        $targetMonth = $month;
        $unit = Auth::user()->unit;

        $categories = [
            'Kondisi Potensial Cedera Signifikan / KPCS',
            'Kejadian Nyaris Cedera / KNC',
            'Kejadian Tidak Cedera / KTC',
            'Kejadian Tidak Diharapkan / KTD',
            'Sentinel'
        ];

        $data = [];

        foreach ($categories as $index => $category) {
            $lapinQuery = Lapin::whereRaw('MONTH(tanggal_kejadian) = ? AND YEAR(tanggal_kejadian) = ? AND jenis_insiden = ?', [$targetMonth, $targetYear, $category]);

            if (!Auth::user()->role === 'admin') {
                $lapinQuery->where('unit_kerja', $unit);
            }

            $monthlyData = $lapinQuery->pluck('jenis_insiden')->toArray();

            $value = [0, 0, 0, 0, 0];

            if ($monthlyData !== null) {
                $value[$index] = count($monthlyData);
            }

            $data[] = [
                'label' => 'Data ' . $category,
                'data' => $value
            ];
        }

        return response()->json([
            'data' => $data
        ]);
    }

    public function lapin()
    {

        $title = 'Laporan Insiden';

        $lapins = Lapin::orderBy('created_at', 'desc');

        if (Auth::user()->role === 'user') {
            $lapins->where('unit_kerja', Auth::user()->unit);
        }

        $lapins = $lapins->get();

        return view('pages.lapin.lapin', compact('lapins', 'title'));
    }

    public function lapinTable()
    {

        $title = 'Tabel Laporan Insiden';

        $lapins = Lapin::orderBy('created_at', 'desc')->get();

        return view('pages.lapin.lapinTable', compact('lapins', 'title'));
    }

    public function addLapinPage()
    {

        $title = 'Laporan Insiden Form';

        $ruangan = Ruangan::all();

        return view('pages.lapin.addLapin', compact('title', 'ruangan'));
    }

    public function store(Request $request)
    {

        $kasusInsidenString = implode(', ', $request->input('kasus_insiden', []));

        $jam_masuk = substr($request->jam_masuk, 0, 5);
        $jam_kejadian = substr($request->jam_kejadian, 0, 5);

        $request->merge(['kasus_insiden' => $kasusInsidenString]);
        $request->merge(['jam_masuk' => $jam_masuk]);
        $request->merge(['jam_kejadian' => $jam_kejadian]);

        $request->merge(['paraf_pelapor' => $request->input('ttd_pelengkap')]);

        // dd($request);

        $validator = Validator::make($request->all(), [
            'unit_kerja' => 'required|string',
            'pembuat_laporan' => 'required|string',
            'status' => 'required|string',
            'nama' => 'required|string',
            'noRM' => 'required|string',
            'noReg' => 'required|string|unique:lapins',
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
            'kejadian_insiden' => 'required|string',
            'paraf_pelapor' =>  'required|string',
        ]);

        // dd($validator);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        Lapin::create($validatedData);
        return redirect('/lapin')->with('success', 'LAPIN added successfully!');
    }

    public function edit($id)
    {

        $title = 'Edit Laporan Insiden';

        $data = Lapin::findOrFail($id);
        $ruangan = Ruangan::all();
        $kategori = 'lapin';

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== $data->unit_kerja)) {
            return redirect('/lapin')->with('error', 'UNAUTHORIZED ACTION');
        }

        // Tandai data sedang diedit
        $data->update(['proses_edit' => true]);

        if ($data->status !== "Belum terverifikasi") {
            // If it has been validated, only allow admins to update
            if (!Auth::user()->isAdmin()) {
                return redirect('/lapin')->with('error', 'UNAUTHORIZED ACTION');
            }
        }

        // Ambil data kasus_insiden
        $data_kasus_insiden = $data->kasus_insiden;

        // Pemisahan data
        $fixed_data_kasus_insiden = explode(', ', $data_kasus_insiden);

        if (count($fixed_data_kasus_insiden) === 1) {
            $fixed_data_kasus_insiden = [$data_kasus_insiden];
        }

        $fixed_kejadian_insiden = str_replace('Ya, terjadi pada ', '', $data->kejadian_insiden);

        return view('pages.lapin.editLapin', compact('data', 'fixed_data_kasus_insiden', 'fixed_kejadian_insiden', 'title', 'ruangan', 'kategori'));
    }

    public function update(Request $request, $id)
    {

        $kasusInsidenString = implode(', ', $request->input('kasus_insiden', []));

        $jam_masuk = substr($request->jam_masuk, 0, 5);
        $jam_kejadian = substr($request->jam_kejadian, 0, 5);

        $request->merge(['kasus_insiden' => $kasusInsidenString]);
        $request->merge(['jam_masuk' => $jam_masuk]);
        $request->merge(['jam_kejadian' => $jam_kejadian]);

        // dd($request);

        $validator = Validator::make($request->all(), [
            'unit_kerja' => 'required|string',
            'pembuat_laporan' => 'required|string',
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
            'kejadian_insiden' => 'required|string',
            'paraf_pelapor' => 'required|string'
        ]);

        // dd($validator);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        Lapin::where('id', $id)->update($validatedData);
        // Hapus penanda sedang diedit setelah proses edit selesai
        Lapin::where('id', $id)->update(['proses_edit' => false]);

        return redirect('/lapin')->with('success', 'LAPIN updated successfully!');
    }

    public function delete($id)
    {

        $lapin = Lapin::findOrFail($id);

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== $lapin->unit_kerja)) {
            return redirect('/lapin')->with('error', 'UNAUTHORIZED ACTION');
        }

        // Hapus data terkait dari tabel Lemkis
        Lemkis::where('lapin_id', $id)->delete();

        // Hapus data Lapin
        $lapin->delete();

        return back()->with('success', 'LAPIN deleted successfully!');
    }

    public function resetEditStatus($id)
    {

        $lapin = Lapin::findOrFail($id);

        // Hapus penanda sedang diedit dari database
        $lapin->update(['proses_edit' => false]);

        return response()->json(['message' => 'Status edit berhasil diperbarui']);
    }

    public function print($id)
    {

        $title = "Print Laporan Insiden";

        $lapin = Lapin::findOrFail($id);

        return view('pages.lapin.printLapin', compact('title', 'lapin'));
    }

    public function verifikasi($id)
    {

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

    public function grading(Request $request, $id)
    {

        $lapin = Lapin::findOrFail($id);

        // dd($request);

        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'penerima_laporan' => 'required|string',
            'tanggal_terima' => 'required|date',
            'grading_risiko' => 'required|string',
            'paraf_penerima' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        $statusMessage = ($validatedData['status'] !== 'Terverifikasi') ? 'Lapin verification removed!' : 'Lapin verified!';

        Lapin::where('id', $id)->update($validatedData);

        return redirect('/lapin')->with('success', $statusMessage);
    }

    public function addLemkisPage($id)
    {

        $title = 'Lembar Kerja Investigasi Sederhana';

        $lapin = Lapin::findOrFail($id);

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== $lapin->unit_kerja)) {
            return redirect('/lapin')->with('error', 'UNAUTHORIZED ACTION');
        }

        return view('pages.lemkis.addLemkis', compact('title', 'lapin'));
    }
}
