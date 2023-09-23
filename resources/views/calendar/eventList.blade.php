@extends('layouts.master')

@section('body')

<style>
    .bg-primary{
        background-color: #3a87ad !important;
    }
    .external-event:hover .fas.fa-pen {
        display: inline;
    }
</style>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Calendar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Calendar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-calendar-days"></i>
                                Events You've Added
                            </h3>
                            <div class="card-tools">
                                <div id="custom-pagination" class="pagination pagination-sm"></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="data-container">
                                @foreach($event as $data)
                                    <ul class="todo-list" data-widget="todo-list" id="tr-{{ $data->id }}">
                                        <li class="mb-1">
                                            <span class="handle">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </span>
                                            <span class="text" style="font-weight: bolder;">{{ $data->title }}</span>
                                            <div class="tools">
                                                <button class="fas fa-edit edit-event" data-toggle="modal" data-target="#EditeventModal{{ $data->id }}" data-event-id="{{ $data->id }}"></button>
                                                <button class="fas fa-trash event-delete" value="{{ $data->id }}"></button>
                                            </div>
                                        </li>
                                    </ul>
                                    @include('calendar.modal')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-gray card-outline">
                        <div class="card-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var EventRoute = "{{ route('eventShow') }}";
    var EventPaginateRoute = "{{ count($event) }}";
    var eventDeleteRoute = "{{ route('eventDelete', ':id') }}";
</script>
<script>
</script>

<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Create Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="eventForm" action="{{ route('eventCreate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="form-group">
                        <label for="eventTitle">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="title">
                    </div>
                    <div class="form-group">
                        <label for="eventStartTime">Start Time</label>
                        <input type="datetime-local" class="form-control" id="eventStartTime" name="start">
                    </div>
                    <div class="form-group">
                        <label for="eventEndTime">End Time</label>
                        <input type="datetime-local" class="form-control" id="eventEndTime" name="end">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


        
@endsection