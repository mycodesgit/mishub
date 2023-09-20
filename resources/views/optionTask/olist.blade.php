@extends('layouts.master')

@section('body')

@php $cr = request()->route()->getName(); @endphp

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Option Task</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Option Task</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card card-gray card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-plus"></i> {{ $cr == 'optiontaskEdit' ? 'Edit' : 'Add'}}
                            </h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ $cr == 'optiontaskEdit' ? route('optiontaskUpdate', ['id' => $selectedOptionTask->id]) : route('optiontaskCreate') }}" id="addoptiontask">
                                @csrf

                                @if ($cr == 'optiontaskEdit')
                                    <input type="hidden" name="id" value="{{ $selectedOptionTask->id }}">
                                @endif

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Task:</label>
                                            <input type="text" id="option_name" name="option_name" value="{{ $cr === 'optiontaskEdit' ? $selectedOptionTask->option_name : '' }}" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Task option" class="form-control" autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                Close
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
                <div class="col-lg-7">
                    <div class="card card-gray card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list"></i> List
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="daily" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Option Name</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @php $no = 1; @endphp
                                        @foreach($option as $data)
                                        <tr id="tr-{{ $data->id }}" class="{{ $cr === 'optiontaskEdit' ? $data->id == $selectedOptionTask->id ? 'bg-selectEdit' : '' : ''}}">
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $data->option_name }}</td>
                                            <td>{{ $data->created_at }}</td>
                                            <td>
                                                <a href="{{ route('optiontaskEdit', $data->id) }}" class="btn btn-info btn-xs btn-edit" data-id="{{ $data->id }}">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </a>
                                                <button value="{{ $data->id }}" class="btn btn-danger btn-xs optiontask-delete">
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
</div>

<script>
    var optionTaskDeleteRoute = "{{ route('optiontaskDelete', ':id') }}";
</script>

@endsection