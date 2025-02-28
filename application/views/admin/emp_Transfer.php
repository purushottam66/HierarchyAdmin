<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css" class="rel">

<style>
    .btnss {
        padding: 10px 20px;
        background-color: #fb7d02;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-left: 20px;
    }

    .btnss:hover {
        background-color: #0a6867;
        color: #ffff;
    }
</style>





<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">User Movement Transfer</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">User Movement</a> / Transfer
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

                            <form id="saveReplaceForm" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <label for="customer-group-code-filter">Select Level With Name :</label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                aria-label="Default select example" title="Select an employee"
                                                data-size="5" data-live-search="true" data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="level"
                                                name="level">
                                                <option value="" disabled selected>Select an employee</option>


                                                <?php if (isset($employees) && !empty($employees)) : ?>
                                                    <?php foreach ($employees as $employee) : ?>
                                                        <?php if (is_array($employee) && isset($employee['id'])) : ?>
                                                            <option
                                                                data-name="<?php echo isset($employee['name']) ? $employee['name'] : ''; ?>"
                                                                data-City="<?php echo isset($employee['City']) ? $employee['City'] : ''; ?>"
                                                                data-pjp_code="<?php echo isset($employee['pjp_code']) ? $employee['pjp_code'] : ''; ?>"
                                                                value="<?php echo isset($employee['level']) ? $employee['level'] : ''; ?>">
                                                                <?php echo isset($employee['name']) ? $employee['name'] : 'N/A'; ?>
                                                                ( <?php echo isset($employee['designation_name']) ? $employee['designation_name'] : 'N/A'; ?> )
                                                                ( <?php echo isset($employee['City']) ? $employee['City'] : 'N/A'; ?> )
                                                                ( <?php echo isset($employee['level']) ? $employee['level'] : 'N/A'; ?> )
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="N/A">No employees available</option>
                                                <?php endif; ?>


                                            </select>

                                            <input type="hidden" class="form-control" readonly
                                                name="selectedEmployeesselectedValue"
                                                id="selectedEmployeesselectedValue" />


                                            <div id="hiddenFieldsContainer"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <label for="state">state:</label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                title="Select state" data-size="5" data-live-search="true" id="state"
                                                name="state">
                                                <?php if (!empty($unique_State)) : ?>
                                                    <?php foreach ($unique_State as $unique_State__) : ?>
                                                        <?php if ($unique_State__ !== null) : ?>
                                                            <option value="<?php echo htmlspecialchars($unique_State__); ?>">
                                                                <?php echo htmlspecialchars($unique_State__); ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="N/A">No available</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <label for="city"> city:</label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                title="Select City" data-size="5" data-live-search="true" id="city"
                                                name="city">
                                                <option value="N/A">Select a state first</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <label for="Zone"> Zone:</label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                title="Select Zone" data-size="5" data-live-search="true" name="Zone" id="Zone__">
                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-md-3">
                                        <div class="form-group p-b-10 ">
                                            <label for="customer-group-code-filter">Replace with Employee :</label>
                                            <input type="text" class="form-control" readonly id="selectedEmployees" />
                                            <input type="hidden" class="form-control" readonly name="set_pjp_code" id="selectedEmployeespjp_code" />
                                            <div id="hiddenDB_Code"></div>
                                        </div>
                                    </div>


                                    <div class="col-md-3" id="vacant-container">
                                        <div class="form-group p-b-10">
                                            <label for="Vacent_Employee" id="v_cent"></label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="Vacent_Employee"
                                                name="Vacant" aria-label="Select Vacent_Employee">

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <div id="Replacing_emp_code"></div>
                                        </div>
                                    </div>


                                </div>
                                <div class="d-flex flex-row-reverse bd-highlight">
                                    <?php

                                    $hasPermission = false;
                                    if (is_array($permissions)) {
                                        foreach ($permissions as $p) {
                                            if ($p['module_name'] === "User Movement" && $p['edit'] === "yes") {
                                                $hasPermission = true;
                                                break;
                                            }
                                        }
                                    }
                                    ?>


                                    <?php if ($hasPermission): ?>
                                        <button type="submit" class="btn btnss">Save & Replace</button>
                                    <?php endif; ?>

                                </div>
                            </form>


                            <div class="card mt-3">
                                <div class="table-responsive p-3">
                                    <h5 class="mt-2 text-center ">
                                        Distributor List of :
                                        <span id="addname3_text"></span>
                                    </h5>

                                    <table id="exampley"
                                        class="display nowrap table table-bordered table-hover text-center"
                                        style="width:100%">

                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Customer Name</th>
                                                <th>Customer Code </th>
                                                <th>Pin Code</th>
                                                <th>City</th>
                                                <th>District</th>
                                                <th>Contact Number</th>
                                                <th>Country</th>
                                                <th>Zone</th>
                                                <th>State</th>
                                                <th>Population Strata 1</th>
                                                <th>Population Strata 2</th>
                                                <th>Country Group</th>
                                                <th>GTM TYPE</th>
                                                <th>Super Stockist</th>
                                                <th>Status</th>

                                                <th>Sales Code</th>
                                                <th>Sales Name</th>
                                                <th>Distribution Channel Code</th>
                                                <th>Distribution Channel Name</th>

                                                <th>Division Code</th>
                                                <th>Division Name</th>

                                                <th>Customer Type Code</th>
                                                <th>Customer Type Name</th>

                                                <th>Customer Group Code</th>
                                                <th>Customer Group Name</th>

                                                <th>Customer Creation Date</th>

                                                <th>Sector Code</th>
                                                <th>State Code</th>
                                                <th>Zone Code</th>

                                                <th>Sector Name</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>

                                    <div id="pagination"></div>


                                </div>





                            </div>




                            <div class="card mt-3">
                                <div class="table-responsive p-3">
                                    <h5 class="mt-2 text-center ">
                                        Select Employee to Replace : <span id="name_add2"></span>

                                    </h5>

                                    <table id="employeeTable"
                                        class="display nowrap table table-bordered table-hover text-center"
                                        style="width:100%">

                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center ">ID</th>
                                                <th class="text-center ">Name</th>
                                                <th class="text-center ">Email</th>
                                                <th class="text-center ">employee code</th>
                                                <th class="text-center ">Designation</th>
                                                <th class="text-center ">Status</th>
                                                <th class="text-center ">State</th>
                                                <th class="text-center ">City</th>
                                                <th class="text-center ">Level</th>


                                            </tr>
                                        </thead>
                                        <tbody id="EmployeeList">


                                        </tbody>

                                    </table>


                                    <div id="updatePagination_Replace"></div>


                                </div>
                            </div>




                            <div class="card mt-3">
                                <div class="table-responsive p-3">
                                    <h5 class="text-center">
                                        Distributor List of : <span id="selectedEmployeeName"></span>

                                    </h5>

                                    <table id="employeedb"
                                        class="display nowrap table table-bordered table-hover text-center"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Customer Name</th>
                                                <th>Customer Code </th>
                                                <th>Pin Code</th>
                                                <th>City</th>
                                                <th>District</th>
                                                <th>Contact Number</th>
                                                <th>Country</th>
                                                <th>Zone</th>
                                                <th>State</th>
                                                <th>Population Strata 1</th>
                                                <th>Population Strata 2</th>
                                                <th>Country Group</th>
                                                <th>GTM TYPE</th>
                                                <th>Super Stockist</th>
                                                <th>Status</th>

                                                <th>Sales Code</th>
                                                <th>Sales Name</th>
                                                <th>Distribution Channel Code</th>
                                                <th>Distribution Channel Name</th>

                                                <th>Division Code</th>
                                                <th>Division Name</th>

                                                <th>Customer Type Code</th>
                                                <th>Customer Type Name</th>

                                                <th>Customer Group Code</th>
                                                <th>Customer Group Name</th>

                                                <th>Customer Creation Date</th>

                                                <th>Sector Code</th>
                                                <th>State Code</th>
                                                <th>Zone Code</th>

                                                <th>Sector Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>


                                    <div class="id" id="pagination_emp">


                                    </div>

                                </div>
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
        $('#saveReplaceForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            const form = this; // Reference to the form element

            swal({
                    title: "Are you sure?",
                    text: "Do you want to proceed with the form submission?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'No, cancel!',
                    closeOnConfirm: true,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {

                        toastr.success("Form submission wait.");

                        $("#loader").show();



                        submitForm(form);
                    } else {
                        toastr.info("Form submission canceled.");
                    }
                });


        });
    });


    function submitForm(form) {



        const formData = $(form).serialize();
        const decodedData = decodeURIComponent(formData);

        const params = new URLSearchParams(decodedData);
        const parsedObject = {};

        // Convert each parameter to a key-value pair
        params.forEach((value, key) => {
            // Handle DB_Code[] as an array
            if (key === "DB_Code[]") {
                if (!parsedObject[key]) {
                    parsedObject[key] = [];
                }
                parsedObject[key].push(JSON.parse(value)); // Parse JSON string to object
            } else {
                parsedObject[key] = value; // Simple key-value pair
            }
        });



        const $submitButton = $(this).find('button[type="submit"]');
        $submitButton.prop('disabled', true).text('Saving...');

        // Log the serialized string


        // Send the form data via AJAX
        $.ajax({
            url: '<?php echo site_url("admin/Save_Replace_emp_Transfer"); ?>', // Your server-side URL
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success response
                let parsedResponse = JSON.parse(response);
                $('#hiddenDB_Code').empty();
                $('#hiddenFieldsContainer').empty();
                if (parsedResponse.status == 'success') {
                    toastr.success(parsedResponse.message); // Show success toast with dynamic message
                    window.location.href = '<?php echo site_url("admin/UserMovement"); ?>?message=' + encodeURIComponent(parsedResponse.message) + '&status=success';

                } else if (parsedResponse.status == 'error') {
                    toastr.error(parsedResponse.message); // Show error toast with dynamic message
                } else {
                    toastr.info("Unexpected response status"); // Handle unexpected status
                }

                // Optionally reset the form or update the UI
                $('#saveReplaceForm')[0].reset();
                $('.selectpicker').selectpicker('refresh');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error('Error:', error);
                console.error('Response:', xhr.responseText);
            },
            complete: function() {
                // Re-enable the button
                $submitButton.prop('disabled', false).text('Save & Replace');
            }
        });

    }
</script>


<script>
    $(document).ready(function() {
        $('#vacant-container').hide();

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

        var table = $('#employeeTable').DataTable({
            paging: false,
            searching: true,
            info: false,
            autoWidth: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            scrollY: "350px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
        });



        let left_emp_city = '';
        let selectedValue = '';
        let pjpCode = '';

        var selectedEmployeepjp_code = '';
        var empresponse = '';

        function updateSelectedLevel() {
            selectedValue = $('#level').val();
            var selectedOption = $('#level').find(':selected');
            left_emp_city = selectedOption.data('city');
            pjpCode = selectedOption.data('pjp_code');

        }





        $('#level').change(function() {
            var selectedValue = $(this).val();
            updateSelectedLevel();

            $('#hiddenDB_Code').empty();
            $('#hiddenFieldsContainer').empty();
            var selectedOption = $(this).find(':selected');
            var selectedValue = selectedOption.val();
            left_emp_city = selectedOption.data('city');
            name_add = selectedOption.data('name');

            $('#name_add').text(name_add)
            $('#name_add2').text(name_add)

            var selected_text = selectedOption.text();

            $('#addname3_text').html(selected_text);

            var pjpCode = selectedOption.data('pjp_code');
            $('#selectedEmployeesselectedValue').val(pjpCode);
            if (selectedValue > 7) {
                selectedValue = 7;
            }

            fetchEmployees(selectedValue, pjpCode, 1); // Default Page 1 पर लोड करें



        });




        function fetchEmployees(selectedValue, pjpCode, pageNumber, search) {

            $.ajax({
                url: '<?= site_url('admin/empreplace_level'); ?>',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    level: selectedValue,
                    pjpCode: pjpCode,
                    page: pageNumber,
                    search: search
                }),
                success: function(response) {
                    var response = JSON.parse(response);
                    empresponse = response;

                    $("#selectedEmployeespjp_code").val(null);
                    $("#selectedEmployees").val(null);
                    updatePagination_Replace(response);

                    table.clear();
                    if (response.employees && response.employees.length > 0) {
                        $.each(response.employees, function(index, employee) {
                            if (employee.id && employee.name) {
                                table.row.add([
                                    '<input type="radio" name="employeeSelect_emp" class="employee-radio" data-emp_City="' +
                                    employee.City + '" data-level="' +

                                    employee.level + '" data-pjp_code="' +


                                    employee.pjp_code + '" data-id="' +
                                    employee.designation_name + '" data-designation_name="' +
                                    employee.id + '" data-name="' + escapeHtml(
                                        employee.name) + '">', employee.id,
                                    escapeHtml(employee.name),
                                    escapeHtml(employee.email),
                                    escapeHtml(employee.employer_code),
                                    escapeHtml(employee.designation_name),
                                    escapeHtml(employee.employee_status),
                                    escapeHtml(employee.state),
                                    escapeHtml(employee.City),
                                    escapeHtml(employee.level)
                                ]).draw();
                            }
                        });
                    } else {
                        table.row.add(['', '', '', '', '', '', '', '', "",
                            'No employees available'
                        ]).draw();
                    }

                    addRadioEventListeners();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });

        }



        function updatePagination_Replace(response) {
            console.log("updatePagination", response);
            var currentPage = parseInt(response.page);
            var totalPages = parseInt(response.total_pages);
            var totalRecords = parseInt(response.total_records);
            var limit = parseInt(response.limit);
            var paginationHtml = '';

            var start = ((currentPage - 1) * limit) + 1;
            var end = Math.min(start + limit - 1, totalRecords);

            paginationHtml += '<div class="d-flex align-items-center justify-content-between mb-2">';
            paginationHtml += '<div class="pagination-info">';
            paginationHtml += 'Showing ' + start + ' to ' + end + ' of ' + totalRecords + ' entries';
            paginationHtml += '</div>';

            if (totalPages > 1) {
                paginationHtml += '<ul class="pagination mb-0">';

                if (currentPage > 1) {
                    paginationHtml += '<li class="page-item"><a class="page-link prev-page__prev" href="#" data-page="1">First</a></li>';
                    paginationHtml += '<li class="page-item"><a class="page-link prev-page__prev" href="#" data-page="' + (currentPage - 1) + '">Previous</a></li>';
                }

                var startPage, endPage;
                if (totalPages <= 5) {
                    startPage = 1;
                    endPage = totalPages;
                } else {
                    if (currentPage <= 3) {
                        startPage = 1;
                        endPage = 5;
                    } else if (currentPage + 2 >= totalPages) {
                        startPage = totalPages - 4;
                        endPage = totalPages;
                    } else {
                        startPage = currentPage - 2;
                        endPage = currentPage + 2;
                    }
                }

                for (var i = startPage; i <= endPage; i++) {
                    if (i === currentPage) {
                        paginationHtml += '<li class="page-item active"><a class="page-link" href="#">' + i + '</a></li>';
                    } else {
                        paginationHtml += '<li class="page-item"><a class="page-link page-number_next" href="#" data-page="' + i + '">' + i + '</a></li>';
                    }
                }

                if (currentPage < totalPages) {
                    paginationHtml += '<li class="page-item"><a class="page-link next-page__next" href="#" data-page="' + (currentPage + 1) + '">Next</a></li>';
                    paginationHtml += '<li class="page-item"><a class="page-link next-page__next" href="#" data-page="' + totalPages + '">Last</a></li>';
                }

                paginationHtml += '</ul>';
            }
            paginationHtml += '</div>';

            $('#updatePagination_Replace').html(paginationHtml);

            $('.page-number_next, .prev-page__prev, .next-page__next').off('click').on('click', function(e) {
                e.preventDefault();
                var pageNumber = $(this).data('page');
                fetchEmployees($('#level').val(), $('#selectedEmployeesselectedValue').val(), pageNumber);
            });
        }

        function escapeHtml(text) {
            return $('<div/>').text(text).html();
        }

        function addRadioEventListeners() {
            $('.employee-radio').on('change', function() {
                var selectedName = $(this).data('name');
                var selectedID = $(this).data('id');

            });
        }



        $("#dt-search-0").keyup(function() {
            var search = $(this).val();
            var selectedValue = $('#level').val(); // लेवल का वैल्यू
            var pjpCode = $('#selectedEmployeesselectedValue').val(); // PJP Code

            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(function() {
                fetchEmployees(selectedValue, pjpCode, 1, search); // सर्च वैल्यू भेजें
            }, 500);
        });


        function addRadioEventListeners() {
            let selectedLevel;
            let selectedPjpCode;

            $('.employee-radio').on('change', function() {
                var selectedData = $(this).data();
                selectedLevel = selectedData.level;
                selectedPjpCode = selectedData.pjp_code;

                var city__ = $(this).attr('data-emp_city');
                var level = $(this).attr('data-level');
                var pjpCode = $(this).attr('data-pjp_code');
                var id = $(this).attr('data-id');
                var designationName = $(this).attr('data-designation_name');
                var name = $(this).attr('data-name');

                let mydata = `${selectedData.name}  (${selectedData.id}) (${selectedData.emp_city}) (${selectedData.level})`;
                $('#selectedEmployees').val(mydata);

                selectedEmployeeName = selectedData.name;
                selectedEmployeepjp_code = selectedData.pjp_code;
                $('#selectedEmployeeName').html(selectedEmployeeName);

                $('#v_cent').html("Replacement User for - " + selectedData.name);

                $('#selectedEmployeespjp_code').val(selectedData.pjp_code);
                let city = selectedData.emp_city
                if (city === left_emp_city) {
                    console.log("City matches!");
                    $('#vacant-container').hide()
                } else {
                    console.log("City does not match.");
                }

                if ($.fn.DataTable.isDataTable('#employeedb')) {
                    $('#employeedb').DataTable().clear().destroy();
                }

                var table = $('#employeedb').DataTable({
                    paging: false,
                    searching: false,
                    info: false,
                    autoWidth: true,
                    pageLength: 10,
                    lengthMenu: [10, 25, 50, 100],
                    scrollY: "350px",
                    scrollCollapse: true,
                    fixedHeader: true,
                    fixedFooter: true,
                });

                // Load initial data with page 1
                loadTableData(1);

                function loadTableData(page) {
                    $.ajax({
                        url: '<?= site_url('admin/pjp_code_emp_Left'); ?>',
                        type: 'POST',
                        data: {
                            level: selectedLevel,
                            pjp_code: selectedPjpCode,
                            page: page,
                            limit: 20
                        },
                        success: function(response) {
                            if (response) {
                                var response = JSON.parse(response);
                                console.log("response", response);

                                let pagination = response.pagination;
                                updatePagination_emp(pagination);

                                $('#Vacent_Employee').empty();
                                $('#Vacent_Employee').append('<option selected>Select</option>');

                                if (empresponse.employees && empresponse.employees.length > 0) {
                                    $.each(empresponse.employees, function(index, employee) {
                                        if (employee.vacant_status == 1 || employee.pjp_code === selectedEmployeepjp_code) {
                                            let option = '<option value="' + escapeHtml(employee.pjp_code) + '" data-id="' + escapeHtml(employee.level) + '">' +
                                                escapeHtml(employee.name) + ' (Level: ' + escapeHtml(employee.level) + ')</option>';
                                            $('#Vacent_Employee').append(option);
                                        }
                                    });

                                    if ($('#Vacent_Employee option').length === 1) {
                                        $('#Vacent_Employee').append('<option value="N/A">No employees available</option>');
                                    }
                                } else {
                                    $('#Vacent_Employee').append('<option value="N/A">No employees available</option>');
                                }

                                $('#Vacent_Employee').selectpicker('refresh');

                                $('#hiddenDB_Code').empty();
                                table.clear();

                                if (response && response.data && response.data.length > 0) {
                                    $('#vacant-container').show();

                                    $.each(response.data, function(index, item) {
                                        const jsonData = JSON.stringify({
                                            DB_Code: item.Customer_Code || 'N/A',
                                            Sales_Code: item.Sales_Code || 'N/A',
                                            Distribution_Channel_Code: item.Distribution_Channel_Code || 'N/A',
                                            Division_Code: item.Division_Code || 'N/A',
                                            Customer_Type_Code: item.Customer_Type_Code || 'N/A',
                                            Customer_Group_Code: item.Customer_Group_Code || 'N/A'
                                        });

                                        table.row.add([
                                            `<input type="hidden" class="row-checkbox" data-json='${escapeHtml(jsonData)}' checked>`,
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

                                            escapeHtml(item.Sales_Code || 'N/A'),
                                            escapeHtml(item.Sales_Name || 'N/A'),
                                            escapeHtml(item.Distribution_Channel_Code || 'N/A'),
                                            escapeHtml(item.Distribution_Channel_Name || 'N/A'),
                                            escapeHtml(item.Division_Code || 'N/A'),
                                            escapeHtml(item.Division_Name || 'N/A'),

                                            escapeHtml(item.Customer_Type_Code || 'N/A'),

                                            escapeHtml(item.Customer_Type_Name || 'N/A'),

                                            escapeHtml(item.Customer_Group_Code || 'N/A'),

                                            escapeHtml(item.Customer_Group_Name || 'N/A'),
                                            escapeHtml(item.Customer_Creation_Date || 'N/A'),

                                            escapeHtml(item.Sector_Code || 'N/A'),
                                            escapeHtml(item.State_Code || 'N/A'),
                                            escapeHtml(item.Zone_Code || 'N/A'),
                                            escapeHtml(item.Sector_Name || 'N/A'),
                                        ]).draw();

                                        $('<input>').attr({
                                            type: 'hidden',
                                            id: 'hidden_' + item.Customer_Code,
                                            name: 'DB_Code[]',
                                            style: 'width: 1200px !important;',
                                            value: jsonData
                                        }).appendTo('#hiddenDB_Code');
                                    });
                                } else {
                                    $('#vacant-container').hide();
                                    table.row.add(['', '', '', '', '', '', 'No data found', '', '', '', '', '', '', 'No data found', '', '', '', '', '', '', 'No data found', '', '', '', '', '', '', 'No data found', '', '', '']).draw();
                                }
                            } else {
                                console.log("PJP Code does not exist at this level.");
                            }
                        },
                        error: function() {
                            console.log("Error occurred during AJAX call.");
                        }
                    });
                }

                function updatePagination_emp(response) {
                    console.log("updatePagination", response);
                    var currentPage = parseInt(response.page);
                    var totalPages = parseInt(response.total_pages);
                    var totalRecords = parseInt(response.total);
                    var limit = parseInt(response.limit);
                    var paginationHtml = '';

                    // Calculate current range
                    var start = ((currentPage - 1) * limit) + 1;
                    var end = Math.min(start + limit - 1, totalRecords);

                    // Add entries info and total records count
                    paginationHtml += '<div class="d-flex align-items-center justify-content-between mb-2">';
                    paginationHtml += '<div class="pagination-info">';
                    paginationHtml += 'Showing ' + start + ' to ' + end + ' of ' + totalRecords + ' entries';
                    paginationHtml += '</div>';

                    if (totalPages > 1) {
                        paginationHtml += '<ul class="pagination mb-0">';

                        // Previous Button
                        if (currentPage > 1) {
                            paginationHtml += '<li class="page-item"><a class="page-link prev-page" href="#" data-page="1">First</a></li>';
                            paginationHtml += '<li class="page-item"><a class="page-link prev-page" href="#" data-page="' + (currentPage - 1) + '">Previous</a></li>';
                        }

                        // Calculate page range to show exactly 5 numbers
                        var startPage, endPage;
                        if (totalPages <= 5) {
                            startPage = 1;
                            endPage = totalPages;
                        } else {
                            if (currentPage <= 3) {
                                startPage = 1;
                                endPage = 5;
                            } else if (currentPage + 2 >= totalPages) {
                                startPage = totalPages - 4;
                                endPage = totalPages;
                            } else {
                                startPage = currentPage - 2;
                                endPage = currentPage + 2;
                            }
                        }

                        // Add page numbers
                        for (var i = startPage; i <= endPage; i++) {
                            if (i === currentPage) {
                                paginationHtml += '<li class="page-item active"><a class="page-link" href="#">' + i + '</a></li>';
                            } else {
                                paginationHtml += '<li class="page-item"><a class="page-link page-number" href="#" data-page="' + i + '">' + i + '</a></li>';
                            }
                        }

                        // Next Button
                        if (currentPage < totalPages) {
                            paginationHtml += '<li class="page-item"><a class="page-link next-page" href="#" data-page="' + (currentPage + 1) + '">Next</a></li>';
                            paginationHtml += '<li class="page-item"><a class="page-link next-page" href="#" data-page="' + totalPages + '">Last</a></li>';
                        }

                        paginationHtml += '</ul>';
                    }
                    paginationHtml += '</div>';

                    $('#pagination_emp').html(paginationHtml);

                    // Add click handlers
                    $('.page-number, .prev-page, .next-page').on('click', function(e) {
                        e.preventDefault();
                        var pageNumber = $(this).data('page');
                        loadTableData(pageNumber);
                    });
                }

                $("#dt-search-2").keyup(function() {
                    var searchValue = $(this).val();

                    // Get all parameters and update search
                    var params = getParams();

                    console.log(params);


                    // Debounce the search to avoid too many requests
                    clearTimeout(window.searchTimeout);
                    window.searchTimeout = setTimeout(function() {
                        // Include search value in parameters
                        params.search = searchValue;
                        fetchData('<?= site_url('admin/pjp_code_emp_Left'); ?>', params);
                    }, 500); // Wait 500ms after user stops typing
                });
            });
        }


        $(document).on('change', '.employee-radio____', function() {
            const isChecked = $(this).is(':checked'); // Check if checkbox is selected
            const jsonData = $(this).data('json'); // Retrieve JSON data from `data-json` attribute

            try {
                const parsedData = typeof jsonData === 'string' ? JSON.parse(jsonData) : jsonData;

                const hiddenInputId = `hidden_${parsedData.Customer_Code}`;
                if (isChecked) {
                    // Append hidden input when checkbox is checked
                    $('<input>')
                        .attr({
                            type: 'hidden',
                            id: hiddenInputId,
                            name: 'employee_data[]', // Name of the hidden input
                            value: JSON.stringify(parsedData) // JSON data as value
                        })
                        .appendTo('#Replacing_emp_code');
                } else {
                    // Remove hidden input when checkbox is unchecked
                    $(`#${hiddenInputId}`).remove();
                }
            } catch (error) {
                console.error("Failed to parse JSON:", error);
            }
        });






        $('#city').change(function() {
            var selectedCity = $(this).val();
            updateSelectedLevel();
            $('#Replacing_emp_code').empty();
            $('.employee-radio____').prop('checked', false);
            $.ajax({
                url: '<?= site_url('admin/get_employees_by_city_t'); ?>',
                type: 'POST',
                data: {
                    city: selectedCity
                },
                dataType: 'json',
                success: function(response) {

                    $('#Zone__').empty();
                    $('#Zone__').append('<option selected disabled>Select Zone</option>');
                    $.each(response, function(index, zoneData) {
                        // Create option element
                        var option = $('<option></option>')
                            .val(zoneData.Zone) // Set value to Zone_Code
                            .text(zoneData.Zone) // Set the display text to Zone
                            .data('zone-name', zoneData.Zone_Code); // Add data-attribute for Zone_Name


                        // Append option to the select dropdown
                        $('#Zone__').append(option);
                    });

                    $('#Zone__').selectpicker('refresh');

                },
                error: function() {
                    alert('Failed to retrieve employees.');
                }
            });
        });




    });
</script>








<script>
    $(document).ready(function() {

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

        if ($.fn.DataTable.isDataTable('#exampley')) {
            $('#exampley').DataTable().clear().destroy();
        }

        window.datatable = $('#exampley').DataTable({
            paging: false,
            searching: true,
            info: false,
            autoWidth: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            scrollY: "550px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
        });


        window.fetchData = function(url, params = {}) {
            $('#loader').show();
            $.ajax({
                url: url,
                method: 'GET',
                data: params,
                dataType: 'json',
                success: function(response) {
                    $('#loader').hide();
                    updatePagination(response);
                    window.datatable.clear();

                    // Assuming response.common_records is an array
                    response.common_records.forEach(item => {
                        const jsonData = JSON.stringify({
                            Customer_Code: item.Customer_Code || 'N/A',
                            Sales_Code: item.Sales_Code || 'N/A',
                            Distribution_Channel_Code: item.Distribution_Channel_Code || 'N/A',
                            Division_Code: item.Division_Code || 'N/A',
                            Customer_Type_Code: item.Customer_Type_Code || 'N/A',
                            Customer_Group_Code: item.Customer_Group_Code || 'N/A',
                            distributors_id: item.distributors_id || 'N/A'
                        });

                        // Create hidden input elements dynamically and append them to the container
                        $('<input>').attr({
                            type: 'hidden', // Changed to 'hidden' to hide the input
                            id: 'hidden_' + item.Customer_Code,
                            name: 'DB_Code[]',
                            style: 'width: 1200px !important;',
                            value: jsonData // Set the JSON data as the value
                        }).appendTo('#hiddenFieldsContainer'); // Append to the container
                    });


                    if (response && response.Distributor_data) {
                        $.each(response.Distributor_data, function(index, item) {

                            const jsonData = JSON.stringify({
                                Customer_Code: item.Customer_Code || 'N/A',
                                Sales_Code: item.Sales_Code || 'N/A',
                                Distribution_Channel_Code: item.Distribution_Channel_Code || 'N/A',
                                Division_Code: item.Division_Code || 'N/A',
                                Customer_Type_Code: item.Customer_Type_Code || 'N/A',
                                Customer_Group_Code: item.Customer_Group_Code || 'N/A',
                                distributors_id: item.distributors_id || 'N/A'
                            });

                            window.datatable.row.add([
                                `<input type="hidden" class="row-checkbox"
                                data-id="${item.Customer_Code}" 
                                data-Sales_Code="${escapeHtml(item.Sales_Code)}" 
                                data-Distribution_Channel_Code="${escapeHtml(item.Distribution_Channel_Code)}" 
                                data-Division_Code="${escapeHtml(item.Division_Code)}" 
                                data-Customer_Type_Code="${escapeHtml(item.Customer_Type_Code)}" 
                                data-Customer_Group_Code="${escapeHtml(item.Customer_Group_Code)}" data-json='${escapeHtml(jsonData)}'
                            
                                checked >`,

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

                                escapeHtml(item.Sales_Code || 'N/A'),
                                escapeHtml(item.Sales_Name || 'N/A'),
                                escapeHtml(item.Distribution_Channel_Code || 'N/A'),
                                escapeHtml(item.Distribution_Channel_Name || 'N/A'),
                                escapeHtml(item.Division_Code || 'N/A'),
                                escapeHtml(item.Division_Name || 'N/A'),

                                escapeHtml(item.Customer_Type_Code || 'N/A'),

                                escapeHtml(item.Customer_Type_Name || 'N/A'),

                                escapeHtml(item.Customer_Group_Code || 'N/A'),

                                escapeHtml(item.Customer_Group_Name || 'N/A'),
                                escapeHtml(item.Customer_Creation_Date || 'N/A'),

                                escapeHtml(item.Sector_Code || 'N/A'),
                                escapeHtml(item.State_Code || 'N/A'),
                                escapeHtml(item.Zone_Code || 'N/A'),
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




                        });
                    } else {
                        window.datatable.row.add(['No data found', '', '', '', '', '', '', '', '', '', '', '', '',
                            '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                        ]).draw();
                    }

                },
                error: function() {
                    $('#loader').hide();
                    window.datatable.row.add(['An error occurred', '', '', '', '', '', '', '', '', '', '', '', '',
                        '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                    ]).draw();
                }
            });
        }




        window.datatable.on('page.dt', function() {
            var info = window.datatable.page.info();
            var params = getParams();
            params.page = info.page + 1;
            params.limit = window.datatable.page.len();
            fetchData('<?= site_url('admin/replacedataajex'); ?>', params);
        });

        window.getParams = function() {
            var selectedOption = $('#level option:selected');
            var searchValue = $('#dt-search-1').val() || '';
            return {
                employee_level: selectedOption.val() || null,
                pjp_code: selectedOption.data('pjp_code') || null,
                City: selectedOption.data('city') || null,
                search: searchValue,
                page: 1 // Reset to first page on search
            };
        }


        function updatePagination(response) {
            console.log("updatePagination", response);
            var currentPage = parseInt(response.page);
            var totalPages = parseInt(response.total_pages);
            var totalRecords = parseInt(response.total_records);
            var limit = parseInt(response.limit);
            var paginationHtml = '';

            // Calculate current range
            var start = ((currentPage - 1) * limit) + 1;
            var end = Math.min(start + limit - 1, totalRecords);

            // Add entries info and total records count
            paginationHtml += '<div class="d-flex align-items-center justify-content-between mb-2">';
            paginationHtml += '<div class="pagination-info">';
            paginationHtml += 'Showing ' + start + ' to ' + end + ' of ' + totalRecords + ' entries';
            paginationHtml += '</div>';

            if (totalPages > 1) {
                paginationHtml += '<ul class="pagination mb-0">';

                // Previous Button
                if (currentPage > 1) {
                    paginationHtml += '<li class="page-item"><a class="page-link prev-page_Transfer" href="#" data-page="1">First</a></li>';
                    paginationHtml += '<li class="page-item"><a class="page-link prev-page_Transfer" href="#" data-page="' + (currentPage - 1) + '">Previous</a></li>';
                }

                // Calculate page range to show exactly 5 numbers
                var startPage, endPage;
                if (totalPages <= 5) {
                    startPage = 1;
                    endPage = totalPages;
                } else {
                    if (currentPage <= 3) {
                        startPage = 1;
                        endPage = 5;
                    } else if (currentPage + 2 >= totalPages) {
                        startPage = totalPages - 4;
                        endPage = totalPages;
                    } else {
                        startPage = currentPage - 2;
                        endPage = currentPage + 2;
                    }
                }

                // Add page numbers
                for (var i = startPage; i <= endPage; i++) {
                    if (i === currentPage) {
                        paginationHtml += '<li class="page-item active"><a class="page-link" href="#">' + i + '</a></li>';
                    } else {
                        paginationHtml += '<li class="page-item"><a class="page-link page-number_Transfer" href="#" data-page="' + i + '">' + i + '</a></li>';
                    }
                }

                // Next Button
                if (currentPage < totalPages) {
                    paginationHtml += '<li class="page-item"><a class="page-link next-page_Transfer" href="#" data-page="' + (currentPage + 1) + '">Next</a></li>';
                    paginationHtml += '<li class="page-item"><a class="page-link next-page_Transfer" href="#" data-page="' + totalPages + '">Last</a></li>';
                }

                paginationHtml += '</ul>';
            }
            paginationHtml += '</div>';

            $('#pagination').html(paginationHtml);

            // Add click handlers
            $('.page-number_Transfer, .prev-page_Transfer, .next-page_Transfer').on('click', function(e) {
                e.preventDefault();
                var pageNumber = $(this).data('page');
                changePage(pageNumber);
            });
        }

        function changePage(pageNumber) {
            if (window.datatable) {
                var params = getParams();
                params.page = pageNumber;
                params.limit = window.datatable.page.len();
                fetchData('<?= site_url('admin/replacedataajex'); ?>', params);
            }
        }


        function fetchDataAndUpdate() {
            window.datatable.clear().draw();
            var params = getParams();
            fetchData('<?= site_url('admin/replacedataajex'); ?>', params);
        }


        $('#level').change(function() {
            $('#Target_DBS').empty();
            fetchDataAndUpdate();
        });



        $("#dt-search-1").keyup(function() {
            var searchValue = $(this).val();
            var params = getParams();
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(function() {
                fetchData('<?= site_url('admin/replacedataajex'); ?>', params);
            }, 500);
        });

    });
</script>






<script>
    $(document).ready(function() {
        $('#state').change(function() {
            var selectedState = $(this).val();
            $.ajax({
                url: '<?= site_url('admin/get_cities_by_state'); ?>',
                type: 'POST',
                data: {
                    state: selectedState
                },
                dataType: 'json',
                success: function(response) {


                    $('#city').empty();
                    $('#city').append('<option selected>Select</option>');

                    if (response && response.length > 0) {
                        let uniqueCities = new Set();

                        $.each(response, function(index, city) {
                            if (city.City) {
                                uniqueCities.add(city.City);
                            }
                        });

                        uniqueCities.forEach(function(city) {
                            $('#city').append(
                                '<option value="' + escapeHtml(city) + '">' +
                                escapeHtml(city) + '</option>'
                            );
                        });
                    } else {
                        $('#city').append('<option value="N/A">No cities available</option>');
                    }

                    $('#city').selectpicker('refresh');

                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    alert('Failed to retrieve cities.');
                }
            });
        });

        function escapeHtml(text) {
            return $('<div/>').text(text).html();
        }
    });
</script>

<script>
    $(document).on('change', '#selectAll', function() {
        const isChecked = $(this).is(':checked');
        $('.employee-radio____').prop('checked', isChecked).trigger('change');
    });
</script>