<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Mapping Inactive</h3>
            </div>
            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / Un Mapped Distributors
                </div>
            </div> -->
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="db-table" class="display nowrap table table-bordered table-hover text-center" style="width:100%">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#db-table').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "autoWidth": true,
            "pageLength": 20,
            "lengthMenu": [20, 30, 60, 100],
            "scrollY": "550px",
            "scrollCollapse": true,
            "fixedHeader": true,
            "processing": true,
            "serverSide": true,
            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',

            "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-download"></i> Download',
                    titleAttr: 'Download as Excel',
                    filename: 'Maping_Inactive',
                }

            ],
            order: [{
                column: 0, // Sort by the first column
                dir: "asc", // Ascending order
            }],

            "ajax": {
                url: "<?= site_url('admin/fetchInactiveMappings') ?>", // New function for AJAX
                type: "POST",
            },

            language: {
                processing: '<img class="spin-image" src="<?php echo base_url('admin/assets/Bloom_2.gif'); ?>" alt="Loading...">', // Custom loading message
            },

            "columns": [{
                    "data": "Customer_Name",
                    "title": "Customer Name"
                },
                {
                    "data": "DB_Code",
                    "title": "Customer Code"
                },
                {
                    "data": "Pin_Code",
                    "title": "Pin Code"
                },
                {
                    "data": "City",
                    "title": "City"
                },
                {
                    "data": "District",
                    "title": "District"
                },
                {
                    "data": "Contact_Number",
                    "title": "Contact Number"
                },
                {
                    "data": "Country",
                    "title": "Country"
                },
                {
                    "data": "Zone",
                    "title": "Zone"
                },
                {
                    "data": "State",
                    "title": "State"
                },
                {
                    "data": "Division_Name",
                    "title": "Division Name"
                },
                {
                    "data": "Division_Code",
                    "title": "Division Code"
                },
                {
                    "data": "Distribution_Channel_Name",
                    "title": "Distribution Channel Name"
                },
                {
                    "data": "Distribution_Channel_Code",
                    "title": "Distribution Channel Code"
                },
                {
                    "data": "Sales_Name",
                    "title": "Sales Name"
                },
                {
                    "data": "Sales_Code",
                    "title": "Sales Code"
                },
                {
                    "data": "Customer_Group_Code",
                    "title": "Customer Group Code"
                },

                {
                    "data": "Customer_Group_Name",
                    "title": "Customer Group Name"
                },

                {
                    "data": "Sector_Name",
                    "title": "Sector Name"
                },
                {
                    "data": "State_Code",
                    "title": "State Code"
                },
                {
                    "data": "Customer_Type_Name",
                    "title": "Customer Type Name"
                },
                {
                    "data": "Customer_Type_Code",
                    "title": "Customer Type Code"
                },
                {
                    "data": "Sector_Code",
                    "title": "Sector Code"
                },
                {
                    "data": "Zone_Code",
                    "title": "Zone Code"
                },
                {
                    "data": "Population_Strata_1",
                    "title": "Population Strata 1"
                },
                {
                    "data": "Population_Strata_2",
                    "title": "Population Strata 2"
                },
                {
                    "data": "Country_Group",
                    "title": "Country Group"
                },
                {
                    "data": "GTM_TYPE",
                    "title": "GTM Type"
                },
                {
                    "data": "SUPERSTOCKIST",
                    "title": "Superstockist"
                },
                {
                    "data": "STATUS",
                    "title": "Status"
                },

                {
                    data: "Level_1",
                    title: "Level 1"
                },
                {
                    data: "Level_1_employee_name",
                    title: "Level 1 Name"
                },
                {
                    data: "Level_1_employee_code",
                    title: "Level 1 Employer Code"
                },
                {
                    data: "Level_1_employee_designation",
                    title: "Level 1 Designation Name"
                },
                {
                    data: "Level_2",
                    title: "Level 2"
                },
                {
                    data: "Level_2_employee_name",
                    title: "Level 2 Name"
                },
                {
                    data: "Level_2_employee_code",
                    title: "Level 2 Employer Code"
                },
                {
                    data: "Level_2_employee_designation",
                    title: "Level 2 Designation Name"
                },
                {
                    data: "Level_3",
                    title: "Level 3"
                },
                {
                    data: "Level_3_employee_name",
                    title: "Level 3 Name"
                },
                {
                    data: "Level_3_employee_code",
                    title: "Level 3 Employer Code"
                },
                {
                    data: "Level_3_employee_designation",
                    title: "Level 3 Designation Name"
                },
                {
                    data: "Level_4",
                    title: "Level 4"
                },
                {
                    data: "Level_4_employee_name",
                    title: "Level 4 Name"
                },
                {
                    data: "Level_4_employee_code",
                    title: "Level 4 Employer Code"
                },
                {
                    data: "Level_4_employee_designation",
                    title: "Level 4 Designation Name"
                },
                {
                    data: "Level_5",
                    title: "Level 5"
                },
                {
                    data: "Level_5_employee_name",
                    title: "Level 5 Name"
                },
                {
                    data: "Level_5_employee_code",
                    title: "Level 5 Employer Code"
                },
                {
                    data: "Level_5_employee_designation",
                    title: "Level 5 Designation Name"
                },
                {
                    data: "Level_6",
                    title: "Level 6"
                },
                {
                    data: "Level_6_employee_name",
                    title: "Level 6 Name"
                },
                {
                    data: "Level_6_employee_code",
                    title: "Level 6 Employer Code"
                },
                {
                    data: "Level_6_employee_designation",
                    title: "Level 6 Designation Name"
                },
                {
                    data: "Level_7",
                    title: "Level 7"
                },
                {
                    data: "Level_7_employee_name",
                    title: "Level 7 Name"
                },
                {
                    data: "Level_7_employee_code",
                    title: "Level 7 Employer Code"
                },
                {
                    data: "Level_7_employee_designation",
                    title: "Level 7 Designation Name"
                },

            ]
        });
    });
</script>