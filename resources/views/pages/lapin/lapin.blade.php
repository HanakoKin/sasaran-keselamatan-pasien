@extends('index')

@section('container')
<section class="content">

    @if(session()->has('success'))
    @include('script.success')
    @endif


    <div class="row">
        <div class="col-xl-9 col-12">

            {{-- Caption --}} <div class="box bg-transparent no-shadow mb-0">
                <div class="box-header no-border">
                    <h4 class="box-title">Tabel Laporan Insiden</h4>
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="/addLapin" class="btn btn-info btn-sm mb-2 text-decoration-none">
                            <i class="fal fa-plus-circle"></i> Add
                        </a>
                    </div>
                </div>
            </div>

            {{-- Tabel Content --}}
            <div class="box">
                <div class="box-body py-0">
                    <div class="table-responsive">
                        <table class="table no-border mb-0">
                            <thead>
                                <tr class="text-center">
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th width="100" scope="col">No RM</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Grade</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapins as $lapin)
                                <tr class="text-center">
                                    <td><img src="https://source.unsplash.com/50x50?people" alt="User Avatar"
                                            class="img-fluid rounded-circle mb-3" style="width: 50px;"></td>
                                    <td>{{ $lapin->nama }}</td>
                                    <td>{{ $lapin->noRM }}</td>
                                    <td>
                                        {{ $lapin->status }}
                                    </td>
                                    <td>
                                        @if ($lapin->status != 'Terverifikasi')
                                        Menunggu verifikasi
                                        @else
                                        {{ ucfirst($lapin->grading_risiko) }}
                                        @endif
                                    </td>
                                    <td>

                                        <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                            data-bs-toggle="modal" onclick="showLapinModal({{ json_encode($lapin) }})">
                                            <i class="fal fa-eye"></i> Lihat
                                        </a>

                                        <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                                            href="{{ url('/editLapin', $lapin->id) }}"><i class="fal fa-pen"></i>
                                            Edit
                                        </a>

                                        <a href="deleteLapin/{{ $lapin->id }}" data-target="lapin"
                                            class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none deleteBtn"><i
                                                class="fal fa-trash-alt"></i>
                                            Delete
                                        </a>

                                        @if (Auth::user()->role === 'admin')

                                        <a class="btn btn-secondary btn-sm me-2 mb-2 text-decoration-none"
                                            href="{{ url('/verifikasiLapin', $lapin->id) }}"><i class="fal fa-pen"></i>
                                            Verifikasi
                                        </a>

                                        @endif


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="box no-shadow mb-0">
                        <div class="box-body px-0 pt-0">
                            <div id="calendar" class="dask evt-cal min-h-400"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Show Data --}}
    @include('modal.lapinShow')

    {{-- JS for Modal --}}
    @include('script.lapinShow')

    {{-- JS for Delete --}}
    @include('script.confirm-delete')

</section>

@endsection
