@extends('index')

@section('container')

<section class="invoice printableArea content">
    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <div class="bb-1 clearFix no-print">
                        <div class="text-end pb-15">
                            <button id="print2" class="btn btn-warning" type="button"> <span><i class="fa fa-print"></i>
                                    Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center invoice-info">
                <div class="col-12">
                    <div class="box box-widget widget-user">
                        <div class="box-footer py-0 border-0">

                            <div class="text-center">
                                <h4 class="box-title mt-20">LEMBAR KERJA INVESTIGASI SEDERHANA</h4>
                                <h4 class="box-title mt-5 mb-20">Untuk Grading Risiko BIRU/HIJAU</h4>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <h5>Penyebab langsung Accident / Insiden :</h5>
                                        <p class="ms-4">{{ $data->penyebab_langsung }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <h5>Penyebab yang melatarbelakangi insiden :</h5>
                                        <p class="ms-4">{{ $data->penyebab_awal }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Rekomendasi</th>
                                            <th scope="col" width="250">Yang bertanggung jawab</th>
                                            <th scope="col" width="150">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class="form-label">Jangka Pendek :</h5>
                                                <p>
                                                    {{ $data->rekom_invest_pendek === NULL ? '-' : $data->rekom_invest_pendek }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->penanggung_rekom_pendek === NULL ? '-' : $data->penanggung_rekom_pendek }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->tanggal_rekom_pendek === NULL ? '-' : $data->tanggal_rekom_pendek }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="form-label">Jangka Menengah :</h5>
                                                <p>
                                                    {{ $data->rekom_invest_menengah === NULL ? '-' : $data->rekom_invest_menengah }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->penanggung_rekom_menengah === NULL ? '-' : $data->penanggung_rekom_menengah }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->tanggal_rekom_menengah === NULL ? '-' : $data->tanggal_rekom_menengah }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="form-label">Jangka Panjang :</h5>
                                                <p>
                                                    {{ $data->rekom_invest_panjang === NULL ? '-' : $data->rekom_invest_panjang }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->penanggung_rekom_panjang === NULL ? '-' : $data->penanggung_rekom_panjang }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->tanggal_rekom_panjang === NULL ? '-' : $data->tanggal_rekom_panjang }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Tindakan yang dilakukan</th>
                                            <th scope="col" width="250">Yang bertanggung jawab</th>
                                            <th scope="col" width="150">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h5 class="form-label">Jangka Pendek :</h5>
                                                <p>
                                                    {{ $data->realisasi_invest_pendek === NULL ? '-' : $data->realisasi_invest_pendek }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->penanggung_realisasi_pendek === NULL ? '-' : $data->penanggung_realisasi_pendek }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->tanggal_realisasi_pendek === NULL ? '-' : $data->tanggal_realisasi_pendek }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="form-label">Jangka Menengah :</h5>
                                                <p>
                                                    {{ $data->realisasi_invest_menengah === NULL ? '-' : $data->realisasi_invest_menengah }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->penanggung_realisasi_menengah === NULL ? '-' : $data->penanggung_realisasi_menengah }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->tanggal_realisasi_menengah === NULL ? '-' : $data->tanggal_realisasi_menengah }}
                                                </p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h5 class="form-label">Jangka Panjang :</h5>
                                                <p>
                                                    {{ $data->realisasi_invest_panjang === NULL ? '-' : $data->realisasi_invest_panjang }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->penanggung_realisasi_panjang === NULL ? '-' : $data->penanggung_realisasi_panjang }}
                                                </p>
                                            </td>
                                            <td>
                                                <p>
                                                    {{ $data->tanggal_realisasi_panjang === NULL ? '-' : $data->tanggal_realisasi_panjang }}
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Ka.Ru, Ka.Sie, Ka.Bag Yang Melengkapi</th>
                                            <th scope="col">Bagian yang perlu diinformasikan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <p>Nama :</p>
                                                <p class="ms-3">{{ $data->nama_pelengkap }}</p>
                                                <p>Tanda tangan :</p>
                                                <p class="ms-3">{{ $data->ttd_pelengkap }}</p>
                                                <p>Bagian / Peran:</p>
                                                <p class="ms-3">{{ $data->bagian_pelengkap }}</p>
                                                <p>Tanggal mulai investigasi</p>
                                                <p class="ms-3">{{ $data->tanggal_mulai_invest }}</p>
                                                <p>Tanggal dilengkapi</p>
                                                <p class="ms-3">{{ $data->tanggal_dilengkapi }}</p>
                                            </td>
                                            <td>
                                                <p>Tanggal :</p>
                                                <p class="ms-3">{{ $data->tanggal_informasi }}</p>
                                                <p>Direksi RS Husada : </p>
                                                <p class="ms-3">{{ $data->direksi }}</p>
                                                <p>Asdir / Manajer Keperawatan : </p>
                                                <p class="ms-3">{{ $data->asdir }}</p>
                                                <p>Tim Keselamatan Pasien : </p>
                                                <p class="ms-3">{{ $data->timkes }}</p>
                                                <p>Ka.Bag Personalia : </p>
                                                <p class="ms-3">{{ $data->personalia }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="text-center" scope="col" rowspan="3" width="250">
                                                TIM KESELAMATAN PASIEN
                                            </td>
                                            <td scope="col">
                                                <h5 class="form-label">Investigasi Lengkap :
                                                    {{ ucfirst(trans($data->invest_lengkap)) }}</h5>
                                            </td>
                                            <td scope="col">
                                                <span>Tanggal : {{ $data->tanggal_pengesahan }}</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="col" colspan="2">
                                                <p class="form-label">Diperlukan Investigasi lebih
                                                    lanjut : {{ ucfirst(trans($data->invest_lanjut)) }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="col" colspan="2">
                                                <p class="form-label">Investigasi setelah Grading ulang
                                                    : {{ ucfirst(trans($data->grading_akhir)) }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
