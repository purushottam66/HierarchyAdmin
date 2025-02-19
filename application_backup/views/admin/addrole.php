<style>
    .permission-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .permission-table th,
    .permission-table td {
        border: 1px solid #ddd;
        line-height: 30px;
        text-align: center;
    }

    .permission-table th {
        background-color: #f2f2f2;
    }

    .btnss {

        padding: 10px 20px;
        background-color: #FB8B03 ;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        margin-left: 20px;

        margin-top: 20px;
        float: right;
    }

    .btnss:hover {
        background-color: #0a6867;
        color: #fff;
    }

    tr td {
        font-size: 12px !important;
        line-height: 30px !important;
    }
</style>



<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Edit role</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="">Permission Manager</a> / Add role</div>
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
                                <form method="post" action="<?php echo site_url('admin/save_role'); ?>">
                                    <style>
                                        .zone-container {
                                            display: flex;
                                            flex-wrap: wrap;
                                            gap: 15px;
                                        }

                                        .zone-checkbox-wrapper {
                                            flex: 1 1 100px;
                                            display: flex;
                                            align-items: center;
                                        }

                                        .form-check {
                                            margin: 0;
                                        }
                                    </style>


                                    <div class="row">
                                        <div class="col-md-8">
                                            <input type="hidden" name="user_id"
                                                value="<?php echo htmlspecialchars($user['id']); ?>">
                                            <table class="permission-table">
                                                <thead>
                                                    <tr>
                                                        <th>Module Name</th>
                                                        <th>View</th>
                                                        <th>Edit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>

                                                        <td>

                                                        </td>
                                                        <td>

                                                            <button type="button" class="btn"
                                                                onclick="setAllPermissionsView('yes')">All
                                                                Yes</button>
                                                            <button type="button" class="btn"
                                                                onclick="setAllPermissionsView('no')">All
                                                                No</button>

                                                        </td>

                                                        <td>

                                                            <button type="button" class="btn"
                                                                onclick="setAllPermissionsEdit('yes')">All
                                                                Yes</button>
                                                            <button type="button" class="btn"
                                                                onclick="setAllPermissionsEdit('no')">All
                                                                No</button>

                                                        </td>
                                                    </tr>
                                                    <?php if (!empty($modules['modules'])): ?>
                                                        <?php foreach ($modules['modules'] as $module): ?>
                                                            <?php
                                                            $permission = array_filter($permissions, function ($p) use ($module) {
                                                                return $p['module_name'] === $module['module_name'];
                                                            });
                                                            $permission = !empty($permission) ? array_shift($permission) : ['view' => 'no', 'edit' => 'no'];
                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo htmlspecialchars($module['module_name']); ?>
                                                                    <input type="hidden"
                                                                        name="modules[<?php echo $module['id']; ?>][name]"
                                                                        value="<?php echo htmlspecialchars($module['module_name']); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type="radio"
                                                                        name="permissions[<?php echo $module['id']; ?>][view]"
                                                                        value="yes"
                                                                        <?php echo ($permission['view'] === 'yes') ? 'checked' : ''; ?>>
                                                                    Yes
                                                                    <input type="radio"
                                                                        name="permissions[<?php echo $module['id']; ?>][view]"
                                                                        value="no"
                                                                        <?php echo ($permission['view'] === 'no') ? 'checked' : ''; ?>>
                                                                    No
                                                                </td>
                                                                <td>
                                                                    <input type="radio"
                                                                        name="permissions[<?php echo $module['id']; ?>][edit]"
                                                                        value="yes"
                                                                        <?php echo ($permission['edit'] === 'yes') ? 'checked' : ''; ?>>
                                                                    Yes
                                                                    <input type="radio"
                                                                        name="permissions[<?php echo $module['id']; ?>][edit]"
                                                                        value="no"
                                                                        <?php echo ($permission['edit'] === 'no') ? 'checked' : ''; ?>>
                                                                    No
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <tr>
                                                            <td colspan="3">No Modules Available</td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-md-4">

                                            <h5>Select Zones</h5>

                                            <div class="dropdown custom-dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton">
                                                    <i class="fa fa-caret-down" id="dropdownIcon"></i>
                                                    <span id="dropdownButtonText">Select Zones</span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                                    <div class="action-buttons">
                                                        <button type="button" class="btn btn-outline-primary btn-sm"
                                                            onclick="checkAll()">Check </button>
                                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                                            onclick="uncheckAll()">Uncheck </button>
                                                    </div>
                                                    <!-- <?php if (!empty($zone)): ?>
                                                    <?php foreach ($zone as $zoneItem): ?>
                                                    <li>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="zone-<?php echo $zoneItem['id']; ?>" name="zones[]"
                                                                value="<?php echo $zoneItem['id']; ?>"
                                                                <?php echo in_array((int)$zoneItem['id'], $selected_zones_array) ? 'checked' : ''; ?>>
                                                            <label class="form-check-label"
                                                                for="zone-<?php echo $zoneItem['id']; ?>">
                                                                <?php echo htmlspecialchars($zoneItem['zone_name']); ?>
                                                            </label>
                                                        </div>
                                                    </li>
                                                    <?php endforeach; ?>
                                                    <?php else: ?>
                                                    <li>No Zones Available</li>
                                                    <?php endif; ?> -->

                                                    <?php foreach ($zone as $zoneItem): ?>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="zone-<?php echo htmlspecialchars($zoneItem['Zone_Code']); ?>"
                                                                name="zones[]"
                                                                value="<?php echo htmlspecialchars($zoneItem['Zone_Code']); ?>"
                                                                <?php echo in_array($zoneItem['Zone_Code'], $selected_zones_array) ? 'checked' : ''; ?>>
                                                            <label class="form-check-label"
                                                                for="zone-<?php echo htmlspecialchars($zoneItem['Zone_Code']); ?>">
                                                                <?php echo htmlspecialchars($zoneItem['Zone']); ?>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>


                                        </div>
                                    </div>


                                    <button type="submit" class="btnss btn r ">Submit</button> &#8202; &#8202;
                                    <a href="#" class="href">
                                        <button type="button" onclick="history.back()"
                                            class="btnss btn bg-danger ">Back</button>
                                    </a><br> <br>
                                    <br>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    #dropdownMenuButton {
        width: 100%;
        overflow: hidden;
    }

    .custom-dropdown {
        position: relative;
        width: 300px;
    }

    .dropdown-menu {
        max-height: 300px;
        width: 100%;
        overflow-y: auto;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 10px;
    }

    .dropdown-menu .form-check {
        margin-bottom: 5px;
    }

    .dropdown-menu .form-check-input {
        margin-right: 10px;
    }

    .dropdown-toggle::after {
        display: none;
    }

    .dropdown-toggle .fa {
        margin-right: 5px;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.custom-dropdown .dropdown-menu .form-check-input');
        const button = document.getElementById('dropdownMenuButton');
        const buttonText = document.getElementById('dropdownButtonText');
        const dropdownIcon = document.getElementById('dropdownIcon');
        const dropdownMenu = document.querySelector('.custom-dropdown .dropdown-menu');

        function updateButtonText() {
            const selectedZones = Array.from(checkboxes)
                .filter(checkbox => checkbox.checked)
                .map(checkbox => checkbox.nextElementSibling.textContent);

            buttonText.textContent = selectedZones.length > 0 ?
                selectedZones.join(', ') :
                'Select Zones';
        }

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateButtonText);
        });

        button.addEventListener('click', function(event) {
            event.stopPropagation(); // Prevent click from closing the dropdown
            const isExpanded = dropdownMenu.classList.contains('show');
            dropdownIcon.classList.toggle('fa-caret-down', !isExpanded);
            dropdownIcon.classList.toggle('fa-caret-up', isExpanded);
            dropdownMenu.classList.toggle('show', !isExpanded);
        });



        window.checkAll = function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateButtonText();
        };

        window.uncheckAll = function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateButtonText();
        };
    });
</script>



<script>
    function setAllPermissionsView(value) {
        var viewRadios = document.querySelectorAll('input[name$="[view]"]');

        viewRadios.forEach(function(radio) {
            if (radio.value === value) {
                radio.checked = true;
            }
        });
    }

    function setAllPermissionsEdit(value) {
        var editRadios = document.querySelectorAll('input[name$="[edit]"]');

        editRadios.forEach(function(radio) {
            if (radio.value === value) {
                radio.checked = true;
            }
        });
    }
</script>



<script>
    new DataTable('#example');
</script>