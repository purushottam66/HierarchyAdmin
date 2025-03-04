<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css" class="rel">

<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">User Movement</h3>
            </div>
            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / HierarchyData
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
                            <?php if ($this->session->flashdata('message')): ?>
                                <div class="alert alert-info">
                                    <?php echo $this->session->flashdata('message'); ?>
                                </div>
                            <?php endif; ?>


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
                                            <label for="sales-code-filter">Sales Name:</label>
                                            <select class="selectpicker form-control" data-actions-box="true" multiple
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" multiple data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="Sales_Code"
                                                name="Sales_Code" aria-label="Select Sales Code">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="distribution-channel-filter">Distribution
                                                Channel Name:</label>
                                            <select class="selectpicker form-control" data-actions-box="true" multiple
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" multiple data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)"
                                                id="Distribution_Channel_Code" name="Distribution_Channel_Code"
                                                aria-label="Select Distribution Channel Code">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="division-code-filter">Division Name:</label>
                                            <select class="selectpicker form-control" data-actions-box="true" multiple
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" multiple data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="Division_Code"
                                                name="Division_Code" aria-label="Select Division Code">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="customer-type-code-filter">Customer Type
                                                Name:</label>
                                            <select class="selectpicker form-control" data-actions-box="true" multiple
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" multiple data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="Customer_Type_Code"
                                                name="Customer_Type_Code" aria-label="Select Customer Type Code">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="customer-group-code-filter">Customer Group
                                                Name:</label>
                                            <select class="selectpicker form-control" data-actions-box="true" multiple
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" multiple data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)"
                                                id="Customer_Group_Code" name="Customer_Group_Code"
                                                aria-label="Select Customer Group Code">
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group p-b-10">
                                            <label for="population-strata-filter">Select Pop
                                                Strata:</label>
                                            <select class="selectpicker form-control" data-actions-box="true" multiple
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" multiple data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)"
                                                id="Population_Strata_2" name="Population_Strata_2"
                                                aria-label="Select Population Strata">

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
                filename: 'UserMovement'
            }],
            ajax: {
                url: "<?= site_url('admin/hierarchydata_ajex') ?>",
                type: "POST",
                data: function(d) {
                    $.extend(d, getParams()); 
                    d.search = $('#dt-search-0').val(); 
                },
                dataSrc: function(json) {

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
            language: {
                processing: '<img class="spin-image" src="<?php echo base_url('admin/assets/Bloom_2.gif'); ?>" alt="Loading...">', // Custom loading message
            },
            columns: [{
                    data: "id",
                    title: "ID",
                    visible: false
                },

                {
                    data: "Customer_Code",
                    title: "Customer Code"
                },


                {
                    data: "Sales_Name",
                    title: "Sales Name"
                },


                {
                    data: "Distribution_Channel_Name",
                    title: "Distribution Channel Name"
                },


                {
                    data: "Division_Name",
                    title: "Division Name"
                },


                {
                    data: "Customer_Type_Name",
                    title: "Customer Type Name"
                },

                {
                    data: "Customer_Group_Name",
                    title: "Customer Group Name"
                },
                {
                    data: "Level_1_Name",
                    title: "Level 1 Name"
                },
                {
                    data: "Level_1_Designation_Name",
                    title: "Level 1 Designation"
                },
                {
                    data: "Level_2_Name",
                    title: "Level 2 Name"
                },
                {
                    data: "Level_2_Designation_Name",
                    title: "Level 2 Designation"
                },
                {
                    data: "Level_3_Name",
                    title: "Level 3 Name"
                },
                {
                    data: "Level_3_Designation_Name",
                    title: "Level 3 Designation"
                },
                {
                    data: "Level_4_Name",
                    title: "Level 4 Name"
                },
                {
                    data: "Level_4_Designation_Name",
                    title: "Level 4 Designation"
                },
                {
                    data: "Level_5_Name",
                    title: "Level 5 Name"
                },
                {
                    data: "Level_5_Designation_Name",
                    title: "Level 5 Designation"
                },
                {
                    data: "Level_6_Name",
                    title: "Level 6 Name"
                },
                {
                    data: "Level_6_Designation_Name",
                    title: "Level 6 Designation"
                },
                {
                    data: "Level_7_Name",
                    title: "Level 7 Name"
                },
                {
                    data: "Level_7_Designation_Name",
                    title: "Level 7 Designation"
                },
                {
                    data: null,
                    title: "Actions",
                    orderable: false,
                    render: function(data, type, row) {
                        return `
                            <div class="testone">
                                <a href="<?= site_url('admin/emp_Left') ?>?id1=${encodeURIComponent(data.Emp_id1 || 'N/A')}&id2=${encodeURIComponent(data.Emp_id2 || 'N/A')}&id3=${encodeURIComponent(data.Emp_id3 || 'N/A')}&id4=${encodeURIComponent(data.Emp_id4 || 'N/A')}&id5=${encodeURIComponent(data.Emp_id5 || 'N/A')}&id6=${encodeURIComponent(data.Emp_id6 || 'N/A')}&id7=${encodeURIComponent(data.Emp_id7 || 'N/A')}&customer_name=${encodeURIComponent(data.Customer_Name || 'N/A')}" class="btn btn-primary text-white setfont">
                                    Left
                                </a>
                                <a href="<?= site_url('admin/emp_Transfer') ?>?id1=${encodeURIComponent(data.Emp_id1 || 'N/A')}&id2=${encodeURIComponent(data.Emp_id2 || 'N/A')}&id3=${encodeURIComponent(data.Emp_id3 || 'N/A')}&id4=${encodeURIComponent(data.Emp_id4 || 'N/A')}&id5=${encodeURIComponent(data.Emp_id5 || 'N/A')}&id6=${encodeURIComponent(data.Emp_id6 || 'N/A')}&id7=${encodeURIComponent(data.Emp_id7 || 'N/A')}&customer_name=${encodeURIComponent(data.Customer_Name || 'N/A')}" class="btn btn-primary text-white setfont">
                                    Transfer
                                </a>
                                <a href="<?= site_url('admin/emp_Promoted') ?>?id1=${encodeURIComponent(data.Emp_id1 || 'N/A')}&id2=${encodeURIComponent(data.Emp_id2 || 'N/A')}&id3=${encodeURIComponent(data.Emp_id3 || 'N/A')}&id4=${encodeURIComponent(data.Emp_id4 || 'N/A')}&id5=${encodeURIComponent(data.Emp_id5 || 'N/A')}&id6=${encodeURIComponent(data.Emp_id6 || 'N/A')}&id7=${encodeURIComponent(data.Emp_id7 || 'N/A')}&customer_name=${encodeURIComponent(data.Customer_Name || 'N/A')}" class="btn btn-primary text-white setfont">
                                    Promoted
                                </a>
                            </div>
                        `;
                    },
                },
            ],
        });

        $('#dt-search-0').on('keyup', function() {

            table.ajax.reload();
        });

    });
    function fetchDataAndUpdate(params) {
        $('#exampley').DataTable().ajax.reload();
    }
    function getParams() {
        return {
            Sales_Code: $('#Sales_Code').val() || null,
            Distribution_Channel_Code: $('#Distribution_Channel_Code').val() || null,
            Division_Code: $('#Division_Code').val() || null,
            Customer_Type_Code: $('#Customer_Type_Code').val() || null,
            Customer_Group_Code: $('#Customer_Group_Code').val() || null,
            Population_Strata_2: $('#Population_Strata_2').val() || null
        };
    }


    function updateSalesCodeDropdown(mapingData) {
        var salesCodeDropdown = $('#Sales_Code');
        var distributionChannelDropdown = $('#Distribution_Channel_Code');
        var divisionCodeDropdown = $('#Division_Code');
        var customerTypeDropdown = $('#Customer_Type_Code');
        var customerGroupDropdown = $('#Customer_Group_Code');
        var populationStrataDropdown = $('#Population_Strata_2');

        var uniqueSalesCodes = {};
        $.each(mapingData, function(index, item) {
            if (item.Sales_Code) {
                uniqueSalesCodes[item.Sales_Code] = item.Sales_Name;
            }
        });
        $.each(uniqueSalesCodes, function(code, name) {
            if (!salesCodeDropdown.find('option[value="' + escapeHtml(
                        code) +
                    '"]').length) {
                salesCodeDropdown.append('<option value="' + escapeHtml(
                        code) +
                    '">' + escapeHtml(name) + '</option>');
            }
        });
        salesCodeDropdown.selectpicker('refresh');

        // Collect unique distribution channels
        var uniqueChannels = {};
        $.each(mapingData, function(index, item) {
            if (item.Distribution_Channel_Code) {
                uniqueChannels[item.Distribution_Channel_Code] = item
                    .Distribution_Channel_Name;
            }
        });
        $.each(uniqueChannels, function(code, name) {
            if (!distributionChannelDropdown.find('option[value="' +
                    escapeHtml(
                        code) + '"]').length) {
                distributionChannelDropdown.append('<option value="' +
                    escapeHtml(code) + '">' + escapeHtml(name) +
                    '</option>'
                );
            }
        });


        distributionChannelDropdown.selectpicker('refresh');

        // Collect unique division codes
        var uniqueDivisions = {};
        $.each(mapingData, function(index, item) {
            if (item.Division_Code) {
                uniqueDivisions[item.Division_Code] = item.Division_Name;
            }
        });
        $.each(uniqueDivisions, function(code, name) {
            if (!divisionCodeDropdown.find('option[value="' + escapeHtml(
                        code) +
                    '"]').length) {
                divisionCodeDropdown.append('<option value="' + escapeHtml(
                    code) + '">' + escapeHtml(name) + '</option>');
            }
        });
        divisionCodeDropdown.selectpicker('refresh');

        // Collect unique customer types
        var uniqueCustomerTypes = {};
        $.each(mapingData, function(index, item) {
            if (item.Customer_Type_Code) {
                uniqueCustomerTypes[item.Customer_Type_Code] = item
                    .Customer_Type_Name;
            }
        });
        $.each(uniqueCustomerTypes, function(code, name) {
            if (!customerTypeDropdown.find('option[value="' + escapeHtml(
                        code) +
                    '"]').length) {
                customerTypeDropdown.append('<option value="' + escapeHtml(
                    code) + '">' + escapeHtml(name) + '</option>');
            }
        });
        customerTypeDropdown.selectpicker('refresh');

        // Collect unique customer groups
        var uniqueCustomerGroups = {};
        $.each(mapingData, function(index, item) {
            if (item.Customer_Group_Code) {
                uniqueCustomerGroups[item.Customer_Group_Code] = item
                    .Customer_Group_Name;
            }
        });
        $.each(uniqueCustomerGroups, function(code, name) {
            if (!customerGroupDropdown.find('option[value="' + escapeHtml(
                    code) + '"]').length) {
                customerGroupDropdown.append('<option value="' + escapeHtml(
                    code) + '">' + escapeHtml(name) + '</option>');
            }
        });
        customerGroupDropdown.selectpicker('refresh');

        // Collect unique population strata
        var uniquePopulationStrata = {};
        $.each(mapingData, function(index, item) {
            if (item.Population_Strata_2) {
                uniquePopulationStrata[item.Population_Strata_2] = item
                    .Population_Strata_2;
            }
        });
        $.each(uniquePopulationStrata, function(code, name) {
            if (!populationStrataDropdown.find('option[value="' +
                    escapeHtml(
                        code) + '"]').length) {
                populationStrataDropdown.append('<option value="' +
                    escapeHtml(
                        code) + '">' + escapeHtml(name) + '</option>');
            }
        });
        populationStrataDropdown.selectpicker('refresh');
    }


    function fetchDataAndUpdate(params) {
        $.ajax({
            url: "<?= site_url('admin/get-hierarchy-filter-options') ?>",
            type: "GET",
            data: params,
            success: function(response) {
                updateSalesCodeDropdown(response);

            },
            error: function(error) {
                console.error("AJAX Error:", error);
            }
        });
    }


    fetchDataAndUpdate(getParams());


    $('#Sales_Code').change(function() {
        $('#Distribution_Channel_Code').empty();
        $('#Division_Code').empty();
        $('#Customer_Type_Code').empty();
        $('#Customer_Group_Code').empty();
        $('#Population_Strata_2').empty();
        fetchDataAndUpdate(getParams());

        $('#exampley').DataTable().ajax.reload();

    });

    $('#Distribution_Channel_Code').change(function() {
        $('#Division_Code').empty();
        $('#Customer_Type_Code').empty();
        $('#Customer_Group_Code').empty();
        $('#Population_Strata_2').empty();
        fetchDataAndUpdate(getParams());
        $('#exampley').DataTable().ajax.reload();

    });

    $('#Division_Code').change(function() {
        $('#Customer_Type_Code').empty();
        $('#Customer_Group_Code').empty();
        $('#Population_Strata_2').empty();
        fetchDataAndUpdate(getParams());
        $('#exampley').DataTable().ajax.reload();
    });

    $('#Customer_Type_Code').change(function() {
        $('#Customer_Group_Code').empty();
        $('#Population_Strata_2').empty();
        fetchDataAndUpdate(getParams());
        $('#exampley').DataTable().ajax.reload();
    });

    $('#Customer_Group_Code').change(function() {
        $('#Population_Strata_2').empty();
        fetchDataAndUpdate(getParams());
        $('#exampley').DataTable().ajax.reload();
    });

    $('#Population_Strata_2').change(function() {
        fetchDataAndUpdate(getParams());
        $('#exampley').DataTable().ajax.reload();
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