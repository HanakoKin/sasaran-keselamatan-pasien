@extends('dashboard.dashboard')

@section('container')

<section class="content container-fluid h-50">
    <h2>Section title</h2>

    <div class="table-responsive small">
        <table id="tableLapin" class="table table-striped table-bordered display">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No RM</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Jenis Kelamin</th>
                    <th scope="col">Penanggung Biaya</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lapins as $lapin)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $lapin->nama }}</td>
                    <td>{{ $lapin->noRM }}</td>
                    <td>{{ $lapin->umur }}</td>
                    <td>{{ $lapin->jenis_kelamin }}</td>
                    <td>{{ $lapin->penjamin }}</td>
                    <td>
                        <a class="btn btn-warning btn-sm me-2 mb-2 text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#lapinModal" data-lapin="{{ json_encode($lapin) }}">
                            <i class="fa-solid fa-pen-to-square"></i> Lihat
                        </a>

                        <a class="btn btn-success btn-sm me-2 mb-2 text-decoration-none"
                            href="{{ url('/editLapin', $lapin->id) }}"><i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </a>

                        <a href="deleteLapin/{{ $lapin->id }}"
                            onclick="return confirm('Are you sure want to delete {{ $lapin->nama }} data?')"
                            class="btn btn-danger btn-sm me-2 mb-2 text-decoration-none"><i
                                class="fa-solid fa-trash"></i>
                            Delete
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal Lihat -->
    @include('dashboard.laporan-insiden.modal.modal_lihat')

    <!-- Modal Edit -->
    @include('dashboard.laporan-insiden.modal.modal_edit')

    @include('dashboard.laporan-insiden.script.read')


</section>

@endsection
