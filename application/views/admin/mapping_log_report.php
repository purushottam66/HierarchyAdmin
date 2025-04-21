<link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">


<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Mapping Log Report</h3>
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
                                    <input type="text" id="DB_Code" class="form-control" placeholder="DB Code">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="date_from" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" id="date_to" class="form-control">
                                </div>
                            </div> -->

                            <div class="table-responsive">
                                <table id="mapping_logs_table" class="display nowrap table table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Action Type</th>
                                            <th>Action Time</th>
                                            <th>Action By</th>
                                            <th>DB Code</th>
                                            <th>Sales Code</th>
                                            <th>Distribution Channel</th>
                                            <th>Division Code</th>
                                            <th>Customer Type</th>
                                            <th>Customer Group</th>
                                            <th>Level 1</th>
                                            <th>Level 2</th>
                                            <th>Level 3</th>
                                            <th>Level 4</th>
                                            <th>Level 5</th>
                                            <th>Level 6</th>
                                            <th>Level 7</th>
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
    var table = $('#mapping_logs_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?php echo base_url("admin/Mapping_log_report/get_logs_ajax"); ?>',
            type: 'GET',
            data: function(d) {
                d.action_type = $('#action_type').val();
                d.DB_Code = $('#DB_Code').val();
                d.date_from = $('#date_from').val();
                d.date_to = $('#date_to').val();
            }
        },
        columns: [
            { data: 0 }, // action_type
            { data: 1 }, // action_time
            { data: 2 }, // action_by
            { data: 3 }, // DB_Code
            { data: 4 }, // Sales_Code
            { data: 5 }, // Distribution_Channel_Code
            { data: 6 }, // Division_Code
            { data: 7 }, // Customer_Type_Code
            { data: 8 }, // Customer_Group_Code
            { data: 9 }, // Level_1
            { data: 10 }, // Level_2
            { data: 11 }, // Level_3
            { data: 12 }, // Level_4
            { data: 13 }, // Level_5
            { data: 14 }, // Level_6
            { data: 15 }  // Level_7
        ],
        scrollX: true,
        scrollY: "550px",
        scrollCollapse: true,
        pageLength: 15,
        lengthMenu: [15, 30, 60, 100],
        dom: 'Bfrtip',
        buttons: [ 'csv', 'excel']
    });

    // Filter handling
    $('#action_type, #DB_Code, #date_from, #date_to').on('change', function() {
        table.ajax.reload();
    });

    // Add delay to DB_Code search
    var searchTimeout;
    $('#DB_Code').on('keyup', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            table.ajax.reload();
        }, 500);
    });
});
</script>