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
                            

                        <a href="<?php echo base_url('admin/userlogreport'); ?>" class="btn active"> user log report</a>
                        <a  href="<?php echo base_url('admin/mapping_log_report'); ?>" class="btn active text-white " style="background:#FB8B03"> mapping log report</a>
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
                                            <th>Id</th>
                                            <th>Batch Id</th>
                                            <th> Parent Batch Id</th>
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

                                            <th>New_date</th>
                                         
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
            serverSide: false,
            ajax: {
                url: '<?php echo base_url("admin/mapping-log-report-get-logs-ajax"); ?>',
                type: 'POST',
                data: function(d) {
                    d.action_type = $('#action_type').val();
                    d.DB_Code = $('#DB_Code').val();
                    d.date_from = $('#date_from').val();
                    d.date_to = $('#date_to').val();
                },
                dataSrc: function(response) {
            
                    return response.data;
                },
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
                    render: function(data, type, row) {
                        return data; // Action badge will be rendered from server
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
                    "data": "id",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 7,
                    "data": "Customer_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 8,
                    "data": "Customer_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 9,
                    "data": "Pin_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 10,
                    "data": "City",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 11,
                    "data": "District",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 12,
                    "data": "Contact_Number",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 13,
                    "data": "Country",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 14,
                    "data": "Zone",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 15,
                    "data": "State",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 16,
                    "data": "Population_Strata_1",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 17,
                    "data": "Population_Strata_2",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 18,
                    "data": "Country_Group",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 19,
                    "data": "GTM_TYPE",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 20,
                    "data": "SUPERSTOCKIST",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 21,
                    "data": "STATUS",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 22,
                    "data": "Sales_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 23,
                    "data": "Sales_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 24,
                    "data": "Distribution_Channel_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 25,
                    "data": "Distribution_Channel_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 26,
                    "data": "Division_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 27,
                    "data": "Division_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 28,
                    "data": "Customer_Type_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 29,
                    "data": "Customer_Type_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 30,
                    "data": "Customer_Group_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 31,
                    "data": "Customer_Group_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 32,
                    "data": "Customer_Creation_Date",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 33,
                    "data": "Sector_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 34,
                    "data": "Sector_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 35,
                    "data": "State_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 36,
                    "data": "Zone_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 37,
                    "data": "Level_1_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 38,
                    "data": "Level_1_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 39,
                    "data": "Level_1_Designation",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 40,
                    "data": "Level_2_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 41,
                    "data": "Level_2_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 42,
                    "data": "Level_2_Designation",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 43,
                    "data": "Level_3_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 44,
                    "data": "Level_3_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 45,
                    "data": "Level_3_Designation",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 46,
                    "data": "Level_4_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 47,
                    "data": "Level_4_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 48,
                    "data": "Level_4_Designation",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 49,
                    "data": "Level_5_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 50,
                    "data": "Level_5_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 51,
                    "data": "Level_5_Designation",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 52,
                    "data": "Level_6_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 53,
                    "data": "Level_6_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 54,
                    "data": "Level_6_Designation",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 55,
                    "data": "Level_7_Name",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 56,
                    "data": "Level_7_Code",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 57,
                    "data": "Level_7_Designation",
                    "searchable": true,
                    "orderable": true
                },
                {
                    "targets": 58,
                    "data": "new_date",
                    "searchable": true,
                    "orderable": true
                },
               


            ],
            scrollX: true,
            scrollY: "550px",
            scrollCollapse: true,
            pageLength: 15,
            lengthMenu: [15, 30, 60, 100]
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