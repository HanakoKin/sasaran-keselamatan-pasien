@extends('index')

@section('container')
<section class="content pt-0">
    <div class="row">
        <div class="col-xl-12 col-12">
            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tabel Laporan Insiden</li>
                    </ol>
                </nav>
                <div class="box">
                    <div class="box-header py-4">
                        <h4 class="box-title">Tabel Laporan Insiden</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>No Register</th>
                                        <th>Ruangan</th>
                                        <th>Umur</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Penjamin</th>
                                        <th>Tanggal Masuk</th>
                                        <th>Jam Masuk</th>
                                        <th>Tanggal Kejadian</th>
                                        <th>Jam Kejadian</th>
                                        <th>Insiden</th>
                                        <th>Kronologis</th>
                                        <th>Jenis Insiden</th>
                                        <th>Pelapor Insiden</th>
                                        <th>Korban Insiden</th>
                                        <th>Layanan Insiden</th>
                                        <th>Tempat Insiden</th>
                                        <th>Kasus Insiden</th>
                                        <th>Unit Insiden</th>
                                        <th>Dampak Insiden</th>
                                        <th>Tindakan Cepat</th>
                                        <th>Tindakan Insiden</th>
                                        <th>Kejadian Insiden</th>
                                        <th>Status</th>
                                        <th>Pembuat Laporan</th>
                                        <th>Penerima Laporan</th>
                                        <th>Tanggal Lapor</th>
                                        <th>Tanggal Terima</th>
                                        <th>Grading</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lapins as $lapin)
                                    <tr>
                                        <td> {{ $lapin->nama }} </td>
                                        <td> {{ $lapin->noRM }} </td>
                                        <td> {{ $lapin->ruangan }} </td>
                                        <td> {{ $lapin->umur }} </td>
                                        <td> {{ $lapin->jenis_kelamin }} </td>
                                        <td> {{ $lapin->penjamin }} </td>
                                        <td> {{ $lapin->tanggal_masuk }} </td>
                                        <td> {{ $lapin->jam_masuk }} </td>
                                        <td> {{ $lapin->tanggal_kejadian }} </td>
                                        <td> {{ $lapin->jam_kejadian }} </td>
                                        <td> {{ $lapin->insiden }} </td>
                                        <td> {{ $lapin->kronologis }} </td>
                                        <td> {{ $lapin->jenis_insiden }} </td>
                                        <td> {{ $lapin->pelapor_insiden }} </td>
                                        <td> {{ $lapin->korban_insiden }} </td>
                                        <td> {{ $lapin->layanan_insiden }} </td>
                                        <td> {{ $lapin->tempat_insiden }} </td>
                                        <td> {{ $lapin->kasus_insiden }} </td>
                                        <td> {{ $lapin->unit_insiden }} </td>
                                        <td> {{ $lapin->dampak_insiden }} </td>
                                        <td> {{ $lapin->tindakan_cepat }} </td>
                                        <td> {{ $lapin->tindakan_insiden }} </td>
                                        <td> {{ $lapin->kejadian_insiden }} </td>
                                        <td> {{ $lapin->status }} </td>
                                        <td> {{ $lapin->pembuat_laporan }} </td>
                                        <td> {{ $lapin->penerima_laporan }} </td>
                                        <td> {{ $lapin->created_at }} </td>
                                        <td> {{ $lapin->tanggal_terima }} </td>
                                        <td> {{ $lapin->grading_risiko }} </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
