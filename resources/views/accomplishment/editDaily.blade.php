@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Accomplishment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dailyRead') }}">Accomplishment</a></li>
                        <li class="breadcrumb-item active">Edit</li>
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
                                <i class="fas fa-pen"></i> Edit
                            </h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('dailyUpdate') }}" id="addDailyTask">
                                @csrf


                                <input type="hidden" name="id" value="{{ $daily->id }}">

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Task:</label>
                                            <select name="task" class="form-control select2bs4" style="width: 100%;">
                                                <option value="">--- Select ---</option>
                                                @foreach ($option as $data)
                                                    <option value="{{ $data->option_name }}" {{ $data->option_name == $selectedTask ? 'selected' : '' }}>{{ $data->option_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>No. of Accommodation:</label>
                                            <textarea class="form-control" rows="4" id="no_accom" name="no_accom">{{ $daily->no_accom }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <a href="{{ route('dailyRead') }}" class="btn btn-danger">
                                                Cancel
                                            </a>
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