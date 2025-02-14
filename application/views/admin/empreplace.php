<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.css" class="rel">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css" class="rel">


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

    .dataTables_wrapper .top {
        text-align: right;
    }

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

    tr td {
        text-align: center !important;
    }
</style>


<style>
    .table-responsive {
        width: 100%;

        overflow-x: auto;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .table-responsive table {
        width: 100%;
        border-collapse: collapse;
    }

    .table-responsive th,
    .table-responsive td {
        padding: 12px;
        text-align: left;
    }

    .table-responsive th {
        background-color: #f2f2f2;
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
                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <label for="customer-group-code-filter">Select Level With Name :</label>

                                            <select class="selectpicker form-control" data-actions-box="true"
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="level"
                                                name="level">
                                                <option selected>Select </option>

                                                <?php if (isset($employees) && !empty($employees)) : ?>
                                                    <?php foreach ($employees as $employee) : ?>
                                                        <?php if (is_array($employee) && isset($employee['id'])) : ?>
                                                            <option value="<?php echo $employee['level']; ?>">
                                                                <?php echo isset($employee['name']) ? $employee['name'] : 'N/A'; ?>
                                                                <?php echo isset($employee['level']) ? $employee['level'] : 'N/A'; ?>
                                                            </option>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <option value="N/A">No employees available</option>
                                                <?php endif; ?>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <label for="State">To State:</label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="State" name="State"
                                                aria-label="Select State">
                                                <option selected>Select </option>
                                                <option data-name="" value="">bihar</option>
                                                <option data-name="" value="">delhi</option>
                                                <option data-name="" value="">goa</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group p-b-10 ">
                                            <label for="customer-group-code-filter">Replace with Employee
                                                :</label>

                                            <input type="text" class="form-control" readonly id="selectedEmployees"
                                                placeholder="Selected Employees Data" />


                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group p-b-10">
                                            <label for="population-strata-filter">Replacing Employee
                                                :</label>
                                            <select class="selectpicker form-control" data-actions-box="true"
                                                aria-label="Default select example" title="Please Select" data-size="5"
                                                data-live-search="true" data-selected-text-format="count"
                                                data-count-selected-text=" ({0} items selected)" id="Replacing_Employee"
                                                name="Replacing_Employee">
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </form>


                            <div class="card mt-3">
                                <div class="d-flex flex-row-reverse">

                                    <div class="col-md-3 ">
                                        <input type="text" id="customSearchemp" class="form-control"
                                            placeholder="Search...">

                                    </div>

                                </div>


                                <div class="table-responsive">
                                    <h5>
                                        Employee List
                                    </h5>

                                    <table id="employeeTable"
                                        class="display nowrap table table-bordered table-hover text-center"
                                        style="width:100%">

                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>PJP Code</th>
                                                <th>Designation</th>
                                                <th>Status</th>
                                                <th>State</th>
                                                <th>Level</th>


                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>

                                    </table>

                                </div>
                            </div>
                            <div class="d-flex flex-row-reverse mt-5">
                                <div class="col-md-3 ">
                                    <input type="text" id="customSearch" class="form-control" placeholder="Search...">

                                </div>

                            </div>

                            <div class="table-responsive">
                                <h5>
                                    distributors List
                                </h5>

                                <table id="exampley" class="display nowrap table table-bordered table-hover text-center"
                                    style="width:100%">

                                    <thead>
                                        <tr>
                                            <th class="text-center ">Customer Name</th>

                                            <th class="text-center ">Pin Code</th>
                                            <th class="text-center ">City</th>
                                            <th class="text-center ">District</th>
                                            <th class="text-center ">Country</th>


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



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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

        var table = $('#employeeTable').DataTable({
            paging: false,
            searching: true,
            info: true,
            autoWidth: true,
            scrollY: "550px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            dom: '<"top"lB>rt<"bottom"ip><"clear">',
            buttons: [
                'excel'
            ]
        });

        $('#customSearchemp').on('keyup', function() {
            table.search(this.value).draw();
        });

        table.buttons().container().appendTo('#exampley_wrapper .col-md-6:eq(0)');
        $('#loader').show();

        $('#level').change(function() {
            var selectedValue = $(this).val();


            $.ajax({
                url: '<?= site_url('admin/empreplace_level'); ?>',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({
                    level: selectedValue
                }),
                success: function(response) {
                    var response = JSON.parse(response);
                    $('#Replacing_Employee').empty();
                    $('#Replacing_Employee').append(
                        '<option selected>Select</option>');

                    if (response.employees && response.employees.length > 0) {
                        $.each(response.employees, function(index, employee) {
                            if (employee.id && employee.name) {
                                $('#Replacing_Employee').append(
                                    '<option value="' + escapeHtml(employee
                                        .pjp_code) + '" data-id="' + escapeHtml(
                                        employee.level) + '">' +
                                    escapeHtml(employee.name) + ' (Level: ' +
                                    escapeHtml(employee.level) + ')</option>'
                                );
                            }

                        });
                    } else {
                        $('#Replacing_Employee').append(
                            '<option value="N/A">No employees available</option>');
                    }
                    $('#Replacing_Employee').selectpicker('refresh');
                    table.clear();

                    if (response.employees && response.employees.length > 0) {
                        $.each(response.employees, function(index, employee) {
                            if (employee.id && employee.name) {
                                table.row.add([
                                    '<input type="radio" name="employeeSelect" class="employee-radio" data-id="' +
                                    employee.id + '" data-name="' + escapeHtml(
                                        employee.name) + '">',
                                    employee.id,
                                    escapeHtml(employee.name),
                                    escapeHtml(employee.email),
                                    escapeHtml(employee.pjp_code),
                                    escapeHtml(employee.designation_name),
                                    escapeHtml(employee.employee_status),
                                    escapeHtml(employee.state),
                                    escapeHtml(employee.level)
                                ]).draw();
                            }
                        });
                    } else {
                        table.row.add(['', '', '', '', '', '', '', '',
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
                $('#selectedEmployees').val(selectedData.name);
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

        var table = $('#exampley').DataTable({
            paging: false,
            searching: true,
            info: true,
            autoWidth: true,
            scrollY: "550px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            dom: '<"top"lB>rt<"bottom"ip><"clear">',
            buttons: [
                'excel'
            ]
        });



        $('#customSearch').on('keyup', function() {
            table.search(this.value).draw();
        });

        table.buttons().container().appendTo('#exampley_wrapper .col-md-6:eq(0)');
        $('#loader').show();

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
                            table.row.add([
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
                                escapeHtml(item.Level_2 || 'N/A'),
                                escapeHtml(item.Level_2_Name || 'N/A'),
                                escapeHtml(item.Level_2_employer_code || 'N/A'),
                                escapeHtml(item.Level_2_designation_name || 'N/A'),
                                escapeHtml(item.Level_3 || 'N/A'),
                                escapeHtml(item.Level_3_Name || 'N/A'),
                                escapeHtml(item.Level_3_employer_code || 'N/A'),
                                escapeHtml(item.Level_3_designation_name || 'N/A'),
                                escapeHtml(item.Level_4 || 'N/A'),
                                escapeHtml(item.Level_4_Name || 'N/A'),
                                escapeHtml(item.Level_4_employer_code || 'N/A'),
                                escapeHtml(item.Level_4_designation_name || 'N/A'),
                                escapeHtml(item.Level_5 || 'N/A'),
                                escapeHtml(item.Level_5_Name || 'N/A'),
                                escapeHtml(item.Level_5_employer_code || 'N/A'),
                                escapeHtml(item.Level_5_designation_name || 'N/A'),
                                escapeHtml(item.Level_6 || 'N/A'),
                                escapeHtml(item.Level_6_Name || 'N/A'),
                                escapeHtml(item.Level_6_employer_code || 'N/A'),
                                escapeHtml(item.Level_6_designation_name || 'N/A'),
                                escapeHtml(item.Level_7 || 'N/A'),
                                escapeHtml(item.Level_7_Name || 'N/A'),
                                escapeHtml(item.Level_7_employer_code || 'N/A'),
                                escapeHtml(item.Level_7_designation_name || 'N/A'),
                            ]).draw();
                        });
                    } else {
                        table.row.add(['No data found', '', '', '', '', '', '', '', '', '', '', '', '',
                            '', '', '', '', '', '', '', '', '', '', '', '', '', ''
                        ]).draw();
                    }

                    populateDropdowns(response.Distributor_data);
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
            var selectedOption = $('#Replacing_Employee option:selected');
            return {
                pjp_code: selectedOption.val() || null,
                employee_level: selectedOption.data('id') || null
            };
        }

        function fetchDataAndUpdate() {
            table.clear().draw();

            var params = getParams();
            fetchData('<?= site_url('admin/replacedataajex'); ?>', params);
        }

        $('#Replacing_Employee').change(function() {
            $('#Target_DBS').empty();
            fetchDataAndUpdate();
        });

    });
</script>