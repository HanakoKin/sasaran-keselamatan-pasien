@extends('index')

@section('container')
<section class="content">

    <div class="row">
        <div class="col-12">
            {{-- Form --}}

            <form action="{{ route('updateLapin', ['id' => $lapin->id]) }}" method="post" enctype="multipart/form-data"
                onsubmit="return validasiForm()">
                @csrf

                <div class="box-body">

                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien</h4>
                    <hr class="my-15">

                    {{-- Nama => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="editNaLap">Nama</label>
                                <input type="text" class="form-control" id="editNaLap" name="nama"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapin->nama }}">
                            </div>
                        </div>
                    </div>

                    {{-- No RM => clear --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="editNoRMLap">No RM</label>
                                <input type="text" class="form-control" id="editNoRMLap" name="noRM"
                                    placeholder="Input Medical Record" required
                                    data-validation-required-message="This field is required" value="{{ $lapin->noRM }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="editRuLap">Ruangan</label>
                                <input type="text" class="form-control" id="editRuLap" name="ruangan"
                                    placeholder="Which room you want?" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapin->ruangan }}">
                            </div>
                        </div>
                    </div>

                    {{-- Umur & Penjamin => clear --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Umur</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="umur" value="0 - 1 bulan" type="radio" id="umur1" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->umur === '0 - 1 bulan' ? 'checked' : '' }}>
                                            <label for="umur1">0 - 1 bulan</label>
                                        </div>
                                        <div class="radio">
                                            <input name="umur" value="> 1 tahun - 5 tahun" type="radio" id="umur2"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->umur === '> 1 tahun - 5 tahun' ? 'checked' : '' }}>
                                            <label for="umur2">> 1 tahun - 5 tahun</label>
                                        </div>
                                        <div class="radio">
                                            <input name="umur" value="> 5 tahun - 15 tahun" type="radio" id="umur3"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->umur === '> 5 tahun - 15 tahun<' ? 'checked' : '' }}>
                                            <label for="umur3">> 5 tahun - 15 tahun</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="umur" value="> 15 tahun - 30 tahun" type="radio" id="umur4"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->umur === '> 15 tahun - 30 tahun' ? 'checked' : '' }}>
                                            <label for="umur4">> 15 tahun - 30 tahun</label>
                                        </div>
                                        <div class="radio">
                                            <input name="umur" value="> 30 - 65 tahun" type="radio" id="umur5" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->umur === '> 30 tahun - 65 tahun' ? 'checked' : '' }}>
                                            <label for="umur5">> 30 - 65 tahun</label>
                                        </div>
                                        <div class="radio">
                                            <input name="umur" value="> 65 tahun" type="radio" id="umur6" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->umur === '> 65 tahun' ? 'checked' : '' }}>
                                            <label for="umur6">> 65 tahun</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Penjamin</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="penjamin" type="radio" value="Pribadi" id="penjamin1" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->penjamin === 'Pribadi' ? 'checked' : '' }}>
                                            <label for="penjamin1">Pribadi</label>
                                        </div>
                                        <div class="radio">
                                            <input name="penjamin" type="radio" value="Pemerintah" id="penjamin2"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->penjamin === 'Pemerintah' ? 'checked' : '' }}>
                                            <label for="penjamin2">Pemerintah</label>
                                        </div>
                                        <div class="radio">
                                            <input name="penjamin" type="radio" value="BPJS" id="penjamin3" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->penjamin === 'BPJS' ? 'checked' : '' }}>
                                            <label for="penjamin3">BPJS</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="penjamin" type="radio" value="Asuransi Swasta" id="penjamin4"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->penjamin === 'Asuransi Swasta' ? 'checked' : '' }}>
                                            <label for="penjamin4">Asuransi Swasta</label>
                                        </div>
                                        <div class="radio">
                                            <input name="penjamin" type="radio" value="Perusahaan" id="penjamin5"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->penjamin === 'Perusahaan' ? 'checked' : '' }}>
                                            <label for="penjamin5">Perusahaan</label>
                                        </div>
                                        <div class="radio">
                                            <input name="penjamin" type="radio" value="Lain-lain" id="penjamin6"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->penjamin === 'Lain-lain' ? 'checked' : '' }}>
                                            <label for="penjamin6">Lain-lain</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Jenis Kelamin => clear --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jenis Kelamin</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="jenis_kelamin" type="radio" value="Laki-laki" id="jekel1"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->jenis_kelamin === 'Laki-laki' ? 'checked' : '' }}>
                                            <label for="jekel1">Laki-laki</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="jenis_kelamin" type="radio" value="Perempuan" id="jekel2"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->jenis_kelamin === 'Perempuan' ? 'checked' : '' }}>
                                            <label for="jekel2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tanggal & jam Masuk => clear --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Masuk</label>
                            <div class="col-12">
                                <input class="form-control" type="date" name="tanggal_masuk" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapin->tanggal_masuk }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jam Masuk</label>
                                <div class="col-12">
                                    <input class="form-control" type="time" name="jam_masuk" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $lapin->jam_masuk }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="box-title text-info mb-0 mt-20"><i class="fal fa-books-medical"></i> Rincian Kejadian
                    </h4>
                    <hr class="my-15">

                    {{-- Tanggal & jam kejadian => clear --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Kejadian</label>
                            <div class="col-12">
                                <input class="form-control" type="date" name="tanggal_kejadian" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapin->tanggal_kejadian }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jam Kejadian</label>
                                <div class="col-12">
                                    <input class="form-control" type="time" name="jam_kejadian" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $lapin->jam_kejadian }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Insiden => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="editInLap">Insiden</label>
                                <input type="text" class="form-control" id="editInLap" name="insiden"
                                    placeholder="Type the incident" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapin->insiden }}">
                            </div>
                        </div>
                    </div>

                    {{-- Kronologis => ?? --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="editKronoLap">Kronologis Insiden</label>
                                <textarea rows="5" class="form-control" id="editKronoLap" name="kronologis"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $lapin->kronologis }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Jenis Insiden & Pelapor Insiden => ?? --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jenis Insiden</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="jenis_insiden" value="Kejadian Nyaris Cedera / KNC"
                                                type="radio" id="jenIn1" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->jenis_insiden === 'Kejadian Nyaris Cedera / KNC' ? 'checked' : '' }}>
                                            <label for="jenIn1">Kejadian Nyaris Cedera / KNC</label>
                                        </div>
                                        <div class="radio">
                                            <input name="jenis_insiden" value="Kejadian Tidak Cedera / KTC" type="radio"
                                                id="jenIn2" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->jenis_insiden === 'Kejadian Tidak Cedera / KTC' ? 'checked' : '' }}>
                                            <label for="jenIn2">Kejadian Tidak Cedera / KTC</label>
                                        </div>
                                        <div class="radio">
                                            <input name="jenis_insiden" value="Kejadian Tidak Diharapkan / KTD"
                                                type="radio" id="jenIn3" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->jenis_insiden === 'Kejadian Tidak Diharapkan / KTD' ? 'checked' : '' }}>
                                            <label for="jenIn3">Kejadian Tidak Diharapkan / KTD</label>
                                        </div>
                                        <div class="radio">
                                            <input name="jenis_insiden" value="Kondisi Potensial Cedera / KTC"
                                                type="radio" id="jenIn4" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->jenis_insiden === 'Kondisi Potensial Cedera / KTC' ? 'checked' : '' }}>
                                            <label for="jenIn4">Kondisi Potensial Cedera / KTC</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Pelapor Insiden</label>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Karyawan : Dokter / Perawat / Petugas Lainnya"
                                        type="radio" id="pelIn1" required
                                        data-validation-required-message="This field is required"
                                        {{ $lapin->pelapor_insiden === 'Karyawan : Dokter / Perawat / Petugas Lainnya' ? 'checked' : '' }}>
                                    <label for="pelIn1">Karyawan : Dokter / Perawat / Petugas Lainnya</label>
                                </div>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Keluarga / Pendamping pasien" type="radio"
                                        id="pelIn2" required data-validation-required-message="This field is required"
                                        {{ $lapin->pelapor_insiden === 'Keluarga / Pendamping pasien' ? 'checked' : '' }}>
                                    <label for="pelIn2">Keluarga / Pendamping pasien</label>
                                </div>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Pasien" type="radio" id="pelIn3" required
                                        data-validation-required-message="This field is required"
                                        {{ $lapin->pelapor_insiden === 'Pasien' ? 'checked' : '' }}>
                                    <label for="pelIn3">Pasien</label>
                                </div>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Pengunjung" type="radio" id="pelIn4" required
                                        data-validation-required-message="This field is required"
                                        {{ $lapin->pelapor_insiden === 'Pengunjung' ? 'checked' : '' }}>
                                    <label for="pelIn4">Pengunjung</label>
                                </div>
                                <div class="radio">
                                    <div class="input-group mt-2">
                                        <span class="input-group-addon">
                                            <input name="pelapor_insiden" type="radio" id="pelIn5" value="" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->pelapor_insiden !== 'Karyawan ( Dokter / Perawat / Petugas Lainnya )' && $lapin->pelapor_insiden !== 'Pasien' && $lapin->pelapor_insiden !== 'Keluarga / Pendamping' ? 'checked' : '' }}>
                                            <label for="pelIn5" style="padding-left: 20px;height: 17px;"></label>
                                        </span>
                                        <input id="pelapor_lain" type="text" class="form-control"
                                            aria-label="Text input with radio button" placeholder="Lain-lain"
                                            onclick="selectRadio('pelIn5')"
                                            oninput="syncInputRadio('pelIn5', 'pelapor_lain')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Korban Insiden & Layanan Insiden => ?? --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Korban Insiden</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="korban_insiden" type="radio" value="Pasien" id="korIn1"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->korban_insiden === 'Pasien' ? 'checked' : '' }}>
                                            <label for="korIn1">Pasien</label>
                                        </div>
                                        <div class="radio">
                                            <div class="input-group mt-2">
                                                <span class="input-group-addon">
                                                    <input name="korban_insiden" type="radio" id="korIn2" value=""
                                                        required
                                                        data-validation-required-message="This field is required"
                                                        {{ $lapin->korban_insiden !== 'Pasien' ? 'checked' : '' }}>
                                                    <label for="korIn2"
                                                        style="padding-left: 20px;height: 17px;"></label>
                                                </span>
                                                <input id="korban_lain" type="text" class="form-control"
                                                    aria-label="Text input with radio button" placeholder="Lain-lain"
                                                    onclick="selectRadio('korIn2')"
                                                    oninput="syncInputRadio('korIn2', 'korban_lain')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Insiden menyangkut pasien</label>
                                <div class="radio">
                                    <input name="layanan_insiden" type="radio" value="Pasien rawat inap" id="layIn1"
                                        required data-validation-required-message="This field is required"
                                        {{ $lapin->layanan_insiden === 'Pasien rawat inap' ? 'checked' : '' }}>
                                    <label for="layIn1">Pasien rawat inap</label>
                                </div>
                                <div class="radio">
                                    <input name="layanan_insiden" type="radio" value="Pasien rawat jalan" id="layIn2"
                                        required data-validation-required-message="This field is required"
                                        {{ $lapin->layanan_insiden === 'Pasien rawat jalan' ? 'checked' : '' }}>
                                    <label for="layIn1">Pasien rawat jalan</label>
                                </div>
                                <div class="radio">
                                    <input name="layanan_insiden" type="radio" value="Pasien UGD" id="layIn3" required
                                        data-validation-required-message="This field is required"
                                        {{ $lapin->layanan_insiden === 'Pasien UGD' ? 'checked' : '' }}>
                                    <label for="layIn3">Pasien UGD</label>
                                </div>
                                <div class="radio">
                                    <div class="input-group mt-2">
                                        <span class="input-group-addon">
                                            <input name="layanan_insiden" type="radio" id="layIn4" value="" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->layanan_insiden !== 'Pasien Rawat Inap' && $lapin->layanan_insiden !== 'Pasien Rawat Jalan' && $lapin->layanan_insiden !== 'Pasien UGD' ? 'checked' : '' }}>
                                            <label for="layIn4" style="padding-left: 20px;height: 17px;"></label>
                                        </span>
                                        <input id="layanan_lain" type="text" class="form-control"
                                            aria-label="Text input with radio button" placeholder="Lain-lain"
                                            onclick="selectRadio('layIn4')"
                                            oninput="syncInputRadio('layIn4', 'layanan_lain')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tempat Insiden => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="editTempLan">Tempat Insiden</label>
                                <input type="text" id="editTempLan" class="form-control" name="tempat_insiden"
                                    placeholder="Input tempat insiden" value="{{ $lapin->tempat_insiden }}">
                            </div>
                        </div>
                    </div>

                    {{-- Insiden terjadi pada => ?? --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Insiden terjadi pada pasien</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Penyakit Dalam dan Subspesialisasinya" id="insiden1"
                                                {{ in_array('Penyakit Dalam dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden1">Penyakit Dalam dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Anak dan Subspesialisasinya" id="insiden2"
                                                {{ in_array('Anak dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden2">Anak dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Bedah dan Subspesialisasinya" id="insiden3"
                                                {{ in_array('Bedah dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden3">Bedah dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Obstetri Gynekologi dan Subspesialisasinya" id="insiden4"
                                                {{ in_array('Obstetri Gynekologi dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden4">Obstetri Gynekologi dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="THT dan Subspesialisasinya" id="insiden5"
                                                {{ in_array('THT dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden5">THT dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Mata dan Subspesialisasinya" id="insiden6"
                                                {{ in_array('Mata dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden6">Mata dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Saraf dan Subspesialisasinya" id="insiden7"
                                                {{ in_array('Saraf dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden7">Saraf dan Subspesialisasinya</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Anastesi dan Subspesialisasinya" id="insiden8"
                                                {{ in_array('Anastesi dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden8">Anastesi dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Kulit & Kelamin dan Subspesialisasinya" id="insiden9"
                                                {{ in_array('Kulit & Kelamin dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden9">Kulit & Kelamin dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Jantung dan Subspesialisasinya" id="insiden10"
                                                {{ in_array('Jantung dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden10">Jantung dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Paru dan Subspesialisasinya" id="insiden11"
                                                {{ in_array('Paru dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden11">Paru dan Subspesialisasinya</label>
                                        </div>

                                        <div class="checkbox">
                                            <input type="checkbox" name="kasus_insiden[]"
                                                value="Jiwa dan Subspesialisasinya" id="insiden12"
                                                {{ in_array('Jiwa dan Subspesialisasinya', $fixed_data_kasus_insiden) ? 'checked' : '' }}>
                                            <label for="insiden12">Jiwa dan Subspesialisasinya</label>
                                        </div>
                                        <div class="checkbox">
                                            <div class="input-group mt-2">
                                                <span class="input-group-addon">
                                                    <input type="checkbox" id="insiden13" name="kasus_insiden[]"
                                                        value="" {{ (
                                                            collect($fixed_data_kasus_insiden)->some(function ($item) {
                                                                return !in_array($item, [
                                                                    'Penyakit Dalam dan Subspesialisasinya',
                                                                    'Anak dan Subspesialisasinya',
                                                                    'Bedah dan Subspesialisasinya',
                                                                    'Obstetri Gynekologi dan Subspesialisasinya',
                                                                    'THT dan Subspesialisasinya',
                                                                    'Mata dan Subspesialisasinya',
                                                                    'Saraf dan Subspesialisasinya',
                                                                    'Anastesi dan Subspesialisasinya',
                                                                    'Kulit & Kelamin dan Subspesialisasinya',
                                                                    'Jantung dan Subspesialisasinya',
                                                                    'Paru dan Subspesialisasinya',
                                                                    'Jiwa dan Subspesialisasinya',
                                                                ]);
                                                            })
                                                        ) ? 'checked' : '' }}>
                                                    <label for="insiden13"
                                                        style="padding-left: 20px;height: 17px;"></label>
                                                </span>
                                                <input id="kasus_lain" type="text" class="form-control"
                                                    aria-label="Text input with radio button" placeholder="Lain-lain"
                                                    onclick="selectRadio('insiden13')"
                                                    oninput="syncInputRadio('insiden13', 'kasus_lain')">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Unit terkait Insiden => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Unit terkait Insiden</label>
                                <input type="text" id="editUnitLap" class="form-control" name="unit_insiden"
                                    placeholder="Input unit insiden" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapin->unit_insiden }}">
                            </div>
                        </div>
                    </div>

                    {{-- Akibat insiden => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Akibat insiden terhadap pasien</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="radio">
                                            <input name="dampak_insiden" type="radio" value="Kematian" id="akIn1"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->dampak_insiden === 'Kematian' ? 'checked' : '' }}>
                                            <label for="akIn1">Kematian</label>
                                        </div>
                                        <div class="radio">
                                            <input name="dampak_insiden" type="radio"
                                                value="Cedera Irreversibel / Cedera Berat" id="akIn2" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->dampak_insiden === 'Cedera Irreversibel / Cedera Berat' ? 'checked' : '' }}>
                                            <label for="akIn2">Cedera Irreversibel / Cedera Berat</label>
                                        </div>
                                        <div class="radio">
                                            <input name="dampak_insiden" type="radio"
                                                value="Cedera Reversibel / Cedera Sedang" id="akIn3" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->dampak_insiden === 'Cedera Reversibel / Cedera Sedang' ? 'checked' : '' }}>
                                            <label for="akIn3">Cedera Reversibel / Cedera Sedang</label>
                                        </div>
                                        <div class="radio">
                                            <input name="dampak_insiden" type="radio" value="Cedera Ringan" id="akIn4"
                                                required data-validation-required-message="This field is required"
                                                {{ $lapin->dampak_insiden === 'Cedera Ringan' ? 'checked' : '' }}>
                                            <label for="akIn4">Cedera Ringan</label>
                                        </div>
                                        <div class="radio">
                                            <input name="dampak_insiden" type="radio" value="Tidak ada cedera"
                                                id="akIn5" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapin->dampak_insiden === 'Tidak ada cedera' ? 'checked' : '' }}>
                                            <label for="akIn5">Tidak ada cedera</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tindakan cepat => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Tindakan cepat yang dilakukan</label>
                                <textarea rows="5" id="editTinCepLap" class="form-control" name="tindakan_cepat"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $lapin->tindakan_cepat }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Penindak cepat & Pernah terjadi => ?? --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tindakan dilakukan oleh</label>
                                <div class="row">
                                    <div class="radio">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input name="tindakan_insiden" type="radio" id="tinIn1" value=""
                                                    required data-validation-required-message="This field is required"
                                                    {{ strpos($lapin->tindakan_insiden, 'Tim,') !== false ? 'checked' : '' }}>
                                                <label class="form-check-label" for="tinIn1">Tim</label>
                                            </span>
                                            <input id="anggota_tim" name="tindakan_insiden" type="hidden"
                                                class="form-control" aria-label="Text input with radio button">
                                            <input id="tindakan_tim" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Terdiri dari"
                                                onclick="selectRadio('tinIn1')"
                                                oninput="syncInputRadioSpecial('tinIn1', 'anggota_tim', 'tindakan_tim')">
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <input name="tindakan_insiden" type="radio" value="Dokter" id="tinIn2" required
                                            data-validation-required-message="This field is required"
                                            {{ $lapin->tindakan_insiden === 'Dokter' ? 'checked' : '' }}>
                                        <label for="tinIn2">Dokter</label>
                                    </div>
                                    <div class="radio">
                                        <input name="tindakan_insiden" type="radio" value="Perawat" id="tinIn3" required
                                            data-validation-required-message="This field is required"
                                            {{ $lapin->tindakan_insiden === 'Perawat' ? 'checked' : '' }}>
                                        <label for="tinIn3">Perawat</label>
                                    </div>
                                    <div class="radio">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input name="tindakan_insiden" type="radio" id="tinIn4" value=""
                                                    required data-validation-required-message="This field is required"
                                                    {{ strpos($lapin->tindakan_insiden, 'Tim,') === false && $lapin->tindakan_insiden !== 'Dokter' && $lapin->tindakan_insiden !== 'Perawat' ? 'checked' : '' }}>
                                                <label for="tinIn4" style="padding-left: 20px;height: 17px;"></label>
                                            </span>
                                            <input id="tindakan_lain" type="text" class="form-control"
                                                aria-label="Text input with radio button" placeholder="Petugas lainnya"
                                                onclick="selectRadio('tinIn4')"
                                                oninput="syncInputRadio('tinIn4', 'tindakan_lain')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Apakah kejadian yang sama pernah terjadi?</label>
                                <div class="row">
                                    <div class="radio">
                                        <input id="pernah1" name="kejadian_insiden" type="radio"
                                            class="form-check-input" value="Ya"
                                            onclick="showTextarea('textarea_pernah')" required
                                            {{ strpos($lapin->kejadian_insiden, 'Ya,') !== false ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pernah1">Ya</label>
                                        <div id="textarea_pernah" class="d-none mb-2">
                                            <label for="ket_pernah">Kapan? dan Langkah / tindakan apa yang
                                                telah diambil pada Unit Kerja tersebut untuk mencegah terulangnya
                                                kejadian yang sama?</label>
                                            <input id="des_pernah" name="kejadian_insiden" type="hidden"
                                                class="form-control" aria-label="Text input with radio button">
                                            <textarea id="ket_pernah" class="form-control mb-2"
                                                oninput="syncInputRadioSpecial('pernah1', 'des_pernah', 'ket_pernah')"></textarea>
                                        </div>
                                    </div>
                                    <div class="radio">
                                        <input name="kejadian_insiden" type="radio" value="Tidak" id="pernah2"
                                            onclick="hideTextarea('textarea_pernah')" required
                                            data-validation-required-message="This field is required"
                                            {{ strpos($lapin->kejadian_insiden, 'Ya,') === false ? 'checked' : '' }}>
                                        <label for="pernah2">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer float-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save-alt"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@include('script.lapinEdit')
@include('script.lapinAdd')


@endsection
