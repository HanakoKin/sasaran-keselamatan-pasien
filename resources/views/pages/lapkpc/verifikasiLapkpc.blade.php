@extends('index')

@section('container')

<section class="invoice printableArea content">
    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <div class="bb-1 clearFix no-print">
                        <div class="text-end pb-15">
                            <button class="btn btn-success" data-bs-toggle="modal"
                                onclick="showVerifModal({{ json_encode($data) }})">
                                <i class="fal fa-eye"></i> Verifikasi
                            </button>
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
                                <h4 class="box-title mt-20">LAPORAN KONDISI POTENSIAL CEDERA (KPC)</h4>
                                <h4 class="box-title mt-5 mb-20">(INTERNAL)</h4>
                            </div>

                            {{-- Tanggal & Jam ditemukan insiden --}}
                            <div class="row">
                                <h5>1. Tanggal dan Waktu ditemukan Kondisi Potensi Cedera (KPC)</h5>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Tanggal</h5>
                                        </div>
                                        <div class="col-6">
                                            <span>: {{ $data->tanggal_ditemukan }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Jam </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->jam_ditemukan }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Insiden KPC --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>2. KPC :</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-9">
                                            <p class="ms-4">{{ $data->kpc }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Pelapor Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>3. Orang pertama yang melaporkan Insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->pelapor_insiden }}</p>
                                </div>
                            </div>

                            {{-- Lokasi Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>4. Lokasi Insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tempat_insiden }}</p>
                                </div>
                            </div>

                            {{-- Unit Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>5. Unit / Departemen terkait KPC :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->unit_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>6. Tindakan apa yang dilakukan untuk mengatasi kondisi potensi cedera selama ini
                                        :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tindakan_cepat }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>7. Tindakan dilakukan oleh :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tindakan_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>8. Apakah kejadian yang sama pernah terjadi di Unit Kerja lain? :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->kejadian_insiden }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td>Pembuat Laporan</td>
                                    <td>{{ $data->pembuat_laporan }}</td>
                                    <td>Penerima Laporan</td>
                                    <td>{{ $data->penerima_laporan }}</td>
                                </tr>
                                <tr>
                                    <td>Paraf</td>
                                    <td>........</td>
                                    <td>Paraf</td>
                                    <td>........</td>
                                </tr>
                                <tr>
                                    <td>Tgl Lapor</td>
                                    <td>{{ $data->created_at->format('Y-m-d') }}</td>
                                    <td>Tgl Terima</td>
                                    <td>{{ $data->tanggal_terima }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Modal Verification --}}
@include('modal.verifData')

{{-- JS for Showing Modal --}}
@include('script.popupVerif')

@endsection
