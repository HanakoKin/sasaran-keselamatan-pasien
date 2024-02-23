@extends('index')

@section('container')
<section class="content pt-0">

    <div class="row">
        <div class="col-12">

            <div class="d-inline-block align-items-center pb-0">
                <nav>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/dashboard"><i class="mdi mdi-home-outline"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="/lemkis">Kelola LEMKIS</a></li>
                        <li class="breadcrumb-item"><a href="/lemkis/noteTable/{{ $data->id }}">Tabel Catatan
                                Tambahan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kelola Catatan Tambahan</li>
                    </ol>
                </nav>
            </div>

            {{-- Form --}}
            <form action="{{ route('addNote', ['id' => $data->id]) }}" method="post" enctype="multipart/form-data"
                onsubmit="return validasiForm()">
                @csrf
                <div class="box-body">

                    @csrf

                    @if (!isset($data->catatan))
                    <div class="form-group">
                        <label for="input1">Catatan 1:</label>
                        <textarea class="form-control" id="textarea1" name="catatan[]" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="date1">Tanggal untuk Catatan 1:</label>
                        <input type="date" class="form-control" id="date1" name="tanggal_catatan[]" required>
                    </div>

                    <div id="dynamicInputs">
                        <!-- Input tambahan akan ditambahkan di sini secara dinamis -->
                    </div>
                    @endif

                    @foreach ($fixed_data_catatan as $catatan)
                    <div class="form-group" id="catatanRow{{ $loop->index }}">
                        <label for="input{{ $loop->index + 1 }}">Catatan {{ $loop->index + 1 }}:</label>
                        <textarea class="form-control" id="textarea{{ $loop->index + 1 }}" name="catatan[]"
                            required>{{ $catatan }}</textarea>
                    </div>
                    <div class="form-group" id="tanggalRow{{ $loop->index }}">
                        <label for="date{{ $loop->index + 1 }}">Tanggal untuk Catatan {{ $loop->index + 1 }}:</label>
                        <input type="date" class="form-control" id="date{{ $loop->index + 1 }}" name="tanggal_catatan[]"
                            required value="{{ $fixed_data_tanggal[$loop->index] }}">
                    </div>
                    @endforeach

                    <div id="dynamicInputs">
                        <!-- Input tambahan akan ditambahkan di sini secara dinamis -->
                    </div>

                    <!-- /.box-body -->
                    <div class="box-footer float-right">
                        <button type="button" class="btn btn-success" id="addInput"><i class="fal fa-layer-plus"></i>
                            Tambah Input</button>
                        <button type="button" class="btn btn-danger" id="removeInput"><i class="fas fa-trash"></i>
                            Kurangi Input</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@include('script.addNote')

@endsection
