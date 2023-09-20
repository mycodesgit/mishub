@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Student</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('studentRead') }}">Students</a></li>
                        <li class="breadcrumb-item active">Edit Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-gray card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user"></i> Student Data
                            </h3>
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" action="" method="post" id="addUser">  
                                @csrf

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Full Name:</label>
                                            <input type="text" name="fullname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Full Name" value="{{ $student->fullname }}" class="form-control" readonly="">
                                        </div>

                                        <div class="col-md-12"><br>
                                            <label>Student ID Number:</label>
                                            <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Student ID Number" value="{{ $student->stud_id }}" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>  
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-gray card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-pen"></i> Edit Password
                            </h3>
                        </div>

                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('studentUpdate') }}" method="post" id="">  
                                @csrf
                                <input type="hidden" name="id" value="{{ $student->id }}">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Password:</label>
                                            <input type="text" name="password" id="passwordInput" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Password" class="form-control" readonly="">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Updated
                                            </button>
                                            <button type="button" id="generatePassword" class="btn btn-outline-success">
                                                <i class="fas fa-key"></i> Generate New Password
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
</div>



        
@endsection