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
                    <div class="card">
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
                                            <label class="badge badge-secondary">Task:</label>
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
                                            <label class="badge badge-secondary">No. of Accommodation:</label>
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
                                                <label class="badge badge-secondary">Date:</label>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list"></i> List
                            </h3>
                        </div>

                        <div class="card-body">
                            <form id="filterForm">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="yearSelect" class="badge badge-secondary">Select Year:</label>
                                            <select class="form-control form-control-sm" id="yearSelect">
                                                @php
                                                    $currentYear = date('Y');
                                                    $years = [$currentYear];
                                                    for ($i = 1; $i <= 10; $i++) {
                                                        $prevYear = $currentYear - $i;
                                                        $years[] = $prevYear;
                                                    }
                                                @endphp
                                                @foreach ($years as $year)
                                                    <option value="{{ $year }}">{{ $year }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="monthSelect" class="badge badge-secondary">Select Month:</label>
                                            <select class="form-control form-control-sm" id="monthSelect">
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
                                                    <option value="{{ $month['value'] }}">{{ $month['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label>&nbsp;</label>
                                        <button type="submit" class="form-control form-control-sm btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <div class="">
                                <table id="dailyTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Task</th>
                                            <th>Accomodation</th>
                                            <th>Date</th>
                                            <th width="10%">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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

<div class="modal fade" id="editDailyModal" role="dialog" aria-labelledby="editDailyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFundModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editDailyForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editDailyId">
                    <div class="form-group">
                        <label for="editTask">Task</label>
                        <select name="task" id="editTask" class="form-control" style="width: 100%;">
                            <option disabled selected>Select</option>
                            @foreach ($option as $data)
                                <option value="{{ $data->option_name }}">{{ $data->option_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editAccom">No. of Accomodation</label>
                        <textarea class="form-control" rows="4" id="editAccom" name="no_accom"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editCreated">Change Date</label>
                        <textarea class="form-control" rows="4" id="editCreated" name="no_accom"></textarea>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var dailyReadRoute = "{{ route('getdailyRead') }}";
    var dailyCreateRoute = "{{ route('dailyCreate') }}";
    var dailyUpdateRoute = "{{ route('dailyUpdate', ['id' => ':id']) }}";
    var dailyDeleteRoute = "{{ route('dailyDelete', ':id') }}";
</script>
@endsection