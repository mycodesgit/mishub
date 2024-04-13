@extends('layouts.master')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Work Progress</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Work Progress</li>
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
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-work">
                                    <i class="fas fa-user-plus"></i> Add New
                                </button>
                            </h3>
                        </div>

                        @include('gantt/addwork')

                        <div class="card-body">
                            <div class="">
                                <table id="workTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Project Name</th>
                                            <th>Duration</th>
                                            <th>Team Members</th>
                                            <th>Progress</th>
                                            <th>Status</th>
                                            <th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                        {{-- @foreach($work as $data)
                                        <tr id="tr-{{ $data->id }}" class="">
                                            <td>
                                                <strong>{{ $data->task }}</strong>
                                                <br>
                                                <small>
                                                    {{ Carbon\Carbon::parse($data->start_date)->format('F d, Y')  }} - {{ Carbon\Carbon::parse($data->end_date)->format('F d, Y')  }}
                                                </small>
                                            </td>
                                            <td>
                                                @php
                                                    $userIdsString = $data->user_id;
                                                    $userIds = explode(',', $userIdsString);
                                                @endphp

                                                @foreach($userIds as $userId)
                                                    @php
                                                        $user = \App\Models\User::find($userId);
                                                    @endphp
                                                    @if($user)
                                                        <span class="badge badge-circle badge-primary">{{ $user->fname }}</span>
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="project_progress">
                                                <div class="progress progress-md" style="border-radius: 10px;">
                                                    <div class="progress-bar bg-green" role="progressbar" aria-valuenow="{{ $data->percent_completed }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $data->percent_completed }}%"></div>
                                                </div>
                                                <small>
                                                    {{ $data->percent_completed }}% Complete
                                                </small>
                                            </td>
                                            <td>
                                                <span class="badge 
                                                    @if($data->status == 'Stuck') badge-danger 
                                                    @elseif($data->status == 'Working on it') badge-warning 
                                                    @elseif($data->status == 'Complete') badge-success 
                                                    @endif">
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-info btn-xs btn-edit">
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


<div class="modal fade" id="editWorkpModal" role="dialog" aria-labelledby="editWorkpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWorkpModalLabel">Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editWorkpForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editWorkpId">
                    <div class="form-group">
                        <label for="editTask">Task</label>
                        <input type="text" name="task" id="editTask" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="editstartdate">Date Start</label>
                        <input type="date" name="start_date" id="editstartdate" class="form-control" onchange="editshowEndDateMin()">
                    </div>
                    <div class="form-group">
                        <label for="editenddate">Date End</label>
                        <input type="date" name="end_date" id="editenddate" class="form-control" onchange="editshowEndDateMin()">
                    </div>
                    <div class="form-group">
                        <label for="editDuration">Duration</label>
                        <input type="text" name="duration" id="editDuration" class="form-control">
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
    var workReadRoute = "{{ route('getworkprogRead') }}";
    var workCreateRoute = "{{ route('workprogCreate') }}";
    var userRoleID = '{{ Auth::user()->id }}';
</script>

<script>
    function updateEndDateMin() {
        var startDate = document.getElementById("start_date").value;
        document.getElementById("end_date").min = startDate;
    
        calculateDuration();
    }
  
    function calculateDuration() {
        var startDate = document.getElementById("start_date").value;
        var endDate = document.getElementById("end_date").value;

        if (startDate && endDate) {
            var start = new Date(startDate);
            var end = new Date(endDate);
            var duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); 
            if (duration === 0) {
                duration = 1;
            } else {
                duration += 1;
            }

         document.getElementById("duration").value = duration + " days";
        }
    }
</script>

<script>
    function editshowEndDateMin() {
        var editstartDate = document.getElementById("editstartdate").value;
        document.getElementById("editenddate").min = editstartDate;
    
        editcalculateDuration();
    }
  
    function editcalculateDuration() {
        var editstartDate = document.getElementById("editstartdate").value;
        var editendDate = document.getElementById("editenddate").value;

        if (editstartDate && editendDate) {
            var start = new Date(editstartDate);
            var end = new Date(editendDate);
            var duration = Math.ceil((end - start) / (1000 * 60 * 60 * 24)); 
            if (duration === 0) {
                duration = 1;
            } else {
                duration += 1;
            }

         document.getElementById("editDuration").value = duration + " days";
        }
    }
</script>

@endsection