@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Wifi Voucher</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Wifi Voucher</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'MIS Officer')
                                        <form action="{{ route('process') }}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    @else
                                        <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                                    @endif
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-8">
                                                    @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'MIS Officer')
                                                        <input type="file" name="csv_file" class="form-control form-control-md" required="" accept=".csv">
                                                    @else
                                                        <input type="file" name="csv_file" class="form-control form-control-md" disabled="">
                                                    @endif
                                                </div>

                                                <div class="col-md-4">
                                                    @if(Auth::user()->role == 'Administrator' || Auth::user()->role == 'MIS Officer')
                                                        <button type="submit" class="btn btn-info btn-md">Upload CSV</button>
                                                    @else
                                                        <button type="button" class="btn btn-info btn-md" disabled>Upload CSV</button>
                                                    @endif
                                                    <button type="reset" class="btn btn-danger btn-md">Cancel</button>  
                                                </div>
                                            </div>
                                        </form>
                                </div>
                                {{-- <div class="col-md-6">
                                    <button type="button" class="btn btn-success btn-md">Download CSV Template</button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-money-check"></i> Voucher Avialable
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Voucher Code</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php $no = 1; @endphp
                                        @foreach($voucher1 as $data)
                                        <tr id="tr-{{ $data->id }}" class="">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->voucher_code }}</td>
                                            <td>
                                                @if ($data->status == 1)
                                                    <span class="badge badge-primary"> Available</span>
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

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-money-check"></i> Voucher Used
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example2" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Voucher Code</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php $no = 1; @endphp
                                        @foreach($voucher2 as $data)
                                        <tr id="tr-{{ $data->id }}" class="">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->voucher_code }}</td>
                                            <td>
                                                @if ($data->status == 0)
                                                    <span class="badge badge-success"> Used</span>
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
        </div>
    </div>

    {{-- @include('control.aside') --}}

</div>
        
@endsection