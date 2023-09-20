@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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

                        @include('users/modal')

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>First Name</th>
                                            <th>Middle Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php $no = 1; @endphp
                                        @foreach($user as $data)
                                        <tr id="tr-{{ $data->id }}" class="">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->fname }}</td>
                                            <td>{{ $data->mname }}</td>
                                            <td>{{ $data->lname }}</td>
                                            <td>{{ $data->username }}</td>
                                            <td>{{ $data->role }}</td>
                                            <td>{{ $data->office_abbr }}</td>
                                            <td>
                                                <a href="{{ route('userEdit', ['id' => $data->id]) }}" class="btn btn-info btn-xs btn-edit">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                                <button value="{{ $data->id }}" class="btn btn-danger btn-xs user-delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
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

<script>
    var userDeleteRoute = "{{ route('userDelete', ':id') }}";
</script>

@endsection