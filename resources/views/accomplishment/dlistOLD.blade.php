@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daily Accomplishment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Daily Accomplishment</li>
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
                                <i class="fas fa-plus"></i> Add New
                            </h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('dailyCreate') }}" id="addDailytask">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Task:</label>
                                            <select name="task" class="form-control select2bs4" style="width: 100%;">
                                                <option value="">--- Select ---</option>
                                                @foreach ($option as $data)
                                                    <option value="{{ $data->option_name }}">{{ $data->option_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>No. of Accommodation:</label>
                                            <textarea id="" class="form-control" rows="4" id="no_accom" name="no_accom"></textarea>
                                        </div>
                                    </div>
                                </div>

                                @if(Auth::user()->off_id == '36')
                                    <div class="form-group">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <button type="button" id="toggleButton" class="btn btn-outline-info btn-block">By Pass Date</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="lastFormSection" class="form-group" style="display: none;">
                                        <div class="form-row">
                                            <div class="col-md-12">
                                                <label>Date:</label>
                                                <input type="date" id="created_at" value="{{ now()->toDateString() }}" class="form-control"  name="created_at">
                                            </div>
                                        </div>
                                    </div>
                                @endif


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
                            @php
                                $selectedMonth = isset($_GET['month']) ? $_GET['month'] : date('m');
                                $selectedYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
                            @endphp

                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-4">
                                        <label for="yearSelect">Select Year:</label>
                                        <select class="form-control" id="yearSelect">
                                            @php
                                                $currentYear = date('Y');
                                                $years = [$currentYear];
                                                for ($i = 1; $i <= 10; $i++) {
                                                    $prevYear = $currentYear - $i;
                                                    $years[] = $prevYear;
                                                }
                                            @endphp

                                            @foreach ($years as $year)
                                                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="monthSelect">Select Month:</label>
                                        <select class="form-control" id="monthSelect">
                                            @php
                                                $months = [
                                                    ['value' => '01', 'name' => 'January'],
                                                    ['value' => '02', 'name' => 'February'],
                                                    ['value' => '03', 'name' => 'March'],
                                                    ['value' => '04', 'name' => 'April'],
                                                    ['value' => '05', 'name' => 'May'],
                                                    ['value' => '06', 'name' => 'June'],
                                                    ['value' => '07', 'name' => 'July'],
                                                    ['value' => '08', 'name' => 'August'],
                                                    ['value' => '09', 'name' => 'September'],
                                                    ['value' => '10', 'name' => 'October'],
                                                    ['value' => '11', 'name' => 'November'],
                                                    ['value' => '12', 'name' => 'December']
                                                ];
                                            @endphp

                                            @foreach ($months as $month)
                                                <option value="{{ $month['value'] }}" {{ $month['value'] == $selectedMonth ? 'selected' : '' }}>
                                                    {{ $month['name'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="monthSelect">&nbsp;</label>
                                        <button type="button" class="btn btn-secondary btn-block" onclick="filterTasks()">Filter</button>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table id="daily" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Accomodation</th>
                                            <th>Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        @foreach($daily as $data)
                                            @php
                                                $taskMonth = date('m', strtotime($data->created_at));
                                                $taskYear = date('Y', strtotime($data->created_at));
                                            @endphp
                                            @if ($taskYear == $selectedYear && $taskMonth == $selectedMonth)
                                            <tr id="tr-{{ $data->id }}">
                                                <td>{{ $data->task }}</td>
                                                <td>{{ $data->no_accom }}</td>
                                                <td>{{ date('M. j, Y', strtotime($data->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ route('dailyEdit', ['id' => $data->accom_id]) }}" class="btn btn-info btn-xs btn-edit">
                                                        <i class="fas fa-exclamation-circle"></i>
                                                    </a>
                                                    <button value="{{ $data->id }}" class="btn btn-danger btn-xs daily-delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endif
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
    function filterTasks() {
        var month = document.getElementById("monthSelect").value;
        var year = document.getElementById("yearSelect").value;
        window.location.href = '?month=' + month + '&year=' + year;
    }
    
</script>

<script>
    var dailyDeleteRoute = "{{ route('dailyDelete', ':id') }}";
</script>
@endsection