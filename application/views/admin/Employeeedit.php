<style>
    .form-group {
        margin-bottom: 15px;
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
                <h3 class="dashhead-title">Edit Employee</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">User Manager
                    </a> / Edit Employee</div>
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
                                <form action="<?php echo site_url('admin/submit_employee_edit/' . $employee['id']); ?>"
                                    method="post">
                                    <?php if ($this->session->flashdata('error')): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $this->session->flashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row">
                                        <!-- Name -->
                                        <!-- Name -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" value="<?php echo $employee['name']; ?>" id="name"
                                                    class="form-control" name="name" placeholder="Enter Name"
                                                    value="<?php echo $employee['name']; ?>" required>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">employer name</label>
                                                <input type="text" value="<?php echo $employee['employer_name']; ?>" id="name"
                                                    class="form-control" name="employer_name" placeholder="employer name"
                                                    value="<?php echo $employee['employer_name']; ?>" required>
                                            </div>
                                        </div>

                                        <!-- Email -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Enter Email" value="<?php echo $employee['email']; ?>"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Mobile -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="tel" id="mobile" maxlength="10" class="form-control"
                                                    name="mobile" placeholder="Enter Mobile"
                                                    value="<?php echo $employee['mobile']; ?>" required>
                                            </div>
                                        </div>




                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="dob">dob</label>


                                                <input type="date" name="dob" class="form-control" placeholder=" dob"
                                                    value="<?php echo $employee['dob']; ?>">

                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="employer_code">employer_code</label>


                                                <input type="text" id="combined_value" name="employer_code"
                                                    class="form-control" placeholder=" employer_code "
                                                    value="<?php echo $employee['employer_code']; ?>">

                                            </div>
                                        </div>




                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="adhar_card">Aadhaar Card</label>
                                                <input type="text" name="adhar_card" class="form-control"
                                                    value="<?php echo $employee['adhar_card']; ?>"
                                                    placeholder="Aadhaar Card" maxlength="12" pattern="\d{12}"
                                                    title="Please enter a valid 12-digit Aadhar number" required
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                            </div>
                                        </div>


                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select class="selectpicker  form-control" id="gender" name="gender" required>
                                                    <option value="" disabled>Select gender</option>
                                                    <option value="Male"
                                                        <?php echo ($employee['gender'] == 'Male') ? 'selected' : ''; ?>>
                                                        Male</option>
                                                    <option value="Female"
                                                        <?php echo ($employee['gender'] == 'Female') ? 'selected' : ''; ?>>
                                                        Female</option>
                                                    <option value="Other"
                                                        <?php echo ($employee['gender'] == 'Other') ? 'selected' : ''; ?>>
                                                        Other</option>
                                                </select>
                                            </div>
                                        </div>







                                        <!-- Level -->
                                        <!-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="level">Level</label>
                                                <select class="form-select" id="level" name="level" required>
                                                    <option value="" disabled
                                                        <?php echo empty($employee['level']) ? 'selected' : ''; ?>>
                                                        Select Level</option>
                                                    <?php foreach ($level as $lvl): ?>
                                                        <option value="<?php echo $lvl['level_id']; ?>"
                                                            <?php echo (string)$lvl['level_id'] === (string)$employee['level'] ? 'selected' : ''; ?>>
                                                            <?php echo $lvl['level_name']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->



                                        <!-- Designation -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="designation">Designation</label>
                                                <select class="selectpicker  form-control" id="designation" name="designation"
                                                    required>
                                                    <option selected>Select Designation</option>
                                                    <?php foreach ($designation as $levels): ?>
                                                        <option data-name="<?php echo $levels['id']; ?>"
                                                            value="<?php echo $levels['id']; ?>"
                                                            <?php echo $levels['id'] == $employee['designation'] ? 'selected' : ''; ?>>
                                                            <?php echo $levels['Designation']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Hidden input to store the designation name -->
                                        <input type="hidden" id="designation_name" name="designation_name"
                                            value="<?php echo $employee['designation']; ?>">

                                        <!-- Designation_Label -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="designation_label">Designation
                                                    Label</label>
                                                <select class="selectpicker  form-control" id="designation_label"
                                                    name="designation_label" required>
                                                    <option selected>Select Label</option>
                                                    <?php foreach ($designation as $levels): ?>
                                                        <option data-name="<?php echo $levels['id']; ?>"
                                                            value="<?php echo $levels['id']; ?>"
                                                            <?php echo $levels['id'] == $employee['designation_label'] ? 'selected' : ''; ?>>
                                                            <?php echo $levels['Designation_Label']; ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                        <!-- Hidden input to store the designation name -->
                                        <input type="hidden" id="designation_label_name" name="designation_label_name"
                                            value="<?php echo $employee['designation_label']; ?>">

                                        <!-- Date of Joining (DOJ) -->


                                        <!-- Employee Status -->
                                        <!-- <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="employee_status">Employee Status</label>
                                                <select id="employee_status" class="selectpicker  form-control" name="employee_status">
                                                    <option value="Active"
                                                        <?php echo ($employee['employee_status'] === 'active') ? 'selected' : ''; ?>>
                                                        Active</option>
                                                    <option value="Inactive"
                                                        <?php echo ($employee['employee_status'] === 'inactive') ? 'selected' : ''; ?>>
                                                        Inactive</option>
                                                </select>
                                            </div>
                                        </div> -->
                                        <!-- 
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="state">state:</label>
                                                <select class="selectpicker form-control" data-actions-box="true"
                                                    title="Select state" data-size="5" data-live-search="true"
                                                    id="state" name="state">
                                                    <?php if (!empty($unique_State)) : ?>
                                                        <?php foreach ($unique_State as $unique_State__) : ?>
                                                            <?php if ($unique_State__ !== null) : ?>
                                                                <?php
                                                                // Trim the values to remove any extra spaces or hidden characters
                                                                $unique_State__ = trim($unique_State__);
                                                                $employee_state = trim($employee['state']);
                                                                ?>
                                                                <option value="<?php echo htmlspecialchars($unique_State__); ?>"
                                                                    <?php echo ($unique_State__ == $employee_state) ? 'selected="selected"' : ''; ?>>
                                                                    <?php echo htmlspecialchars($unique_State__); ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <option value="N/A">No available</option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                        </div> -->


                                        <!-- 

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="city"> city:</label>
                                                <select class="selectpicker form-control" data-actions-box="true"
                                                    title="Select City" data-size="5" data-live-search="true" id="city" name="city">
                                                    <option value="<?php echo htmlspecialchars($employee_city); ?>"
                                                        <?php echo (strtolower(trim($employee_city)) == strtolower(trim($employee_city))) ? 'selected="selected"' : ''; ?>>
                                                        <?php echo htmlspecialchars($employee_city); ?>
                                                    </option>
                                                </select>


                                            </div>
                                        </div> -->





                                        <!-- 
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label for="region"> Zone:</label>
                                                <select class="selectpicker  form-control" data-actions-box="true"
                                                    title="Select Zone" data-size="5" data-live-search="true"
                                                    id="region" name="region" required>
                                                    <option value="N/A">Select </option>

                                                    <option value="<?php echo htmlspecialchars($employee_region); ?>"
                                                        <?php echo (strtolower(trim($employee_region)) == strtolower(trim($employee_region))) ? 'selected="selected"' : ''; ?>>
                                                        <?php echo htmlspecialchars($employee_region); ?>
                                                    </option>
                                                </select>
                                            </div>
                                        </div> -->



                                        <!-- Address -->
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea id="address" class="form-control" name="address"
                                                    placeholder="Enter Address"><?php echo $employee['address']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btnss ">Submit</button> &#8202;
                                    <a href="#" class="href">
                                        <button onclick="history.back()" type="button"
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



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

    if (selectedOption) {
        var designationName = selectedOption.textContent.trim(); // Get visible text (ASM)
        document.getElementById('designation_label_name').value = designationName;

    }
});

</script>

<script>
    document.getElementById('designation').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];

        if (selectedOption) {
            var designationText = selectedOption.textContent.trim(); // Get visible text (ASM)
            document.getElementById('designation_name').value = designationText;

        }
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
                                    '<option value="' + zone + '">' + zone +
                                    '</option>'
                                );
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