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
                <div class="col-lg-8">
                    <div class="card card-gray card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-info-circle"></i> Update Info
                            </h3>
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('userUpdate') }}" method="post" id="addUser">  
                                @csrf
                                <input type="hidden" name="id" value="{{ $selectedUser->id }}">

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>First Name:</label>
                                            <input type="text" name="fname" value="{{ $selectedUser->fname }}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Middle Name:</label>
                                            <input type="text" name="mname" value="{{ $selectedUser->mname }}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Last Name:</label>
                                            <input type="text" name="lname" value="{{ $selectedUser->lname }}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Username:</label>
                                            <input type="text" id="username" value="{{ $selectedUser->username }}" name="username" placeholder="Enter Username" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Select Office:</label>
                                            <select name="off_id" class="form-control select2bs4" style="width: 100%;">
                                                <option value="">-- Select --</option>
                                                @foreach ($office as $data)
                                                    <option value="{{ $data->id }}" {{ $data->id == $selectedOfficeId ? 'selected' : '' }}>{{ $data->office_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Gender:</label>
                                            <select name="gender" class="form-control">
                                                <option value=""> --- Select ---</option>
                                                <option value="Male" {{ $selectedUser->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ $selectedUser->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group"> 
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Role:</label>
                                            <select name="role" class="form-control">
                                                <option value=""> --- Select ---</option>
                                                <option value="Administrator" {{ $selectedUser->role == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                                <option value="MIS Officer" {{ $selectedUser->role == 'MIS Officer' ? 'selected' : '' }}>MIS Officer</option>
                                                <option value="Staff" {{ $selectedUser->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Campus:</label>
                                            <select name="campus_id" class="form-control">
                                                <option value=""> --- Select ---</option>
                                                @foreach ($campus as $data)
                                                    <option value="{{ $data->id }}" {{ $data->id == $selectedCampusId ? 'selected' : '' }}>{{ $data->campus_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card card-gray card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-lock"></i> Update Password
                            </h3>
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('userUpdatePassword') }}" method="post" id="addUser">  
                                @csrf
                                <input type="hidden" name="id" value="{{ $selectedUser->id }}">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Password:</label>
                                            <input type="password" name="password" value="" placeholder="Enter Password" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger">
                                                Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('control.aside') --}}

</div>
        
@endsection