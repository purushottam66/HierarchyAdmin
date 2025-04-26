<link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">


<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">User Log Report</h3>

                <!-- <a href="<?php echo base_url('admin/userlogreport_json'); ?>" class="btn "> api test</a> -->

            </div>
        </div>
    </header>

    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <!-- Filter Section -->
                            <!-- <div class="row mb-3">
                                <div class="col-md-3">
                                    <select id="action_type" class="form-control">
                                        <option value="">All Actions</option>
                                        <option value="INSERT">Insert</option>
                                        <option value="UPDATE">Update</option>
                                        <option value="DELETE">Delete</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" id="employee_search" class="form-control" placeholder="Search Employee">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="date_from" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="date_to" class="form-control">
                                </div>
                            </div> -->

                            <div class="table-responsive">
                                <table id="user_logs_table" class="display nowrap table table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>User ID</th>
                                            <th>Parent ID</th>
                                            <th>Action</th>
                                          
                                            <th>Created At</th>
                                            <th>Created By</th>
                                            <th>Name</th>
                                            <th>Vacant Status</th>
                                            <th>Email</th>
                                            <th>Mobile No</th>
                                            <th>Date of Birth</th>
                                            <th>Employer Code</th>
                                            <th>Employer Name</th>
                                            <th>Aadhar Card</th>
                                            <th>Gender</th>
                                       
                                            <th>Employee ID</th>
                                            <th>Application ID</th>
                                            <th>Level</th>
                                         
                                            <th>Designation Label</th>
                                            <th>Designation Label Name</th>
                                            <th>Date of Joining</th>
                                            <th>Employee Status</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Zone</th>
                                            <th>Address</th>
                                            <!-- <th>Created At</th>
                                            <th>Updated At</th> -->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('admin/assets/js/jquery-3.7.1.js'); ?>"></script>
<script>
    $(document).ready(function() {
        var table = $('#user_logs_table').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '<?php echo base_url("admin/User_log_report/get_logs_ajax"); ?>',
                type: 'GET',
                data: function(d) {
                    d.action_type = $('#action_type').val();
                    d.employee_search = $('#employee_search').val();
                    d.date_from = $('#date_from').val();
                    d.date_to = $('#date_to').val();
                }
            },
            "columnDefs": [{
                "targets": 0,
                "data": "id",
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 1,
                "data": "user_id",
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 2,
                "data": "parent_id",
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 3,
                "data": "action",
                "searchable": true,
                "orderable": true,
                "render": function(data, type, row) {
                    // Check the action value and return the corresponding color
                    if (data === "old_data") {
                        return '<span style="color: red;">' + data + '</span>';
                    } else if (data === "updated") {
                        return '<span style="color: orange;">' + data + '</span>';
                    } else if (data === "delete") {
                        return '<span style="color: green;">' + data + '</span>';
                    } else {
                        return data; // Default case if action is not matched
                    }
                }
            },
      
            {
                "targets": 4,
                "data": "created_at",
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 5,
                "data": "created_by",
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 6,
                "data": "employee_name", // Accessing name again for display
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 7,
                "data": "vacant_status", // Accessing vacant_status inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 8,
                "data": "email", // Accessing email inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 9,
                "data": "mobile", // Accessing mobile_no inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 10,
                "data": "dob", // Accessing dob inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 11,
                "data": "employer_code", // Accessing employer_code inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 12,
                "data": "employer_name", // Accessing employer_name inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 13,
                "data": "adhar_card", // Accessing adhar_card inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 14,
                "data": "gender", // Accessing gender inside nested `data`
                "searchable": true,
                "orderable": true
            },
   
            {
                "targets": 15,
                "data": "employee_id", // Accessing employee_id inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 16,
                "data": "application_id", // Accessing application_id inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 17,
                "data": "level", // Accessing level inside nested `data`
                "searchable": true,
                "orderable": true
            },
        
            {
                "targets": 18,
                "data": "designation_label", // Accessing designation_label inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 19,
                "data": "designation_label_name", // Accessing designation_label_name inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 20,
                "data": "doj", // Accessing doj inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 21,
                "data": "employee_status", // Accessing employee_status inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 22,
                "data": "city", // Accessing city inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 23,
                "data": "state", // Accessing state inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 24,
                "data": "Zone", // Accessing region inside nested `data`
                "searchable": true,
                "orderable": true
            },
            {
                "targets": 25,
                "data": "address", // Accessing address inside nested `data`
                "searchable": true,
                "orderable": true
            },
            // {
            //     "targets": 30,
            //     "data": "created_at", // created_at column
            //     "searchable": true,
            //     "orderable": true
            // },
            // {
            //     "targets": 31,
            //     "data": "updated_at", // updated_at column
            //     "searchable": true,
            //     "orderable": true
            // },

        ],
            scrollX: true,
            scrollY: "550px",
            scrollCollapse: true,
            pageLength: 15,
            lengthMenu: [15, 30, 60, 100],

        });

        // Filter handling
        $('#action_type, #employee_search, #date_from, #date_to').on('change', function() {
            table.ajax.reload();
        });

        // Add delay to employee search
        var searchTimeout;
        $('#employee_search').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                table.ajax.reload();
            }, 500);
        });
    });
</script>