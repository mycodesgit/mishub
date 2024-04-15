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
                        <label for="editTask" class="badge badge-secondary">Project/Work</label>
                        <input type="text" name="task" id="editTask" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="editstartdate" class="badge badge-secondary">Date Start</label>
                                <input type="date" name="start_date" id="editstartdate" class="form-control form-control-sm" onchange="editshowEndDateMin()">
                            </div>
                            <div class="col-md-6">
                                <label for="editenddate" class="badge badge-secondary">Date End</label>
                                <input type="date" name="end_date" id="editenddate" class="form-control form-control-sm" onchange="editshowEndDateMin()">
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label for="editDuration" class="badge badge-secondary">Duration</label>
                                <input type="text" name="duration" id="editDuration" class="form-control form-control-sm" readonly>
                            </div>
                            <div class="col-md-6">
                                <label for="editStatus" class="badge badge-secondary">Status:</label>
                                <input type="text" id="editStatus" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label for="editName" class="badge badge-secondary">Teams</label>
                                <input type="text" id="editName" class="form-control form-control-sm" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="editModule" class="badge badge-secondary">Module/Task:</label>
                        <textarea class="form-control form-control-sm" id="editModule" rows="4" name="descrip"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editPercent" class="badge badge-secondary">Percentage:</label>
                        <input type="number" name="percent_completed" id="editPercent" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="updateStatus" class="badge badge-secondary">Status:</label>
                        <select class="form-control form-control-sm" name="status" id="updateStatus">
                            <option disabled selected>Select</option>
                            <option value="Stuck">Stuck</option>
                            <option value="Working on it">Working on it</option>
                            <option value="Complete">Complete</option>
                        </select>
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
    var workUpdateRoute = "{{ route('workprogUpdate', ['id' => ':id']) }}";
    var workDeleteRoute = "{{ route('workprogDelete', ['id' => ':id']) }}";
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