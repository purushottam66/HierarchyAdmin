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
                                    <button type="submit" class="btn btnss">Save & Replace</button> &#8202;

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
                                                <th>Population Strata 1
                                                </th>
                                                <th>Population Strata 2
                                                </th>
                                                <th>Country Group</th>
                                                <th>GTM TYPE</th>
                                                <th>Super Stockist</th>
                                                <th>Status</th>
                                                <th>Customer Type Code
                                                </th>
                                                <th>Sales Code</th>
                                                <th>Customer Type Name
                                                </th>
                                                <th>Customer Group Code
                                                </th>
                                                <th>Customer Creation Date
                                                </th>
                                                <th>Division Code</th>
                                                <th>Sector Code</th>
                                                <th>State Code</th>
                                                <th>Zone Code</th>
                                                <th>Distribution Channel
                                                    Code</th>
                                                <th>Distribution Channel
                                                    Name</th>
                                                <th>Customer Group Name
                                                </th>
                                                <th>Sales Name</th>
                                                <th>Division Name</th>
                                                <th>Sector Name</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>

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

                                </div>
                            </div>



                            <!-- <div class="card mt-3">
                                <div class="table-responsive p-3">
                                    <h5 class="mt-2 text-center ">
                                        Distributor List of  : <span id="selectedzone_"></span> remove section
                                        <span id="name_add_Replacing"></span>
                                    </h5>

                                    <table id="Replacing_Employee___id"
                                        class="display nowrap table table-bordered table-hover text-center"
                                        style="width:100%">

                                        <thead>
                                            <tr>
                                                <th>
                                                    All <input type="checkbox" class="checkbox" id="selectAll" />
                                                </th>
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
                                                <th>Customer Type Code</th>
                                                <th>Sales Code</th>
                                                <th>Customer Type Name</th>
                                                <th>Customer Group Code</th>
                                                <th>Customer Creation Date</th>
                                                <th>Division Code</th>
                                                <th>Sector Code</th>
                                                <th>State Code</th>
                                                <th>Zone Code</th>
                                                <th>Distribution Channel Code</th>
                                                <th>Distribution Channel Name</th>
                                                <th>Customer Group Name</th>
                                                <th>Sales Name</th>
                                                <th>Division Name</th>
                                                <th>Sector Name</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>

                                </div>

                            </div> -->


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
                                                <th>Population Strata 1
                                                </th>
                                                <th>Population Strata 2
                                                </th>
                                                <th>Country Group</th>
                                                <th>GTM TYPE</th>
                                                <th>Super Stockist</th>
                                                <th>Status</th>
                                                <th>Customer Type Code
                                                </th>
                                                <th>Sales Code</th>
                                                <th>Customer Type Name
                                                </th>
                                                <th>Customer Group Code
                                                </th>
                                                <th>Customer Creation Date
                                                </th>
                                                <th>Division Code</th>
                                                <th>Sector Code</th>
                                                <th>State Code</th>
                                                <th>Zone Code</th>
                                                <th>Distribution Channel
                                                    Code</th>
                                                <th>Distribution Channel
                                                    Name</th>
                                                <th>Customer Group Name
                                                </th>
                                                <th>Sales Name</th>
                                                <th>Division Name</th>
                                                <th>Sector Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>

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

            // Show confirmation dialog
            swal({
                    title: "Are you sure?",
                    text: "Do you want to proceed with the form submission?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#DD6B55',
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'No, cancel!',
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        //swal.close(); // Close the SweetAlert dialog
                        submitForm(form); // Call the submitForm function
                    } else {
                        toastr.info("Form submission canceled."); // Optional cancellation message
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
        $('#EmployeeList').hide()

        var table = $('#employeeTable').DataTable({
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

            columnDefs: [{
                orderable: false,
                targets: [0]
            }]
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


            $.ajax({
                url: '<?= site_url('admin/empreplace_level'); ?>',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    level: selectedValue,
                    pjpCode: pjpCode
                }),
                success: function(response) {
                    var response = JSON.parse(response);
                    empresponse = response;



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
                        table.row.add(['', '', '', '', '', '', '', '',"",
                            'No employees available'
                        ]).draw();
                    }

                    addRadioEventListeners();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        $('#selectedEmployees').click(function() {
            $('#EmployeeList').show()

        })

        function addRadioEventListeners() {
            $('.employee-radio').on('change', function() {
                var selectedData = $(this).data();
                selectedEmployeeName = selectedData.name;
                selectedEmployeepjp_code = selectedData.pjp_code;
                //$('#selectedEmployees').val(selectedData.name);
                $('#selectedEmployeeName').html(selectedEmployeeName);
                let mydata = `${selectedData.name}  (${selectedData.id}) (${selectedData.emp_city}) (${selectedData.level})`;
              $('#selectedEmployees').val(mydata);



                $('#v_cent').html("Replacement User for - " + selectedData.name);

                $('#selectedEmployeespjp_code').val(selectedData.pjp_code);
                let city = selectedData.emp_city
                if (city === left_emp_city) {
                    console.log("City matches!");
                    $('#vacant-container').hide()

                } else {
                    console.log("City does not match.");
                    //$('#vacant-container').show()

                }
                if ($.fn.DataTable.isDataTable('#employeedb')) {
                    $('#employeedb').DataTable().clear().destroy();
                }

                var table = $('#employeedb').DataTable({
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

                    columnDefs: [{
                        orderable: false,
                        targets: [0]
                    }]
                });
                $.ajax({
                    url: '<?= site_url('admin/pjp_code_emp_Left'); ?>',
                    type: 'POST',
                    data: {
                        level: selectedData.level,
                        pjp_code: selectedData.pjp_code
                    },
                    success: function(response) {
                        if (response) {
                            var response = JSON.parse(response);

                            $('#Vacent_Employee').empty();
                            $('#Vacent_Employee').append('<option selected>Select</option>');

                            if (empresponse.employees && empresponse.employees.length > 0) {

                                $('#vacant-container').show()
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
                            if (response && response.pjp_codes && response.pjp_codes.length >
                                0) {
                                $.each(response.pjp_codes, function(index, item) {


                                    const jsonData = JSON.stringify({
                                        DB_Code: item.Customer_Code || 'N/A',
                                        
                                        Sales_Code: item.Sales_Code || 'N/A',
                                        Distribution_Channel_Code: item.Distribution_Channel_Code || 'N/A',
                                        Division_Code: item.Division_Code || 'N/A',
                                        Customer_Type_Code: item.Customer_Type_Code || 'N/A',
                                        Customer_Group_Code: item.Customer_Group_Code || 'N/A'
                                    });

                                    table.row.add([
                                        `<input type="checkbox" class="row-checkbox"  data-json='${escapeHtml(jsonData)}' checked>`,
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
                                    ]).draw();

                                    $('<input>').attr({
                                        type: 'hidden',
                                        id: 'hidden_' + item.DB_Code,
                                        name: 'Replace_DB_Code[]',
                                        value: jsonData
                                    }).appendTo('#hiddenDB_Code');
                                });
                            } else {

                                $('#vacant-container').hide()
                                table.row.add(['', '', '', 'No data found', '', '', '','', '', '', 'No data found', '', '', '','', '', '', 'No data found', '', '', '','', '', '', 'No data found', '', '', '','', '', '', 'No data found', '', '']).draw();
                            }

                        } else {
                            console.log("PJP Code does not exist at this level.");
                        }
                    },
                    error: function() {
                        console.log("Error occurred during AJAX call.");
                    }
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


        /////////////////////////////////
        /////////////////////////////////////////

        // $('#Zone__').change(function() {
        //     var selectedzone = $('#Zone__ option:selected').data('zone-name');

        //     const value____ = this.value;
        //     $('#selectedzone_').html(value____);

        //     var selectedstate = $('#state').val(); // State should be selected from #state
        //     var selectedCity = $('#city').val(); // City should be selected from #city

        //     updateSelectedLevel();

        //     if ($.fn.DataTable.isDataTable('#Replacing_Employee___id')) {
        //         $('#Replacing_Employee___id').DataTable().clear().destroy();
        //     }

        //     $('#Replacing_emp_code').empty();
        //     $('.employee-radio____').prop('checked', false);

        //     const table = $('#Replacing_Employee___id').DataTable({
        //         paging: false,
        //         searching: true,
        //         info: true,
        //         autoWidth: true,
        //         pageLength: 100,
        //         lengthMenu: [100],
        //         scrollY: "350px",
        //         scrollCollapse: true,
        //         fixedHeader: true,
        //         fixedFooter: true,
        //         columnDefs: [{
        //             orderable: false,
        //             targets: [0]
        //         }]
        //     });

        //     function escapeHtml(unsafe) {
        //         return (typeof unsafe === 'string') ?
        //             unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
        //             .replace(/"/g, "&quot;").replace(/'/g, "&#039;") :
        //             '';
        //     }

        //     $.ajax({
        //         url: '<?= site_url('admin/get_employees_by_city_and_level_zone_all_distubuter'); ?>',
        //         type: 'POST',
        //         data: {
        //             state: selectedstate,
        //             city: selectedCity,
        //             zone: selectedzone,
        //         },
        //         dataType: 'json',
        //         success: function(response) {


        //             table.clear();

        //             if (response && response.length > 0) {
        //                 $.each(response, function(index, distributor) {
        //                     if (distributor.id && distributor.Customer_Name) {
        //                         const jsonData = JSON.stringify({
        //                             Customer_Code: distributor.Customer_Code || 'N/A',
        //                             Sales_Code: distributor.Sales_Code || 'N/A',
        //                             Distribution_Channel_Code: distributor.Distribution_Channel_Code || 'N/A',
        //                             Division_Code: distributor.Division_Code || 'N/A',
        //                             Customer_Type_Code: distributor.Customer_Type_Code || 'N/A',
        //                             Customer_Group_Code: distributor.Customer_Group_Code || 'N/A'
        //                         });


        //                         const row = [
        //                             `<input type="checkbox" name="Replacing_Employee___id" class="employee-radio____" data-json='${escapeHtml(jsonData)}'">`,
        //                             escapeHtml(distributor.Customer_Name || 'N/A'),
        //                             escapeHtml(distributor.Customer_Code || 'N/A'),
        //                             escapeHtml(distributor.Pin_Code || 'N/A'),
        //                             escapeHtml(distributor.City || 'N/A'),
        //                             escapeHtml(distributor.District || 'N/A'),
        //                             escapeHtml(distributor.Contact_Number || 'N/A'),
        //                             escapeHtml(distributor.Country || 'N/A'),
        //                             escapeHtml(distributor.Zone || 'N/A'),
        //                             escapeHtml(distributor.State || 'N/A'),
        //                             escapeHtml(distributor.Population_Strata_1 || 'N/A'),
        //                             escapeHtml(distributor.Population_Strata_2 || 'N/A'),
        //                             escapeHtml(distributor.Country_Group || 'N/A'),
        //                             escapeHtml(distributor.GTM_TYPE || 'N/A'),
        //                             escapeHtml(distributor.SUPERSTOCKIST || 'N/A'),
        //                             escapeHtml(distributor.STATUS || 'N/A'),
        //                             escapeHtml(distributor.Customer_Type_Code || 'N/A'),
        //                             escapeHtml(distributor.Sales_Code || 'N/A'),
        //                             escapeHtml(distributor.Customer_Type_Name || 'N/A'),
        //                             escapeHtml(distributor.Customer_Group_Code || 'N/A'),
        //                             escapeHtml(distributor.Customer_Creation_Date || 'N/A'),
        //                             escapeHtml(distributor.Division_Code || 'N/A'),
        //                             escapeHtml(distributor.Sector_Code || 'N/A'),
        //                             escapeHtml(distributor.State_Code || 'N/A'),
        //                             escapeHtml(distributor.Zone_Code || 'N/A'),
        //                             escapeHtml(distributor.Distribution_Channel_Code || 'N/A'),
        //                             escapeHtml(distributor.Distribution_Channel_Name || 'N/A'),
        //                             escapeHtml(distributor.Customer_Group_Name || 'N/A'),
        //                             escapeHtml(distributor.Sales_Name || 'N/A'),
        //                             escapeHtml(distributor.Division_Name || 'N/A'),
        //                             escapeHtml(distributor.Sector_Name || 'N/A'),
        //                         ];
        //                         table.row.add(row);
        //                     }
        //                 });
        //                 table.draw();
        //             } else {
        //                 table.row.add(['', '', '', '', '', '', '', '', '', '', '', '', '', '', 'No employees available', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']).draw();
        //             }
        //         },
        //         error: function() {
        //             alert('Failed to retrieve employees.');
        //         }
        //     });
        // });

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

        var table = $('#exampley').DataTable({
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

            columnDefs: [{
                orderable: false,
                targets: [0]
            }]
        });


        function fetchData(url, params = {}) {
            $('#loader').show();
            $.ajax({
                url: url,
                method: 'GET',
                data: params,
                dataType: 'json',
                success: function(response) {
                    $('#loader').hide();
                    table.clear();
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

                            table.row.add([
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


                            $('<input>').attr({
                                type: 'hidden',
                                id: 'hidden_' + item.Customer_Code,
                                name: 'DB_Code[]',
                                style: 'width: 1200px !important;',
                                value: jsonData // Set JSON as value
                            }).appendTo('#hiddenFieldsContainer');

                        });
                    } else {
                        table.row.add(['No data found', '', '', '', '', '', '', '', '', '', '', '', '',
                            '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                        ]).draw();
                    }

                },
                error: function() {
                    $('#loader').hide();
                    table.row.add(['An error occurred', '', '', '', '', '', '', '', '', '', '', '', '',
                        '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                    ]).draw();
                }
            });
        }



        function getParams() {

            var selectedOption = $('#level option:selected');
            var dataId = selectedOption.data('pjp_code');
            return {
                employee_level: selectedOption.val() || null,

                pjp_code: dataId || null
            };
        }


        function fetchDataAndUpdate() {
            table.clear().draw();
            var params = getParams();
            fetchData('<?= site_url('admin/replacedataajex'); ?>', params);
        }
        $('#level').change(function() {
            $('#Target_DBS').empty();
            fetchDataAndUpdate();
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