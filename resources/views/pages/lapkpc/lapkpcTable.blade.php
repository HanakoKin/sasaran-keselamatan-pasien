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
                        <li class="breadcrumb-item active" aria-current="page">Tabel Laporan KPC</li>
                    </ol>
                </nav>
                <div class="box">
                    <div class="box-header py-4">
                        <h4 class="box-title">Tabel Laporan KPC</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead>
                                    <tr>
                                        <th>Kondisi Potensial Cedera</th>
                                        <th>Tanggal Ditemukan</th>
                                        <th>Jam Ditemukan</th>
                                        <th>Pelapor Insiden</th>
                                        <th>Tempat Insiden</th>
                                        <th>Unit Insiden</th>
                                        <th>Tindakan Cepat</th>
                                        <th>Tindakan Insiden</th>
                                        <th>Kejadian Insiden</th>
                                        <th>Status</th>
                                        <th>Pembuat Laporan</th>
                                        <th>Tanggal Lapor</th>
                                        <th>Penerima laporan</th>
                                        <th>Tanggal Terima</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lapkpcs as $lapkpc)
                                    <tr>
                                        <td> {{ $lapkpc->kpc }} </td>
                                        <td> {{ $lapkpc->tanggal_ditemukan }} </td>
                                        <td> {{ $lapkpc->jam_ditemukan }} </td>
                                        <td> {{ $lapkpc->pelapor_insiden }} </td>
                                        <td> {{ $lapkpc->tempat_insiden }} </td>
                                        <td> {{ $lapkpc->unit_insiden }} </td>
                                        <td> {{ $lapkpc->tindakan_cepat }} </td>
                                        <td> {{ $lapkpc->tindakan_insiden }} </td>
                                        <td> {{ $lapkpc->kejadian_insiden }} </td>
                                        <td> {{ $lapkpc->status }} </td>
                                        <td> {{ $lapkpc->pembuat_laporan }} </td>
                                        <td> {{ $lapkpc->penerima_laporan }} </td>
                                        <td> {{ $lapkpc->created_at }} </td>
                                        <td> {{ $lapkpc->tanggal_terima }} </td>
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
