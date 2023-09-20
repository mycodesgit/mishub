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
                            <form class="form-horizontal" action="{{ route('profileUpdate') }}" method="post" id="addUser">  
                                @csrf

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>First Name:</label>
                                            <input type="text" name="fname" value="{{ Auth::guard('web')->user()->fname}}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Middle Name:</label>
                                            <input type="text" name="mname" value="{{ Auth::guard('web')->user()->mname}}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Last Name:</label>
                                            <input type="text" name="lname" value="{{ Auth::guard('web')->user()->lname}}" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control">
                                        </div>

                                        <div class="col-md-6">
                                            <label>Username:</label>
                                            <input type="text" id="username" value="{{ Auth::guard('web')->user()->username}}" name="username" placeholder="Enter Username" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label>Role:</label>
                                            <select name="role" class="form-control" style="pointer-events: none;">
                                                <option value=""> --- Select ---</option>
                                                <option value="Administrator" {{ Auth::guard('web')->user()->role == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                                <option value="MIS Officer" {{ Auth::guard('web')->user()->role == 'MIS Officer' ? 'selected' : '' }}>MIS Officer</option>
                                                <option value="Staff" {{ Auth::guard('web')->user()->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Gender:</label>
                                            <select name="gender" class="form-control">
                                                <option value=""> --- Select ---</option>
                                                <option value="Male" {{ Auth::guard('web')->user()->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ Auth::guard('web')->user()->gender == 'Female' ? 'selected' : '' }}>Female</option>
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
                            <form class="form-horizontal" action="{{ route('profilePassUpdate') }}" method="post" id="addUser">  
                                @csrf
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