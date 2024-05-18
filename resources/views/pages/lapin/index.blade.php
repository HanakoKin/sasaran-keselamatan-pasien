@extends('index')

@section('container')
    <section class="content pt-0">

        @if (session()->has('success'))
            @include('script.alert.success')
        @endif

        @if (session()->has('error'))
            @include('script.alert.error')
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
                            <table class="table table-borderless mb-0">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">#</th>
                                        <th scope="col">Nama</th>
                                        <th width="100" scope="col">No Reg</th>
                                        <th width="120" scope="col">Status</th>
                                        <th width="120" scope="col">Grade</th>
                                        <th width="70" scope="col">LEMKIS</th>
                                        @if (Auth::user()->role !== 'user')
                                            <th width="120" scope="col">Unit Pelapor</th>
                                        @endif
                                        <th width="130" scope="col">Status Pelapor</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lapins as $lapin)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $lapin->nama }}</td>
                                            <td>{{ $lapin->noReg }}</td>
                                            <td>{{ $lapin->status }}</td>
                                            <td>
                                                @if ($lapin->status != 'Terverifikasi')
                                                    Menunggu verifikasi
                                                @else
                                                    {{ ucfirst($lapin->grading_risiko) }}
                                                @endif
                                            </td>
                                            <td>{{ isset($lapin->lemkis) ? 'Ada' : 'Belum ada' }}</td>
                                            @if (Auth::user()->role !== 'user')
                                                <td>{{ $lapin->unit_kerja }}</td>
                                            @endif
                                            <td>{{ $lapin->status_pelapor }}</td>
                                            <td class="max-w-250">

                                                <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                                                    data-bs-toggle="modal"
                                                    onclick="showLapinModal({{ json_encode($lapin) }})">
                                                    <i class="fal fa-eye"></i> Lihat
                                                </a>

                                                @if (Auth::user()->role !== 'user' ||
                                                        $lapin->status ===
                                                            "Belum
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        terverifikasi")
                                                    <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                                        href="{{ url('/lapin/edit', $lapin->id) }}"><i
                                                            class="fal fa-pen"></i>
                                                        Edit
                                                    </a>
                                                @elseif (Auth::user()->role === 'user' && $lapin->status === 'Belum terverifikasi')
                                                    <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none"
                                                        href="{{ url('/lapin/edit', $lapin->id) }}"><i
                                                            class="fal fa-pen"></i> Edit
                                                    </a>
                                                @endif

                                                <a href="{{ route('deleteLapin', ['id' => $lapin->id]) }}"
                                                    data-target="lapin"
                                                    class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none deleteBtn"><i
                                                        class="fal fa-trash-alt"></i> Delete
                                                </a>

                                                @if (Auth::user()->role !== 'user' || $lapin->status === 'Terverifikasi')
                                                    <a class="btn btn-primary btn-sm me-2 mb-2 text-decoration-none"
                                                        href="{{ url('/lapin/verificate', $lapin->id) }}"><i
                                                            class="fas fa-badge-check"></i> Cetak
                                                    </a>
                                                @endif

                                                @if (!isset($lapin->lemkis))
                                                    <a class="btn btn-info btn-sm me-2 mb-2 text-decoration-none"
                                                        href="{{ url('/lemkis/addLemkis', $lapin->id) }}"><i
                                                            class="fal fa-notes-medical"></i> LEMKIS
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
        @include('modal.lapin.show')

        {{-- JS for Modal --}}
        @include('script.lapin.show')

        {{-- JS for Delete --}}
        @include('script.confirm.delete')

    </section>
@endsection
