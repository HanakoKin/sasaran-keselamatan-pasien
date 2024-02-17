@extends('index')

@section('container')
<section class="content pt-0">

    @if(session()->has('success'))
    @include('script.success')
    @endif


    <div class="row">
        <div class="col-xl-12 col-12">

            {{-- Caption --}}
            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola LEMKIS
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="box bg-transparent no-shadow mb-0">
                <div class="box-header no-border">
                    <h4 class="box-title">Tabel Lembar Kerja Investigasi Sederhana</h4>
                    <div class="box-controls pull-right d-md-flex d-none">
                        <a href="/lemkis/add" class="btn btn-info btn-sm mb-2 text-decoration-none">
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
                                    <th scope="col">Penyebab Langsung</th>
                                    <th scope="col">Penyebab Awal</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lemkises as $lemkis)
                                <tr class="text-center">
                                    <td><img src="https://source.unsplash.com/50x50?people" alt="User Avatar"
                                            class="img-fluid rounded-circle mb-3" style="width: 50px;"></td>
                                    <td>{{ $lemkis->penyebab_langsung }}</td>
                                    <td>{{ $lemkis->penyebab_awal }}</td>
                                    <td>

                                        <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                            href="{{ url('/lemkis/show', $lemkis->id) }}"><i class="fal fa-eye"></i>
                                            Lihat
                                        </a>

                                        <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                                            href="{{ url('/lemkis/edit', $lemkis->id) }}"><i class="fal fa-pen"></i>
                                            Edit
                                        </a>

                                        <a href="lemkis/delete/{{ $lemkis->id }}" data-target="lemkis"
                                            class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none deleteBtn"><i
                                                class="fal fa-trash-alt"></i>
                                            Delete
                                        </a>

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
    @include('modal.lemkisShow')

    {{-- JS for Modal --}}
    @include('script.lapinShow')

    {{-- JS for Delete --}}
    @include('script.confirm-delete')

</section>

@endsection
