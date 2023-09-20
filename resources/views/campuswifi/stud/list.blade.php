@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Students</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-gray card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-user">
                                    <i class="fas fa-user-plus"></i> Add New
                                </button>
                            </h3>
                        </div>

                        {{-- @include('users/modal-user') --}}

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Stud ID</th>
                                            <th>Name</th>
                                            <th>Voucher Code</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php $no = 1; @endphp
                                        @foreach($student as $data)
                                        <tr id="tr-{{ $data->id }}" class="">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->stud_id }}</td>
                                            <td>{{ $data->fullname }}</td>
                                            <td>{{ $data->voucher_code }}</td>
                                            <td>{{ $data->course }}</td>
                                            <td>
                                                <a href="{{ route('studentEdit', $data->s_id) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
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
        </div>
    </div>

    {{-- @include('control.aside') --}}

</div>
        
@endsection