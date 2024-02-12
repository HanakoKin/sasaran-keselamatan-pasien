@extends('index')

@section('container')
<section class="content">

    <div class="row">
        <div class="col-12">
            {{-- Form --}}

            <form action="{{ route('updateLemkis', ['id' => $lemkis->id]) }}" method="post"
                enctype="multipart/form-data">
                @csrf

                <div class="box-body">
                    <h4 class="box-title text-info mb-0"><i class="fal fa-user-injured"></i> Data Pasien
                    </h4>
                    <hr class="my-15">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Penyebab langsung Accident / Insiden :</label>
                                <textarea rows="5" class="form-control" name="penyebab_langsung"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $lemkis->penyebab_langsung }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Penyebab yang melatarbelakangi insiden :</label>
                                <textarea rows="5" class="form-control" name="penyebab_awal"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required">{{ $lemkis->penyebab_awal }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table no-border mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Rekomendasi</th>
                                    <th scope="col">Yang bertanggung jawab</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Pendek :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_pendek"
                                                placeholder="How is it happen">{{ $lemkis->rekom_invest_pendek }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_pendek"
                                                value="{{ $lemkis->penanggung_rekom_pendek }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $lemkis->tanggal_rekom_pendek }}" name="tanggal_rekom_pendek">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Menengah :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_menengah"
                                                placeholder="How is it happen">{{ $lemkis->rekom_invest_menengah }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_menengah"
                                                value="{{ $lemkis->penanggung_rekom_menengah }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $lemkis->tanggal_rekom_menengah }}"
                                                name="tanggal_rekom_menengah">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Panjang :</label>
                                            <textarea rows="3" class="form-control" name="rekom_invest_panjang"
                                                placeholder="How is it happen">{{ $lemkis->rekom_invest_panjang }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_panjang"
                                                value="{{ $lemkis->penanggung_rekom_panjang }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $lemkis->tanggal_rekom_panjang }}"
                                                name="tanggal_rekom_panjang">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table class="table no-border mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Tindakan yang dilakukan</th>
                                    <th scope="col">Yang bertanggung jawab</th>
                                    <th scope="col">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Pendek :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_pendek"
                                                placeholder="How is it happen">{{ $lemkis->realisasi_invest_pendek }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_pendek"
                                                value="{{ $lemkis->penanggung_realisasi_pendek }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $lemkis->tanggal_realisasi_pendek }}"
                                                name="tanggal_realisasi_pendek">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Menengah :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_menengah"
                                                placeholder="How is it happen">{{ $lemkis->realisasi_invest_menengah }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_menengah"
                                                value="{{ $lemkis->penanggung_realisasi_menengah }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $lemkis->tanggal_realisasi_menengah }}"
                                                name="tanggal_realisasi_menengah">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Panjang :</label>
                                            <textarea rows="3" class="form-control" name="realisasi_invest_panjang"
                                                placeholder="How is it happen">{{ $lemkis->realisasi_invest_panjang }}</textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_realisasi_panjang"
                                                value="{{ $lemkis->penanggung_realisasi_panjang }}" placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date"
                                                value="{{ $lemkis->tanggal_realisasi_panjang }}"
                                                name="tanggal_realisasi_panjang">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <h5>Ka.Ru, Ka.Sie, Ka.Bag Yang Melengkapi</h5>
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lemkis->nama_pelengkap }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanda tangan</label>
                                <input type="text" class="form-control" name="ttd_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lemkis->ttd_pelengkap }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bagian / Peran</label>
                                <input type="text" class="form-control" name="bagian_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required"
                                    value="{{ $lemkis->bagian_pelengkap }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal mulai investigasi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_mulai_invest" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $lemkis->tanggal_mulai_invest }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal dilengkapi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_dilengkapi" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $lemkis->tanggal_dilengkapi }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h5>Bagian yang perlu diinformasikan</h5>
                                <label class="form-label">Tanggal :</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_informasi" required
                                        data-validation-required-message="This field is required"
                                        value="{{ $lemkis->tanggal_informasi }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Direksi RS Husada : </label>
                                <input type="text" class="form-control" name="direksi" placeholder="Input patient name"
                                    value="{{ $lemkis->direksi }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Asdir / Manajer Keperawatan : </label>
                                <input type="text" class="form-control" name="asdir" placeholder="Input patient name"
                                    value="{{ $lemkis->asdir }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tim Keselamatan Pasien : </label>
                                <input type="text" class="form-control" name="timkes" placeholder="Input patient name"
                                    value="{{ $lemkis->timkes }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ka.Bag Personalia : </label>
                                <input type="text" class="form-control" name="personalia"
                                    placeholder="Input patient name" value="{{ $lemkis->personalia }}">
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Progres hari minggu malam senin, mulai batas ini belum diberi value, sesuaikan dengan radio button yang dicek sebelumnya --}}

                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <tbody>
                                <tr>
                                    <td class="text-center" scope="col" rowspan="3" width="250">
                                        TIM KESELAMATAN PASIEN
                                    </td>
                                    <td scope="col">
                                        <div class="d-flex align-items-center">
                                            <div class="row mt-10">
                                                <div class="col-10">
                                                    <div class=" form-group mb-0">
                                                        <label class="form-label">Investigasi Lengkap :</label>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group mb-0">
                                                        <div class="form-group mb-0 d-flex align-items-center">
                                                            <div class="radio me-3">
                                                                <input name="invest_lengkap" value="ya" type="radio"
                                                                    id="inLen1" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $lemkis->invest_lengkap === 'ya' ? 'checked' : '' }}>
                                                                <label for="inLen1" class="me-1">Ya</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="invest_lengkap" value="tidak" type="radio"
                                                                    id="inLen2" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $lemkis->invest_lengkap === 'tidak' ? 'checked' : '' }}>
                                                                <label for="inLen2">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td scope="col">
                                        <div class="d-flex align-items-center">
                                            <span>Tanggal :</span>
                                            <div class="form-group ms-3 mb-0">
                                                <input class="form-control" type="date" name="tanggal_pengesahan"
                                                    required data-validation-required-message="This field is required"
                                                    value="{{ $lemkis->tanggal_pengesahan }}">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="d-flex align-items-center">
                                            <div class="row mt-10">
                                                <div class="col-8">
                                                    <div class=" form-group mb-0">
                                                        <label class="form-label">Diperlukan Investigasi lebih lanjut
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-4 ps-2">
                                                    <div class="form-group mb-0">
                                                        <div class="form-group mb-0 d-flex align-items-center">
                                                            <div class="radio me-3">
                                                                <input name="invest_lanjut" value="ya" type="radio"
                                                                    id="inLan1" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $lemkis->invest_lanjut === 'ya' ? 'checked' : '' }}>
                                                                <label for="inLan1" class="me-1">Ya</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="invest_lanjut" value="tidak" type="radio"
                                                                    id="inLan2" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $lemkis->invest_lanjut === 'tidak' ? 'checked' : '' }}>
                                                                <label for="inLan2">Tidak</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="d-flex align-items-center">
                                            <div class="row mt-10">
                                                <div class="col-6">
                                                    <div class=" form-group mb-0">
                                                        <label class="form-label">Investigasi setelah Grading ulang
                                                            :</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 ps-3">
                                                    <div class="form-group mb-0">
                                                        <div class="form-group mb-0 d-flex align-items-left">
                                                            <div class="radio me-3">
                                                                <input name="grading_akhir" value="hijau" type="radio"
                                                                    id="gradUl1" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $lemkis->grading_akhir === 'hijau' ? 'checked' : ''}}>
                                                                <label for="gradUl1" class="me-1">Hijau</label>
                                                            </div>
                                                            <div class="radio me-3">
                                                                <input name="grading_akhir" value="kuning" type="radio"
                                                                    id="gradUl2" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $lemkis->grading_akhir === 'kuning' ? 'checked' : ''}}>
                                                                <label for="gradUl2" class="me-1">Kuning</label>
                                                            </div>
                                                            <div class="radio">
                                                                <input name="grading_akhir" value="merah" type="radio"
                                                                    id="gradUl3" required
                                                                    data-validation-required-message="This field is required"
                                                                    {{ $lemkis->grading_akhir === 'merah' ? 'checked' : ''}}>
                                                                <label for="gradUl3">Merah</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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


@endsection
