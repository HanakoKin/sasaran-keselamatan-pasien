@extends('index')

@section('container')

<section class="invoice printableArea content">
    <div class="row">
        <div class="col-12">

            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center clearFix no-print">
                        <div class="d-block align-items-center pb-0">
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="/dashboard"><i
                                                class="mdi mdi-home-outline"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="/lapin">Kelola Laporan Insiden</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Verifikasi Laporan Insiden
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="d-block">
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
                                <h4 class="box-title mt-20">LAPORAN INSIDEN</h4>
                                <h4 class="box-title mt-5 mb-20">(INTERNAL)</h4>
                            </div>

                            <h4 class="box-title mt-20"><strong>I. DATA PASIEN </strong></h4>

                            {{-- Nama --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Nama </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->nama }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- No RM & Ruangan --}}
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>No RM </h5>
                                        </div>
                                        <div class="col-6">
                                            <span>: {{ $data->noRM }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Ruangan </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->ruangan }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Umur --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Umur </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->umur }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Jenis Kelamin </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->jenis_kelamin }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Penanggung biaya pasien --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Penanggung biaya pasien</h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->penjamin }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Tanggal & Jam Masuk RS --}}
                            <div class="row">
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Tanggal Masuk RS</h5>
                                        </div>
                                        <div class="col-6">
                                            <span>: {{ $data->tanggal_masuk }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Jam </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->jam_masuk }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="box-title mt-20"><strong>II. RINCIAN KEJADIAN</strong></h4>

                            {{-- Tanggal & Jam Kejadian Insiden --}}
                            <div class="row">
                                <h5>1. Tanggal dan Waktu Insiden</h5>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-6">
                                            <h5>Tanggal</h5>
                                        </div>
                                        <div class="col-6">
                                            <span>: {{ $data->tanggal_kejadian }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>Jam </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->jam_kejadian }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-3">
                                            <h5>2. Insiden </h5>
                                        </div>
                                        <div class="col-9">
                                            <span>: {{ $data->insiden }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Kronologis --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>3. Kronologis :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->kronologis }}</p>
                                </div>
                            </div>

                            {{-- Jenis Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>4. Jenis Insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->jenis_insiden }}</p>
                                </div>
                            </div>

                            {{-- Pelapor Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>5. Orang pertama yang melaporkan insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->pelapor_insiden }}</p>
                                </div>
                            </div>

                            {{-- Korban Insiden --}}
                            <div class="row">
                                <div class="col-12">
                                    <h5>6. Insiden terjadi pada :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->korban_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>7. Insiden menyangkut pasien :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->layanan_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>8. Tempat Insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tempat_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>9. Insiden terjadi pada pasien :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->kasus_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>10. Unit / Departemen terkait yang menyebabkan insiden :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->unit_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>11. Akibat insiden terhadap pasien :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->dampak_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>12. Tindakan yang dilakukan segera setelah kejadian, dan hasilnya :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tindakan_cepat }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>13. Tindakan dilakukan oleh :</h5>
                                </div>
                                <div class="col-12">
                                    <p class="ms-4">{{ $data->tindakan_insiden }}</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <h5>14. Apakah kejadian yang sama pernah terjadi di unit kerja lain? </h5>
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
                                    <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                    <td>Tgl Terima</td>
                                    <td>{{ $data->tanggal_terima }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    @if ($data->grading_risiko === 'biru' || $data->grading_risiko === 'hijau' || $data->grading_risiko
                    === 'kuning' || $data->grading_risiko === 'merah')
                    <div class="row d-flex justify-content-center mt-5">
                        <div class="col-3">
                            <div
                                class="box box-link-shadow text-center border {{ $data->grading_risiko === 'biru' ? 'border-primary' : ($data->grading_risiko === 'hijau' ? 'border-success' : ($data->grading_risiko === 'kuning' ? 'border-warning' : 'border-danger')) }}">
                                <div class="box-body">
                                    <div class="">Grading Risiko Kejadian</div>
                                </div>
                                <div
                                    class="box-body bg-{{ $data->grading_risiko === 'biru' ? 'info' : ($data->grading_risiko === 'hijau' ? 'success' : ($data->grading_risiko === 'kuning' ? 'warning' : 'danger')) }} btsr-0 bter-0">
                                    <p class=" ">
                                        {{ $data->grading_risiko === 'biru' ? 'Rendah' : ($data->grading_risiko === 'hijau' ? 'Aman' : ($data->grading_risiko === 'kuning' ? 'Waspada' : 'Kritis ')) }}
                                        <span class="mdi mdi-thumb-up-outline "></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

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
