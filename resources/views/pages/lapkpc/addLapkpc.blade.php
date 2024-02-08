@extends('index')

@section('container')
<section class="content">

    <div class="row">
        <div class="col-12">
            {{-- Form --}}

            <form action="{{ url('/addLapkpc') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="box-body">
                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Laporan Kondisi Potensial
                        Cedera
                    </h4>
                    <hr class="my-15">
                    <div class="row">
                        <input type="hidden" name="pembuat_laporan" value="{{ auth()->user()->nama }}">
                        <input type="hidden" name="status" value="Belum terverifikasi">
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Ditemukan KPC</label>
                            <div class="col-12">
                                <input class="form-control" type="date" name="tanggal_ditemukan" required
                                    data-validation-required-message="This field is required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Jam Ditemukan KPC</label>
                                <div class="col-12">
                                    <input class="form-control" type="time" name="jam_ditemukan" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">KPC</label>
                                <textarea rows="5" class="form-control" name="kpc" placeholder="How is it happen"
                                    required data-validation-required-message="This field is required"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Orang pertama yang melaporkan insiden</label>
                            <div class="radio">
                                <input name="pelapor_insiden" value="Karyawan : Dokter / Perawat / Petugas Lainnya"
                                    type="radio" id="pelIn1" required
                                    data-validation-required-message="This field is required">
                                <label for="pelIn1">Karyawan : Dokter / Perawat / Petugas Lainnya</label>
                            </div>
                            <div class="radio">
                                <input name="pelapor_insiden" value="Keluarga / Pendamping pasien" type="radio"
                                    id="pelIn2" required data-validation-required-message="This field is required">
                                <label for="pelIn2">Keluarga / Pendamping pasien</label>
                            </div>
                            <div class="radio">
                                <input name="pelapor_insiden" value="Pasien" type="radio" id="pelIn3" required
                                    data-validation-required-message="This field is required">
                                <label for="pelIn3">Pasien</label>
                            </div>
                            <div class="radio">
                                <input name="pelapor_insiden" value="Pengunjung" type="radio" id="pelIn4" required
                                    data-validation-required-message="This field is required">
                                <label for="pelIn4">Pengunjung</label>
                            </div>
                            <div class="radio">
                                <div class="input-group mt-2">
                                    <span class="input-group-addon">
                                        <input name="pelapor_insiden" type="radio" id="pelIn5" value="" required
                                            data-validation-required-message="This field is required">
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
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Lokasi diketahui KPC</label>
                                <input type="text" class="form-control" name="tempat_insiden"
                                    placeholder="Input tempat insiden">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Unit / Departemen terkait KPC</label>
                                <input type="text" class="form-control" name="unit_insiden"
                                    placeholder="Input unit insiden" required
                                    data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Tindakan apa yang dilakukan untuk mengatasi kondisi potensi
                                    cedera selama ini?</label>
                                <textarea rows="5" class="form-control" name="tindakan_cepat"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label">Tindakan dilakukan oleh</label>
                                <div class="row">
                                    <div class="radio">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input name="tindakan_insiden" type="radio" id="tinIn1" value=""
                                                    required data-validation-required-message="This field is required">
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
                                            data-validation-required-message="This field is required">
                                        <label for="tinIn2">Dokter</label>
                                    </div>
                                    <div class="radio">
                                        <input name="tindakan_insiden" type="radio" value="Perawat" id="tinIn3" required
                                            data-validation-required-message="This field is required">
                                        <label for="tinIn3">Perawat</label>
                                    </div>
                                    <div class="radio">
                                        <div class="input-group mt-2">
                                            <span class="input-group-addon">
                                                <input name="tindakan_insiden" type="radio" id="tinIn4" value=""
                                                    required data-validation-required-message="This field is required">
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
                                            onclick="showTextarea('textarea_pernah')" required>
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
                                            data-validation-required-message="This field is required">
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

@include('script.lapinAdd')


@endsection
