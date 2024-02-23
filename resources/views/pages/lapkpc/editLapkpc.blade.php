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
                        <li class="breadcrumb-item"><a href="/lapkpc">Kelola Laporan KPC</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Laporan KPC</li>
                    </ol>
                </nav>
            </div>

            {{-- Form --}}
            <form action="{{ route('updateLapkpc', ['id' => $lapkpc->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien</h4>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <label for="editUnLap" class="form-label text-bold">Unit Kerja / Ruangan :</label>
                                <div class="form-group mb-0">
                                    <div class="form-check form-check-inline">
                                        <input type="text" class="form-control" id="editUnLap" name="unit_kerja"
                                            value="{{ $lapkpc->unit_kerja }}">
                                    </div>
                                </div>
                            </div>
                            <div class="invalid-feedback">
                                Valid Unit Kerja is required.
                            </div>
                        </div>
                    </div>

                    <hr class="my-15">

                    {{-- Tanggal & jam Ditemukan => clear --}}
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Ditemukan KPC</label>
                            <div class="col-12">
                                <input class="form-control" type="date" name="tanggal_ditemukan" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapkpc->tanggal_ditemukan }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jam Ditemukan KPC</label>
                                <div class="col-12">
                                    <input class="form-control" type="time" name="jam_ditemukan" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $lapkpc->jam_ditemukan }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KPC => Clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">KPC</label>
                                <textarea rows="5" class="form-control" id="editKPC" name="kpc"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $lapkpc->kpc }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Pelapor Insiden => ?? --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Pelapor Insiden</label>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Karyawan : Dokter / Perawat / Petugas Lainnya"
                                        type="radio" id="pelIn1" required
                                        data-validation-required-message="This field is required"
                                        {{ $lapkpc->pelapor_insiden === 'Karyawan : Dokter / Perawat / Petugas Lainnya' ? 'checked' : '' }}>
                                    <label for="pelIn1">Karyawan : Dokter / Perawat / Petugas Lainnya</label>
                                </div>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Keluarga / Pendamping pasien" type="radio"
                                        id="pelIn2" required data-validation-required-message="This field is required"
                                        {{ $lapkpc->pelapor_insiden === 'Keluarga / Pendamping pasien' ? 'checked' : '' }}>
                                    <label for="pelIn2">Keluarga / Pendamping pasien</label>
                                </div>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Pasien" type="radio" id="pelIn3" required
                                        data-validation-required-message="This field is required"
                                        {{ $lapkpc->pelapor_insiden === 'Pasien' ? 'checked' : '' }}>
                                    <label for="pelIn3">Pasien</label>
                                </div>
                                <div class="radio">
                                    <input name="pelapor_insiden" value="Pengunjung" type="radio" id="pelIn4" required
                                        data-validation-required-message="This field is required"
                                        {{ $lapkpc->pelapor_insiden === 'Pengunjung' ? 'checked' : '' }}>
                                    <label for="pelIn4">Pengunjung</label>
                                </div>
                                <div class="radio">
                                    <div class="input-group mt-2">
                                        <span class="input-group-addon">
                                            <input name="pelapor_insiden" type="radio" id="pelIn5" value="" required
                                                data-validation-required-message="This field is required"
                                                {{ $lapkpc->pelapor_insiden !== 'Karyawan ( Dokter / Perawat / Petugas Lainnya )' && $lapkpc->pelapor_insiden !== 'Pasien' && $lapkpc->pelapor_insiden !== 'Keluarga / Pendamping' ? 'checked' : '' }}>
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

                    {{-- Tempat Insiden => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Tempat Insiden</label>
                                <input type="text" id="editTempKpc" class="form-control" name="tempat_insiden"
                                    placeholder="Input tempat insiden" value="{{ $lapkpc->tempat_insiden }}">
                            </div>
                        </div>
                    </div>

                    {{-- Unit terkait Insiden => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Unit terkait Insiden</label>
                                <input type="text" id="editUnitKpc" class="form-control" name="unit_insiden"
                                    placeholder="Input unit insiden" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lapkpc->unit_insiden }}">
                            </div>
                        </div>
                    </div>

                    {{-- Tindakan cepat => clear --}}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Tindakan cepat yang dilakukan</label>
                                <textarea rows="5" id="editTinCepKpc" class="form-control" name="tindakan_cepat"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $lapkpc->tindakan_cepat }}</textarea>
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
                                                    {{ strpos($lapkpc->tindakan_insiden, 'Tim,') !== false ? 'checked' : '' }}>
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
                                            {{ $lapkpc->tindakan_insiden === 'Dokter' ? 'checked' : '' }}>
                                        <label for="tinIn2">Dokter</label>
                                    </div>
                                    <div class="radio">
                                        <input name="tindakan_insiden" type="radio" value="Perawat" id="tinIn3" required
                                            data-validation-required-message="This field is required"
                                            {{ $lapkpc->tindakan_insiden === 'Perawat' ? 'checked' : '' }}>
                                        <label for="tinIn3">Perawat</label>
                                    </div>
                                    <div class="radio">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input name="tindakan_insiden" type="radio" id="tinIn4" value=""
                                                    required data-validation-required-message="This field is required"
                                                    {{ strpos($lapkpc->tindakan_insiden, 'Tim,') === false && $lapkpc->tindakan_insiden !== 'Dokter' && $lapkpc->tindakan_insiden !== 'Perawat' ? 'checked' : '' }}>
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
                                            {{ strpos($lapkpc->kejadian_insiden, 'Ya,') !== false ? 'checked' : '' }}>
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
                                            {{ strpos($lapkpc->kejadian_insiden, 'Ya,') === false ? 'checked' : '' }}>
                                        <label for="pernah2">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="box-footer float-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti-save-alt"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

@include('script.lapkpcEdit')
@include('script.lapinAdd')



@endsection
