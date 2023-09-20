@extends('layouts.master')

@section('body')

<style>
    .alert.alert-outline-warning {
        border: 1px solid #ffc107 !important;
        background-color: #ffdc72 !important;
        color: #ffc107 !important;
    }
    .alert.alert-outline-warning h5 {
        color: #000 !important;
    }
    .alert.alert-outline-warning .icon {
        color: #000 !important;
    }
    .text-muted{
        color: #000 !important;
    }
</style>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Reports</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reports</li>
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
                                <i class="fas fa-file-pdf"></i> Accomplishment Reports
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="alert alert-outline-warning alert-dismissible">
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Note!</h5>
                                <div class="text-muted">Please check if you've completed your task within this month or within the range you've set to finish it before generating your <strong>Accomplishment Reports</strong>.</div>
                            </div>

                            <form class="form-horizontal" action="{{ route('generateReports') }}" method="GET" id="generateReport" target="_blank">  
                                @csrf
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-5">
                                            <label>From:</label>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>
                                        <div class="col-md-5">
                                            <label>To:</label>
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                        <div class="col-md-1">
                                            <label>&emsp;&emsp;Group:</label>
                                            <input type="checkbox" name="group" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary"> 
                                               <i class="fas fa-file-pdf"></i> Generate
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