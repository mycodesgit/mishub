@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $stud }}</h3>
                            <p>Students Registered</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users"></i>
                        </div>
                        <a href="{{ route('studentRead') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $voucher1 }}</h3>
                            <p>Total Voucher Available </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money-check"></i>
                        </div>
                        <a href="{{ route('voucherRead') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $voucher2 }}</h3>
                            <p>Total Voucher Used </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-money-check"></i>
                        </div>
                        <a href="{{ route('voucherRead') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            <h3>{{ $user }}</h3>
                            <p>Total Users </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-users-gear"></i>
                        </div>
                        <a href="{{ route('dashboard') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bar Chart Campus Wifi</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" data-january="{!! $studentJanuaryCount !!}"
                                                            data-february="{!! $studentFebruaryCount !!}"
                                                            data-march="{!! $studentMarchCount !!}"
                                                            data-april="{!! $studentAprilCount !!}"
                                                            data-may="{!! $studentMayCount !!}" 
                                                            data-june="{!! $studentJuneCount !!}"
                                                            data-july="{!! $studentJulyCount !!}"
                                                            data-august="{!! $studentAugustCount !!}"
                                                            data-september="{!! $studentSeptemberCount !!}"
                                                            data-october="{!! $studentOctoberCount !!}"
                                                            data-november="{!! $studentNovemberCount !!}"
                                                            data-december="{!! $studentDecemberCount !!}"
                                                            height="200">
                                    </canvas>
                                </div>
                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square" style="color: #00a65a"></i> Student Register in Campus Wifi
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

</div>
        
@endsection