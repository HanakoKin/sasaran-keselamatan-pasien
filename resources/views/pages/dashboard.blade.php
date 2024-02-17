@extends('index')

@section('container')
<section class="content">
    <div class="row">
        <div class="row">
            <div class="col-12">
                <div class="box bg-gradient-primary overflow-hidden pull-up">
                    <div class="box-body pe-0 ps-lg-50 ps-15 py-0">
                        <div class="row align-items-center">
                            <div class="col-12 col-lg-8">
                                <h1 class="fs-40 text-white">Welcome
                                    <strong>{{ ucfirst(trans(Auth()->user()->username)) }} !</strong></h1>
                                <p class="text-white mb-0 fs-20">
                                    Education is the passport to the future, So learn more & more
                                </p>
                            </div>
                            <div class="col-12 col-lg-4"><img
                                    src="{{ asset('assets/images/svg-icon/color-svg/custom-15.svg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Di bawah ini kasus berdasarkan jenis --}}

        <div class="row">
            <div class="col-12">
                <div class="box no-shadow mb-0 bg-transparent">
                    <div class="box-header no-border px-0">
                        <h4 class="box-title">Kasus Berdasarkan Jenis</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <a href="#" class="box pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-running fs-60 m-0"></i>
                            <div class="ms-15">
                                <h5 class="mb-0">Kejadian Nyaris Cedera</h5>
                                <p class="text-fade fs-12 mb-0">{{ $jumlahKNC }} kasus</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-20">
                            <div class="w-p70">
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar bg-{{ $prosentaseKNC >= 0 && $prosentaseKNC <= 25 ? 'info' : ($prosentaseKNC > 25 && $prosentaseKNC <= 50 ? 'success' : ($prosentaseKNC > 50 && $prosentaseKNC <= 75 ? 'warning' : ($prosentaseKNC > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseKNC }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $prosentaseKNC }}%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>{{ $prosentaseKNC }}%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12">
                <a href="#" class="box pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-shield fs-60 m-0"></i>
                            <div class="ms-15">
                                <h5 class="mb-0">Kejadian Tidak Cedera</h5>
                                <p class="text-fade fs-12 mb-0">{{ $jumlahKTC }} kasus</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-20">
                            <div class="w-p70">
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar bg-{{ $prosentaseKTC >= 0 && $prosentaseKTC <= 25 ? 'info' : ($prosentaseKTC > 25 && $prosentaseKTC <= 50 ? 'success' : ($prosentaseKTC > 50 && $prosentaseKTC <= 75 ? 'warning' : ($prosentaseKTC > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseKTC }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $prosentaseKTC }}%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>{{ $prosentaseKTC }}%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12">
                <a href="#" class="box pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-injured fs-60 m-0"></i>
                            <div class="ms-15">
                                <h5 class="mb-0">Kejadian Tidak Diharapkan</h5>
                                <p class="text-fade fs-12 mb-0">{{ $jumlahKTD }} kasus</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-20">
                            <div class="w-p70">
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar bg-{{ $prosentaseKTD >= 0 && $prosentaseKTD <= 25 ? 'info' : ($prosentaseKTD > 25 && $prosentaseKTD <= 50 ? 'success' : ($prosentaseKTD > 50 && $prosentaseKTD <= 75 ? 'warning' : ($prosentaseKTD > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseKTD }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $prosentaseKTD }}%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>{{ $prosentaseKTD }}%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-12">
                <a href="#" class="box pull-up">
                    <div class="box-body">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-procedures fs-60 m-0"></i>
                            <div class="ms-15">
                                <h5 class="mb-0">Kondisi Potensial Cedera</h5>
                                <p class="text-fade fs-12 mb-0">{{ $jumlahKPC }} kasus</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-20">
                            <div class="w-p70">
                                <div class="progress progress-sm mb-0">
                                    <div class="progress-bar  bg-{{ $prosentaseKPC >= 0 && $prosentaseKPC <= 25 ? 'info' : ($prosentaseKPC > 25 && $prosentaseKPC <= 50 ? 'success' : ($prosentaseKPC > 50 && $prosentaseKPC <= 75 ? 'warning' : ($prosentaseKPC > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseKPC }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $prosentaseKPC }}%">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div>{{ $prosentaseKPC }}%</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Di bawah ini kasus berdasarkan grading --}}

        <div class="row">
            <div class="col-12">
                <div class="box no-shadow mb-0 bg-transparent">
                    <div class="box-header no-border px-0">
                        <h4 class="box-title">Kasus Berdasarkan Grading</h4>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div class="bg-info rounded">
                            <h5 class="text-white text-center p-10">{{ $gradeBiru }} Kasus</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <div>
                                <p class="mb-0 text-fade">Grade</p>
                                <p class="mb-0">Biru</p>
                            </div>
                            <div>
                                <p class="mb-5 fw-600">{{ $prosentaseBiru }}%</p>
                                <div class="progress progress-sm mb-0 w-100">
                                    <div class="progress-bar bg-{{ $prosentaseBiru >= 0 && $prosentaseBiru <= 25 ? 'info' : ($prosentaseBiru > 25 && $prosentaseBiru <= 50 ? 'success' : ($prosentaseBiru > 50 && $prosentaseBiru <= 75 ? 'warning' : ($prosentaseBiru > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseBiru }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $prosentaseBiru }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div class="bg-success rounded">
                            <h5 class="text-white text-center p-10">{{ $gradeHijau }} Kasus</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <div>
                                <p class="mb-0 text-fade">Grade</p>
                                <p class="mb-0">Hijau</p>
                            </div>
                            <div>
                                <p class="mb-5 fw-600">{{ $prosentaseHijau }}%</p>
                                <div class="progress progress-sm mb-0 w-100">
                                    <div class="progress-bar bg-{{ $prosentaseHijau >= 0 && $prosentaseHijau <= 25 ? 'info' : ($prosentaseHijau > 25 && $prosentaseHijau <= 50 ? 'success' : ($prosentaseHijau > 50 && $prosentaseHijau <= 75 ? 'warning' : ($prosentaseHijau > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseHijau }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $prosentaseHijau }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div class="bg-warning rounded">
                            <h5 class="text-white text-center p-10">{{ $gradeKuning }} Kasus</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <div>
                                <p class="mb-0 text-fade">Grade</p>
                                <p class="mb-0">Kuning</p>
                            </div>
                            <div>
                                <p class="mb-5 fw-600">{{ $prosentaseKuning }}%</p>
                                <div class="progress progress-sm mb-0 w-100">
                                    <div class="progress-bar bg-{{ $prosentaseKuning >= 0 && $prosentaseKuning <= 25 ? 'info' : ($prosentaseKuning > 25 && $prosentaseKuning <= 50 ? 'success' : ($prosentaseKuning > 50 && $prosentaseKuning <= 75 ? 'warning' : ($prosentaseKuning > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseKuning }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{ $prosentaseKuning }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box pull-up">
                    <div class="box-body">
                        <div class="bg-danger rounded">
                            <h5 class="text-white text-center p-10">{{ $gradeMerah }} Kasus</h5>
                        </div>
                        <div class="d-flex justify-content-between mt-30">
                            <div>
                                <p class="mb-0 text-fade">Grade</p>
                                <p class="mb-0">Merah</p>
                            </div>
                            <div>
                                <p class="mb-5 fw-600">{{ $prosentaseMerah }}%</p>
                                <div class="progress progress-sm mb-0 w-100">
                                    <div class="progress-bar bg-{{ $prosentaseMerah >= 0 && $prosentaseMerah <= 25 ? 'info' : ($prosentaseMerah > 25 && $prosentaseMerah <= 50 ? 'success' : ($prosentaseMerah > 50 && $prosentaseMerah <= 75 ? 'warning' : ($prosentaseMerah > 75 ? 'danger' : ''))) }}"
                                        role="progressbar" aria-valuenow="{{ $prosentaseMerah }}" aria-valuemin="0"
                                        aria-valuemax="100" style="width: {{$prosentaseMerah}}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-12">
                <div class="box">
                    <div class="box-body analytics-info">
                        <div id="pie-jenis" style="height:400px;"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-12">
                <div class="box">
                    <div class="box-body analytics-info">
                        <div id="pie-grading" style="height:400px;"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@include('script.chart')

@endsection
