@extends('index')

@section('container')
<section class="content">
    <div class="row">
        <div class="col-xl-8 col-12">
            <div class="box bg-primary-light">
                <div class="box-body d-flex px-0">
                    <div class="flex-grow-1 p-30 flex-grow-1 bg-img dask-bg bg-none-md"
                        style="background-position: right bottom; background-size: auto 100%; background-image: url({{ asset('assets/images/svg-icon/color-svg/custom-1.svg') }})">
                        <div class="row">
                            <div class="col-12 col-xl-7">
                                <h2>Welcome back, <strong>{{ ucfirst(trans(Auth()->user()->username)) }} !</strong></h2>

                                <p class="text-dark my-10 fs-16">
                                    Your students complated <strong class="text-warning">80%</strong> of the tasks.
                                </p>
                                <p class="text-dark my-10 fs-16">
                                    Progress is <strong class="text-warning">very good!</strong>
                                </p>
                            </div>
                            <div class="col-12 col-xl-5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6">
                    <div class="box">
                        <div class="box-body d-flex p-0">
                            <div class="flex-grow-1 bg-danger p-30 flex-grow-1 bg-img"
                                style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url({{ asset('assets/images/svg-icon/color-svg/custom-3.svg') }})">

                                <h4 class="fw-400">User Activity</h4>

                                <p class="my-10 fs-16">
                                    Grow marketing &amp; sales<br>through product.
                                </p>

                                <a href="#" class="btn btn-danger-light">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="box">
                        <div class="box-body d-flex p-0">
                            <div class="flex-grow-1 bg-primary p-30 flex-grow-1 bg-img"
                                style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url({{ asset('assets/images/svg-icon/color-svg/custom-4.svg') }})">

                                <h4 class="fw-400">Based On</h4>

                                <div class="mt-5">
                                    <div class="d-flex mb-10 fs-16">
                                        <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span
                                                class="path2"></span></span>
                                        <span class="text-white">Activities</span>
                                    </div>

                                    <div class="d-flex mb-10 fs-16">
                                        <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span
                                                class="path2"></span></span>
                                        <span class="text-white">Sales</span>
                                    </div>

                                    <div class="d-flex mb-10 fs-16">
                                        <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span
                                                class="path2"></span></span>
                                        <span class="text-white">Releases</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-12">
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
</section>

@endsection
