@extends('index')

@section('container')
<section class="content pt-0">

    <div class="row">
        <div class="col-12">

            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/lapin">Kelola Laporan Insiden</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah Laporan Insiden</li>
                    </ol>
                </nav>
            </div>

            {{-- Form --}}
            <form action="{{ url('/lapin/add') }}" method="post" enctype="multipart/form-data"
                onsubmit="return validasiForm()">
                @csrf
                <div class="box-body">

                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien</h4>
                    <hr class="my-15">

                    <input type="hidden" name="pembuat_laporan" value="{{ auth()->user()->nama }}">
                    <input type="hidden" name="status" value="Belum terverifikasi">
                    <div class="col-sm-12">
                        <label for="naLap" class="form-label text-bold">Nama</label>
                        <input type="text" class="form-control" id="naLap" name="nama" placeholder="" required readonly>
                        <div class="invalid-feedback">
                            Valid Nama is required.
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col-sm-6">
                            <label for="noRMLap" class="form-label text-bold">No RM</label>
                            <input type="text" class="form-control" id="noRMLap" name="noRM" placeholder="" required>
                            <div class="invalid-feedback">
                                Valid No RM is required.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="ruLap" class="form-label text-bold">Ruangan</label>
                            {{-- <input type="text" class="form-control" id="ruLap" name="ruangan" placeholder="" required> --}}
                            <select class="form-control select2" id="ruLap" name="ruangan" style="width: 100%;">
                                <option>Pilih salah satu</option>
                                @foreach ($ruangan as $item)
                                <option value="{{ $item->nama }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Valid Ruangan is required.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="d-flex align-items-center">
                            <label for="jenis_kelamin" class="form-label me-3 text-bold">Jenis Kelamin</label>
                            <div class="form-group mb-0">
                                <div class="form-check form-check-inline">
                                    <input id="jekel1" name="jenis_kelamin" type="radio" class="form-check-input"
                                        value="Laki-laki" required onclick="return false" style="pointer-events: none">
                                    <label class="form-check-label" for="jekel1">Laki-laki</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input id="jekel2" name="jenis_kelamin" type="radio" class="form-check-input"
                                        value="Perempuan" required onclick="return false" style="pointer-events: none">
                                    <label class="form-check-label" for="jekel2">Perempuan</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="umur" class="form-label text-bold">Umur</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="umur1" name="umur" type="radio" class="form-check-input"
                                                value="0 - 1 bulan" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="umur1">0 - 1 bulan</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="umur2" name="umur" type="radio" class="form-check-input"
                                                value="> 1 bulan - 1 tahun" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="umur2">> 1 bulan - 1 tahun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="umur3" name="umur" type="radio" class="form-check-input"
                                                value="> 1 tahun - 5 tahun" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="umur3">> 1 tahun - 5 tahun</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="umur4" name="umur" type="radio" class="form-check-input"
                                                value="> 5 tahun - 15 tahun" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="umur4">> 5 tahun - 15
                                                tahun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="umur5" name="umur" type="radio" class="form-check-input"
                                                value="> 15 tahun - 30 tahun" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="umur5">> 15 tahun - 30 tahun</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="umur6" name="umur" type="radio" class="form-check-input"
                                                value="> 30 tahun - 65 tahun" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="umur6">> 30 tahun - 65 tahun</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-end">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="umur7" name="umur" type="radio" class="form-check-input"
                                                value="> 65 tahun" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="umur7">> 65 tahun</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Please select a valid Umur.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="penjamin" class="form-label text-bold">Penanggung Biaya Pasien</label>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="penjamin1" name="penjamin" type="radio" class="form-check-input"
                                                value="Pribadi" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="penjamin1">Pribadi</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="penjamin2" name="penjamin" type="radio" class="form-check-input"
                                                value="Pemerintah" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="penjamin2">Pemerintah</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="penjamin3" name="penjamin" type="radio" class="form-check-input"
                                                value="BPJS" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="penjamin3">BPJS</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="penjamin4" name="penjamin" type="radio" class="form-check-input"
                                                value="Asuransi Swasta" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="penjamin4">Asuransi Swasta</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="penjamin5" name="penjamin" type="radio" class="form-check-input"
                                                value="Perusahaan" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="penjamin5">Perusahaan</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-check form-check-inline ms-3">
                                            <input id="penjamin6" name="penjamin" type="radio" class="form-check-input"
                                                value="Lain-lain" required onclick="return false"
                                                style="pointer-events: none">
                                            <label class="form-check-label" for="penjamin6">Lain-lain</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="tamas" class="form-label text-bold">Tanggal Masuk RS:</label>
                            <input type="date" class="form-control" id="tamas" name="tanggal_masuk" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="jamas" class="form-label text-bold">Jam:</label>
                            <input type="time" class="form-control" id="jamas" name="jam_masuk" readonly>
                        </div>
                    </div>


                    <h4 class="box-title text-info mb-0 mt-30"><i class="fal fa-books-medical"></i> Rincian Kejadian
                    </h4>
                    <hr class="my-15">

                    <p class="mt-3 mb-0 text-bold">1. Tanggal dan Waktu Insiden</p>

                    <div class="row">
                        <div class="col-md-6 mt-2">
                            <label for="takej" class="form-label text-bold">Tanggal:</label>
                            <input type="date" class="form-control" id="takej" name="tanggal_kejadian">
                        </div>
                        <div class="col-md-6 mt-2">
                            <label for="jakej" class="form-label text-bold">Jam:</label>
                            <input type="time" class="form-control" id="jakej" name="jam_kejadian">
                        </div>
                    </div>

                    <div class="col-md-12 my-3">
                        <label for="inLap" class="form-label text-bold">2. Insiden</label>
                        <input type="text" class="form-control" id="inLap" name="insiden" placeholder="" value=""
                            required>
                        <div class="invalid-feedback">
                            Valid Insiden is required.
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="kronLap" class="form-label text-bold">3. Kronologis Insiden</label>
                        <textarea rows="3" class="form-control" id="kronLap" name="kronologis" placeholder="" value=""
                            required></textarea>
                        <div class="invalid-feedback">
                            Valid Kronologis Insiden is required.
                        </div>
                    </div>

                    <div class="col-md-12 my-3">
                        <label for="jenis_insiden" class="form-label text-bold">4. Jenis Insiden</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline  ms-3">
                                        <input id="jenLap1" name="jenis_insiden" type="radio" class="form-check-input"
                                            value="Kejadian Nyaris Cedera / KNC" required>
                                        <label class="form-check-label" for="jenLap1">Kejadian Nyaris Cedera /
                                            KNC</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline  ms-3">
                                        <input id="jenLap2" name="jenis_insiden" type="radio" class="form-check-input"
                                            value="Kejadian Tidak Cedera / KTC" required>
                                        <label class="form-check-label" for="jenLap2">Kejadian Tidak Cedera /
                                            KTC</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline  ms-3">
                                        <input id="jenLap3" name="jenis_insiden" type="radio" class="form-check-input"
                                            value="Kejadian Tidak Diharapkan / KTD" required>
                                        <label class="form-check-label" for="jenLap3">Kejadian Tidak Diharapkan /
                                            KTD</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline  ms-3">
                                        <input id="jenLap4" name="jenis_insiden" type="radio" class="form-check-input"
                                            value="Kondisi Potensial Cedera / KPC" required>
                                        <label class="form-check-label" for="jenLap4">Kondisi Potensial Cedera /
                                            KPC</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="pelapor_insiden" class="form-label me-3 text-bold">5. Orang Pertama yang Melaporkan
                            Insiden</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input id="penLap1" name="pelapor_insiden" type="radio" class="form-check-input"
                                            value="Karyawan ( Dokter / Perawat / Petugas Lainnya )" required>
                                        <label class="form-check-label" for="penLap1">Karyawan ( Dokter / Perawat /
                                            Petugas
                                            Lainnya )</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input id="penLap2" name="pelapor_insiden" type="radio" class="form-check-input"
                                            value="Pasien" required>
                                        <label class="form-check-label" for="penLap2">Pasien</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input id="penLap3" name="pelapor_insiden" type="radio" class="form-check-input"
                                            value="Pengunjung" required>
                                        <label class="form-check-label" for="penLap3">Pengunjung</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-3">
                                        <input id="penLap4" name="pelapor_insiden" type="radio" class="form-check-input"
                                            value="Keluarga / Pendamping" required>
                                        <label class="form-check-label" for="penLap4">Keluarga / Pendamping
                                            Pasien</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline ms-25 mt-2 p-0">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input id="penLap5" name="pelapor_insiden"
                                                    class="form-check-input mt-0 ms-0" type="radio" value=""
                                                    aria-label="Radio button for following text input">
                                                <label class=mb-2 for="penLap5"
                                                    style="padding-left: 20px;height: 17px;"></label>
                                            </div>
                                            <input id="pelapor_lain" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                                onclick="selectRadio('penLap5')"
                                                oninput="syncInputRadio('penLap5', 'pelapor_lain')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="korban_insiden" class="form-label text-bold">6. Insiden terjadi pada</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline  ms-3">
                                        <input id="korLap1" name="korban_insiden" type="radio" class="form-check-input"
                                            value="Pasien" required>
                                        <label class="form-check-label" for="korLap1">Pasien</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline  ms-25 p-0">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input id="korLap2" name="korban_insiden"
                                                    class="form-check-input mt-0 ms-0" type="radio" value=""
                                                    aria-label="Radio button for following text input">
                                                <label class=mb-2 for="korLap2"
                                                    style="padding-left: 20px;height: 17px;"></label>
                                            </div>
                                            <input id="korban_lain" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                                onclick="selectRadio('korLap2')"
                                                oninput="syncInputRadio('korLap2', 'korban_lain')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="layanan_insiden" class="form-label text-bold">7. Insiden menyangkut pasien</label>
                        <div class="form-group d-flex justify-content-between align-items-center">
                            <div class="form-check form-check-inline  ms-3">
                                <input id="inLap1" name="layanan_insiden" type="radio" class="form-check-input"
                                    value="Pasien Rawat Inap" required>
                                <label class="form-check-label" for="inLap1">Pasien Rawat
                                    Inap</label>
                            </div>
                            <div class="form-check form-check-inline  ms-3">
                                <input id="inLap2" name="layanan_insiden" type="radio" class="form-check-input"
                                    value="Pasien Rawat Jalan" required>
                                <label class="form-check-label" for="inLap2">Pasien Rawat
                                    Jalan</label>
                            </div>
                            <div class="form-check form-check-inline  ms-3">
                                <input id="inLap3" name="layanan_insiden" type="radio" class="form-check-input"
                                    value="Pasien UGD" required>
                                <label class="form-check-label" for="inLap3">Pasien UGD</label>
                            </div>
                            <div class="form-check form-check-inline p-0">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input id="inLap4" name="layanan_insiden" class="form-check-input mt-0 ms-0"
                                            type="radio" value="" aria-label="Radio button for following text input">
                                        <label class=mb-2 for="inLap4" style="padding-left: 20px;height: 17px;"></label>
                                    </div>
                                    <input id="layanan_lain" type="text" class="form-control"
                                        aria-label="Text input with radio button" placeholder="Lain-lain"
                                        onclick="selectRadio('inLap4')"
                                        oninput="syncInputRadio('inLap4', 'layanan_lain')">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="temLap" class="form-label text-bold">8. Tempat Insiden</label>
                        <input type="text" class="form-control" id="temLap" name="tempat_insiden" placeholder=""
                            value="" required>
                        <div class="invalid-feedback">
                            Valid Tempat Insiden is required.
                        </div>
                    </div>

                    <div class="col-md-12 my-3">
                        <label for="kasus_insiden" class="form-label text-bold">9. Insiden terjadi pada pasien ( sesuai
                            kasus penyakit / spesialisasi )</label>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-check">
                                        <input id="kasus1" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Penyakit Dalam dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus1">Penyakit Dalam dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus2" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Anak dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus2">Anak dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus3" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Bedah dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus3">Bedah dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus4" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Obstetri Gynekologi dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus4">Obstetri Gynekologi dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus5" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="THT dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus5">THT dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus6" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Mata dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus6">Mata dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus7" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Saraf dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus7">Saraf dan
                                            Subspesialiasinya</label>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-check">
                                        <input id="kasus8" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Anastesi dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus8">Anastesi dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus9" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Kulit & Kelamin dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus9">Kulit & Kelamin dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus10" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Jantung dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus10">Jantung dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus11" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Paru dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus11">Paru dan
                                            Subspesialiasinya</label>
                                    </div>
                                    <div class="form-check">
                                        <input id="kasus12" name="kasus_insiden[]" type="checkbox"
                                            class="form-check-input" value="Jiwa dan Subspesialisasinya">
                                        <label class="form-check-label" for="kasus12">Jiwa dan
                                            Subspesialiasinya</label>
                                    </div>

                                    <div class="form-check ps-0 ms-10">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <input id="kasus13" name="kasus_insiden[]"
                                                    class="form-check-input mt-0 ms-0" type="checkbox" value=""
                                                    aria-label="Radio button for following text input">
                                                <label class=mb-2 for="kasus13"
                                                    style="padding-left: 20px;height: 17px;"></label>
                                            </div>
                                            <input id="kasus_lain" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Lain-lain"
                                                onclick="selectRadio('kasus13')"
                                                oninput="syncInputRadio('kasus13', 'kasus_lain')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="unLap" class="form-label text-bold">10. Unit / Departemen terkait yang
                            menyebabkan insiden</label>
                        <input type="text" class="form-control" id="unLap" name="unit_insiden" placeholder="" value=""
                            required>
                        <div class="invalid-feedback">
                            Valid Unit Insiden is required.
                        </div>
                    </div>

                    <div class="col-md-12 my-3">
                        <label for="dampak_insiden" class="form-label text-bold">11. Akibat insiden terhadap
                            pasien</label>
                        <div class="form-group">
                            <div class="form-check form-check-inline  ms-3">
                                <input id="dampak1" name="dampak_insiden" type="radio" class="form-check-input"
                                    value="Kematian" required>
                                <label class="form-check-label" for="dampak1">Kematian</label>
                            </div>
                            <div class="form-check form-check-inline  ms-3">
                                <input id="dampak2" name="dampak_insiden" type="radio" class="form-check-input"
                                    value="Cedera Irreversibel / Cedera Berat" required>
                                <label class="form-check-label" for="dampak2">Cedera Irreversibel /
                                    Cedera Berat</label>
                            </div>
                            <div class="form-check form-check-inline  ms-3">
                                <input id="dampak3" name="dampak_insiden" type="radio" class="form-check-input"
                                    value="Cedera Reversibel / Cedera Sedang" required>
                                <label class="form-check-label" for="dampak3">Cedera Reversibel /
                                    Cedera Sedang</label>
                            </div>
                            <div class="form-check form-check-inline  ms-3">
                                <input id="dampak4" name="dampak_insiden" type="radio" class="form-check-input"
                                    value="Cedera Ringan" required>
                                <label class="form-check-label" for="dampak4">Cedera Ringan</label>
                            </div>
                            <div class="form-check form-check-inline  ms-3">
                                <input id="dampak5" name="dampak_insiden" type="radio" class="form-check-input"
                                    value="Tidak Ada Cedera" required>
                                <label class="form-check-label" for="dampak5">Tidak Ada Cedera</label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="tinCe" class="form-label text-bold">12. Tindakan yang dilakukan segera setelah
                            kejadian, dan hasilnya</label>
                        <textarea rows="3" class="form-control" id="tinCe" name="tindakan_cepat" placeholder="" value=""
                            required></textarea>
                        <div class="invalid-feedback">
                            Valid Tindakan Insiden is required.
                        </div>
                    </div>

                    <div class="col-md-12 my-3">
                        <label for="tindakan_insiden" class="form-label text-bold">13. Tindakan dilakukan oleh</label>
                        <div class="form-group">
                            <div class="form-check ps-0">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input id="tinDil1" name="tindakan_insiden" type="radio"
                                            class="form-check-input ms-0 mt-0 me-2" required>
                                        <label class="form-check-label" for="tinDil1">Tim</label>
                                    </div>
                                    <input id="anggota_tim" name="tindakan_insiden" type="hidden" class="form-control"
                                        aria-label="Text input with radio button">
                                    <input id="tindakan_tim" type="text" class="form-control"
                                        aria-label="Text input with radio button" placeholder="Terdiri dari"
                                        onclick="selectRadio('tinDil1')"
                                        oninput="syncInputRadioSpecial('tinDil1', 'anggota_tim', 'tindakan_tim')">
                                </div>
                            </div>
                            <div class="form-check ms-3">
                                <input id="tinDil2" name="tindakan_insiden" type="radio" class="form-check-input"
                                    value="Dokter" required>
                                <label class="form-check-label" for="tinDil2">Dokter</label>
                            </div>
                            <div class="form-check ms-3">
                                <input id="tinDil3" name="tindakan_insiden" type="radio" class="form-check-input"
                                    value="Perawat" required>
                                <label class="form-check-label" for="tinDil3">Perawat</label>
                            </div>
                            <div class="form-check ps-0">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <input id="tinDil4" name="tindakan_insiden" class="form-check-input mt-0 ms-0"
                                            type="radio" value="" aria-label="Radio button for following text input">
                                        <label class=mb-2 for="tinIn4" style="padding-left: 20px;height: 17px;"></label>
                                    </div>
                                    <input id="tindakan_petugas_lain" type="text" class="form-control"
                                        aria-label="Text input with radio button" placeholder="Petugas lainnya"
                                        onclick="selectRadio('tinDil4')"
                                        oninput="syncInputRadio('tinDil4', 'tindakan_petugas_lain')">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <label for="kejadian_insiden" class="form-label text-bold">14. Apakah kejadian yang sama pernah
                            terjadi di Unit Kerja lain?</label>
                        <div class="form-group">
                            <div class="form-check ms-3">
                                <input id="kejadian1" name="kejadian_insiden" type="radio" class="form-check-input"
                                    value="ya" onclick="showTextarea('ket_unit_kerja')" required>
                                <label class="form-check-label" for="kejadian1">Ya</label>
                                <div id="ket_unit_kerja" class="d-none">
                                    <label for="kejadian_insiden">Kapan? dan Langkah / tindakan apa yang
                                        telah diambil pada Unit Kerja tersebut untuk mencegah terulangnya
                                        kejadian yang sama?</label>
                                    <input id="des_kejadian_insiden" name="kejadian_insiden" type="hidden"
                                        class="form-control" aria-label="Text input with radio button">
                                    <textarea id="kejadian_insiden" class="form-control"
                                        oninput="syncInputRadioSpecial('kejadian1', 'des_kejadian_insiden', 'kejadian_insiden')"></textarea>
                                </div>
                            </div>
                            <div class="form-check ms-3">
                                <input id="kejadian2" name="kejadian_insiden" type="radio" class="form-check-input"
                                    value="Tidak" onclick="hideTextarea('ket_unit_kerja')" required>
                                <label class="form-check-label" for="kejadian2">Tidak</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer float-right">
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@include('script.lapinAdd')


@endsection
