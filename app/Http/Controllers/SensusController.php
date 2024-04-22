<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Igd;
use App\Models\Lab;
use App\Models\Gizi;
use App\Models\Rajal;
use App\Models\Ranap;
use App\Models\Rehab;
use App\Models\Bandar;
use App\Models\Kritis;
use App\Models\Farmasi;
use App\Models\Operasi;
use App\Models\Rshusada;
use App\Models\Admission;
use App\Models\Radiologi;
use App\Models\Spesialis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SensusController extends Controller
{
    public function index($item)
    {
        $title = 'Sensus ' . ucwords(trans($item)) . ' Page';

        if ((Auth::user()->role === 'user') && (Auth::user()->unit !== strtoupper(trans($item)))) {
            return redirect('/dashboard')->with('error', 'UNAUTHORIZED ACTION');
        }

        $type = $item;

        return view('pages.sensus.sensus', compact('title', 'type'));
    }

    public function showData(Request $request, $item)
    {
        $currentMonth = $request->input('month') ?? Carbon::now()->translatedFormat('F');
        $currentYear = $request->input('year') ?? now()->format('Y');

        if ($item === 'admission') {
            $datas = Admission::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'bank darah') {
            $datas = Bandar::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'EEG EMG' || $item === 'fisioterapi') {
            $datas = Rehab::where('tahun', $currentYear)->where('bulan', $currentMonth)->where('unit', $item)->get();
        } else if ($item === 'farmasi') {
            $datas = Farmasi::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'gizi produksi') {
            $datas = Gizi::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'graha utama Lt V' || $item === 'graha utama Lt VI' || $item === 'pav ICU anak' || $item === 'pav anggrek' || $item === 'pav cempaka' || $item === 'pav gladiola' || $item === 'pav mawar' || $item === 'pav melati' || $item === 'pav nusa indah' || $item === 'pav putra I' || $item === 'pav putra III' || $item === 'perina' || $item === 'vk graha 5') {
            $datas = Ranap::where('tahun', $currentYear)->where('bulan', $currentMonth)->where('unit', $item)->get();
        } else if ($item === 'kamar operasi') {
            $datas = Operasi::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'klinik spesialis') {
            $datas = Spesialis::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'laboratorium') {
            $datas = Lab::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'pav ICU' || $item === 'pav ICCU') {
            $datas = Kritis::where('tahun', $currentYear)->where('bulan', $currentMonth)->where('unit', $item)->get();
        } else if ($item === 'radiologi') {
            $datas = Radiologi::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'unit gawat darurat') {
            $datas = Igd::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'rshusada') {
            $datas = Rshusada::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        } else if ($item === 'unit rawat jalan') {
            $datas = Rajal::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        }

        // else if ($item === 'rehab') {
        //     $datas = Rehab::where('tahun', $currentYear)->where('bulan', $currentMonth)->get();
        // }

        $sensus = [];

        foreach ($datas as $data) {

            // Gunakan explode pada atribut 'sensus'
            $sensusArray = explode(' -- ', $data->sensus);

            // Gabungkan hasil explode ke dalam array $sensus
            $sensus = array_merge($sensus, $sensusArray);
        }

        $mainArray = [];

        // Loop melalui stringData dan membagi setiap string menjadi array
        foreach ($sensus as $val) {
            $innerArray = explode(', ', $val);
            $mainArray[] = $innerArray;
        }

        if ($item === 'admission') {
            $question = [
                'Kesalahan penulisan nama pada pendaftaran pasien baru',
                'Kesalahan pemasangan gelang pasien baru',
                'Pasien baru yang tidak terpasang gelang identitas',
                'Kesalahan penulisan nama DPJP',
                'Kesalahan penulisan diagnosa',
                'Tulisan DPJP tidak terbaca dengan jelas di surat rawat',
                'Kesalahan pemberian informasi kepada pasien',
                'Kesalahan jenis operasi',
                'Kesalahan posisi operasi',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh'
            ];
        } else if ($item === 'bank darah') {
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'Kesalahan golongan darah',
                'Kesalahan jenis darah',
                'Reaksi transfusi darah',
                'Perbedaan hasil skrining',
                'Ketidakpatuhan cuci tangan',
            ];
        } else if ($item === 'EEG EMG' || $item === 'fisioterapi') {
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'Luka bakar akibat diatermi',
                'kesalahan yang terkait dengan obat yang perlu diwaspadai (High Alert Medications)',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
            ];
        } else if ($item === 'farmasi') {
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'Ketidakpatuhan cuci tangan',
                'Kesalahan yang terkait dengan obat yang perlu diwaspadai (High Alert Medications)',
                'Kesalahan penyerahan obat pada pasien URJ',
                'Kesalahan penyerahan obat pada pasien rawat inap',
                'Kelebihan penyerahan obat pada pasien URJ',
                'Kelebihan penyerahan obat pada pasien rawat inap',
                'Kekurangan penyerahan obat pada pasien URJ',
                'Kekurangan penyerahan obat pada pasien rawat inap',
                'Kesalahan dosis obat',
                'Kesalahan pembacaan resep obat',
                'Kesalahan jenis obat',
                'Kesalahan pencampuran obat KEMOTERAPI',
                'Kesalahan pengemasan obat',

            ];
        } else if ($item === 'gizi produksi') {
            $question = [
                'Keterlambatan penyediaan makanan pada pasien baru',
                'Ketidaktepatan identifikasi pasien',
                'Kesalahan jenis diet',
                'Keterlambatan penyediaan makanan pagi pasien rawat inap',
                'Tercemarnya makanan',
                'Kesalahan sediaan diet khusus',
                'Komunikasi kurang efektif',
                'Ketidakpatuhan cuci tangan',
            ];
        } else if ($item === 'graha utama Lt V' || $item === 'graha utama Lt VI' || $item === 'pav ICU anak' || $item === 'pav anggrek' || $item === 'pav cempaka' || $item === 'pav gladiola' || $item === 'pav mawar' || $item === 'pav melati' || $item === 'pav nusa indah' || $item === 'pav putra I' || $item === 'pav putra III' || $item === 'perina' || $item === 'vk graha 5') {
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'Pasien jatuh',
                'Infus blong',
                'Luka tekan',
                'kesalahan yang terkait dengan obat yang perlu diwaspadai (High Alert Medications)',
                'Kesalahan pemberian obat',
                'Kesalahan cara pemberian obat',
                'Kesalahan pencampuran obat',
                'Kesalahan dosis obat',
                'Reaksi efek samping obat',
                'Kesalahan sampling',
                'Kesalahan hasil sampling',
                'Kesalahan identifikasi pasien pada saat pengambilan sample',
                'Ketidaktepatan tehnik pengambilan sample darah',
                'Kesalahan persiapan operasi',
                'Trauma elektrik',
                'Luka bakar akibat buli – buli panas',
                'Kesalahan persiapan pemeriksaan penunjang',
                'Kesalahan golongan/jenis darah',
                'Reaksi efek samping transfusi darah',
                'Kesalahan pemberian informasi harga alat kesehatan',
                'Kesalahan pemberian informasi kepada dokter',
                'Ketidak jelasan tulisan pada rekam medis pasien',
                'Luka bakar akibat pemasangan Bicnat Drip (100 CC)',
                'Ketidakpatuhan cuci tangan',
                'Tertusuk jarum',
                'Flebitis',
                'ISK (Infeksi Saluran Kemih)',
                'IADP (Infeksi Aliran Darah Primer - pemasangan CVC)',
                'IDO (Infeksi  Daerah Operasi)',
            ];
        } else if ($item === 'kamar operasi') {
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'Kesalahan jenis operasi',
                'Kesalahan posisi',
                'kesalahan terkait dengan obat yang perlu diwaspadai (High Alert Medications)',
                'Ketidakpatuhan pelaksanaan TIME OUT',
                'Tertinggalnya kain kassa',
                'Tertinggalnya instrumen',
                'Operasi tanpa spesialis anestesi',
                'Operasi dengan kekurangan darah',
                'Konsultasi durante operasi',
                'Perluasan operasi',
                'Kesalahan diagnosis pra operasi',
                'Trauma elektrik',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
                'Kesalahan pemberian informasi harga alat kesehatan',
                'Reaksi efek samping transfusi darah',
                'Kesalahan pemberian informasi kepada dokter',
                'Kesalahan pemberian obat',
                'Kesalahan cara pemberian obat',
                'Kesalahan pencampuran obat',
                'Kesalahan dosis obat',
                'Reaksi efek samping obat',
            ];
        } else if ($item === 'klinik spesialis') {
            $question = [
                'Ketidaktepatan identifikasi pasien rawat jalan',
                'Komunikasi kurang efektif',
                'kesalahan yang terkait dengan obat yang perlu diwaspadai (high alert medications)',
                'Kesalahan pemberian obat',
                'Kesalahan cara pemberian obat',
                'Kesalahan pencampuran obat',
                'Kesalahan sampling',
                'Kesalahan identifikasi pasien pada saat pengambilan sample',
                'Kesalahan pemberian informasi',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
            ];
        } else if ($item === 'laboratorium'){
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'Kesalahan penyediaan sample',
                'Kesalahan menginput hasil',
                'Kesalahan pengoperasian alat',
                'Kesalahan pencampuran reagen',
                'Kesalahan mencetak hasil',
                'Kesalahan golongan darah',
                'Kesalahan menyampaikan hasil',
                'Kesalahan pengambilan sample',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',

            ];
        } else if ($item === 'radiologi') {
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'kesalahan yang terkait dengan obat yang perlu diwaspadai (High Alert Medications)',
                'Kesalahan interpretasi hasil',
                'Keterlambatan foto ruangan lebih dari 15 menit',
                'Keterlambatan radiologi pada pemeriksaan radiologi',
                'Kesalahan posisi pemeriksaan',
                'Reaksi obat kontras',
                'Keterlambatan penyerahan hasil foto',
                'Pengulangan pemeriksaan radiologi',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
            ];
        } else if ($item === 'pav ICU' || $item === 'pav ICCU') {
            $question = [
                'Ketidaktepatan identifikasi pasien',
                'Komunikasi kurang efektif',
                'kesalahan yang terkait dengan obat yang perlu diwaspadai (High Alert Medications)',
                'Vagal reflex pada pemasangan ETT',
                'Tersumbatnya saluran nafas yang berakibat bradikardi',
                'Kesalahan setting ventilator',
                'Infus blong',
                'Luka tekan',
                'Kesalahan pemberian obat',
                'Kesalahan cara pemberian obat',
                'Kesalahan pencampuran obat',
                'Kesalahan dosis obat',
                'Reaksi efek samping obat',
                'Kesalahan sampling',
                'Kesalahan hasil sampling',
                'Kesalahan identifikasi pasien pada saat pengambilan sample',
                'Ketidaktepatan tehnik pengambilan sample darah',
                'Kesalahan persiapan operasi',
                'Trauma elektrik',
                'Luka bakar akibat buli – buli panas',
                'Kesalahan persiapan pemeriksaan penunjang',
                'Kesalahan golongan/jenis darah',
                'Reaksi efek samping transfusi darah',
                'Kesalahan pemberian informasi harga alat kesehatan',
                'Kesalahan pemberian informasi kepada dokter',
                'Ketidak jelasan tulisan pada rekam medis pasien',
                'Luka bakar akibat pemasangan Bicnat Drip (100 CC)',
                'Flebitis',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
                'VAP (Ventilator Associated Pneumonia)',
                'ISK (Infeksi Saluran Kemih)',
                'IADP (Infeksi Aliran Darah Primer - Pemasangan PVC)',
                'IDO (Infeksi Daerah Operasi)',
            ];
        } else if ($item === 'unit gawat darurat') {
            $question = [
                'Kesalahan identifikasi pasien',
                'Kesalahan identifikasi kegawatdaruratan',
                'Komunikasi yang kurang efektif',
                'kesalahan yang terkait dengan obat yang perlu diwaspadai (high alert medications)',
                'Kesalahan transportasi pasien',
                'Kesalahan transportasi pasien pada saat merujuk',
                'Kesalahan transportasi pada saat menjemput pasien',
                'Kesalahan pemberian obat',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
                'Tertusuk jarum',
            ];
        } else if ($item === 'rshusada') {
            $question = [
                'Ketidaktepatan identifikasi pasien rawat inap',
                'Ketidaktepatan identifikasi pasien rawat jalan',
                'Komunikasi kurang efektif',
                'Keamanan obat yang kurang diwaspadai',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
                'Kesalahan transportasi pasien saat merujuk',
                'Kesalahan transportasi saat menjemput pasien',
                'Kesalahan jenis operasi',
                'Kesalahan posisi operasi',
                'Tertinggalnya kain kassa',
                'Tertinggalnya instrumen',
                'Operasi tanpa spesialis anestesi',
                'Operasi dengan kekurangan darah',
                'Konsultasi durante operasi',
                'Perluasan operasi',
                'Kesalahan diagnosis pra operasi',
                'Tersumbatnya saluran nafas yang berakibat bradicardi',
                'Kesalahan setting ventilator',
                'Vagal refleks pada pemasangan ET',
                'Infus blong',
                'Trauma elektrik',
                'Kesalahan pemberian informasi kepada dokter',
                'Kesalahan sampling',
                'Kesalahan persiapan pemeriksaan penunjang',
                'Kesalahan persiapan operasi',
                'Luka bakar akibat buli – buli panas',
                'Kesalahan golongan darah',
                'Kesalahan jenis darah',
                'Perbedaan hasil skrining',
                'Kesalahan posisi pemeriksaan',
                'Reaksi obat kontras',
                'Kesalahan pembacaan resep',
                'Kesalahan penyerahan obat',
                'Ketidakjelasan tulisan pada rekam medis',
                'Luka bakar akibat diatermi',
                'Kesalahan cara pemberian obat',
                'Kesalahan pencampuran obat',
                'Kesalahan dosis obat',
                'Kesalahan identifikasi pasien pada saat pengambilan sample',
                'Kesalahan pemberian obat',
                'Kesalahan pemberian informasi harga alat kesehatan',
                'Ketidaktepatan teknik pengambilan sample darah',
                'Luka bakar akibat pemasangan Bicnat Drip (100 CC)',
                'Reaksi efek samping obat',
                'Reaksi efek samping transfusi darah',
            ];
        } else if ($item === 'unit rawat jalan') {
            $question = [
                'Ketidaktepatan identifikasi pasien rawat jalan',
                'Komunikasi kurang efektif',
                'kesalahan yang terkait dengan obat yang perlu diwaspadai (high alert medications)',
                'Kesalahan pemberian obat',
                'Kesalahan cara pemberian obat',
                'Kesalahan pencampuran obat',
                'Kesalahan sampling',
                'Kesalahan identifikasi pasien pada saat pengambilan sample',
                'Kesalahan pemberian informasi',
                'Ketidakpatuhan cuci tangan',
                'Pasien jatuh',
            ];
        }

        $evenDayMonths = ['April', 'Juni', 'September', 'November'];

        if ($currentMonth == 'Februari' && ($currentYear % 4 == 0 && $currentYear % 100 != 0) || $currentYear % 400 == 0) {
            $totalDay = 29;
        } else if ($currentMonth == 'Februari' && $currentYear % 4 != 0) {
            $totalDay = 28;
        } else if (in_array($currentMonth, $evenDayMonths)) {
            $totalDay = 30;
        } else {
            $totalDay = 31;
        }

        $response = [
            'title' => 'Sensus' . $item . 'Page',
            'question' => $question,
            'datas' => $datas,
            'mainArray' => $mainArray,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
            'totalDay' => $totalDay,
        ];

        return response()->json($response);
    }

    public function add($item)
    {
        $title = 'Add Sensus' . $item . 'Page';

        $type = $item;

        return view('pages.sensus.addSensus', compact('title', 'type'));
    }

    public function store(Request $request, $item)
    {

        // dd($request);

        $totalDay = $request->jml_hari;

        $inputArray = $request->sensus;

        $sensusString = implode(', ', $inputArray);
        $sensusString = '';
        foreach ($inputArray as $index => $value) {
            // Set pemisah berdasarkan indeks
            $separator = ((($index) % $totalDay) === $totalDay - 1) ? ' -- ' : ', ';

            // Tambahkan nilai dan pemisah ke string
            $sensusString .= $value . $separator;
        }

        // Hapus pemisah ekstra di akhir string
        $sensusString = rtrim($sensusString, ', --');
        $request->merge(['sensus' => $sensusString]);

        $commonRules = [
            'jml_hari' => 'string',
            'bulan' => 'string',
            'tahun' => 'string',
            'sensus' => 'string',
        ];

        $units = [
            'EEG EMG',
            'fisioterapi',
            'graha utama Lt. V',
            'graha utama Lt. VI',
            'pav ICU',
            'pav ICU anak',
            'pav ICCU',
            'pav anggrek',
            'pav cempaka',
            'pav gladiola',
            'pav mawar',
            'pav melati',
            'pav nusa indah',
            'pav putra I',
            'pav putra II',
            'perina',
            'vk graha 5'
        ];

        foreach($units as $unit){
            if($item === $unit){
                $request->merge(['unit' => $item]);
                $commonRules['unit'] = 'required|string';
            }
        }

        $validator = Validator::make($request->all(), $commonRules);

        if ($validator->fails()) {
            $errors = implode(', ', $validator->errors()->all());
            return back()->with('error', $errors)->withInput();
        }

        $validatedData = $validator->validated();

        if ($item === 'admission') {
            $data = Admission::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Admission::create($validatedData);
            }
        } else if ($item === 'bank darah') {
            $data = Bandar::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Bandar::create($validatedData);
            }
        } else if ($item === 'EEG EMG' || $item === 'fisioterapi') {
            $data = Rehab::where('tahun', $request->tahun)->where('bulan', $request->bulan)->where('unit', $item)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Rehab::create($validatedData);
            }
        } else if ($item === 'farmasi') {
            $data = Farmasi::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Farmasi::create($validatedData);
            }
        } else if ($item === 'gizi produksi') {
            $data = Gizi::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Gizi::create($validatedData);
            }
        } else if ($item === 'graha utama Lt V' || $item === 'graha utama Lt VI' || $item === 'pav ICU anak' || $item === 'pav anggrek' || $item === 'pav cempaka' || $item === 'pav gladiola' || $item === 'pav mawar' || $item === 'pav melati' || $item === 'pav nusa indah' || $item === 'pav putra I' || $item === 'pav putra III' || $item === 'perina' || $item === 'vk graha 5') {
            $data = Ranap::where('tahun', $request->tahun)->where('bulan', $request->bulan)->where('unit', $item)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Ranap::create($validatedData);
            }
        } else if ($item === 'kamar operasi') {
            $data = Operasi::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Operasi::create($validatedData);
            }
        } else if ($item === 'klinik spesialis') {
            $data = Spesialis::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Spesialis::create($validatedData);
            }
        } else if ($item === 'laboratorium') {
            $data = Lab::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Lab::create($validatedData);
            }
        } else if ($item === 'pav ICU' || $item === 'pav ICCU') {
            $data = Kritis::where('tahun', $request->tahun)->where('bulan', $request->bulan)->where('unit', $item)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Kritis::create($validatedData);
            }
        } else if ($item === 'radiologi') {
            $data = Radiologi::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Radiologi::create($validatedData);
            }
        } else if ($item === 'rshusada') {
            $data = Rshusada::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Rshusada::create($validatedData);
            }
        } else if ($item === 'unit gawat darurat') {
            $data = Igd::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Igd::create($validatedData);
            }
        } else if ($item === 'unit rawat jalan') {
            $data = Rajal::where('tahun', $request->tahun)->where('bulan', $request->bulan)->first();
            if (isset($data)) {
                $data->update($validatedData);
            } else {
                Rajal::create($validatedData);
            }
        }


        return redirect('/sensus/' . $item)->with('success', 'Sensus added successfully!');
    }
}
