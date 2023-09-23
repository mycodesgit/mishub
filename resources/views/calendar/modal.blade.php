<div class="modal fade" id="EditeventModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Edit Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="editEvent">
                <form id="eventForm" action="{{ route('eventUpdate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}"> 
                    <div class="form-group">
                        <label for="eventTitle">Event Title</label>
                        <input type="text" class="form-control" id="eventTitle" name="title"  value="{{ $data->title }}">
                    </div>
                    <div class="form-group">
                        <label for="eventStartTime">Start Time</label>
                        <input type="datetime-local" class="form-control" id="eventStartTime" name="start" value="{{ $data->start }}">
                    </div>
                    <div class="form-group">
                        <label for="eventEndTime">End Time</label>
                        <input type="datetime-local" class="form-control" id="eventEndTime" name="end" value="{{ $data->end }}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>