<link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">


<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Mapping Log Report</h3>
                <!-- <a href="<?php echo base_url('admin/mapping_log_report_json'); ?>" class="btn "> api test</a> -->



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
                                            <th>ID</th>
                                            <th>User ID</th>
                                            <th>Parent ID</th>
                                            <th>Action</th>
                                            <th>Created At</th>
                                            <th>Created By</th>
                                            <th>id</th>
                                            <th>Customer_Name</th>
                                            <th>Customer_Code</th>
                                            <th>Pin_Code</th>
                                            <th>City</th>
                                            <th>District</th>
                                            <th>Contact_Number</th>
                                            <th>Country</th>
                                            <th>Zone</th>
                                            <th>State</th>
                                            <th>Population_Strata_1</th>
                                            <th>Population_Strata_2</th>
                                            <th>Country_Group</th>
                                            <th>GTM_TYPE</th>
                                            <th>SUPERSTOCKIST</th>
                                            <th>STATUS</th>
                                            <th>Sales_Code</th>
                                            <th>Sales_Name</th>
                                            <th>Distribution_Channel_Code</th>
                                            <th>Distribution_Channel_Name</th>
                                            <th>Division_Code</th>
                                            <th>Division_Name</th>
                                            <th>Customer_Type_Code</th>
                                            <th>Customer_Type_Name</th>
                                            <th>Customer_Group_Code</th>
                                            <th>Customer_Group_Name</th>
                                            <th>Customer_Creation_Date</th>
                                            <th>Sector_Name</th>
                                            <th>Sector_Code</th>
                                            <th>State_Code</th>
                                            <th>Zone_Code</th>
                                            <th>Level_1_Name</th>
                                            <th>Level_1_Employer_Code</th>
                                            <th>Level_1_Designation_Name</th>
                                            <th>Level_2_Name</th>
                                            <th>Level_2_Employer_Code</th>
                                            <th>Level_2_Designation_Name</th>
                                            <th>Level_3_Name</th>
                                            <th>Level_3_Employer_Code</th>
                                            <th>Level_3_Designation_Name</th>
                                            <th>Level_4_Name</th>
                                            <th>Level_4_Employer_Code</th>
                                            <th>Level_4_Designation_Name</th>
                                            <th>Level_5_Name</th>
                                            <th>Level_5_Employer_Code</th>
                                            <th>Level_5_Designation_Name</th>
                                            <th>Level_6_Name</th>
                                            <th>Level_6_Employer_Code</th>
                                            <th>Level_6_Designation_Name</th>
                                            <th>Level_7_Name</th>
                                            <th>Level_7_Employer_Code</th>
                                            <th>Level_7_Designation_Name</th>
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
                url: '<?php echo base_url("admin/Mapping_log_report_get_logs_ajax"); ?>',
                type: 'POST',
                data: function(d) {
                    d.action_type = $('#action_type').val();
                    d.DB_Code = $('#DB_Code').val();
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
            },],
      
            scrollX: true,
            scrollY: "550px",
            scrollCollapse: true,
            pageLength: 15,
            lengthMenu: [15, 30, 60, 100],

        });



        

        // फ़िल्टर हैंडलिंग
        $('#action_type, #DB_Code, #date_from, #date_to').on('change', function() {
            table.ajax.reload();
        });

        // DB_Code सर्च में डिले जोड़ें
        var searchTimeout;
        $('#DB_Code').on('keyup', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                table.ajax.reload();
            }, 500);
        });
    });
</script>