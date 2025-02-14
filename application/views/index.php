<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <title>Sales Hierarchy</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="assets/img/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="assets/img/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/img/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/img/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="assets/img/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/img/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="assets/img/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="assets/img/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicon-16x16.png">
    <link rel="manifest" href="assets/img/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="assets/img/ms-icon-144x144.png">

    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/fontawesome/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/vendor.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard-menu-theme-default.css'); ?>">
    <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css'> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">


    <style>
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



        .dt-buttons {
            float: right;
        }

        .dt-length label {
            display: none;
        }

        /* General styling for the menu */
        .nav-divider {
            height: 1px;
            background-color: #ddd;

        }

        .nav>li {
            list-style: none;
            position: relative;
            transition: background-color 0.3s ease;
            /* border-left: 4px solid; */
            /* Base border for levels */
            cursor: pointer;
            /* Add pointer cursor to indicate clickable items */
        }



        /* Active state styling */
        .nav>li.active {
            background-color: #e9ecef;
            font-weight: bold;
            color: #007bff;
        }

        /* Styling for different levels */
        .nav>li[data-level="1"] {
            border-color: #007bff;
            /* Blue for Level 1 */
        }

        .nav>li[data-level="2"] {
            border-color: #28a745;
            /* Green for Level 2 */
        }

        .nav>li[data-level="3"] {
            border-color: #17a2b8;
            /* Teal for Level 3 */
        }

        .nav>li[data-level="4"] {
            border-color: #ffc107;
            /* Yellow for Level 4 */
        }

        .nav>li[data-level="5"] {
            border-color: #dc3545;
            /* Red for Level 5 */
        }

        .nav>li[data-level="6"] {
            border-color: #6f42c1;
            /* Purple for Level 6 */
        }

        .nav>li[data-level="7"] {
            border-color: #343a40;
            /* Dark for Level 7 */

            /* Hide Level 7 */
        }

        /* Styling for menu items */

        @keyframes slideDown {
            from {
                height: 0;
                opacity: 0;
            }

            to {
                height: auto;
                opacity: 1;
            }
        }
    </style>

    <style>
        /* .mgscd-menu .app-side,
    .mgscd-menu .app-side .side-nav ul,
    .mgscd-menu .app-side .side-nav a {
        position: relative;
        z-index: 9999 !important;
    } */

        /* General Styling */
        .nav-divider {
            margin: 10px 0;
            border-bottom: 1px solid #e0e0e0;
        }

        .mgscd-menu .app-side {
            width: 251px;
        }



        .leaf-node .nav-tools {
            display: none;
            /* Hide toggle icon for Level 7 */
        }

        .nav-title {
            font-weight: bold;
            font-size: 16px;
            color: #2c3e50;
        }

        .nav-icon img {
            transition: transform 0.3s ease;
        }

        .has-children:hover .nav-icon img {
            transform: scale(1.1);
        }

        .nav-sub {
            margin-left: 20px;
            border-left: 2px solid #e0e0e0;
        }

        .no-toggle {
            cursor: default;
            /* Disable pointer events on Level 7 */
        }

        /* Mobile Responsive Design */
        @media (max-width: 768px) {
            .nav-title {
                font-size: 14px;
            }

            .nav-icon img {
                height: 25px;
            }
        }
    </style>
    <style>
        .nav-title {
            font-size: 10px
        }

        .mgscd-menu .app-main {
            width: 79vw;

        }

        .mgscd-menu .navbar-default {
            background-image: linear-gradient(3deg, #FB7D02 0%, #FDE20D 100%) !important;
        }
    </style>

    <style>
        /* CSS styles */




        thead .table-dark {
            background: #bd0000 !important;
            /* Background color for the header */
        }
    </style>


    <style>
        .nav-sub {
            display: none;
            margin-left: 15px;
        }

        .nav-sub.show {
            display: block;
        }

        .toggle-icon {
            margin-left: 5px;
        }
    </style>



    <style>
        .nav-sub {
            display: none;
        }

        .nav-sub.open {
            display: block;
        }



        /* Default style for all levels */
        .nav-item {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }

        .Level_1 {
            background-color: rgb(248, 154, 3) !important;
            /* AliceBlue */
        }

        .Level_2 {
            background-color: rgb(248, 160, 22) !important;
            /* LightBlue */
        }

        .Level_3 {
            background-color: rgb(250, 169, 38) !important;
            /* LightCyan */
        }

        .Level_4 {
            background-color: rgb(251, 179, 55) !important;
            /* LightSkyBlue */
        }

        .Level_5 {
            background-color: rgb(253, 188, 71) !important;
            /* SkyBlue */
        }

        .Level_6 {
            background-color: rgb(254, 198, 88) !important;
            /* DodgerBlue */
        }

        .Level_7 {
            background-color: rgb(254, 207, 104) !important;
            /* Blue */
        }

        /* Additional styling for nav tools */
        .nav-tools {
            float: right;
            margin-left: 10px;
        }

        .nav-tools i {
            color: #333;
        }

        /* Styling for active menu items */
        /* .nav-item.active {
            background-color: #b3e0ff;
        } */

        @media (min-width: 992px) {
            .mgscd-menu .navbar-header-left {
                width: 254px;
            }
        }

        table th {
            background: linear-gradient(3deg, #FB7D02 0%, #FDE20D 100%) !important;
        }
    </style>

    <style>
        /* .nav-item.active {
                    background-color: red;
                    color: #fff;
                } */

        /* .nav-item.active .nav-title {
            color: red;

        } */

        .nav-sub {
            display: none;
        }

        .nav-sub.open {
            display: block;
        }
    </style>


    <style>
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

        .app-side,
        .mgscd-menu .side-visible-line {
            background-color: #C7E2DB;
        }

        table.dataTable>tbody>tr>th,
        table.dataTable>tbody>tr>td {
            padding: 4px 10px !important;
        }
    </style>

</head>

<body>
    <div class="mgscd-menu app">
        <div class="app-wrap">
            <header class="app-heading">
                <div class="canvas is-fixed is-top bg-white p-v-15 shadow-4dp" id="top-search">
                    <div class="container-fluid">
                        <form class="topheadersearch">
                            <div class="input-group input-group-lg icon-before-input"><input type="text" name="s"
                                    class="form-control input-lg b-0" placeholder="Search for...">
                                <div class="icon z-3"><i class="fa-solid fa-magnifying-glass fa-fw fa-lg"></i></div>
                                <span class="input-group-btn"><button data-target="#top-search" data-toggle="canvas"
                                        class="btn btn-danger btn-line top-search-btn-icon"><i
                                            class="fa-solid fa-circle-xmark fa-fw fa-lg"></i></button></span>
                            </div>
                        </form>
                    </div>
                </div>
                <nav class="navbar navbar-default navbar-static-top shadow-2dp">
                    <div class="navbar-header">
                        <div class="navbar-header-left b-r"><a class="logo" href="index"><span
                                    class="logo-xs hidden-md"><img src="assets/img/logo-sm.png"
                                        alt="logo-sm"></span><span class="logo-lg visible-md"><img
                                        src="assets/img/logo.png" alt="logo"></span></a> </div>
                        <nav class="nav navbar-header-nav">
                            <!-- <a class="hidden-md b-r" href="#" data-side="collapse"><i
                                    class="fa-solid fa-bars fa-fw"></i></a><a class="visible-md b-r" href="#"
                                data-side="mini"><i class="fa-solid fa-bars fa-fw"></i></a> -->
                            <!-- <form class="navbar-form visible-md b-r">
                                <div class="icon-after-input"><input type="text" name="s" class="form-control"
                                        placeholder="Search">
                                    <div class="icon"><a href="#"><i class="fa-solid fa-magnifying-glass fa-fw"></i></a>
                                    </div>
                                </div>
                            </form> -->
                        </nav>
                        <ul class="nav navbar-header-nav m-l-a">
                            <li class="hidden-md b-l"><a href="#top-search" data-toggle="canvas"><i
                                        class="fa-solid fa-magnifying-glass fa-fw"></i></a></li>


                            <li class="dropdown b-l">
                                <a class="dropdown-toggle profile-pic" href="#" data-bs-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <!-- <img class="img-circle" src="assets//img/m1.jpg" alt="Jone Doe">
                                    
                                     -->
                                    <b class="visible-md hidden-sm logged-user-display-name"> Welcome,
                                        <?php echo htmlspecialchars($user_name); ?>!
                                    </b>
                                </a>
                                <ul class="dropdown-menu animated flipInY float-right">


                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('welcome/logout'); ?>"><i
                                                class="fa-solid fa-right-from-bracket fa-fw"></i> Logout</a></li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <div class="app-container">
                <aside class="app-side">
                    <div class="side-content">


                        <div class="user-panel">
                            <div class="user-image">
                                <a href="#">
                                    <img class="img-circle" src="./assets/img/Bloom.png" alt="John Doe"></a>
                            </div>

                        </div>
                        <?php
                        function render_tree($tree, $level = 1)
                        {
                            $html = '';

                            foreach ($tree as $key => $subTree) {
                                $level_class = "Level_$level";
                                $level_label = "Level $level"; // Label for the current level

                                $html .= "<li class='$level_class'>";

                                // Check if the current level is the last level (Level 7)
                                $is_last_level = ($level == 7);

                                // Construct the link with or without icon based on whether it's the last level
                                $html .= "<a href='javascript:void(0);' class='nav-item' data-id='" . htmlspecialchars($key) . "' data-level='" . $level . "'>";
                                $html .= "<span class='nav-icon'><img src='./assets/img/profile.png' alt='' class='img-circle' style='height: 20px;'></span>";
                                $html .= "<span class='nav-title'>" . htmlspecialchars($level_label . ": " . " (" . $subTree['name'] . ")") . "</span>";

                                // Only include the arrow icon if it's not the last level
                                if (!$is_last_level) {
                                    $html .= "<span class='nav-tools'><i class='fa-solid fa-plus'></i></span>";
                                }

                                $html .= "</a>";

                                // Check if there are nested levels
                                if (!empty($subTree['children'])) {
                                    $html .= "<ul class='nav nav-sub'>";
                                    $html .= render_tree($subTree['children'], $level + 1); // Recursive call
                                    $html .= "</ul>";
                                }

                                $html .= "</li>";
                            }

                            return $html;
                        }
                        ?>


                        <nav class="side-nav dmvertical-menu">
                            <ul class="metismenu nav nav-inverse nav-bordered" data-plugin="dashboardmenu">
                                <?php echo render_tree($maping); ?>
                            </ul>
                        </nav>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                // Select all menu items
                                const menuItems = document.querySelectorAll('.nav-item');

                                menuItems.forEach(item => {
                                    item.addEventListener('click', function() {
                                        // Remove the 'active' class from all items
                                        menuItems.forEach(i => {
                                            i.classList.remove('active');
                                            // Reset all icons to the "+" symbol
                                            const icon = i.querySelector('.nav-tools i');
                                            if (icon) {
                                                icon.classList.remove('fa-minus');
                                                icon.classList.add('fa-plus');
                                            }
                                        });

                                        // Add the 'active' class to the clicked item
                                        this.classList.add('active');

                                        // Optionally, you can open the submenu if it has one
                                        const subMenu = this.nextElementSibling;
                                        if (subMenu && subMenu.classList.contains('nav-sub')) {
                                            subMenu.classList.toggle('open');
                                        }

                                        // Toggle the icon for the clicked item
                                        const icon = this.querySelector('.nav-tools i');
                                        if (icon) {
                                            if (subMenu && subMenu.classList.contains('open')) {
                                                // Change icon to "-" when submenu is open
                                                icon.classList.remove('fa-plus');
                                                icon.classList.add('fa-minus');
                                            } else {
                                                // Reset icon to "+" when submenu is closed
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



                <div class="side-visible-line visible-md" data-side="collapse">
                    <!-- 
                    <i class="fa-solid fa-caret-left"></i><i class="fa-solid fa-arrow-right-arrow-left"></i> -->
                </div>
                <div class="app-main">

                    <div class="main-content bg-clouds">
                        <div class="container p-t-15">
                            <div class="row">


                                <div class="table-responsive">
                                    <table id="example" class="table table-bordered table-striped" cellspacing="0"
                                        width="100%">
                                        <thead class="table-danger">
                                            <tr>
                                                <th>Customer Name</th>
                                                <th>Customer Code</th>
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
                                                <th>SUPER STOCKIST</th>
                                                <th>STATUS</th>
                                                <th>Customer Type Name</th>
                                                <th>Customer Type Code</th>
                                                <th>Sales Name</th>
                                                <th>Sales Code</th>
                                                <th>Customer Group Name</th>
                                                <th>Customer Group Code</th>
                                                <th>Division Name</th>
                                                <th>Division Code</th>
                                                <th>Sector Name</th>
                                                <th>Sector Code</th>
                                                <th>State Code</th>
                                                <th>Zone Code</th>
                                                <th>Distributor Channel Name</th>
                                                <th>Distributor Channel Code</th>
                                                <th>Level 7 Designation Name</th>
                                                <th>Level 7 Name</th>
                                                <th>Level 6 Designation Name</th>
                                                <th>Level 6 Name</th>
                                                <th>Level 5 Designation Name</th>
                                                <th>Level 5 Name</th>
                                                <th>Level 4 Designation Name</th>
                                                <th>Level 4 Name</th>
                                                <th>Level 3 Designation Name</th>
                                                <th>Level 3 Name</th>
                                                <th>Level 2 Designation Name</th>
                                                <th>Level 2 Name</th>
                                                <th>Level 1 Designation Name</th>
                                                <th>Level 1 Name</th>
                                                <th>Customer Creation Date</th>
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
            <footer id="footer" class="footer app-footer">
                <div class="container">
                    <div class="row">
                        <div class="footer-top col-sm-12">

                            <p class="text-center copyright">&copy; <span id="mgsYear"></span> <a href="">©2024</a>
                                Sales Hierarchy All Rights Reserved </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <div id="loader" style="display: none ">
        <div class="spinner"></div>
    </div>

    <style>
        /* Loader container */
        #loader {
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            /* background-color: rgba(255, 255, 255, 0.8); */
            /* Semi-transparent background */
            display: flex;
            justify-content: center;
            /* Center horizontally */
            align-items: center;
            /* Center vertically */
            z-index: 9999;
            /* Ensure loader is above other content */
        }

        /* Loader spinner */
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            border-left: 4px solid #000;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        /* Spinner animation */
        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- <a href="#" class="scrollup"><i class="fa-solid fa-circle-arrow-up"></i></a> -->
    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/vendor.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/mgsdashboard.js'); ?>"></script>


    <script src='https://cdn.datatables.net/2.0.8/js/dataTables.js'></script>
    <script src='https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js'></script>



    <script>
        new DataTable('#example');
    </script>

    <script>
        $(document).ready(function() {

            function loadTreeData(id, level) {
                console.log(id);
                console.log(level);

                $('#loader').show();


                $.ajax({
                    url: '<?php echo base_url('welcome/ajax_endpoint'); ?>',
                    method: 'POST',
                    contentType: 'application/json',
                    dataType: 'json',
                    data: JSON.stringify({
                        id: id,
                        level: level
                    }),
                    success: function(data) {
                        var treeArray = data;
                        $('#loader').hide();
                        treeajex(treeArray);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });
            }

            var sessionPjpCode = '<?php echo $pjp_code; ?>';
            var sessionLevel = '<?php echo $level; ?>';
            loadTreeData(sessionPjpCode, sessionLevel);
            $('.side-nav a').on('click', function() {
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
            scrollY: "400px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"B><"p-2 bd-highlight"f>>t<"bottom"ip><"clear">',
            buttons: [{
                extend: 'excelHtml5', // Keeps Excel functionality
                text: '<i class="fa fa-download"></i> Download', // Adds icon and custom text
                titleAttr: 'Download as Excel', // Tooltip text
                exportOptions: {
                    // Optional: customize columns or rows here
                }
            }]
        });

        function treeajex(treeArray) {
            $('#loader').show();

            $.ajax({
                url: '<?php echo base_url('welcome/treeajexsave'); ?>',
                method: 'POST',
                contentType: 'application/json',
                dataType: 'json',
                data: JSON.stringify(treeArray),
                success: function(response) {
                    $('#loader').hide();

                    if (response.status === 'success') {
                        console.log('response Employee Data:', response);
                        displayEmployeeData(response.data);
                    } else {
                        console.error('Error:', response.message);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }
            });
        }


        function displayEmployeeData(employeeData) {
            table.clear();
            $.each(employeeData, function(index, employee) {
                var row = `
          <tr>
            <td>${employee.Customer_Name}</td>
            <td>${employee.DB_Code}</td>
            <td>${employee.Pin_Code}</td>
            <td>${employee.City}</td>
            <td>${employee.District}</td>
            <td>${employee.Contact_Number}</td>
            <td>${employee.Country}</td>
              <td>${employee.Zone}</td>
                <td>${employee.State}</td>
                  <td>${employee.Population_Strata_1}</td>
                    <td>${employee.Population_Strata_2}</td>
                      <td>${employee.Country_Group}</td>
                        <td>${employee.GTM_TYPE}</td>
                          <td>${employee.SUPERSTOCKIST}</td>
                            <td>${employee.STATUS}</td>
                            <td>${employee.Customer_Type_Name}</td>
                            <td>${employee.Customer_Type_Code}</td>
                            <td>${employee.Sales_Name}</td>
                             <td>${employee.Sales_Code}</td>
                            <td>${employee.Customer_Group_Name}</td>
                            <td>${employee.Customer_Group_Code}</td>
                            <td>${employee.Division_Name}</td>
                            <td>${employee.Division_Code}</td>
                                        <td>${employee.Sector_Name}</td>
                                          <td>${employee.Sector_Code}</td>
                                            <td>${employee.State_Code}</td>
                                               <td>${employee.Zone_Code}</td>
                                                <td>${employee.Distribution_Channel_Name}</td>
                                                  <td>${employee.Distribution_Channel_Code}</td>
                                                    <td>${employee.emp1_employee_id}</td>
                                                       <td>${employee.emp1_name}</td>
                                                        <td>${employee.emp2_employee_id}</td>
                                                        <td>${employee.emp2_name}</td>
                                                        <td>${employee.emp3_employee_id}</td>
                                                         <td>${employee.emp3_name}</td>
                                                          <td>${employee.emp4_employee_id}</td>
                                                           <td>${employee.emp4_name}</td>
                                                            <td>${employee.emp5_employee_id}</td>
                                                             <td>${employee.emp5_name}</td>
                                                              <td>${employee.emp6_employee_id}</td>
                                                               <td>${employee.emp6_name}</td>
                                                                <td>${employee.emp7_employee_id}</td>
                                                                 <td>${employee.emp7_name}</td>
                                                                  <td>${employee.Customer_Creation_Date} 
                                                                   </td>
                                                                   </tr>`;
                table.row.add($(row));
            });
            table.draw();
        }
    </script>

</body>

</html>