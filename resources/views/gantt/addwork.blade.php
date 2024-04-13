<div class="modal fade" id="modal-work">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fas fa-plus"></i> Add New
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <form action="" class="form-horizontal" method="post" id="workAdd">
                    @csrf
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label class="badge badge-secondary">Task</label>
                                <input type="text" name="task" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control" placeholder="Enter Task">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label class="badge badge-secondary">Date Start:</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" placeholder="Enter Date Start" onchange="updateEndDateMin()">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label class="badge badge-secondary">Date End:</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" placeholder="Enter Date End" onchange="updateEndDateMin()">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label class="badge badge-secondary">Duration:</label>
                                <input type="text" id="duration" name="duration" class="form-control" readonly>
                            </div>
                        </div>
                    </div>  

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label class="badge badge-secondary">Select Teammates:</label>
                                <select name="user_id[]" class="form-control select2" style="width: 100%;" multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ (Auth::id() == $user->id) ? 'selected' : '' }}>
                                            {{ $user->fname }} {{ $user->lname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit" name="btn-submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Save
                                </button>
                            </div>
                        </div>
                    </div>   
                </form>
            </div>
            
            <div class="modal-footer justify-content-between">
                <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
        </div>
    </div>
</div>