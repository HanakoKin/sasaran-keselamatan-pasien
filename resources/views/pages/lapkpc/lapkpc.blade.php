@extends('index')

@section('container')
<section class="content pt-0">

    @if(session()->has('success'))
    @include('script.success')
    @endif

    <div class="row">
        <div class="col-xl-12 col-12">

            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Laporan KPC</li>
                    </ol>
                </nav>
            </div>

            {{-- Caption --}}
            <div class="box bg-transparent no-shadow mb-0">
                <div class="box-header no-border">
                    <h4 class="box-title">Data Laporan KPC</h4>
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="/lapkpc/add" class="btn btn-info btn-sm mb-2 text-decoration-none">
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
                                    <th scope="col">KPC</th>
                                    <th scope="col">Pelapor KPC</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lapkpcs as $lapkpc)
                                <tr>
                                    <td><img src="https://source.unsplash.com/50x50?people" alt="User Avatar"
                                            class="img-fluid rounded-circle mb-3" style="width: 50px;"></td>
                                    <td>{{ $lapkpc->kpc }}</td>
                                    <td>{{ $lapkpc->pelapor_insiden }}</td>
                                    <td>{{ $lapkpc->status }}</td>
                                    <td>

                                        <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                            data-bs-toggle="modal"
                                            onclick="showLapkpcModal({{ json_encode($lapkpc) }})">
                                            <i class="fal fa-eye"></i> Lihat
                                        </a>

                                        <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                                            href="{{ url('/lapkpc/edit', $lapkpc->id) }}"><i class="fal fa-pen"></i>
                                            Edit
                                        </a>

                                        <a href="lapkpc/delete/{{ $lapkpc->id }}" data-target="lapkpc"
                                            class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none deleteBtn"><i
                                                class="fal fa-trash-alt"></i>
                                            Delete
                                        </a>

                                        @if (Auth::user()->role === 'admin')

                                        <a class="btn btn-secondary btn-sm me-2 mb-2 text-decoration-none"
                                            href="{{ url('/lapkpc/verificate', $lapkpc->id) }}"><i
                                                class="fal fa-pen"></i>
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
    </div>

    {{-- Modal Show Data --}}
    @include('modal.lapkpcShow')

    {{-- JS for Modal --}}
    @include('script.lapkpcShow')

    {{-- JS for Delete --}}
    @include('script.confirm-delete')

</section>

@endsection
