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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-user">
                                    <i class="fas fa-user-plus"></i> Add New
                                </button>
                            </h3>
                        </div>

                        {{-- @include('users/modal-user') --}}

                        <div class="card-body">
                            <div class="">
                                <table id="studEnTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Stud ID</th>
                                            <th>Name</th>
                                            <th>Voucher Code</th>
                                            <th>Course</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        {{-- @php $no = 1; @endphp
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
                                        @endforeach --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editStudEnModal" role="dialog" aria-labelledby="editStudEnModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFundModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editStudEnForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editStudEnId">
                    <div class="form-group">
                        <label for="editstudID">Student ID No.</label>
                        <input type="text" id="editstudID" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Student ID Number" class="form-control" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="editstudName">Name</label>
                        <input type="text" id="editstudName" name="fullname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Full Name" class="form-control" readonly="">
                    </div>
                    <div class="form-group">
                        <label for="passwordInput">Generate New Password</label>
                        <input type="text" name="password" id="passwordInput" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Password" class="form-control" readonly="">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" id="generatePassword" class="btn btn-success">
                        <i class="fas fa-key"></i> Generate New Password
                    </button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var studEnReadRoute = "{{ route('getstudentRead') }}";
    var studEnUpdateRoute = "{{ route('studentUpdate', ['id' => ':id']) }}";
</script>

@endsection