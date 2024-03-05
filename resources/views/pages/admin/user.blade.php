@extends('index')

@section('container')

<section class="content pt-0">

    @if(session()->has('success'))
    @include('script.success')
    @endif

    @if(session()->has('error'))
    @include('script.error')
    @endif


    <div class="row">
        <div class="col-xl-12 col-12">

            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Laporan Insiden</li>
                    </ol>
                </nav>
            </div>

            {{-- Caption --}}
            <div class="box bg-transparent no-shadow mb-0">
                <div class="box-header no-border">
                    <h4 class="box-title">Tabel Laporan Insiden</h4>
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="/lapin/add" class="btn btn-info btn-sm mb-2 text-decoration-none">
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
                                    <th scope="col">Username</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr class="text-center">
                                    <td><img src="https://source.unsplash.com/50x50?people" alt="User Avatar"
                                            class="img-fluid rounded-circle mb-3" style="width: 50px;"></td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->unit }}</td>
                                    <td>

                                        <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                                            data-bs-toggle="modal" onclick="showLapinModal({{ json_encode($user) }})">
                                            <i class="fal fa-eye"></i> Lihat
                                        </a>

                                        <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                            href="{{ url('/admin/user/edit', $user->id) }}"><i class="fal fa-pen"></i>
                                            Edit
                                        </a>

                                        <a href="{{ route('deleteLapin', ['id' => $user->id]) }}" data-target="lapin"
                                            class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none deleteBtn"><i
                                                class="fal fa-trash-alt"></i> Delete
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $users->links('pagination::bootstrap-5') }}
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
