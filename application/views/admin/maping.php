<style>
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
        font-size: 10px;



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
                                                        <label for="Sales_Code">Sales Code
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
                                                            Distribution Channel Code </label>
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
                                                            Division Code
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
                                                            Customer Type Code </label>
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
                                                            Customer Group Code </label>
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
                                                    <table id="example"
                                                        class="display nowrap table table-bordered table-hover text-center"
                                                        style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th><input type="checkbox" id="select-all"></th> <!-- Master Checkbox -->
                                                                <th>Customer Name</th>
                                                                <th>Customer Code </th>
                                                                <th>Pin Code</th>
                                                                <th>City</th>
                                                                <th>District</th>
                                                                <th>Contact Number</th>
                                                                <th>Country</th>
                                                                <th>Zone</th>
                                                                <th>State</th>
                                                                <th>Population Strata 1
                                                                </th>
                                                                <th>Population Strata 2
                                                                </th>
                                                                <!-- <th>Country Group</th> -->
                                                                <th>GTM TYPE</th>
                                                                <th>Super Stockist</th>
                                                                <th>Status</th>
                                                                <th>Customer Type Name
                                                                </th>
                                                                <!-- <th>Customer Type Code
                                                                </th> -->
                                                                <th>Sales Name</th>
                                                                <!-- <th>Sales Code</th> -->
                                                                <th>Customer Group Name
                                                                </th>
                                                                <!-- <th>Customer Group Code
                                                                </th> -->
                                                                <th>Customer Creation Date
                                                                </th>
                                                                <th>Division Name</th>
                                                                <th>Division Code</th>
                                                                <th>Sector Name</th>
                                                                <th>Sector Code</th>
                                                                <!-- <th>State Code</th> -->
                                                                <!-- <th>Zone Code</th> -->
                                                                <th>Distribution Channel
                                                                    Name</th>
                                                                <th>Distribution Channel
                                                                    Code</th>



                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                        </tbody>


                                                    </table>



                                                    <div class="d-flex justify-content-between">
                                                        <p id="current_page_total_items_items_per_page">
                                                        </p>
                                                        <nav aria-label="Page navigation example">
                                                            <ul class="pagination" id="customPagination">
                                                            </ul>
                                                        </nav>
                                                    </div>
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

                                            <div class="col-12">
                                                <button type="submit" class="btn btnss setfont-btn">Submit</button> &#8202;
                                            </div>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    $(document).ready(function() {

        $('#treeView').on('click', 'span', function(event) {
            event.stopPropagation();

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
            if ($.fn.DataTable.isDataTable('#levelbase')) {
                $('#levelbase').DataTable().clear().destroy();
            }
            var table = $('#levelbase').DataTable({
                paging: true,
                searching: true,
                info: true,
                autoWidth: true,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                scrollY: "350px",
                scrollCollapse: true,
                fixedHeader: true,
                fixedFooter: true,
            });



            $('#treeView').find('li').removeClass('active');
            $(this).parent().addClass('active');
            let level = $(this).data('level');

            function setCheckedLevel(level, id, name, selecteddesignation_name) {
                localStorage.setItem('selectedLevel', level);
                localStorage.setItem('selectedId', id);
                localStorage.setItem('selectedName', name);
                localStorage.setItem('selecteddesignation_name', selecteddesignation_name);

                $('#level_' + level).val(id);
                $('#level_name_' + level).html(`Level ${level} ->  ` + name + ` -> ` +
                    selecteddesignation_name);

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


            $("#loader").show();

            $.ajax({
                url: '<?php echo base_url("admin/employeedata"); ?>',
                type: 'POST',
                data: {
                    level: level
                },
                success: function(response) {

                    $("#loader").hide();
                    try {

                        var data = JSON.parse(response);

                        if (data && data.status === "success" && Array.isArray(data.data)) {
                            const uniqueDesignationsWithLevel = [...new Set(data.data.map(
                                item => `${item.designation_name}-${item.level}`))];

                            const uniqueDesignationsArray = uniqueDesignationsWithLevel.map(
                                item => {
                                    const [designation_name, level] = item.split('-');
                                    return {
                                        designation_name,
                                        level
                                    };
                                });

                            const uniqueDesignationNames = uniqueDesignationsArray.map(item =>
                                item.designation_name).join(', ');

                            let uniname = $('#unicnme').html(
                                `For level  <strong> (${level})</strong> <br>  Select <strong> (${uniqueDesignationNames}) </strong>`
                            );

                        } else {
                            console.error("Data is not in the expected format.");

                        }

                        if (data.status === 'success' && data.data) {
                            table.clear();
                            $.each(data.data, function(index, item) {
                                table.row.add([
                                    '<input type="checkbox" class="row-checkbox_" id="' +
                                    item.level + '" data-designation_name="' +
                                    item.designation_name + '"   data-name="' +
                                    item.name + '" data-id="' + item.pjp_code +
                                    '">',
                                    escapeHtml(item.employer_code || 'N/A'),
                                    escapeHtml(item.name || 'N/A'),
                                    escapeHtml(item.mobile || 'N/A'),
                                    escapeHtml(item.state || 'N/A'),
                                    escapeHtml(item.designation_name || 'N/A'),
                                    escapeHtml(item.email || 'N/A'),


                                ]).draw();
                            });

                            $('.row-checkbox_').on('change', function() {
                                if ($(this).is(':checked')) {
                                    $('.row-checkbox_').not(this).prop('checked',
                                        false);

                                    var selectedLevel = $(this).attr('id');
                                    var selectedId = $(this).data('id');
                                    var selectedName = $(this).data('name');
                                    var selecteddesignation_name = $(this).data(
                                        'designation_name');


                                    setCheckedLevel(selectedLevel, selectedId,
                                        selectedName, selecteddesignation_name);

                                }
                            });

                        } else {
                            table.row.add(['No data found', '', '', '']).draw();
                        }
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                        table.row.add(['Error loading data', '', '', '']).draw();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error for Level ' + level + ':', error);
                    table.row.add(['Error fetching data', '', '', '']).draw();
                }
            });





            const nextSibling = $(this).next('ul');
            if (nextSibling.length > 0) {
                nextSibling.toggleClass('active');
            }
        });

        $(document).on('change', '.row-checkbox_', function() {
            if (!$(this).is(':checked')) {
                var selectedLevel = $(this).attr('id');
                var selectedName = $(this).data('name');

                localStorage.removeItem('selectedLevel');
                localStorage.removeItem('selectedId');
                localStorage.removeItem('selectedName');

                $('#level_' + selectedLevel).val('');

                $('#level_name_' + selectedLevel).html(
                    `Level ${selectedLevel}`);
            }
        });
    });
</script>







<script>
    $(document).ready(function() {

        function escapeHtml(unsafe) {
            if (typeof unsafe !== 'string') return '';
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().clear().destroy();
        }

        var table = $('#example').DataTable({
            paging: false,
            searching: true,
            info: false,
            autoWidth: true,
            scrollY: "550px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
            dom: '<"d-flex bd-highlight" id="om"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-download"></i> Download',
                filename: 'User_Dist.Mapping',
                titleAttr: 'Download as Excel',
                exportOptions: {}
            }]

        });

        $('.flex-grow-1').append(`
        <label class="ml-2">
            
            <select id="pageLengthSelect" class="form-select form-control-sm " aria-label="Select Page Length">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select> 
      
        </label>
    `);

        $('#pageLengthSelect').on('change', function() {
            var selectedLength = parseInt($(this).val(), 10);
            if (!isNaN(selectedLength)) {
                table.page.len(selectedLength).draw();
                fetchDataAndUpdate(getParams());
            }
        });

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
                        type: 'text',
                        id: 'hidden_' + distributorId,
                        name: 'distributors_code[]',
                        value: distributorId
                    }).appendTo('#hiddenFieldsContainer');
                } else {
                    $('#hidden_' + distributorId).remove();
                }
            });
        });


        function addRowToTable(item) {
            table.row.add([
                `<input type="checkbox" class="row-checkbox" data-id="${item.Customer_Code}"data-id="${item.Sales_Code}"data-id="${item.Distribution_Channel_Code}"data-id="${item.Division_Code}"data-id="${item.Customer_Type_Code}" data-id="${item.Customer_Group_Code}">`,
                escapeHtml(item.Customer_Name || 'N/A'),
                escapeHtml(item.Customer_Code || 'N/A'),
                escapeHtml(item.Pin_Code || 'N/A'),
                escapeHtml(item.City || 'N/A'),
                escapeHtml(item.District || 'N/A'),
                escapeHtml(item.Contact_Number || 'N/A'),
                escapeHtml(item.Country || 'N/A'),
                escapeHtml(item.Zone || 'N/A'),
                escapeHtml(item.State || 'N/A'),
                escapeHtml(item.Population_Strata_1 || 'N/A'),
                escapeHtml(item.Population_Strata_2 || 'N/A'),
                // escapeHtml(item.Country_Group || 'N/A'),
                escapeHtml(item.GTM_TYPE || 'N/A'),
                escapeHtml(item.SUPERSTOCKIST || 'N/A'),
                escapeHtml(item.STATUS || 'N/A'),
                escapeHtml(item.Customer_Type_Name || 'N/A'),
                // escapeHtml(item.Customer_Type_Code || 'N/A'),
                escapeHtml(item.Sales_Name || 'N/A'),
                // escapeHtml(item.Sales_Code || 'N/A'),
                escapeHtml(item.Customer_Group_Name || 'N/A'),
                // escapeHtml(item.Customer_Group_Code || 'N/A'),
                escapeHtml(item.Customer_Creation_Date || 'N/A'),
                escapeHtml(item.Division_Name || 'N/A'),
                escapeHtml(item.Division_Code || 'N/A'),
                escapeHtml(item.Sector_Name || 'N/A'),
                escapeHtml(item.Sector_Code || 'N/A'),
                // escapeHtml(item.State_Code || 'N/A'),
                // escapeHtml(item.Zone_Code || 'N/A'),
                escapeHtml(item.Distribution_Channel_Name || 'N/A'),
                escapeHtml(item.Distribution_Channel_Code || 'N/A'),
                escapeHtml(item.Level_1 || 'N/A'),
                escapeHtml(item.Level_1_Name || 'N/A'),
                escapeHtml(item.Level_1_employer_code || 'N/A'),
                escapeHtml(item.Level_1_designation_name || 'N/A'),
                `<div class="d-flex">
                    <a href="<?= site_url('admin/hierarchyedit') ?>?id=${item.id}&customer_name=${encodeURIComponent(item.Customer_Name || 'N/A')}" class="btn btn-primary">
                        <i class="fa-solid fa-pencil fa-fw"></i>
                    </a>
                    <a href="javascript:void(0);" data-id="${item.id}" class="delete-btn">
                        <button class="btn btn-primary">
                            <i class="fa-solid fa-trash fa-fw"></i>
                        </button>
                    </a>
                </div>`
            ]).draw();
        }

        function fetchData(url, params = {}) {
            $('#loader').show();
            $.ajax({
                url: url,
                method: 'POST',
                data: params,
                dataType: 'json',
                success: function(response) {
                    updatePagination(response.pagination);
                    $('#loader').hide();
                    table.clear();
                    if (response && response.Distributor) {
                        $.each(response.Distributor, function(index, item) {
                            addRowToTable(item);
                        });
                    } else {
                        table.row.add(['', '', '', '', '', 'no data', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                            '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                        ]).draw();
                    }

                },

                error: function() {
                    $('#loader').hide();
                    table.row.add(['An error occurred', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
                        '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                    ]).draw();
                }
            });
        }



        function updatePagination(pagination) {
            var paginationContainer = $('#customPagination');
            paginationContainer.empty();

            var startItem = (pagination.current_page - 1) * pagination.items_per_page + 1;
            var endItem = Math.min(pagination.current_page * pagination.items_per_page, pagination.total_items);
            $('#current_page_total_items_items_per_page').html(
                `Showing ${startItem} to ${endItem} of ${pagination.total_items} entries`
            );

            var currentPage = parseInt(pagination.current_page);
            var totalPages = parseInt(pagination.total_pages);
            var maxVisiblePages = 4;

            if (currentPage > 1) {
                paginationContainer.append(
                    '<li class="page-item"><a class="page-link" href="#" data-page="1">First</a></li>');
                paginationContainer.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (
                    currentPage - 1) + '">Previous</a></li>');
            }

            var startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            var endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage < maxVisiblePages - 1) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            for (var i = startPage; i <= endPage; i++) {
                var activeClass = (i === currentPage) ? 'active' : '';
                paginationContainer.append('<li class="page-item ' + activeClass +
                    '"><a class="page-link" href="#" data-page="' + i + '">' + i + '</a></li>');
            }

            if (currentPage < totalPages) {
                paginationContainer.append('<li class="page-item"><a class="page-link" href="#" data-page="' + (
                    currentPage + 1) + '">Next</a></li>');
                paginationContainer.append('<li class="page-item"><a class="page-link" href="#" data-page="' +
                    totalPages + '">Last</a></li>');
            }

            $('#customPagination .page-link').on('click', function(e) {
                e.preventDefault();
                var page = $(this).data('page');
                var params = getParams();
                params.page = page;

                fetchDataAndUpdate(params);
            });
        }

         fetchData('<?= site_url('admin/mapingajex'); ?>');
      
        function getParams() {
            return {
                Sales_Code: $('#Sales_Code').val() || null,
                Distribution_Channel_Code: $('#Distribution_Channel_Code').val() || null,
                Division_Code: $('#Division_Code').val() || null,
                Customer_Type_Code: $('#Customer_Type_Code').val() || null,
                Customer_Group_Code: $('#Customer_Group_Code').val() || null,
                Population_Strata_2: $('#Population_Strata_2').val() || null,
                Zone: $('#Zone').val() || null,
                page: parseInt($('#currentPage').val(), 10) || 1,
                items_per_page: parseInt($('#pageLengthSelect').val(), 10) || 10
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
            console.log("Unique Zone Data:", uniqueZone);

        }


        function fetchDataAndUpdate__(params) {
            $.ajax({
                url: "<?= site_url('admin/get-hierarchy-filter-options') ?>",
                type: "GET",
                data: params,
                success: function(response) {
                    updateSalesCodeDropdown(response);

                    console.log(response);
                    

                },
                error: function(error) {
                    console.error("AJAX Error:", error);
                }
            });
        }


        fetchDataAndUpdate__(getParams());
        function commonChangeHandler(triggerElement, affectedElements) {
            $(triggerElement).change(function() {
                affectedElements.forEach(function(element) {
                   // $(element).empty();
                });

                $('#hiddenFieldsContainer').empty();
                $('#select-all').prop('checked', false);
                fetchDataAndUpdate(getParams());
                $('#example').show();

                console.log(getParams());
                
            });
        }

        commonChangeHandler('#Sales_Code', ['#Distribution_Channel_Code', '#Division_Code', '#Customer_Type_Code', '#Customer_Group_Code', '#Population_Strata_2', '#Zone_Code']);
        commonChangeHandler('#Distribution_Channel_Code', ['#Division_Code', '#Customer_Type_Code', '#Customer_Group_Code', '#Population_Strata_2', '#Zone_Code']);
        commonChangeHandler('#Division_Code', ['#Customer_Type_Code', '#Customer_Group_Code', '#Population_Strata_2', '#Zone_Code']);
        commonChangeHandler('#Customer_Type_Code', ['#Customer_Group_Code', '#Population_Strata_2', '#Zone_Code']);
        commonChangeHandler('#Customer_Group_Code', ['#Population_Strata_2', '#Zone_Code']);
        commonChangeHandler('#Population_Strata_2', ['#Zone_Code']);
        commonChangeHandler('#Zone_Code', []);


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


<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">

<script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Reference to the form element
        const form = this;

        // Display SweetAlert confirmation dialog
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
                    // If confirmed, submit the form
                    form.submit();
                } else {
                    // If canceled, show cancellation message (optional)
                    swal("Cancelled", "Your form submission was canceled.", "error");
                }
            });
    });
</script>