<style>
    .form-group {
        margin-bottom: 15px;
    }

    .selectpicker form-control {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }



    .btnss {
        padding: 10px 20px;
        background-color: #0a6867;
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
                <h3 class="dashhead-title">Add Employee</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">User Manager
                    </a> / Add Employee</div>
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
                                <form action="" method="post" id="employeeForm">

                                    <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="form-group">
                                            <label>
                                                <input type="checkbox" id="vacantCheckbox"> Is Vacant
                                            </label>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="vacantInput">Name :</label>
                                                <input type="text" id="vacantInput" class=" form-control"
                                                    name="name" placeholder="Enter Name">
                                            </div>
                                        </div>

                                        <input type="hidden" id="hiddenVacant" name="hiddenVacant">
                                        <script>
                                            const checkbox = document.getElementById('vacantCheckbox');
                                            const vacantInput = document.getElementById('vacantInput');
                                            const hiddenVacant = document.getElementById('hiddenVacant');

                                            checkbox.addEventListener('change', function() {
                                                if (this.checked) {
                                                    vacantInput.value = "vacant";
                                                    hiddenVacant.value = "1";
                                                } else {
                                                    vacantInput.value = "";
                                                    hiddenVacant.value = "";
                                                }
                                            });
                                        </script>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="selectpicker form-control"
                                                    name="email" placeholder="Enter Email" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="tel" id="mobile" maxlength="10"
                                                    class="selectpicker form-control" name="mobile"
                                                    placeholder="Enter Mobile" required>
                                            </div>
                                        </div>




                                        <input type="hidden" id="combined_value" name="pjp_code"
                                            class="selectpicker form-control" placeholder=" PJP Code" readonly>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="dob">dob</label>


                                                <input type="date" name="dob" id="dob" class="selectpicker form-control"
                                                    placeholder=" dob">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="application_id">Application ID</label>
                                                <input type="text" id="application_id" class="selectpicker form-control"
                                                    name="application_id" maxlength="12" max="12" placeholder="Enter Application ID" required>
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="employer_code">employer Name</label>


                                                <input type="text" name="employer_name"
                                                    class="selectpicker form-control" placeholder=" Employer Name">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="employer_code">employer_code</label>


                                                <input type="text" id="combined_value" name="employer_code"
                                                    class="selectpicker form-control" placeholder=" employer_code">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="adhar_card">Aadhaar Card</label>
                                                <input type="text" id="aadhar" name="adhar_card" class="selectpicker form-control"
                                                    placeholder="Aadhaar Card" maxlength="12" pattern="\d{12}"
                                                    title="Please enter a valid 12-digit Aadhar number" required
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            </div>
                                        </div>



                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="form-control selectgender" id="gender" name="gender" required>
                                                    <option value="" selected disabled>Select gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="employee_id">Employee ID</label>
                                                <input type="text" id="employee_id" class="selectpicker form-control"
                                                    name="employee_id" placeholder="Enter Employee ID" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="level">Level</label>
                                                <select class="selectpicker  form-control" id="level" name="level"
                                                    required>

                                                    <?php foreach ($level as $levels): ?>
                                                        <option value="<?php echo $levels['level_id']; ?>">
                                                            <?php echo $levels['level_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <input type="hidden" id="designation_name" name="designation_name" value="" placeholder="...">


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="designation">Designation</label>
                                                <select class="selectpicker form-control" id="designation" name="designation" required>
                                                    <option selected>Select Designation</option>
                                                    <?php foreach ($designation as $levels): ?>
                                                        <option data-label="<?php echo $levels['Designation']; ?>" data-name="<?php echo $levels['Designation_Label']; ?>"
                                                            value="<?php echo $levels['id']; ?>">
                                                            <?php echo $levels['Designation']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="designation_label">Designation label</label>
                                                <select class="selectpicker form-control" id="designation_label" name="designation_label" required>
                                                    <option selected>Select Label</option>
                                                </select>
                                            </div>
                                        </div>


                                        <input type="hidden" id="designation_label_name" name="designation_label_name"
                                            value="">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="doj">Date of Joining (DOJ)</label>
                                                <input type="date" id="doj" class="selectpicker form-control"
                                                    name="doj">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="employee_status">Employee Status</label>
                                                <select id="employee_status" class="selectpicker  form-control"
                                                    name="employee_status">
                                                    <option value="active">Active</option>
                                                    <!-- <option value="inactive">Inactive</option> -->
                                                </select>
                                            </div>
                                        </div>








                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="state"> state:</label>
                                                <select class="selectpicker  form-control" data-actions-box="true"
                                                    title="Select state" data-size="5" data-live-search="true"
                                                    id="state" name="state">
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


                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="city"> city:</label>
                                                <select class="selectpicker  form-control" data-actions-box="true"
                                                    title="Select City" data-size="5" data-live-search="true" id="city"
                                                    name="city">
                                                    <option value="N/A">Select </option>
                                                </select>
                                            </div>
                                        </div>




                                        <div class="col-md-4">
                                            <div class="form-group ">
                                                <label for="region"> Zone:</label>
                                                <select class="selectpicker  form-control" data-actions-box="true"
                                                    title="Select Zone" data-size="5" data-live-search="true"
                                                    id="region" name="region" required>
                                                    <option value="N/A">Select </option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Add hidden input for zone code -->
                                        <input type="hidden" id="zone_code" name="zone_code" value="">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label for="address">Address</label>


                                                <textarea id="address" class="selectpicker form-control" name="address"
                                                    placeholder="Enter Address" required></textarea>
                                            </div>
                                        </div>

                                        <input type="hidden" id="password" class="selectpicker form-control"
                                            name="password" value="test@test" placeholder="Enter Password" required>


                                    </div>

                                    <button type="submit" class="btn btnss ">Submit</button> &#8202;
                                    <a href="#" onclick="history.back()" class="href">
                                        <button type="button"
                                            class="btn btnss bg-danger ">Back</button>
                                    </a>

                                    <br><br>
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
<script src="<?php echo base_url('admin/assets/js/sweetalert2.js'); ?>"></script>



<script>
    $(document).ready(function() {
        $('#employeeForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '<?php echo site_url('admin/submit_employee'); ?>',
                type: 'POST',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    // Check if the response is an error or success
                    if (response.status === 'error') {
                        // Show error toast
                        Swal.fire({
                            toast: true,
                            icon: 'error',
                            title: response.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                    } else {
                        // Show success toast
                        Swal.fire({
                            toast: true,
                            icon: 'success',
                            title: response.message,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        }).then(() => {
                            window.location.href = '<?php echo site_url('admin/userdetails'); ?>';
                        });
                    }
                },
                error: function() {
                    // Show general error toast
                    Swal.fire({
                        toast: true,
                        icon: 'error',
                        title: 'Something went wrong!',
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                    });
                }
            });
        });
    });
</script>

<script>
    function updateCombinedValue() {
        var employeeId = document.getElementById('employee_id').value;
        var designationElement = document.getElementById('designation_label');
        var selectedOption = designationElement.options[designationElement.selectedIndex];
        var designationName = selectedOption ? selectedOption.getAttribute('data-name') : '';

        var combinedValue = designationName + employeeId;

        document.getElementById('combined_value').value = combinedValue;

    }

    document.getElementById('employee_id').addEventListener('input', updateCombinedValue);
    document.getElementById('designation_label').addEventListener('change', updateCombinedValue);
</script>


<script>
    document.getElementById('designation_label').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        var designation_label = selectedOption.getAttribute('data-name');

        document.getElementById('designation_label_name').value = designation_label;
    });
</script>

<script>
    document.getElementById('designation').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        var designation = selectedOption.getAttribute('data-label');

        document.getElementById('designation_name').value = designation;
    });


    document.getElementById('combined_value').addEventListener('input', function(e) {
        this.value = this.value.replace(/[^0-9]/g, '');
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
                        $.each(response, function(index, city) {
                            if (city.City) {
                                $('#city').append(
                                    '<option value="' + escapeHtml(city.City) +
                                    '">' +
                                    escapeHtml(city.City) +
                                    '</option>'
                                );
                            }
                        });
                    } else {
                        $('#city').append('<option value="N/A">No cities available</option>');
                    }

                    $('#city').selectpicker('refresh');

                    if (response && response.length > 0) {
                        const uniqueZones = new Map();

                        $.each(response, function(index, zoneData) {
                            if (zoneData.Zone && zoneData.Zone_Code) {
                                uniqueZones.set(zoneData.Zone_Code, escapeHtml(zoneData
                                    .Zone));
                            }
                        });

                        $('#region').empty();

                        if (uniqueZones.size > 0) {
                            uniqueZones.forEach(function(zone, zoneCode) {
                                $('#region').append(
                                    '<option value="' + zone + '" data-zonecode="' + zoneCode + '">' + zone +
                                    '</option>'
                                );
                            });
                            
                            // Add change event handler to update hidden zone code
                            $('#region').on('change', function() {
                                var selectedOption = $(this).find('option:selected');
                                var zoneCode = selectedOption.data('zonecode');
                                $('#zone_code').val(zoneCode);
                            });
                        } else {
                            $('#region').append(
                                '<option value="N/A">No zones available</option>');
                        }
                    } else {
                        $('#region').append('<option value="N/A">No zones available</option>');
                    }

                    $('#region').selectpicker('refresh');



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
    $(document).ready(function() {
        // On change of the Designation dropdown
        $('#designation').change(function() {
            var designationId = $(this).val(); // Get the selected Designation ID

            // Clear the Designation Label dropdown
            $('#designation_label').empty();
            $('#designation_label').append('<option selected>Select Label</option>'); // Reset the first option

            // Loop through the options and find the labels corresponding to the selected designation
            $('option[data-name]').each(function() {
                var label = $(this).data('name'); // Get the corresponding Designation Label
                var value = $(this).val(); // Get the corresponding Designation ID

                // Only append the label if the ID matches the selected Designation ID
                if (designationId == value) {
                    // Correctly append the option with the 'data-name' attribute and the label
                    $('#designation_label').append('<option value="' + value + '" data-name="' + label + '">' + label + '</option>');
                }
            });

            // Reinitialize selectpicker to reflect changes
            $('#designation_label').selectpicker('refresh');
        });
    });
</script>



<script>
    document.getElementById('vacantCheckbox').addEventListener('change', function() {
        const emailField = document.getElementById('email');
        const mobileField = document.getElementById('mobile');
        const aadharField = document.getElementById('aadhar');
        const dobField = document.getElementById('dob');
        const genderField = document.getElementById('gender');
        const dojField = document.getElementById('doj');

        if (this.checked) {
            emailField.value = `user${Math.floor(Math.random() * 1000)}@example.com`;
            mobileField.value = '99999' + Math.floor(10000 + Math.random() * 90000).toString();
            aadharField.value = '111111111111'; // Fixed Aadhar value
            dobField.value = '1990-01-01'; // Fixed DOB value in YYYY-MM-DD format

            genderField.value = 'Male';

            const today = new Date();
            const currentDate = today.toISOString().split('T')[0];
            dojField.value = currentDate;

            // Disable fields
            emailField.readOnly = true;
            mobileField.readOnly = true;
            aadharField.readOnly = true;
            dobField.readOnly = true;
            genderField.readOnly = true;
            dojField.readOnly = true;
        } else {
            // Clear the fields
            emailField.value = '';
            mobileField.value = '';
            dobField.value = '';
            aadharField.value = '';
            genderField.value = '';
            dojField.value = '';

            // Enable fields
            emailField.readOnly = false;
            mobileField.readOnly = false;
            aadharField.readOnly = false;
            dobField.readOnly = false;
            genderField.readOnly = false;
            dojField.readOnly = false;
        }
    });
</script>