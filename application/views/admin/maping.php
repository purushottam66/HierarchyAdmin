<style>
    #submitButton__ {
        border: 1px solid #007bff;
        background-color: #FB8B03;
        color: #ffff;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .btnss {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-left: 20px;
    }

    .btnss:hover {
        background-color: #0056b3;
    }



    .col1 {
        width: 200px;
    }

    .col2 {
        width: 220px;
    }

    .col3 {
        width: 240px;
    }

    .col4 {
        width: 260px;
    }

    .col5 {
        width: 280px;
    }

    .col6 {
        width: 300px;
    }

    .col7 {
        width: 320px;
    }
</style>


<style>
    #treeView span.active {
        background-color: #0a6867;
        color: #ffff;

    }
</style>

<style>
    .rightbutton {
        float: right;
    }

    .btn-primary {
        color: #fff;
        border-radius: 3px;
        background-image: linear-gradient(122deg, #633991 0%, #c1156c 100%);
        box-shadow: 0px 9px 32px 0px rgba(0, 0, 0, 0.2);
        font-weight: 500;
        border: 0;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary:not([disabled]):not(.disabled).active,
    .btn-primary:not([disabled]):not(.disabled):active,
    .show>.btn-primary.dropdown-toggle {
        background-image: linear-gradient(122deg, #4e2a75 0%, #a01059 100%);
        box-shadow: 0px 9px 32px 0px rgba(0, 0, 0, 0.3);
        color: #FFF;
    }
</style>











<style>
    #treeView li>span {
        padding: 8px 12px;
        background-color: #0a6868;
        color: white;
        border-radius: 5px;
        transition: background-color 0.3s;
    }

    #treeView li>span:hover {
        background-color: #0a6168;
    }

    .nested {
        display: none;
    }

    .nested.active {
        display: block;
    }





    .btnss {
        background-color: #FB8B03;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        transition: background-color 0.3s;
    }

    .btnss:hover {
        background-color: #218838;
    }
</style>
<style>
    ul {
        list-style-type: none;
    }

    #treeView li {
        margin-left: -18px;

        cursor: pointer;
        padding: 10px 0;
    }

    #treeView li span {

        background-color: #484848;
        color: #ffff;
        border: 1px solid gray;
        padding: 10px 9px 10px 11px;
        line-height: 43px;
        font-size: 8px;



    }

    #treeView {
        margin-left: -12px;
        border: 1px solid gray;
    }

    .nested {
        display: flex;
    }
</style>



<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">User - Dist.Mapping</h3>
            </div>
            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / Add Mapping</div>
            </div> -->
        </div>
    </header>


    <div class="main-content bg-clouds ">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <div class="form-container">
                                <form action="<?php echo site_url('admin/submit_maping'); ?>" id="myForm" method="post">
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

                                    <div class="row">
                                        <div class="card">
                                            <div class="row">
                                                <div class="col-md-3 mt-2">
                                                    <div class="form-group">
                                                        <label for="Sales_Code">Sales Name
                                                        </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Sales_Code" name="Sales_Code" required>
                                                            <?php foreach ($distributors as $role): ?>
                                                                <option value="<?php echo $role['Sales_Code']; ?>">

                                                                    <?php echo $role['Sales_Name']; ?>
                                                                    <!-- <?php echo $role['Sales_Code']; ?> -->
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 mt-2">
                                                    <div class="form-group">
                                                        <label for="Distribution_Channel_Code">
                                                            Distribution Channel Name </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Distribution_Channel_Code"
                                                            name="Distribution_Channel_Code" required>

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-3 mt-2">
                                                    <div class="form-group">
                                                        <label for="Division_Code">
                                                            Division Name
                                                        </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Division_Code" name="Division_Code" required>

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-3 mt-2">
                                                    <div class="form-group">
                                                        <label for="Customer_Type_Code">
                                                            Customer Type Name </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Customer_Type_Code" name="Customer_Type_Code" required>

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="Customer_Group_Code">
                                                            Customer Group Name </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Customer_Group_Code" name="Customer_Group_Code"
                                                            required>

                                                        </select>
                                                    </div>
                                                </div>




                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="Population_Strata_2">Population
                                                            Strata 2 </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Population_Strata_2" name="Population_Strata_2"
                                                            required>

                                                        </select>
                                                    </div>
                                                </div>




                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="Zone">Zone
                                                        </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)" id="Zone_Code"
                                                            name="Zone" required>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="card mt-3">
                                            <div class="row">
                                                <div class="table-responsive pb-2 ">
                                                    <table id="examplecsv"
                                                        class="display nowrap table table-bordered table-hover text-center"
                                                        style="width:100%">

                                                    </table>


                                                </div>

                                            </div>

                                        </div>
                                        <hr>

                                        <div class="container card">

                                            <div class="row">
                                                <div class="col-md-3 mt-3">

                                                    <div id="filter-sidebar" class="  sliding-sidebar">
                                                        <p class="text-center fw-bold">level wise Select User</p>
                                                        <hr>
                                                        <p class="text-center" id="unicnme"></p>


                                                        <ul id="treeView">
                                                            <li class="">
                                                                <span data-level="1" id="level_name_1">Level 1</span>
                                                                <ul class="nested ">
                                                                    <li class="">
                                                                        <span data-level="2" id="level_name_2">Level
                                                                            2</span>
                                                                        <ul class="nested ">
                                                                            <li class="">
                                                                                <span data-level="3"
                                                                                    id="level_name_3">Level 3</span>
                                                                                <ul class="nested ">
                                                                                    <li class="">
                                                                                        <span data-level="4"
                                                                                            id="level_name_4">Level
                                                                                            4</span>
                                                                                        <ul class="nested ">
                                                                                            <li class="">
                                                                                                <span data-level="5"
                                                                                                    id="level_name_5">Level
                                                                                                    5</span>
                                                                                                <ul class="nested ">
                                                                                                    <li class="">
                                                                                                        <span
                                                                                                            data-level="6"
                                                                                                            id="level_name_6">Level
                                                                                                            6</span>
                                                                                                        <ul
                                                                                                            class="nested ">
                                                                                                            <li
                                                                                                                class="">
                                                                                                                <span
                                                                                                                    data-level="7"
                                                                                                                    id="level_name_7">Level
                                                                                                                    7</span>
                                                                                                            </li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                </ul>
                                                                                            </li>
                                                                                        </ul>
                                                                                    </li>
                                                                                </ul>
                                                                            </li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>



                                                    </div>
                                                </div>

                                                <div class="col-sm-9">
                                                    <div class="table-responsive pb-3">
                                                        <table id="levelbase"
                                                            class="display nowrap table table-bordered table-hover text-center"
                                                            style="width:100%">
                                                            <thead>
                                                                <tr>
                                                                    <th></th>
                                                                    <th>Employee Code </th>
                                                                    <th>Employee Name</th>
                                                                    <th>Mobile Number</th>
                                                                    <th>State</th>
                                                                    <th>city</th>

                                                                    <th>Designation</th>
                                                                    <th>Email ID </th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>



                                            <?php

                                            $hasPermission = false;
                                            if (is_array($permissions)) {
                                                foreach ($permissions as $p) {
                                                    if ($p['module_name'] === "User - Dist.Mapping" && $p['edit'] === "yes") {
                                                        $hasPermission = true;
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>


                                            <?php if ($hasPermission): ?>
                                                <div class="col-12">
                                                    <button type="submit" id="submitButton__" class="btn btnss setfont-btn">Submit</button> &#8202;
                                                </div>
                                            <?php else: ?>
                                                <div class="col-12">
                                                    <p class=" btnss setfont-btn">No Permission to Submit</p>
                                                </div>
                                            <?php endif; ?>


                                            <br>
                                        </div>


                                        <input type="hidden" value="" name="level1" id="level_1">
                                        <input type="hidden" value="" name="level2" id="level_2">
                                        <input type="hidden" value="" name="level3" id="level_3">
                                        <input type="hidden" value="" name="level4" id="level_4">
                                        <input type="hidden" value="" name="level5" id="level_5">
                                        <input type="hidden" value="" name="level6" id="level_6">
                                        <input type="hidden" value="" name="level7" id="level_7">
                                        <div id="hiddenFieldsContainer"></div>
                                        <br>
                                    </div>
                                </form>
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
    $("#treeView").on('click', 'span', function() {
        $("#treeView li > span.active").removeClass("active");
        $(this).addClass("active");
        var parentLi = $(this).parent();
        if (parentLi.hasClass("active-li")) {
            parentLi.removeClass("active-li");
        } else {
            parentLi.addClass("active-li");
        }
    });
</script>




<script>
    function escapeHtml(unsafe) {
        if (typeof unsafe !== 'string') return '';
        return unsafe
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }

    $(document).ready(function() {
        var table = $('#examplecsv').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "autoWidth": true,
            "pageLength": 400,
            "lengthMenu": [400, 500, 600],
            "scrollY": "350px",
            "scrollCollapse": true,
            "fixedHeader": true,
            "fixedFooter": true,
            "processing": true,
            "serverSide": true,

            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',

            "buttons": [{
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-download"></i> Download',
                    titleAttr: 'Download as Excel',
                    filename: 'distributor_data',
                }

            ],
            order: [{
                column: 0, // Sort by the first column
                dir: "asc", // Ascending order
            }], // Default sorting
            ajax: {
                url: "<?= site_url('admin/distributors_db') ?>",
                type: "POST",
                data: function(d) {
                    d.search = $('#dt-search-0').val();
                    d.Sales_Code = $('#Sales_Code').val() || null;
                    d.Distribution_Channel_Code = $('#Distribution_Channel_Code').val() || null;
                    d.Division_Code = $('#Division_Code').val() || null;
                    d.Customer_Type_Code = $('#Customer_Type_Code').val() || null;
                    d.Customer_Group_Code = $('#Customer_Group_Code').val() || null;
                    d.Population_Strata_2 = $('#Population_Strata_2').val() || null;
                    d.Zone = $('#Zone_Code').val() || null;

                 
                    return d;
                },
                dataSrc: function(json) {
                   

                    $('#hiddenFieldsContainer').empty();
                    $('#select-all').prop('checked', false);
                    return json.data;
                },
                error: function(xhr, error, code) {
                    console.error("Ajax Error: ", {
                        xhr,
                        error,
                        code
                    });

                }
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
                    title: '<input type="checkbox" id="select-all">',
                    data: null,
                    render: function(data) {

                        let obj = {
                            Customer_Code: data[2],
                            Sales_Code: data[18],
                            Distribution_Channel_Code: data[29],
                            Division_Code: data[23],
                            Customer_Type_Code: data[16],
                            Customer_Group_Code: data[20]
                        };

                        return `<input type="checkbox" 
                class="row-checkbox customerDataSelected" 
                data-id="${obj.Customer_Code || ''}" 
                data-sales="${obj.Sales_Code || ''}" 
                data-distribution="${obj.Distribution_Channel_Code || ''}" 
                data-division="${obj.Division_Code || ''}" 
                data-customer-type="${obj.Customer_Type_Code || ''}" 
                data-customer-group="${obj.Customer_Group_Code || ''}">`;
                    },
                    orderable: false
                },
                {
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
                    columns: "Sales_Code",
                    title: "Sales_Code"
                },
                {
                    columns: "Sales_Name",
                    title: "Sales_Name"
                },
                {
                    columns: "Distribution_Channel_Code",
                    title: "Distribution Channel Code"
                },
                {
                    columns: "Distribution_Channel_Name",
                    title: "Distribution Channel Name"
                },
                {
                    columns: "Division_Code",
                    title: "Division Code"
                },
                {
                    columns: "Division_Name",
                    title: "Division Name"
                },
                {
                    columns: "Customer_Type_Code",
                    title: "Customer Type Code"
                },
                {
                    columns: "Customer_Type_Name",
                    title: "Customer Type Name"
                },
                {
                    columns: "Customer_Group_Code",
                    title: "Customer Group Code"
                },
                {
                    columns: "Customer_Group_Name",
                    title: "Customer Group Name"
                },
                {
                    columns: "Customer_Creation_Date",
                    title: "Customer Creation Date"
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
            ]
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#treeView').on('click', 'span', function(event) {
            event.stopPropagation();
            let level = $(this).data('level');

            $('#treeView').find('li').removeClass('active');
            $(this).parent().addClass('active');

            if ($.fn.DataTable.isDataTable('#levelbase')) {
                $('#levelbase').DataTable().destroy();
            }

            var table = $('#levelbase').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '<?php echo base_url("admin/employeedata"); ?>',
                    type: 'POST',
                    data: function(d) {
                        d.level = level;
                        return d;
                    },
                    dataSrc: function(json) {
                        let uniqueDesignationNames = [...new Set(json.data.map(item => item.designation_name))].join(', ');

                        // Update the unicnme element with level and designation names
                        $('#unicnme').html(
                            `For level <strong>(${level})</strong><br>Select <strong>(${uniqueDesignationNames})</strong>`
                        );
                        return json.data;
                    }
                },
                columns: [{
                        data: null,
                        render: function(data, type, row) {
                            return '<input type="checkbox" class="row-checkbox_" id="' +
                                row.level + '" data-designation_name="' +
                                row.designation_name + '" data-name="' +
                                row.name + '" data-id="' + row.pjp_code + '">';
                        }
                    },
                    {
                        data: 'employer_code'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'mobile'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'city'
                    },
                    {
                        data: 'designation_name'
                    },
                    {
                        data: 'email'
                    }
                ],
                pageLength: 10,
                lengthMenu: [
                    [10, 25, 50, 100],
                    [10, 25, 50, 100]
                ],
                scrollY: "450px",
                scrollCollapse: true,
                fixedHeader: true,
                fixedFooter: true,
                // dom: 'Blfrtip',
                // buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
            });

            // Handle checkbox changes
            $('#levelbase').on('change', '.row-checkbox_', function() {
                if ($(this).is(':checked')) {
                    $('.row-checkbox_').not(this).prop('checked', false);
                    var selectedLevel = $(this).attr('id');
                    var selectedId = $(this).data('id');
                    var selectedName = $(this).data('name');
                    var selecteddesignation_name = $(this).data('designation_name');
                    setCheckedLevel(selectedLevel, selectedId, selectedName, selecteddesignation_name);
                } else {
                    var selectedLevel = $(this).attr('id');
                    localStorage.removeItem('selectedLevel');
                    localStorage.removeItem('selectedId');
                    localStorage.removeItem('selectedName');
                    $('#level_' + selectedLevel).val('');
                    $('#level_name_' + selectedLevel).html(`Level ${selectedLevel}`);
                }
            });

            const nextSibling = $(this).next('ul');
            if (nextSibling.length > 0) {
                nextSibling.toggleClass('active');
            }
        });

        function setCheckedLevel(level, id, name, selecteddesignation_name) {
            localStorage.setItem('selectedLevel', level);
            localStorage.setItem('selectedId', id);
            localStorage.setItem('selectedName', name);
            localStorage.setItem('selecteddesignation_name', selecteddesignation_name);
            $('#level_' + level).val(id);
            $('#level_name_' + level).html(`Level ${level} ->  ` + name + ` -> ` + selecteddesignation_name);
        }

        function restoreCheckedLevel() {
            var storedLevel = localStorage.getItem('selectedLevel');
            var storedId = localStorage.getItem('selectedId');
            if (storedLevel && storedId) {
                $('#' + storedLevel).prop('checked', true);
                $('#level_' + storedLevel).val(storedId);
            }
        }




        restoreCheckedLevel();
    });
</script>





<script>
    $(document).ready(function() {

        $(document).on('change', '.row-checkbox', function() {
            var distributorId = $(this).data('id');
            if ($(this).is(':checked')) {
                // Add hidden input if checkbox is checked
                $('<input>').attr({
                    type: 'hidden',
                    id: 'hidden_' + distributorId,
                    name: 'distributors_code[]',
                    value: distributorId
                }).appendTo('#hiddenFieldsContainer');
            } else {
                // Remove hidden input if checkbox is unchecked
                $('#hidden_' + distributorId).remove();
            }
        });

        // Toggle all checkboxes when master checkbox is clicked
        $('#select-all').on('click', function() {
            var isChecked = this.checked;
            $('.row-checkbox').each(function() {
                $(this).prop('checked', isChecked);
                var distributorId = $(this).data('id');
                if (isChecked) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'hidden_' + distributorId,
                        name: 'distributors_code[]',
                        value: distributorId
                    }).appendTo('#hiddenFieldsContainer');
                } else {
                    $('#hidden_' + distributorId).remove();
                }
            });
        });



        function getParams() {
            return {
                Sales_Code: $('#Sales_Code').val() || null,
                Distribution_Channel_Code: $('#Distribution_Channel_Code').val() || null,
                Division_Code: $('#Division_Code').val() || null,
                Customer_Type_Code: $('#Customer_Type_Code').val() || null,
                Customer_Group_Code: $('#Customer_Group_Code').val() || null,
                Population_Strata_2: $('#Population_Strata_2').val() || null,
                Zone: $('#Zone_Code').val() || null,

            };
        }



        function fetchDataAndUpdate(params) {

            fetchData('<?= site_url('admin/mapingajex'); ?>', params);
        }




        function updateSalesCodeDropdown(mapingData) {
            var salesCodeDropdown = $('#Sales_Code');
            var distributionChannelDropdown = $('#Distribution_Channel_Code');
            var divisionCodeDropdown = $('#Division_Code');
            var customerTypeDropdown = $('#Customer_Type_Code');
            var customerGroupDropdown = $('#Customer_Group_Code');
            var Population_Strata_2GroupDropdown = $('#Population_Strata_2');
            var Zone_CodeGroupDropdown = $('#Zone_Code');
            var uniqueSalesCodes = {};
            $.each(mapingData, function(index, item) {
                if (item.Sales_Code) {
                    uniqueSalesCodes[item.Sales_Code] = item.Sales_Name;
                }
            });
            $.each(uniqueSalesCodes, function(code, name) {
                if (!salesCodeDropdown.find('option[value="' + escapeHtml(code) +
                        '"]').length) {
                    salesCodeDropdown.append('<option value="' + escapeHtml(name) +
                        '">' + escapeHtml(code) + '</option>');
                }
            });
            salesCodeDropdown.selectpicker('refresh');

            var uniqueChannels = {};
            $.each(mapingData, function(index, item) {
                if (item.Distribution_Channel_Code) {
                    uniqueChannels[item.Distribution_Channel_Code] = item
                        .Distribution_Channel_Name;
                }
            });
            $.each(uniqueChannels, function(code, name) {
                if (!distributionChannelDropdown.find('option[value="' + escapeHtml(
                        code) + '"]').length) {
                    distributionChannelDropdown.append('<option value="' +
                        escapeHtml(code) + '">' + escapeHtml(name) + '</option>'
                    );
                }
            });




            distributionChannelDropdown.selectpicker('refresh');

            var uniqueDivisions = {};
            $.each(mapingData, function(index, item) {
                if (item.Division_Code) {
                    uniqueDivisions[item.Division_Code] = item.Division_Name;
                }
            });
            $.each(uniqueDivisions, function(code, name) {
                if (!divisionCodeDropdown.find('option[value="' + escapeHtml(code) +
                        '"]').length) {
                    divisionCodeDropdown.append('<option value="' + escapeHtml(
                        code) + '">' + escapeHtml(name) + '</option>');
                }
            });
            divisionCodeDropdown.selectpicker('refresh');

            var uniqueCustomerTypes = {};
            $.each(mapingData, function(index, item) {
                if (item.Customer_Type_Code) {
                    uniqueCustomerTypes[item.Customer_Type_Code] = item
                        .Customer_Type_Name;
                }
            });
            $.each(uniqueCustomerTypes, function(code, name) {
                if (!customerTypeDropdown.find('option[value="' + escapeHtml(code) +
                        '"]').length) {
                    customerTypeDropdown.append('<option value="' + escapeHtml(
                        code) + '">' + escapeHtml(name) + '</option>');
                }
            });
            customerTypeDropdown.selectpicker('refresh');

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


            var uniquePopulation_Strata_2 = {};
            $.each(mapingData, function(index, item) {
                if (item.Population_Strata_2) {
                    uniquePopulation_Strata_2[item.Population_Strata_2] = item
                        .Population_Strata_2;
                }
            });
            $.each(uniquePopulation_Strata_2, function(code, name) {
                if (!Population_Strata_2GroupDropdown.find('option[value="' +
                        escapeHtml(
                            code) + '"]').length) {
                    Population_Strata_2GroupDropdown.append('<option value="' +
                        escapeHtml(
                            code) + '">' + escapeHtml(name) + '</option>');
                }
            });
            Population_Strata_2GroupDropdown.selectpicker('refresh');


            var uniqueZone = {};
            $.each(mapingData, function(index, item) {
                if (item.Zone_Code) {
                    uniqueZone[item.Zone_Code] = item.Zone;
                }
            });
            $.each(uniqueZone, function(code, name) {
                if (!Zone_CodeGroupDropdown.find('option[value="' + escapeHtml(
                        code) + '"]').length) {
                    Zone_CodeGroupDropdown.append('<option value="' + escapeHtml(
                        code) + '">' + escapeHtml(name) + '</option>');
                }
            });
            Zone_CodeGroupDropdown.selectpicker('refresh');

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
            $('#Zone_Code').empty();

            fetchDataAndUpdate(getParams());

            $('#examplecsv').DataTable().ajax.reload();

            $('#hiddenFieldsContainer').empty();
            $('#select-all').prop('checked', false);

        });

        $('#Distribution_Channel_Code').change(function() {
            $('#Division_Code').empty();
            $('#Customer_Type_Code').empty();
            $('#Customer_Group_Code').empty();
            $('#Population_Strata_2').empty();
            $('#Zone_Code').empty();
            fetchDataAndUpdate(getParams());
            $('#examplecsv').DataTable().ajax.reload();
            $('#hiddenFieldsContainer').empty();
            $('#select-all').prop('checked', false);

        });

        $('#Division_Code').change(function() {
            $('#Customer_Type_Code').empty();
            $('#Customer_Group_Code').empty();
            $('#Population_Strata_2').empty();
            $('#Zone_Code').empty();
            fetchDataAndUpdate(getParams());
            $('#examplecsv').DataTable().ajax.reload();
            $('#hiddenFieldsContainer').empty();
            $('#select-all').prop('checked', false);
        });

        $('#Customer_Type_Code').change(function() {
            $('#Customer_Group_Code').empty();
            $('#Population_Strata_2').empty();
            $('#Zone_Code').empty();
            fetchDataAndUpdate(getParams());
            $('#examplecsv').DataTable().ajax.reload();
            $('#hiddenFieldsContainer').empty();
            $('#select-all').prop('checked', false);
        });

        $('#Customer_Group_Code').change(function() {
            $('#Population_Strata_2').empty();
            $('#Zone_Code').empty();
            fetchDataAndUpdate(getParams());
            $('#examplecsv').DataTable().ajax.reload();
            $('#hiddenFieldsContainer').empty();
            $('#select-all').prop('checked', false);
        });

        $('#Population_Strata_2').change(function() {
            $('#Zone_Code').empty();
            fetchDataAndUpdate(getParams());
            $('#examplecsv').DataTable().ajax.reload();
            $('#hiddenFieldsContainer').empty();
            $('#select-all').prop('checked', false);
        });

        $('#Zone_Code').change(function() {
            fetchDataAndUpdate(getParams());
            $('#examplecsv').DataTable().ajax.reload();
            $('#hiddenFieldsContainer').empty();
            $('#select-all').prop('checked', false);
        });






    });
</script>




<script>
    document.querySelectorAll('.delete-btn').forEach(function(element) {
        element.onclick = function() {
            var id = this.getAttribute('data-id');


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
                        window.location.href = "<?php echo site_url('admin/roledelete/'); ?>" + id;
                    } else {
                        swal("Cancelled", "Your item is safe :)", "error");
                    }
                });
        };
    });
</script>

<script src="<?php echo base_url('admin/assets/js/sweetalert.min.js'); ?>"></script>
<link rel="stylesheet" href="<?php echo base_url('admin/assets/css/sweetalert.min.css'); ?>">





<script>
    $(document).ready(function() {
        function checkConditions() {
            let allSelected = true;
            let levelSelected = false;
            let customerDataSelected = false;

            $("select").each(function() {
                let value = $(this).val();
                if (!value || value.trim() === "") {
                    allSelected = false;
                    return false;
                }
            });

            $(".row-checkbox_:checked").each(function() {

                levelSelected = true;
                return false;
            });

            $(".customerDataSelected:checked").each(function() {
                let customerId = $(this).data("id");
                if (customerId && customerId.toString().trim() !== "") {
                    customerDataSelected = true;
                    return false;
                }
            });

            let enableButton = allSelected && levelSelected && customerDataSelected;
            console.log("🔵 Final Button Enable Status:", enableButton);

            $("#submitButton__").prop("disabled", !enableButton);
        }

        $("select").on("change", checkConditions);

        $(document).on("change", ".row-checkbox_, .customerDataSelected", checkConditions);

        checkConditions();
    });
</script>

<script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const form = this;
        swal({
                title: "Are you sure you want to Proceed ?",
                text: "",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, submit it!',
                cancelButtonText: "No, cancel!",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if (isConfirm) {

                    form.submit();
                } else {

                    swal("Cancelled", "Your form submission was canceled.", "error");
                }
            });
    });
</script>



<script>
    $(document).ready(function() {
        $("[id^=level_name_]").not("#level_name_1").addClass("disabled-level").css({
            "pointer-events": "none",
            "background-color": "red"
        });


        $("#level_name_1").css({

            "background-color": "green"
        });


        $(document).on("change", ".row-checkbox_", function() {
            let levelSelected = parseInt($(this).attr("id").replace("level_", ""), 10);

            console.log(levelSelected);

            if (!isNaN(levelSelected)) {
                let nextLevel = levelSelected + 1;

                if ($(this).is(":checked")) {

                    if (levelSelected >= 1 && levelSelected < 7) {
                        $("#level_name_" + nextLevel).removeClass("disabled-level").css({
                            "pointer-events": "auto",
                            "background-color": "green"
                        });
                    }
                } else {

                    for (let i = nextLevel; i <= 7; i++) {
                        $("#level_name_" + i).addClass("disabled-level").css({
                            "pointer-events": "none",
                            "background-color": "red"
                        });
                    }
                }
            }
        });
    });
</script>