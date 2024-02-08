@extends('index')

@section('container')
<section class="content">

    <div class="row">
        <div class="col-12">
            {{-- Form --}}

            <form action="{{ url('/addLapin') }}" method="post" enctype="multipart/form-data"
                onsubmit="return validasiForm()">
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
                                    data-validation-required-message="This field is required"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Penyebab yang melatarbelakangi insiden :</label>
                                <textarea rows="5" class="form-control" name="penyebab_awal"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required"></textarea>
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
                                            <textarea rows="5" class="form-control" name="rekom_invest_pendek"
                                                placeholder="How is it happen"></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_pendek"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_rekom_pendek" required
                                                data-validation-required-message="This field is required">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Menengah :</label>
                                            <textarea rows="5" class="form-control" name="rekom_invest_menengah"
                                                placeholder="How is it happen"></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_menengah"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_rekom_menengah"
                                                required data-validation-required-message="This field is required">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="form-label">Jangka Panjang :</label>
                                            <textarea rows="5" class="form-control" name="rekom_invest_panjang"
                                                placeholder="How is it happen"></textarea>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="penanggung_rekom_panjang"
                                                placeholder="">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input class="form-control" type="date" name="tanggal_rekom_panjang"
                                                required data-validation-required-message="This field is required">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <h5>Ka.Ru, Ka.Sie, Ka.Bag Yang Melengkapi</h5>
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanda tangan</label>
                                <input type="text" class="form-control" name="ttd_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Bagian / Peran</label>
                                <input type="text" class="form-control" name="bagian_pelengkap"
                                    placeholder="Input patient name" required
                                    data-validation-required-message="This field is required">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal mulai investigasi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_mulai_invest" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tanggal dilengkapi</label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_dilengkapi" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <h5>Bagian yang perlu diinformasikan</h5>
                                <label class="form-label">Tanggal mulai investigasi : </label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="tanggal_informasi" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Direksi RS Husada : </label>
                                <input type="text" class="form-control" name="direksi" placeholder="Input patient name"
                                    required data-validation-required-message="This field is required">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Asdir / Manajer Keperawatan : </label>
                                <input type="text" class="form-control" name="asdir" placeholder="Input patient name"
                                    required data-validation-required-message="This field is required">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tim Keselamatan Pasien : </label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="timkes" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Ka.Bag Personalia : </label>
                                <div class="col-12">
                                    <input class="form-control" type="date" name="personalia" required
                                        data-validation-required-message="This field is required">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TIM KESELAMATAN PASIEN --}}

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Jangka Pendek :</label>
                                <textarea rows="5" class="form-control" name="rekom_invest_pendek"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Input patient name"
                                    required data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Tanggal Masuk</label>
                            <div class="col-12">
                                <input class="form-control" type="date" name="tanggal_masuk" required
                                    data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Unit terkait Insiden</label>
                                <input type="text" class="form-control" name="unit_insiden"
                                    placeholder="Input unit insiden" required
                                    data-validation-required-message="This field is required">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Tindakan cepat yang dilakukan</label>
                                <textarea rows="5" class="form-control" name="tindakan_cepat"
                                    placeholder="How is it happen" required
                                    data-validation-required-message="This field is required"></textarea>
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
