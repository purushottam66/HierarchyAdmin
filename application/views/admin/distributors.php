<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Un Mapped Distributors</h3>
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
                                <table id="db-table" class="display nowrap table table-bordered table-hover text-center" style="width:100%"></table>
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
            "fixedFooter": true,
            "processing": true,
            "serverSide": true,

            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',

            "buttons": [

       
                {
                    text: '<i class="fa fa-database"></i> Export  Data',
                    titleAttr: 'Export Filtered Data',
                    action: function() {
                        var zoneSelect = $('#zoneSelect').val() || [];
                        var State_Code = $('#State_Code').val() || [];
                        var City = $('#City').val() || [];

                        var params = new URLSearchParams();
                        if (zoneSelect.length > 0) {
                            params.append('zoneSelect', JSON.stringify(zoneSelect));
                        }
                        if (State_Code.length > 0) {
                            params.append('State_Code', JSON.stringify(State_Code));
                        }
                        if (City.length > 0) {
                            params.append('City', JSON.stringify(City));
                        }


                        var url = '<?php echo base_url("admin/unmapped_distributors_csv"); ?>?' + params.toString();
                        window.location.href = url;
                    }
                }

            ],
            order: [{
                column: 0, // Sort by the first column
                dir: "asc", // Ascending order
            }], // Default sorting
            ajax: {
                url: "<?= site_url('admin/distributors_db_unmppd') ?>", // Ensure the URL is correct
                type: "POST",
                data: function(d) {
                    d.search = $('#dt-search-0').val(); // Add custom search parameters if needed
                    console.log("Sent Data: ", d); // Log data being sent to server
                },
                dataSrc: function(json) {
                    console.log("Received Response: ", json); // Debugging - log response
                    return json.data; // Ensure API response has a 'data' property
                },
                error: function(xhr, error, code) {
                    console.error("Ajax Error: ", {
                        xhr,
                        error,
                        code
                    }); // Log error
                    alert(`Error loading data: ${xhr.responseText || error}`);
                },
            },

            language: {
                processing: '<img class="spin-image" src="<?php echo base_url("admin/assets/Bloom_2.gif"); ?>" alt="Loading...">', // Custom loader
            },
            columnDefs: [{
                    targets: '_all',
                    orderable: true
                },
                {
                    className: 'text-center',
                    targets: '_all'
                },
            ],

            columns: [{
                    columns: "Customer_Name",
                    title: "Customer Name"
                },
                {
                    columns: "Customer_Code",
                    title: "Customer Code"
                },
                {
                    columns: "Pin_Code",
                    title: "Pin Code"
                },
                {
                    columns: "City",
                    title: "City"
                },
                {
                    columns: "District",
                    title: "District"
                },
                {
                    columns: "Contact_Number",
                    title: "Contact Number"
                },
                {
                    columns: "Country",
                    title: "Country"
                },
                {
                    columns: "Zone",
                    title: "Zone"
                },
                {
                    columns: "State",
                    title: "State"
                },
                {
                    columns: "Population_Strata_1",
                    title: "Population Strata 1"
                },
                {
                    columns: "Population_Strata_2",
                    title: "Population Strata 2"
                },
                {
                    columns: "Country_Group",
                    title: "Country Group"
                },
                {
                    columns: "GTM_TYPE",
                    title: "GTM Type"
                },
                {
                    columns: "SUPERSTOCKIST",
                    title: "Superstockist"
                },
                {
                    columns: "STATUS",
                    title: "Status"
                },

                {
                    columns: "Sales_Name",
                    title: "Sales Name"
                },
                {
                    columns: "Sales_Code",
                    title: "Sales Code"
                },
                {
                    columns: "Customer_Type_Name",
                    title: "Customer Type Name"
                },
                {
                    columns: "Customer_Type_Code",
                    title: "Customer Type Code"
                },
                {
                    columns: "Customer_Group_Name",
                    title: "Customer Group Name"
                },
                {
                    columns: "Customer_Group_Code",
                    title: "Customer Group Code"
                },

                {
                    columns: "Division_Name",
                    title: "Division Name"
                },
                {
                    columns: "Division_Code",
                    title: "Division Code"
                },
                {
                    columns: "Sector_Name",
                    title: "Sector Name"
                },
                {
                    columns: "Sector_Code",
                    title: "Sector Code"
                },
                {
                    columns: "State_Code",
                    title: "State Code"
                },
                {
                    columns: "Zone_Code",
                    title: "Zone Code"
                },
                {
                    columns: "Distribution_Channel_Name",
                    title: "Distribution Channel Name"
                },
                {
                    columns: "Distribution_Channel_Code",
                    title: "Distribution Channel Code"
                },

                {
                    columns: "Customer_Creation_Date",
                    title: "Customer Creation Date"
                },
            ]
        });
    });
</script>