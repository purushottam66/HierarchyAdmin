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
                <h3 class="dashhead-title">User Movement / Left</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">User Movement
                    </a> / Left
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
                                        <div class="form-group p-b-10 ">
                                            <label for="customer-group-code-filter">Replace with Employee
                                                :</label>

                                            <input type="text" class="form-control" readonly id="selectedEmployees" />

                                            <input type="text" class="form-control" readonly name="set_pjp_code"
                                                id="selectedEmployeespjp_code" />

                                            <div id="hiddenDB_Code"></div>
                                        </div>
                                    </div>


                                    <div class="col-md-3" id="vacant-container">
                                        <div class="form-group p-b-10">
                                            <label for="Vacant" id="v_cent"> </label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="Vacant"
                                                name="Vacant" aria-label="Select Vacant">

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex flex-row-reverse bd-highlight">
                                    <button type="submit" class="btn btnss">Save & Replace</button> &#8202;

                                </div>
                            </form>


                            <div class="card mt-3">
                                <div class="table-responsive p-3">
                                    <h5 class="text-center">
                                        Distributor List of : <span id="addname3_text"></span>
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


                                    <div id="pagination"></div>



                                </div>


                            </div>


                            <div class="card mt-3">
                                <div class="table-responsive p-3">
                                    <h5 class="text-center">
                                        Select Employee to Replace : <span id="addname2"></span>

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
                                        <tbody>

                                        </tbody>
                                    </table>
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



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>





<script>
    $(document).ready(function() {
        $('#saveReplaceForm').on('submit', function(e) {
            e.preventDefault();

            const form = this;


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

        function submitForm(form) {
            const formData = $(form).serialize();
            const decodedData = decodeURIComponent(formData);

            const params = new URLSearchParams(decodedData);
            const parsedObject = {};


            params.forEach((value, key) => {
                if (key === "DB_Code[]") {
                    if (!parsedObject[key]) {
                        parsedObject[key] = [];
                    }
                    parsedObject[key].push(JSON.parse(value));
                } else {
                    parsedObject[key] = value;
                }
            });

            const $submitButton = $(form).find('button[type="submit"]');
            $submitButton.prop('disabled', true).text('Saving...');


            $.ajax({
                url: '<?php echo site_url("admin/Save_Replace"); ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    let parsedResponse = JSON.parse(response);

                    if (parsedResponse.status == 'success') {
                        toastr.success(parsedResponse.message);
                        $('#hiddenDB_Code').empty();
                        $('#hiddenFieldsContainer').empty();
                        window.location.href = '<?php echo site_url("admin/UserMovement"); ?>?message=' + encodeURIComponent(parsedResponse.message) + '&status=success';
                    } else if (parsedResponse.status == 'error') {
                        toastr.error(parsedResponse.message);
                    } else {
                        toastr.info("Unexpected response status");
                    }


                    $(form)[0].reset();
                    $('.selectpicker').selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while processing the request.');
                    console.error('Error:', error);
                    console.error('Response:', xhr.responseText);
                },
                complete: function() {
                    $submitButton.prop('disabled', false).text('Save & Replace');
                }
            });
        }
    });
</script>



<script>
    $(document).ready(function() {


        $('#vacant-container').hide()

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
        });


        let left_emp_city = '';

        var selectedEmployeeName = '';
        var selectedEmployeepjp_code = '';
        var empresponse = '';

        $('#level').change(function() {

            $('#hiddenDB_Code').empty();
            $('#hiddenFieldsContainer').empty();

            var selectedOption = $(this).find(':selected');
            var selectedValue = selectedOption.val();
            var selected_text = selectedOption.text();

            $('#addname3_text').html(selected_text);


            left_emp_city = selectedOption.data('city');
            var pjpCode = selectedOption.data('pjp_code');
            var addname = selectedOption.data('name');
            $('#selectedEmployeesselectedValue').val(pjpCode);
            $('#addname1').html(addname);
            $('#addname2').html(addname);

            $('#addname3').html(addname);

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
                                    '<input type="radio" name="employeeSelect" class="employee-radio" data-emp_City="' +
                                    employee.City + '" data-level="' +

                                    employee.level + '" data-pjp_code="' +
                                    employee.pjp_code + '" data-id="' +
                                    employee.designation_name + '" data-designation_name="' +
                                    employee.id + '" data-name="' +
                                    escapeHtml(employee.name) + '">', employee.id,
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
        });


        function addRadioEventListeners() {
            $('.employee-radio').on('change', function() {
                var selectedData = $(this).data();

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

                            console.log("response", response);

                            $('#Vacant').empty();
                            $('#Vacant').append('<option selected>Select</option>');

                            if (empresponse.employees && empresponse.employees.length > 0) {
                                $.each(empresponse.employees, function(index, employee) {
                                    if (employee.vacant_status == 1 || employee.pjp_code === selectedEmployeepjp_code) {
                                        let option = '<option value="' + escapeHtml(employee.pjp_code) + '" data-id="' + escapeHtml(employee.level) + '">' +
                                            escapeHtml(employee.name) + ' (Level: ' + escapeHtml(employee.level) + ')</option>';
                                        $('#Vacant').append(option);
                                    }
                                });

                                if ($('#Vacant option').length === 1) {
                                    $('#Vacant').append('<option value="N/A">No employees available</option>');
                                }
                            } else {
                                $('#Vacant').append('<option value="N/A">No employees available</option>');
                            }

                            $('#Vacant').selectpicker('refresh');




                            $('#hiddenDB_Code').empty();
                            table.clear();
                            if (response && response.pjp_codes && response.pjp_codes.length >
                                0) {

                                $('#vacant-container').show()

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
                                        id: 'hidden_' + item.Customer_Code,
                                        name: 'DB_Code[]',
                                        style: 'width: 1200px !important;',
                                        value: jsonData
                                    }).appendTo('#hiddenDB_Code');
                                });
                            } else {
                                $('#vacant-container').hide()
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

            });
        }


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

                    updatePagination(response);
                    $('#city').empty();
                    $('#city').append('<option selected>Select</option>');

                    if (response.Distributor_data && response.Distributor_data.length > 0) {
                        const uniqueCities = new Set();
                        $.each(response.Distributor_data, function(index, distributor) {
                            if (distributor.City && !uniqueCities.has(distributor.City)) {
                                uniqueCities.add(distributor.City);

                                $('#city').append(
                                    '<option value="' + escapeHtml(distributor.City) +
                                    '" data-id="' + escapeHtml(distributor.City) + '">' +
                                    escapeHtml(distributor.City) + '</option>'
                                );
                            }
                        });
                    } else {
                        $('#city').append('<option value="N/A">No employees available</option>');
                    }

                    $('#city').selectpicker('refresh');
                    $('#loader').hide();
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

                            window.datatable.row.add([`
                            <input type="hidden" class="row-checkbox" data-json='${escapeHtml(jsonData)}' checked>`, // Auto-checked checkbox
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




                        });
                    } else {
                        window.datatable.row.add(['No data found', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']).draw();
                    }
                },
                error: function() {
                    $('#loader').hide();
                    window.datatable.row.add(['An error occurred', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '']).draw();
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

            $('#pagination').html(paginationHtml);

            // Add click handlers
            $('.page-number, .prev-page, .next-page').on('click', function(e) {
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

            // Get all parameters and update search
            var params = getParams();

            // Debounce the search to avoid too many requests
            clearTimeout(window.searchTimeout);
            window.searchTimeout = setTimeout(function() {
                fetchData('<?= site_url('admin/replacedataajex'); ?>', params);
            }, 500); // Wait 500ms after user stops typing
        });



    });
</script>