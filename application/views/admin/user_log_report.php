<link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">


<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">User Log Report</h3>
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
                            <div class="row mb-3">
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
                            </div>

                            <div class="table-responsive">
                                <table id="user_logs_table" class="display nowrap table table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Log ID</th>
                                            <th>Action Type</th>
                                            <th>Action Time</th>
                                            <th>Action By</th>
                                            <th>Employee Details</th>
                                            <th>Contact Info</th>
                                            <th>Employment Info</th>
                                            <th>Location Info</th>
                                            <th>Previous Employee Details</th>
                                            <th>Previous Contact Info</th>
                                            <th>Previous Employment Info</th>
                                            <th>Previous Location Info</th>
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
        serverSide: true,
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
        columns: [
            { data: 'log_id' },
            { data: 'action_type' },
            { data: 'action_time' },
            { data: 'action_by' },
            { 
                data: null,
                render: function(data, type, row) {
                    return 'ID: ' + row.id + '<br>' +
                           'Name: ' + row.name + '<br>' +
                           'Status: ' + row.vacant_status + '<br>' +
                           'Employee ID: ' + row.employee_id;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return 'Email: ' + row.email + '<br>' +
                           'Mobile: ' + row.mobile + '<br>' +
                           'DOB: ' + row.dob;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return 'Designation: ' + row.designation_name + '<br>' +
                           'Level: ' + row.level + '<br>' +
                           'DOJ: ' + row.doj + '<br>' +
                           'Status: ' + row.employee_status;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return 'Town: ' + row.town + '<br>' +
                           'District: ' + row.district + '<br>' +
                           'State: ' + row.state + '<br>' +
                           'Region: ' + row.region;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return 'ID: ' + row.old_id + '<br>' +
                           'Name: ' + row.old_name + '<br>' +
                           'Status: ' + row.old_vacant_status + '<br>' +
                           'Employee ID: ' + row.old_employee_id;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return 'Email: ' + row.old_email + '<br>' +
                           'Mobile: ' + row.old_mobile + '<br>' +
                           'DOB: ' + row.old_dob;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return 'Designation: ' + row.old_designation_name + '<br>' +
                           'Level: ' + row.old_level + '<br>' +
                           'DOJ: ' + row.old_doj + '<br>' +
                           'Status: ' + row.old_employee_status;
                }
            },
            {
                data: null,
                render: function(data, type, row) {
                    return 'Town: ' + row.old_town + '<br>' +
                           'District: ' + row.old_district + '<br>' +
                           'State: ' + row.old_state + '<br>' +
                           'Region: ' + row.old_region;
                }
            }
        ],
        scrollX: true,
        scrollY: "550px",
        scrollCollapse: true,
        pageLength: 15,
        lengthMenu: [15, 30, 60, 100],
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
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