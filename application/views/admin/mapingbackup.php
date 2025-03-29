<style>
    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        margin-bottom: 5px;
        display: block;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .form-select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
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


    .form-container {
        margin: 20px auto;
        padding: 20px;
        max-width: 100%;
        border: 1px solid #ccc;
        border-radius: 8px;

        background-color: #f9f9f9;
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

    /* Add custom styles if needed */
    .dataTables_wrapper .top {
        text-align: right;
        /* Align buttons to the right */
    }

    /* Ensure length menu is visible */
    .dataTables_length {
        display: block;
    }

    .dt-paging {
        float: right;
    }

    .dt-search {
        display: block !important;
        background-color: red;

    }

    .dt-buttons {
        float: right;
    }

    .dt-length label {
        display: none;
    }

    .buttons-excel {
        display: none !important;
    }

    tr th,
    tr td {
        text-align: center !important;
    }
</style>

<style>
    #example {
        table-layout: fixed;
        width: 100%;

    }


    th,
    td {
        padding: 8px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

    }

    /* .mgscd-menu .main-content .container-fluid {
        width: 1275px;
        max-width: 1375px;
    } */

    .table-responsive {
        width: 100%;

        /* Use max-width instead of width */
        overflow-x: auto;
        /* Allow horizontal scrolling */
        border: 1px solid #ddd;
        /* Optional: Add a border for better visibility */
        border-radius: 5px;
        /* Optional: Add rounded corners */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        /* Optional: Add a subtle shadow */
    }

    /* Optional: Style for the table inside the responsive container */
    .table-responsive table {
        width: 100%;
        border-collapse: collapse;
        /* Remove space between table cells */
    }

    .table-responsive th,
    .table-responsive td {
        padding: 12px;
        /* Add padding for better spacing */
        text-align: left;
        /* Align text to the left */
    }

    .table-responsive th {
        background-color: #f2f2f2;
        /* Optional: Add a background color for header */
    }



    th,
    td {
        padding: 8px;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;

    }
</style>







<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Add Mapping</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / Add Mapping</div>
            </div>
        </div>
    </header>
    <div class="main-content bg-clouds container">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <div class="form-container">
                                <form action="<?php echo site_url('admin/submit_maping'); ?>" method="post">

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
                                        <!-- Name -->


                                        <div class="card ">

                                            <div class="row">




                                                <!-- Level 1 -->
                                                <div class="col-md-4 mt-2">
                                                    <div class="form-group">
                                                        <label for="Sales_Code">VKORG (Sales_Code)
                                                        </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Sales_Code" name="Sales_Code">
                                                            <?php foreach ($distributors as $role): ?>
                                                                <option value="<?php echo $role['Sales_Code']; ?>">
                                                                    <?php echo $role['Sales_Code']; ?>
                                                                    <?php echo $role['Sales_Name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-4 mt-2">
                                                    <div class="form-group">
                                                        <label for="Distribution_Channel_Code">VTWEG
                                                            (Distribution_Channel_Code) </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Distribution_Channel_Code"
                                                            name="Distribution_Channel_Code">

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Division_Code">SPART
                                                            (Division_Code)
                                                        </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Division_Code" name="Division_Code">

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Customer_Type_Code">KATR1
                                                            (Customer_Type_Code) </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Customer_Type_Code" name="Customer_Type_Code">

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="Customer_Group_Code">KDGRP
                                                            (Customer_Group_Code) </label>
                                                        <select class="selectpicker form-control"
                                                            data-actions-box="true" aria-label="Default select example"
                                                            title="Please Select" data-size="5" data-live-search="true"
                                                            data-selected-text-format="count"
                                                            data-count-selected-text=" ({0} items selected)"
                                                            id="Customer_Group_Code" name="Customer_Group_Code">

                                                        </select>
                                                    </div>
                                                </div>



                                                <div class="d-flex flex-row-reverse mt-5">
                                                    <div class="col-md-3 ">
                                                        <input type="text" id="customSearch" class="form-control"
                                                            placeholder="Search...">

                                                    </div>
                                                </div>
                                                <div class="table-responsive">

                                                    <table id="example"
                                                        class="table table-bordered table-hover text-center">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th style="width: 150px;">Customer Name</th>
                                                                <th style="width: 150px;">Customer Code </th>
                                                                <th style="width: 150px;">Pin Code</th>
                                                                <th style="width: 150px;">City</th>
                                                                <th style="width: 150px;">District</th>
                                                                <th style="width: 150px;">Contact Number</th>
                                                                <th style="width: 150px;">Country</th>
                                                                <th style="width: 150px;">Zone</th>
                                                                <th style="width: 150px;">State</th>
                                                                <th style="width: 150px;">Population Strata 1
                                                                </th>
                                                                <th style="width: 150px;">Population Strata 2
                                                                </th>
                                                                <th style="width: 150px;">Country Group</th>
                                                                <th style="width: 150px;">GTM TYPE</th>
                                                                <th style="width: 150px;">Super Stockist</th>
                                                                <th style="width: 150px;">Status</th>
                                                                <th style="width: 150px;">Customer Type Code
                                                                </th>
                                                                <th style="width: 150px;">Sales Code</th>
                                                                <th style="width: 150px;">Customer Type Name
                                                                </th>
                                                                <th style="width: 150px;">Customer Group Code
                                                                </th>
                                                                <th style="width: 150px;">Customer Creation Date
                                                                </th>
                                                                <th style="width: 150px;">Division Code</th>
                                                                <th style="width: 150px;">Sector Code</th>
                                                                <th style="width: 150px;">State Code</th>
                                                                <th style="width: 150px;">Zone Code</th>
                                                                <th style="width: 150px;">Distribution Channel
                                                                    Code</th>
                                                                <th style="width: 150px;">Distribution Channel
                                                                    Name</th>
                                                                <th style="width: 150px;">Customer Group Name
                                                                </th>
                                                                <th style="width: 150px;">Sales Name</th>
                                                                <th style="width: 150px;">Division Name</th>
                                                                <th style="width: 150px;">Sector Name</th>

                                                            </tr>
                                                        </thead>

                                                        <tbody>




                                                        </tbody>


                                                    </table>
                                                </div>

                                            </div>




                                        </div>
                                        <hr>


                                        <br>
                                        <style>
                                            /* Tree structure styles */
                                            ul {
                                                list-style-type: none;
                                            }

                                            #treeView li {
                                                margin-left: -18px;

                                                /* margin-left: 1px; */
                                                cursor: pointer;
                                                padding: 10px 0;
                                            }

                                            #treeView li span {
                                                /* margin-left: 1px; */

                                                background-color: #484848;
                                                color: #ffff;
                                                width: 400px;
                                                border: 1px solid gray;
                                                padding: 10px 30px;
                                                line-height: 43px;



                                            }


                                            /* Highlight active level */
                                            /* .active span {
                                            background-color: green !important;
                                        } */

                                            #treeView {
                                                margin-left: -12px;
                                                border: 1px solid gray;
                                            }




                                            .nested {
                                                display: block;
                                                /* Display all levels by default */
                                            }
                                        </style>
                                        <div class="col-md-12 card">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <ul id="treeView">
                                                            <li class="open">
                                                                <span data-level="1" id="level_name_1">Level 1</span>
                                                                <ul class="nested active">
                                                                    <li class="open">
                                                                        <span data-level="2" id="level_name_2">Level
                                                                            2</span>
                                                                        <ul class="nested active">
                                                                            <li class="open">
                                                                                <span data-level="3"
                                                                                    id="level_name_3">Level 3</span>
                                                                                <ul class="nested active">
                                                                                    <li class="open">
                                                                                        <span data-level="4"
                                                                                            id="level_name_4">Level
                                                                                            4</span>
                                                                                        <ul class="nested active">
                                                                                            <li class="open">
                                                                                                <span data-level="5"
                                                                                                    id="level_name_5">Level
                                                                                                    5</span>
                                                                                                <ul
                                                                                                    class="nested active">
                                                                                                    <li class="open">
                                                                                                        <span
                                                                                                            data-level="6"
                                                                                                            id="level_name_6">Level
                                                                                                            6</span>
                                                                                                        <ul
                                                                                                            class="nested active">
                                                                                                            <li
                                                                                                                class="open">
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


                                                        <script>
                                                            // Toggle the display of nested lists when clicked
                                                            const treeItems = document.querySelectorAll(
                                                                "#treeView li > span");

                                                            treeItems.forEach(item => {
                                                                item.addEventListener("click", function() {
                                                                    const nextSibling = this
                                                                        .nextElementSibling;
                                                                    if (nextSibling) {
                                                                        nextSibling.classList.toggle(
                                                                            "active");
                                                                        this.parentElement.classList.toggle(
                                                                            "open");
                                                                    }
                                                                });
                                                            });
                                                        </script>


                                                    </div>

                                                    <div class="col-md-9">


                                                        <div class="d-flex flex-row-reverse mt-5">
                                                            <div class="col-md-3 ">
                                                                <input type="text" id="empSearch" class="form-control"
                                                                    placeholder="Search...">

                                                            </div>
                                                        </div>
                                                        <div class="table-responsive">

                                                            <table id="levelbase"
                                                                class="table table-bordered table-hover text-center">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th style="width: 150px;">Customer Code </th>
                                                                        <th style="width: 150px;">level</th>

                                                                        <th style="width: 150px;">Pin Code</th>
                                                                        <th style="width: 150px;">City</th>


                                                                    </tr>
                                                                </thead>

                                                                <tbody>




                                                                </tbody>


                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                            <input type="hidden" value="" name="level1" id="level_1">
                                            <input type="hidden" value="" name="level2" id="level_2">
                                            <input type="hidden" value="" name="level3" id="level_3">
                                            <input type="hidden" value="" name="level4" id="level_4">
                                            <input type="hidden" value="" name="level5" id="level_5">
                                            <input type="hidden" value="" name="level6" id="level_6">
                                            <input type="hidden" value="" name="level7" id="level_7">




                                            <div id="hiddenFieldsContainer"></div>


                                            <div class="col-12">

                                                <button type="submit" class="btn btnss">Submit</button> &#8202;

                                            </div>
                                            <br>

                                        </div>




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
    $(document).ready(function() {
        // Add click event to spans to handle AJAX call and toggle active class
        $('#treeView').on('click', 'span', function(event) {
            event.stopPropagation(); // Prevent triggering the parent level's event

            // Function to escape HTML
            function escapeHtml(unsafe) {
                if (typeof unsafe !== 'string') {
                    return ''; // Return an empty string if not a string
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
                scrollY: "550px",
                scrollCollapse: true,
                fixedHeader: true,
                fixedFooter: true,
                dom: '<"top"lB>rt<"bottom"ip><"clear">',
                buttons: ['excel']
            });

            // Custom Download Button Event
            // Custom search functionality
            $('#empSearch').on('keyup', function() {
                table.search(this.value).draw();
            });

            // Remove the active class from all levels
            $('#treeView').find('li').removeClass('active');

            // Add active class to the clicked item
            $(this).parent().addClass('active');

            // Fetch the data-level attribute (which level was clicked)
            let level = $(this).data('level');

            // Function to set the value in local storage and hidden field selectedName
            function setCheckedLevel(level, id, name) {
                localStorage.setItem('selectedLevel', level);
                localStorage.setItem('selectedId', id);
                localStorage.setItem('selectedName', name);

                $('#level_' + level).val(id);
                $('#level_name_' + level).html(`Level ${level}  ` + name);

            }

            // Function to restore the checkbox state from local storage
            function restoreCheckedLevel() {
                var storedLevel = localStorage.getItem('selectedLevel');
                var storedId = localStorage.getItem('selectedId');

                if (storedLevel && storedId) {
                    $('#' + storedLevel).prop('checked', true);
                    $('#level_' + storedLevel).val(storedId);
                }
            }

            // Restore the checkbox state when the page loads
            restoreCheckedLevel();

            // Make the AJAX call
            $.ajax({
                url: '<?php echo base_url("admin/employeedata"); ?>',
                type: 'POST',
                data: {
                    level: level
                },
                success: function(response) {
                    console.log('AJAX response for Level ' + level + ':', response);
                    try {
                        var data = JSON.parse(response);

                        if (data.status === 'success' && data.data) {
                            table.clear(); // Clear existing table data
                            $.each(data.data, function(index, item) {
                                table.row.add([
                                    '<input type="checkbox" class="row-checkbox_" id="' +
                                    item.level + '" data-name="' + item.name +
                                    '" data-id="' + item.pjp_code + '">',
                                    escapeHtml(item.id || 'N/A'),
                                    escapeHtml(item.level || 'N/A'),
                                    escapeHtml(item.name || 'N/A'),
                                    escapeHtml(item.email || 'N/A')
                                ]).draw(); // Draw the table with new data
                            });

                            // Add event listener for checkbox click
                            $('.row-checkbox_').on('change', function() {
                                if ($(this).is(':checked')) {
                                    // Uncheck all other checkboxes
                                    $('.row-checkbox_').not(this).prop('checked',
                                        false);

                                    // Get the selected level, id, and name
                                    var selectedLevel = $(this).attr('id');
                                    var selectedId = $(this).data('id');
                                    var selectedName = $(this).data('name');

                                    // Set checked level and id in local storage
                                    setCheckedLevel(selectedLevel, selectedId,
                                        selectedName);
                                    console.log('Selected level:', selectedLevel,
                                        'Selected ID:', selectedId,
                                        'Selected name:', selectedName);
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

            // Optionally toggle nested levels
            const nextSibling = $(this).next('ul');
            if (nextSibling.length > 0) {
                nextSibling.toggleClass('active');
            }
        });

        // Event listener for checkbox changes
        $(document).on('change', '.row-checkbox_', function() {
            // If unchecked, clear the input and local storage
            if (!$(this).is(':checked')) {
                var selectedLevel = $(this).attr('id'); // Get the checkbox ID
                var selectedName = $(this).data('name'); // Get the checkbox data-name

                // Clear local storage for the unselected checkbox
                localStorage.removeItem('selectedLevel');
                localStorage.removeItem('selectedId');
                localStorage.removeItem('selectedName');

                // Clear the hidden input field
                $('#level_' + selectedLevel).val(''); // Clear the corresponding hidden input

                // Update the level name display
                $('#level_name_' + selectedLevel).html(
                    `Level ${selectedLevel}`); // Make sure the selector is correct
            }
        });
    });
</script>









<script>
    $(document).ready(function() {

        function escapeHtml(unsafe) {
            if (typeof unsafe !== 'string') return ''; // Return empty if not a string
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }

        // Check if DataTable is already initialized and destroy it if so
        if ($.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable().clear().destroy();
        }

        var table = $('#example').DataTable({
            paging: true,
            searching: true,
            info: true,
            autoWidth: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            scrollY: "550px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
            dom: '<"top"lB>rt<"bottom"ip><"clear">',
            buttons: ['excel'] // Default Excel export button
        });



        // Custom search functionality
        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#example').hide();


        // Checkbox event listener
        $(document).on('change', '.row-checkbox', function() {
            var distributorId = $(this).data('id'); // Get the data-id of the checkbox
            if ($(this).is(':checked')) {
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

        $('#loader').show();


        function addRowToTable(item) {
            table.row.add([
                `<input type="checkbox" class="row-checkbox" data-id="${item.Customer_Code}">`,
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
                escapeHtml(item.Country_Group || 'N/A'),
                escapeHtml(item.GTM_TYPE || 'N/A'),
                escapeHtml(item.SUPERSTOCKIST || 'N/A'),
                escapeHtml(item.STATUS || 'N/A'),
                escapeHtml(item.Customer_Type_Code || 'N/A'),
                escapeHtml(item.Sales_Code || 'N/A'),
                escapeHtml(item.Customer_Type_Name || 'N/A'),
                escapeHtml(item.Customer_Group_Code || 'N/A'),
                escapeHtml(item.Customer_Creation_Date || 'N/A'),
                escapeHtml(item.Division_Code || 'N/A'),
                escapeHtml(item.Sector_Code || 'N/A'),
                escapeHtml(item.State_Code || 'N/A'),
                escapeHtml(item.Zone_Code || 'N/A'),
                escapeHtml(item.Distribution_Channel_Code || 'N/A'),
                escapeHtml(item.Distribution_Channel_Name || 'N/A'),
                escapeHtml(item.Customer_Group_Name || 'N/A'),
                escapeHtml(item.Sales_Name || 'N/A'),
                escapeHtml(item.Division_Name || 'N/A'),
                escapeHtml(item.Sector_Name || 'N/A'),
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
            console.log("params", params);
            $('#loader').show();
            $.ajax({
                url: url,
                method: 'POST',
                data: params,
                dataType: 'json',
                success: function(response) {
                    $('#loader').hide();
                    table.clear();
                    if (response && response.Distributor) {
                        $.each(response.Distributor, function(index, item) {
                            addRowToTable(item); // Add new rows to the table
                        });
                    } else {
                        table.row.add(['No data found', ...Array(28).fill('')])
                            .draw(); // Show no data found
                    }




                    populateDropdowns(response.Distributor);

                    function populateDropdowns(mapingData) {

                        console.log("mapingData", mapingData);

                        var salesCodeDropdown = $('#Sales_Code');
                        var distributionChannelDropdown = $('#Distribution_Channel_Code');
                        var divisionCodeDropdown = $('#Division_Code');
                        var customerTypeDropdown = $('#Customer_Type_Code');
                        var customerGroupDropdown = $('#Customer_Group_Code');

                        // Collect unique zones


                        // Collect unique sales codes
                        var uniqueSalesCodes = {};
                        $.each(mapingData, function(index, item) {
                            if (item.Sales_Code) {
                                uniqueSalesCodes[item.Sales_Code] = item.Sales_Name;
                            }
                        });
                        $.each(uniqueSalesCodes, function(code, name) {
                            if (!salesCodeDropdown.find('option[value="' + escapeHtml(code) +
                                    '"]').length) {
                                salesCodeDropdown.append('<option value="' + escapeHtml(code) +
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
                            if (!distributionChannelDropdown.find('option[value="' + escapeHtml(
                                    code) + '"]').length) {
                                distributionChannelDropdown.append('<option value="' +
                                    escapeHtml(code) + '">' + escapeHtml(name) + ' ' +
                                    escapeHtml(
                                        code) + '</option>'
                                );
                            }
                        });


                        console.log("uniqueChannels", uniqueChannels);


                        distributionChannelDropdown.selectpicker('refresh');

                        // Collect unique division codes
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
                                        code) + '">' + escapeHtml(name) + ' ' +
                                    escapeHtml(
                                        code) + '</option>');
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
                            if (!customerTypeDropdown.find('option[value="' + escapeHtml(code) +
                                    '"]').length) {
                                customerTypeDropdown.append('<option value="' + escapeHtml(
                                        code) + '">' + escapeHtml(name) + ' ' +
                                    escapeHtml(
                                        code) + '</option>');
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
                                        code) + '">' + escapeHtml(name) + ' ' +
                                    escapeHtml(
                                        code) + '</option>');
                            }
                        });
                        customerGroupDropdown.selectpicker('refresh');


                    }


                },
                error: function() {
                    $('#loader').hide(); // Hide loader on error
                    table.row.add(['An error occurred', '', '', '', '', '', '', '', '', '', '', '', '',
                        '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                    ]).draw();
                }
            });
        }

        // Fetch initial data
        fetchData('<?= site_url('admin/mapingajex'); ?>');

        function getParams() {
            return {
                Sales_Code: $('#Sales_Code').val() || null,
                Distribution_Channel_Code: $('#Distribution_Channel_Code').val() || null,
                Division_Code: $('#Division_Code').val() || null,
                Customer_Type_Code: $('#Customer_Type_Code').val() || null,
                Customer_Group_Code: $('#Customer_Group_Code').val() || null,
            };
        }

        function fetchDataAndUpdate() {
            var params = getParams();
            fetchData('<?= site_url('admin/mapingajex'); ?>', params);
        }

        // Handle dropdown change events
        $('#Sales_Code').change(function() {
            $('#Distribution_Channel_Code').empty();
            $('#Division_Code').empty();
            $('#Customer_Type_Code').empty();
            $('#Customer_Group_Code').empty();
            fetchDataAndUpdate();
        });

        $('#Distribution_Channel_Code').change(function() {
            $('#Division_Code').empty();
            $('#Customer_Type_Code').empty();
            $('#Customer_Group_Code').empty();
            fetchDataAndUpdate();
        });

        $('#Division_Code').change(function() {
            $('#Customer_Type_Code').empty();
            $('#Customer_Group_Code').empty();
            fetchDataAndUpdate();
        });

        $('#Customer_Type_Code').change(function() {
            $('#Customer_Group_Code').empty();
            fetchDataAndUpdate();
        });

        $('#Customer_Group_Code').change(function() {
            fetchDataAndUpdate();
            $('#example').show();
        });

    });
</script>