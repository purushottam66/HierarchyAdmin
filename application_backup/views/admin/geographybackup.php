<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.css" class="rel">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css" class="rel">


<style>
    .setfont {
        font-size: 8px;
        padding: 0px 16px;
    }

    #loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        text-align: center;
    }

    .spinner {
        border: 8px solid #932d86;
        border-left: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .dataTables_wrapper .top {
        text-align: right;
    }

    .dataTables_length {
        display: block;
    }

    .dt-paging {
        float: right;
    }



    .dt-buttons {
        float: right;
    }

    .dt-length label {
        display: none;
    }


    tr td {
        text-align: center !important;
    }
</style>







<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">HierarchyData</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / HierarchyData
                </div>
            </div>
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">

                        <div class="box-body">
                            <?php if ($this->session->flashdata('success')): ?>
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php endif; ?>
                            <form action="" method="post">


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="sel1">Select Zone</label>
                                            <select class="selectpicker form-control" id="zoneSelect"
                                                data-actions-box="true" multiple aria-label="Default select example"
                                                title="Please Select" data-size="5" name="Sales_Code" data-live-search="true" multiple
                                                data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="sel1">Select State</label>
                                            <select class="selectpicker form-control" id="State_Code"
                                                data-actions-box="true" multiple aria-label="Default select example"
                                                title="Please Select" data-size="5" name="State_Code" data-live-search="true" multiple
                                                data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="sel1">Select City </label>
                                            <select class="selectpicker form-control" id="City" data-actions-box="true"
                                                multiple aria-label="Default select example" name="City" title="Please Select"
                                                data-size="5" data-live-search="true" multiple
                                                data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div class="table-responsive">
                                <table id="exampley" class="display nowrap table table-bordered table-hover text-center"
                                    style="width:100%">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




<script>
    $(document).ready(function() {
        $('#zoneSelect').change(function() {
            var zoneCode = $(this).val();

            console.log(zoneCode);

            if (zoneCode) {
                $.ajax({
                    url: '<?= site_url('admin/get_states_by_zone') ?>',
                    method: 'POST',
                    data: {
                        zone_code: zoneCode
                    },
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);

                        if (response.status) {
                            $('#State_Code').empty();
                            $('#State_Code').append('<option value="">Select State</option>');
                            $.each(response.data, function(index, state) {
                                $('#State_Code').append(
                                    `<option value="${state.State_Code}">${state.State}</option>`
                                );
                            });
                            $('#State_Code').selectpicker('refresh');
                        }
                    },
                    error: function() {
                        alert('Error loading states.');
                    }
                });
            } else {
                // $('#State_Code').empty();
                // $('#City').empty();
                $('#State_Code').selectpicker('refresh');
                $('#City').selectpicker('refresh');
            }
        });

        $('#State_Code').change(function() {
            var stateCode = $(this).val();




            if (stateCode) {
                $.ajax({
                    url: '<?= site_url('admin/get_cities_by_state') ?>',
                    method: 'POST',
                    data: {
                        state_code: stateCode
                    },
                    dataType: 'json',
                    success: function(response) {

                        console.log(response);

                        if (response.status) {
                            $('#City').empty();
                            $('#City').append('<option value="">Select City</option>');
                            $.each(response.data, function(index, city) {
                                $('#City').append(
                                    `<option value="${city.City}">${city.City}</option>`
                                );
                            });
                            $('#City').selectpicker('refresh');
                        }
                    },
                    error: function() {
                        alert('Error loading cities.');
                    }
                });
            } else {
                $('#City').empty();
                $('#City').selectpicker('refresh');
            }
        });
    });
</script>








<script>
    function getParams() {
        return {
            zoneSelect: $('#zoneSelect').val() || null,
            State_Code: $('#State_Code').val() || null,
            City: $('#City').val() || null,

        };
    }

    // The DataTable initialization
    $(document).ready(function() {
        var table = $('#exampley').DataTable({
            paging: true,
            searching: true,
            info: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            scrollY: "400px",
            scrollCollapse: true,
            fixedHeader: true,
            processing: true,
            serverSide: true,
            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-download"></i> Download',
                titleAttr: 'Download as Excel',
            }],
            ajax: {
                url: "<?= site_url('admin/hierarchydata_ajex') ?>",
                type: "POST",
                data: function(d) {
                    $.extend(d, getParams()); // This calls getParams
                    d.search = $('#dt-search-0').val(); // Include search term
                    // Log the data being sent
                    console.log("Data being sent to the server:", d);

                    return d;
                },
                dataSrc: function(json) {
                    console.log("Ajax Response Data:", json);
                    if (json.filter) {
                        updateSalesCodeDropdown(json.filter);
                    }
                    return json.data;
                },
                error: function(xhr, error, code) {
                    console.error("Ajax Error:", {
                        xhr: xhr,
                        error: error,
                        code: code
                    });
                    
                },
            },
            columns: [{
                    data: "id",
                    title: "ID",
                    visible: false
                },

                {
                    data: "Customer_Name",
                    title: "Customer Name"
                },
                {
                    data: "Customer_Code",
                    title: "Customer Code"
                },
                {
                    data: "Pin_Code",
                    title: "Pin Code"
                },
                {
                    data: "City",
                    title: "City"
                },
                {
                    data: "District",
                    title: "District"
                },
                {
                    data: "Contact_Number",
                    title: "Contact Number"
                },
                {
                    data: "Country",
                    title: "Country"
                },
                {
                    data: "Zone",
                    title: "Zone"
                },
                {
                    data: "State",
                    title: "State"
                },
                {
                    data: "Population_Strata_1",
                    title: "Population Strata 1"
                },
                {
                    data: "Population_Strata_2",
                    title: "Population Strata 2"
                },
                {
                    data: "Country_Group",
                    title: "Country Group"
                },
                {
                    data: "GTM_TYPE",
                    title: "GTM Type"
                },
                {
                    data: "SUPERSTOCKIST",
                    title: "Super Stockist"
                },
                {
                    data: "STATUS",
                    title: "Status"
                },
                {
                    data: "Customer_Type_Code",
                    title: "Customer Type Code"
                },
                {
                    data: "Sales_Code",
                    title: "Sales Code"
                },
                {
                    data: "Customer_Type_Name",
                    title: "Customer Type Name"
                },
                {
                    data: "Customer_Group_Code",
                    title: "Customer Group Code"
                },
                {
                    data: "Customer_Creation_Date",
                    title: "Customer Creation Date"
                },
                {
                    data: "Division_Code",
                    title: "Division Code"
                },
                {
                    data: "Sector_Code",
                    title: "Sector Code"
                },
                {
                    data: "State_Code",
                    title: "State Code"
                },
                {
                    data: "Zone_Code",
                    title: "Zone Code"
                },
                {
                    data: "Distribution_Channel_Code",
                    title: "Distribution Channel Code"
                },
                {
                    data: "Distribution_Channel_Name",
                    title: "Distribution Channel Name"
                },
                {
                    data: "Customer_Group_Name",
                    title: "Customer Group Name"
                },
                {
                    data: "Sales_Name",
                    title: "Sales Name"
                },
                {
                    data: "Division_Name",
                    title: "Division Name"
                },
                {
                    data: "Sector_Name",
                    title: "Sector Name"
                },
                {
                    data: "Level_1",
                    title: "Level 1"
                },
                {
                    data: "Level_1_Name",
                    title: "Level 1 Name"
                },
                {
                    data: "Level_1_employer_code",
                    title: "Level 1 Employer Code"
                },
                {
                    data: "Level_1_designation_name",
                    title: "Level 1 Designation Name"
                },
                {
                    data: "Level_2",
                    title: "Level 2"
                },
                {
                    data: "Level_2_Name",
                    title: "Level 2 Name"
                },
                {
                    data: "Level_2_employer_code",
                    title: "Level 2 Employer Code"
                },
                {
                    data: "Level_2_designation_name",
                    title: "Level 2 Designation Name"
                },
                {
                    data: "Level_3",
                    title: "Level 3"
                },
                {
                    data: "Level_3_Name",
                    title: "Level 3 Name"
                },
                {
                    data: "Level_3_employer_code",
                    title: "Level 3 Employer Code"
                },
                {
                    data: "Level_3_designation_name",
                    title: "Level 3 Designation Name"
                },
                {
                    data: "Level_4",
                    title: "Level 4"
                },
                {
                    data: "Level_4_Name",
                    title: "Level 4 Name"
                },
                {
                    data: "Level_4_employer_code",
                    title: "Level 4 Employer Code"
                },
                {
                    data: "Level_4_designation_name",
                    title: "Level 4 Designation Name"
                },
                {
                    data: "Level_5",
                    title: "Level 5"
                },
                {
                    data: "Level_5_Name",
                    title: "Level 5 Name"
                },
                {
                    data: "Level_5_employer_code",
                    title: "Level 5 Employer Code"
                },
                {
                    data: "Level_5_designation_name",
                    title: "Level 5 Designation Name"
                },
                {
                    data: "Level_6",
                    title: "Level 6"
                },
                {
                    data: "Level_6_Name",
                    title: "Level 6 Name"
                },
                {
                    data: "Level_6_employer_code",
                    title: "Level 6 Employer Code"
                },
                {
                    data: "Level_6_designation_name",
                    title: "Level 6 Designation Name"
                },
                {
                    data: "Level_7",
                    title: "Level 7"
                },
                {
                    data: "Level_7_Name",
                    title: "Level 7 Name"
                },
                {
                    data: "Level_7_employer_code",
                    title: "Level 7 Employer Code"
                },
                {
                    data: "Level_7_designation_name",
                    title: "Level 7 Designation Name"
                },


                {
                    data: null,
                    title: "Actions",
                    orderable: false,
                    render: function(data, type, row) {
                        return `
        <div class="d-flex">
            <a href="<?= site_url('admin/hierarchyedit') ?>?id=${encodeURIComponent(row.id || 'N/A')}&customer_name=${encodeURIComponent(row.Customer_Name || 'N/A')}" class="btn btn-primary text-white setfont">
                <i class="fa-solid fa-pencil fa-fw"></i>
            </a>
            <a href="javascript:void(0);" data-id="${row.id || 'N/A'}" class="delete-btn">
                <button class="btn btn-primary text-white setfont">
                    <i class="fa-solid fa-trash fa-fw"></i>
                </button>
            </a>
        </div>
    `;
                    }

                },
            ],
        });






        function escapeHtml(unsafe) {
            if (typeof unsafe !== 'string') {
                return '';
            }
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }




        function updateSalesCodeDropdown(mapingData) {
            var zoneCodeDropdown = $('#zoneSelect');
            var stateDropdown = $('#State_Code');
            var cityDropdown = $('#City');


            var uniqueSalesCodes = {};
            $.each(mapingData, function(index, item) {
                if (item.Zone_Code) {
                    uniqueSalesCodes[item.Zone_Code] = item.Zone;
                }
            });
            $.each(uniqueSalesCodes, function(code, name) {
                if (!zoneCodeDropdown.find('option[value="' + escapeHtml(
                            code) +
                        '"]').length) {
                    zoneCodeDropdown.append('<option value="' + escapeHtml(
                            code) +
                        '">' + escapeHtml(name) + '</option>');
                }
            });
            zoneCodeDropdown.selectpicker('refresh');

            // Collect unique distribution channels
            // var uniqueChannels = {};
            // $.each(mapingData, function(index, item) {
            //     if (item.State_Code) {
            //         uniqueChannels[item.State_Code] = item
            //             .State;
            //     }
            // });
            // $.each(uniqueChannels, function(code, name) {
            //     if (!stateDropdown.find('option[value="' +
            //             escapeHtml(
            //                 code) + '"]').length) {
            //         stateDropdown.append('<option value="' +
            //             escapeHtml(code) + '">' + escapeHtml(name) +
            //             '</option>'
            //         );
            //     }
            // });


            // stateDropdown.selectpicker('refresh');

            // Collect unique division codes
            // var uniqueDivisions = {};
            // $.each(mapingData, function(index, item) {
            //     if (item.City) {
            //         uniqueDivisions[item.City] = item.City;
            //     }
            // });
            // $.each(uniqueDivisions, function(code, name) {
            //     if (!cityDropdown.find('option[value="' + escapeHtml(
            //                 code) +
            //             '"]').length) {
            //         cityDropdown.append('<option value="' + escapeHtml(
            //             code) + '">' + escapeHtml(name) + '</option>');
            //     }
            // });
            // cityDropdown.selectpicker('refresh');


        }


        $('#dt-search-0').on('keyup', function() {
            console.log("Custom Search Triggered:", $(this).val());
            table.ajax.reload();
        });

    });

    // Function to fetch data and update DataTable
    function fetchDataAndUpdate(params) {
        $('#exampley').DataTable().ajax.reload();
    }



    $('#zoneSelect').change(function() {
        $('#State_Code').empty();
        $('#City').empty();
        fetchDataAndUpdate(getParams());
    });

    $('#State_Code').change(function() {
        $('#City').empty();
        fetchDataAndUpdate(getParams());
    });

    $('#City').change(function() {
        fetchDataAndUpdate(getParams());
    });
</script>









<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.body.addEventListener('click', function(event) {
            if (event.target.closest('.delete-btn')) {
                var id = event.target.closest('.delete-btn').getAttribute('data-id');

                swal({
                        title: "Are you sure?",
                        text: "You won't be able to undo this action!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: "No, cancel!",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            window.location.href = "<?php echo site_url('admin/hierarchydelete/'); ?>" +
                                id;
                        } else {
                            swal("Cancelled", "Your item is safe :)", "error");
                        }
                    });
            }
        });
    });
</script>