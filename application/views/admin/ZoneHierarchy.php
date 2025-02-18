<link rel="stylesheet" href="https://cdn.datatables.net/2.1.6/css/dataTables.dataTables.css" class="rel">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css" class="rel">

<style>
    .sidetree {
        border: 1px solid gray;
        background-color: #cccccc;
    }


    #ooooo.nav>li {
        list-style: none;
    }

    #ooooo.nav-item {
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        transition: background-color 0.3s, color 0.3s;

    }

    .Level_1 {
        background-color: rgb(248, 154, 3) !important;
        color: #444;
        border-bottom: 1px solid;
    }

    .Level_1:hover {
        background-color: rgb(248, 154, 3) !important;
        color: #333;
    }

    .Level_2 {
        background-color: rgb(248, 160, 22) !important;
        color: #555;
        border-bottom: 1px solid;
    }

    .Level_2:hover {
        background-color: rgb(248, 160, 22) !important;
        color: #444;
    }

    .Level_3 {
        background-color: rgb(250, 169, 38) !important;
        color: #666;
        border-bottom: 1px solid;
    }

    .Level_3:hover {
        background-color: rgb(250, 169, 38) !important;
        color: #555;
    }

    .Level_4 {
        background-color: rgb(251, 179, 55) !important;
        color: #777;
        border-bottom: 1px solid;
    }

    .Level_4:hover {
        background-color: rgb(251, 179, 55) !important;
        color: #666;
    }

    .Level_5 {
        background-color: rgb(253, 188, 71) !important;
        color: #888;
        border-bottom: 1px solid;
    }

    .Level_5:hover {
        background-color: rgb(253, 188, 71) !important;
        color: #777;
    }

    .Level_6 {
        background-color: rgb(254, 198, 88) !important;
        color: #999;
        border-bottom: 1px solid;
    }

    .Level_6:hover {
        background-color: rgb(254, 198, 88) !important;
        color: #888;
    }

    .Level_7 {
        background-color: rgb(254, 207, 104) !important;
        color: #aaa;
        border-bottom: 1px solid;
    }

    .Level_7:hover {
        background-color: rgb(254, 207, 104) !important;
        color: #999;
    }


    #ooooo a {
        background-color: transparent;
        color: rgb(68, 59, 59);
        font-weight: bold;
    }

    .nav-item:hover {
        background-color: #d0d0d0;
        color: #333;
    }


    .nav-tools i {
        margin-left: 10px;
    }
</style>






<style>
    .test {
        font-size: 10px;
    }

    .zones {
        font-size: 8px;
    }

    .nav-divider {
        height: 1px;
        background-color: #ccc;
        margin: 5px 0;
    }

    .nav {
        list-style-type: none;
        padding: 0;
    }

    .nav li {
        position: relative;
    }

    .nav a {
        display: block;
        padding: 10px;
        text-decoration: none;
    }



    .nav-sub__ {
        padding-left: 10px;
        display: none;
    }

    .nav-tools {
        float: right;
    }

    .fa-angles-down {
        transform: rotate(90deg);
    }
</style>



<div class="app-main">
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body row">
                            <div class="col-md-3 sidetree">
                                <aside class="app-side mt-1">
                                    <div class="side-content">
                                        <?php
                                        function render_tree($tree, $level = 1)
                                        {
                                            $html = '';

                                            foreach ($tree as $key => $subTree) {
                                                $level_class = "Level_$level";
                                                $level_label = "Level $level";
                                                $level_value = htmlspecialchars($key);

                                                $html .= "<li class='$level_class' style='width: -webkit-fill-available;'>";

                                                $is_last_level = ($level == 7);

                                                $html .= "<a href='javascript:void(0);' class='nav-item test' style='font-size: 9px;' data-id='" . $level_value . "' data-level='" . $level . "'>";
                                                $html .= "<span class='nav-title'>" . htmlspecialchars($level_label . ": " . " (" . $subTree['name'] . ")") . "</span>";

                                                if (!$is_last_level) {
                                                    $html .= "<span class='nav-tools'><i class='fa-solid fa-plus'></i></span>";
                                                }

                                                $html .= "</a>";

                                                if (!empty($subTree['children'])) {
                                                    $html .= "<ul class='nav nav-sub nav-sub__'>";
                                                    $html .= render_tree($subTree['children'], $level + 1);
                                                    $html .= "</ul>";
                                                }

                                                $html .= "</li>";
                                            }

                                            return $html;
                                        }
                                        ?>
                                        <nav class="side-nav dmvertical-menu" id="ooooo" >
                                            <ul class="metismenu nav nav-inverse nav-bordered"
                                                data-plugin="dashboardmenu" style="margin-left: -14px;">
                                                <?php echo render_tree($maping); ?>
                                            </ul>
                                        </nav>



                                        <script>
                                            document.addEventListener('DOMContentLoaded', function() {

                                                const menuItems = document.querySelectorAll('.nav-item');

                                                menuItems.forEach(item => {
                                                    item.addEventListener('click', function() {

                                                        menuItems.forEach(i => {
                                                            i.classList.remove('active');
                                                            const icon = i.querySelector(
                                                                '.nav-tools i');
                                                            if (icon) {
                                                                icon.classList.remove(
                                                                    'fa-minus');
                                                                icon.classList.add(
                                                                    'fa-plus');
                                                            }
                                                        });

                                                        this.classList.add('active');

                                                        const subMenu = this.nextElementSibling;
                                                        if (subMenu && subMenu.classList.contains(
                                                                'nav-sub')) {
                                                            subMenu.classList.toggle('open');
                                                        }

                                                        const icon = this.querySelector(
                                                            '.nav-tools i');
                                                        if (icon) {
                                                            if (subMenu && subMenu.classList
                                                                .contains('open')) {
                                                                icon.classList.remove('fa-plus');
                                                                icon.classList.add('fa-minus');
                                                            } else {
                                                                icon.classList.remove('fa-minus');
                                                                icon.classList.add('fa-plus');
                                                            }
                                                        }
                                                    });
                                                });
                                            });
                                        </script>
                                    </div>
                                </aside>
                            </div>


                            <div class="col-md-9" style="margin-top: -10px;">
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
                                    <div class="table-responsive">
                                        <table id="employeeTable" class="display nowrap table table-bordered table-hover text-center"
                                            style="width:100%">
                                            <thead class="table-danger">
                                                <tr>
                                                    <th class="text-center">sr.no</th>
                                                    <th class="text-center ">Customer Name</th>
                                                    <th class="text-center ">Customer Code </th>
                                                    <th class="text-center ">Pin Code</th>
                                                    <th class="text-center ">City</th>
                                                    <th class="text-center ">District</th>
                                                    <th class="text-center ">Contact Number</th>
                                                    <th class="text-center ">Country</th>
                                                    <th class="text-center ">Zone</th>
                                                    <th class="text-center ">State</th>
                                                    <th class="text-center ">Population Strata 1</th>
                                                    <th class="text-center ">Population Strata 2</th>
                                                    <!-- <th class="text-center ">Country Group</th> -->
                                                    <th class="text-center ">GTM TYPE</th>
                                                    <th class="text-center ">Super Stockist</th>
                                                    <th class="text-center ">Status</th>
                                                    <th class="text-center ">Customer Type Name</th>
                                                    <!-- <th class="text-center ">Customer Type Code</th> -->
                                                    <th class="text-center ">Sales Name</th>
                                                    <!-- <th class="text-center ">Sales Code</th> -->
                                                    <th class="text-center ">Customer Group Name</th>
                                                    <!-- <th class="text-center ">Customer Group Code</th> -->
                                                    <th class="text-center ">Customer Creation Date</th>
                                                    <th class="text-center ">Division Name</th>
                                                    <th class="text-center ">Division Code</th>
                                                    <th class="text-center ">Sector Name</th>
                                                    <th class="text-center ">Sector Code</th>
                                                    <!-- <th class="text-center ">State Code</th> -->
                                                    <!-- <th class="text-center ">Zone Code</th> -->
                                                    <th class="text-center ">Distribution Channel Code</th>
                                                    <th class="text-center ">Distribution Channel Name</th>
                                                    <th class="text-center ">Level 1</th>
                                                    <th class="text-center ">Level 1 Name</th>
                                                    <th class="text-center ">Level 1 designation name</th>
                                                    <th class="text-center ">Level 2</th>
                                                    <th class="text-center ">Level 2 Name</th>
                                                    <th class="text-center ">Level 2 designation name</th>
                                                    <th class="text-center ">Level 3</th>
                                                    <th class="text-center ">Level 3 Name</th>
                                                    <th class="text-center ">Level 3 designation name</th>
                                                    <th class="text-center ">Level 4</th>
                                                    <th class="text-center ">Level 4 Name</th>
                                                    <th class="text-center ">Level 4 designation name</th>
                                                    <th class="text-center ">Level 5</th>
                                                    <th class="text-center ">Level 5 Name</th>
                                                    <th class="text-center ">Level 5 designation name</th>
                                                    <th class="text-center ">Level 6</th>
                                                    <th class="text-center ">Level 6 Name</th>
                                                    <th class="text-center ">Level 6 designation name</th>
                                                    <th class="text-center ">Level 7</th>
                                                    <th class="text-center ">Level 7 Name</th>
                                                    <th class="text-center ">Level 7 designation name</th>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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

                        window.location.href = "<?php echo site_url('admin/hierarchydelete/'); ?>" +
                            id;
                    } else {
                        swal("Cancelled", "Your item is safe :)", "error");
                    }
                });
        };
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

        if ($.fn.DataTable.isDataTable('#employeeTable')) {
            $('#employeeTable').DataTable().clear().destroy();
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
            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"B><"p-2 bd-highlight"f>>t<"bottom"ip><"clear">',
            buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fa fa-download"></i> Download',
                filename: 'ZoneHierarchy',
                titleAttr: 'Download as Excel',
                exportOptions: {}
            }]
        });

        var previousLevels = {
            Level_1: null,
            Level_2: null,
            Level_3: null,
            Level_4: null,
            Level_5: null,
            Level_6: null,
            Level_7: null
        };

        var previousId = null;

        function loadTreeData(id, level) {
            $('#loader').show();

            if (level === 1 && id !== previousLevels.Level_1) {
                previousLevels = {
                    Level_1: id,
                    Level_2: null,
                    Level_3: null,
                    Level_4: null,
                    Level_5: null,
                    Level_6: null,
                    Level_7: null
                };
            }

            var requestData = {
                id: id,
                level: level,
                Level_1: previousLevels.Level_1,
                Level_2: previousLevels.Level_2,
                Level_3: previousLevels.Level_3,
                Level_4: previousLevels.Level_4,
                Level_5: previousLevels.Level_5,
                Level_6: previousLevels.Level_6,
                Level_7: previousLevels.Level_7
            };




            $.ajax({
                url: '<?php echo base_url('admin/ajax_endpoint'); ?>',
                method: 'POST',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify(requestData),
                success: function(data) {
                    var treeArray = data;


                    $('#loader').hide();

                    treeajex(treeArray);

                    var levelKey = "Level_" + level;
                    previousLevels[levelKey] = id;

                    if (level > 1) {
                        for (var i = level + 1; i <= 7; i++) {
                            previousLevels["Level_" + i] = null;
                        }
                    }

                    previousId = id;
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        }

        $('#ooooo a').on('click', function() {
            var id = $(this).data('id');
            var level = $(this).data('level');

            loadTreeData(id, level);
        });






    });


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


    function treeajex(treeArray) {
        $('#loader').show();

        $.ajax({
            url: '<?php echo base_url('admin/treezoneajex'); ?>',
            method: 'POST',
            contentType: 'application/json',
            dataType: 'json',
            data: JSON.stringify(treeArray),
            success: function(response) {
                $('#loader').hide();
                if (response.status === 'success') {
                    $('#employeeTable').DataTable().clear();
                    let employeeData = response.data;
                    $.each(employeeData, function(index, employee) {
                        var serialNumber = index + 1;

                        var rowData = [
                            serialNumber,
                            escapeHtml(employee.Customer_Name || 'N/A'),
                            escapeHtml(employee.Customer_Code || 'N/A'),
                            escapeHtml(employee.Pin_Code || 'N/A'),
                            escapeHtml(employee.City || 'N/A'),
                            escapeHtml(employee.District || 'N/A'),
                            escapeHtml(employee.Contact_Number || 'N/A'),
                            escapeHtml(employee.Country || 'N/A'),
                            escapeHtml(employee.Zone || 'N/A'),
                            escapeHtml(employee.State || 'N/A'),
                            escapeHtml(employee.Population_Strata_1 || 'N/A'),
                            escapeHtml(employee.Population_Strata_2 || 'N/A'),
                            // escapeHtml(employee.Country_Group || 'N/A'),
                            escapeHtml(employee.GTM_TYPE || 'N/A'),
                            escapeHtml(employee.SUPERSTOCKIST || 'N/A'),
                            escapeHtml(employee.STATUS || 'N/A'),
                            escapeHtml(employee.Customer_Type_Name || 'N/A'),
                            // escapeHtml(employee.Customer_Type_Code || 'N/A'),
                            escapeHtml(employee.Sales_Name || 'N/A'),
                            // escapeHtml(employee.Sales_Code || 'N/A'),
                            escapeHtml(employee.Customer_Group_Name || 'N/A'),
                            // escapeHtml(employee.Customer_Group_Code || 'N/A'),
                            escapeHtml(employee.Customer_Creation_Date || 'N/A'),
                            escapeHtml(employee.Division_Name || 'N/A'),
                            escapeHtml(employee.Division_Code || 'N/A'),
                            escapeHtml(employee.Sector_Name || 'N/A'),
                            escapeHtml(employee.Sector_Code || 'N/A'),
                            // escapeHtml(employee.State_Code || 'N/A'),
                            // escapeHtml(employee.Zone_Code || 'N/A'),
                            escapeHtml(employee.Distribution_Channel_Code || 'N/A'),
                            escapeHtml(employee.Distribution_Channel_Name || 'N/A'),
                            escapeHtml(employee.emp1 || 'N/A'),
                            escapeHtml(employee.emp1_name || 'N/A'),
                            escapeHtml(employee.emp1_employee_id || 'N/A'),

                            escapeHtml(employee.emp2 || 'N/A'),
                            escapeHtml(employee.emp2_name || 'N/A'),
                            escapeHtml(employee.emp2_employee_id || 'N/A'),

                            escapeHtml(employee.emp3 || 'N/A'),
                            escapeHtml(employee.emp3_name || 'N/A'),
                            escapeHtml(employee.emp3_employee_id || 'N/A'),

                            escapeHtml(employee.emp4 || 'N/A'),
                            escapeHtml(employee.emp4_name || 'N/A'),
                            escapeHtml(employee.emp4_employee_id || 'N/A'),

                            escapeHtml(employee.emp5 || 'N/A'),
                            escapeHtml(employee.emp5_name || 'N/A'),
                            escapeHtml(employee.emp5_employee_id || 'N/A'),

                            escapeHtml(employee.emp6 || 'N/A'),
                            escapeHtml(employee.emp6_name || 'N/A'),
                            escapeHtml(employee.emp6_employee_id || 'N/A'),

                            escapeHtml(employee.emp7 || 'N/A'),
                            escapeHtml(employee.emp7_name || 'N/A'),
                            escapeHtml(employee.emp7_employee_id || 'N/A'),

                        ];

                        $('#employeeTable').DataTable().row.add(rowData);
                    });

                    $('#employeeTable').DataTable().draw();
                } else {
                    console.error('Error:', response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }
        });
    }
</script>





<script>
        $(document).ready(function() {

            $("#loader").show();

            console.log("Fetching data...");
            $.ajax({
                url: '<?php echo base_url("admin/ZoneHierarchy_ajex_tree"); ?> ', 
                type: 'GET',
                dataType: 'json',
                success: function(response) {

                    console.log(response);
                    

                    console.log("Data fetched successfully.");

                    $("#loader").hide();
                    if (response && response.length > 0) {
                        var treeHtml = generateTree(response); 
                        $('#zone-hierarchy').html(treeHtml); 
                    } else {
                        $('#zone-hierarchy').html('No Data Available.');
                    }
                },
                error: function() {
                    $('#zone-hierarchy').html('Error fetching data.');
                }
            });


        });
    </script>