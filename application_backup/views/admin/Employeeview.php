<style>
    .value-display {
        padding: 8px 0;
        border-bottom: 1px solid #dee2e6;
    }
</style>


<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">View Employee</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">User Manager
                    </a> / View Employee</div>
            </div>
        </div>
    </header>

    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <div class="form-container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <!-- Name -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="value-display">
                                                        <b>Name</b> :
                                                        <?php echo ($employee['name']) ? $employee['name'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="value-display">
                                                        <b>employer name</b> :
                                                        <?php echo ($employee['employer_name']) ? $employee['employer_name'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Email -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Email</b> : <?php echo ($employee['email']) ? $employee['email'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>employer_code </b> : <?php echo ($employee['employer_code']) ? $employee['employer_code'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>adhar_card </b> : <?php echo ($employee['adhar_card']) ? $employee['adhar_card'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>gender </b> : <?php echo ($employee['gender']) ? $employee['gender'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>pjp_code </b> : <?php echo ($employee['pjp_code']) ? $employee['pjp_code'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>employee_id </b> : <?php echo ($employee['employee_id']) ? $employee['employee_id'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>application_id </b> : <?php echo ($employee['application_id']) ? $employee['application_id'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>level </b> : <?php echo ($employee['level']) ? $employee['level'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>dob </b> : <?php echo ($employee['dob']) ? $employee['dob'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mobile -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Mobile</b> : <?php echo ($employee['mobile']) ? $employee['mobile'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- PJP Code -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>PJP Code</b> : <?php echo ($employee['pjp_code']) ? $employee['pjp_code'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Employee ID -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Employee ID</b> : <?php echo ($employee['employee_id']) ? $employee['employee_id'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Level -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Level</b> : <?php echo ($employee['level']) ? $employee['level'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Designation Name -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Designation Name</b> : <?php echo ($employee['designation_name']) ? $employee['designation_name'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>



                                            <!-- Designation Label Name -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Designation Label Name</b> : <?php echo ($employee['designation_label_name']) ? $employee['designation_label_name'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Date of Joining -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Date of Joining (DOJ)</b> : <?php echo ($employee['doj']) ? $employee['doj'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Employee Status -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Employee Status</b> : <?php echo ($employee['employee_status']) ? $employee['employee_status'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Town -->







                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>city</b> : <?php echo ($employee['city']) ? $employee['city'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- District -->


                                            <!-- State -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>State</b> : <?php echo ($employee['state']) ? $employee['state'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Address -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Address</b>: <?php echo ($employee['address']) ? $employee['address'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Region -->
                                            <div class="col-md-6">
                                                <div class="form-group">

                                                    <div class="value-display">
                                                        <b>Zone</b> : <?php echo !empty($employee['region']) ? $employee['region'] : 'N/A'; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Back button (optional) -->
                                        <div class="text-center mt-4">
                                            <a href="#" onclick="history.back()"
                                                class="btn btn-secondary text-white ">Back to
                                                List</a>
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
</div>