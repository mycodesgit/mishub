<div class="modal fade" id="modal-user">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-plus"></i> Add User
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
               <form class="form-horizontal" action="{{ route('userCreate') }}" method="post" id="addUser">  
                    @csrf

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-4">
                                <label>First Name:</label>
                                <input type="text" name="fname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter First Name" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Middle Name:</label>
                                <input type="text" name="mname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Middle Name" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label>Last Name:</label>
                                <input type="text" name="lname" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Last Name" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <label>Username:</label>
                                <input type="text" id="username" name="username" placeholder="Enter Username" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label>Password:</label>
                                <input type="password" name="password" placeholder="Enter Password" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-12">
                                <label>Select Office:</label>
                                <select name="off_id" class="form-control select2bs4" style="width: 100%;">
                                    <option value="">-- Select --</option>
                                    @foreach ($office as $data)
                                        <option value="{{ $data->id }}">{{ $data->office_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group"> 
                        <div class="form-row">
                            <div class="col-md-4">
                                <label>Gender:</label>
                                <select name="gender" class="form-control">
                                    <option value=""> --- Select ---</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Role:</label>
                                <select name="role" class="form-control">
                                    <option value=""> --- Select ---</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="MIS Officer">MIS Officer</option>
                                    <option value="Network Ad">Network Ad</option>
                                    <option value="Computer Technician">Computer Technician</option>
                                    <option value="Document Controller">Document Controller</option>
                                    <option value="Staff">Staff</option>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Campus:</label>
                                <select name="campus_id" class="form-control">
                                    <option value=""> --- Select ---</option>
                                    @foreach ($campus as $data)
                                        <option value="{{ $data->id }}">{{ $data->campus_name }}</option>
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
                                <button type="submit" class="btn btn-primary">
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