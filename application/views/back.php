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

    .leaf-node .nav-tools {
        display: none;
        /* Hide toggle icon for Level 7 */
    }

    .nav-title {
        font-weight: 600;
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
                        <nav class="nav navbar-header-nav"><a class="hidden-md b-r" href="#" data-side="collapse"><i
                                    class="fa-solid fa-bars fa-fw"></i></a><a class="visible-md b-r" href="#"
                                data-side="mini"><i class="fa-solid fa-bars fa-fw"></i></a>
                            <form class="navbar-form visible-md b-r">
                                <div class="icon-after-input"><input type="text" name="s" class="form-control"
                                        placeholder="Search">
                                    <div class="icon"><a href="#"><i class="fa-solid fa-magnifying-glass fa-fw"></i></a>
                                    </div>
                                </div>
                            </form>
                        </nav>
                        <ul class="nav navbar-header-nav m-l-a">
                            <li class="hidden-md b-l"><a href="#top-search" data-toggle="canvas"><i
                                        class="fa-solid fa-magnifying-glass fa-fw"></i></a></li>


                            <li class="dropdown b-l">
                                <a class="dropdown-toggle profile-pic" href="#" data-bs-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">
                                    <img class="img-circle" src="assets//img/m1.jpg" alt="Jone Doe"><b
                                        class="visible-md hidden-sm logged-user-display-name"> Admin
                                    </b></a>
                                <ul class="dropdown-menu animated flipInY float-right">


                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url('login'); ?>"><i
                                                class="fa-solid fa-right-from-bracket fa-fw"></i>
                                            Logout</a></li>
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
                                    <img class="img-circle" src="./assets/img/Group8143.png" alt="John Doe"></a>
                            </div>

                        </div>
                        <?php




$levels = [
    'Level_1' => [],
    'Level_2' => [],
    'Level_3' => [],
    'Level_4' => [],
    'Level_5' => [],
    'Level_6' => [],
    'Level_7' => []
];

// Iterate through the mappings to separate data by levels
foreach ($users['mappings'] as $mapping) {
    for ($i = 1; $i <= 7; $i++) {
        $level_key = "Level_$i";
        if (!empty($mapping[$level_key])) {
            $levels[$level_key][] = [
                $level_key => $mapping[$level_key],
                'DB_Code' => $mapping['DB_Code'],
                'Distinct_Column' => $mapping['Distinct_Column'],
                'id' => $mapping['id']
            ];
        }
    }
}

// Remove duplicates from each level data
foreach ($levels as $key => $level) {
    $levels[$key] = array_map("unserialize", array_unique(array_map("serialize", $level)));
}

// Encode the results as JSON
$levels_json = json_encode($levels);

?>
                        <!-- Pass the PHP data to JavaScript -->


                        <nav class="side-nav dmvertical-menu">
                            <ul id="menuContainer" class="metismenu nav nav-inverse nav-bordered"></ul>
                        </nav>



                    </div>
                    <!-- <div class="side-footer p-h-15 p-t-15 p-b-10">
                        <p>
                            <img src="./assets/img/Group8143.png" alt="" class="img-circle" style="height: 30px;">
                            Sales Hierarchy
                        </p>


                    </div> -->
                </aside>
                <div class="side-visible-line visible-md" data-side="collapse"><i class="fa-solid fa-caret-left"></i><i
                        class="fa-solid fa-arrow-right-arrow-left"></i></div>
                <div class="app-main">
                    <!-- <header class="main-heading shadow-2dp">
                        <div class="dashhead bg-white">
                            <div class="dashhead-titles">
                                <h3 class="dashhead-title">

                                    <img src="./assets/img/Component1.png" alt="" class="src">
                                </h3>
                            </div>
                            <div class="dashhead-toolbar">
                                <div class="dashhead-toolbar-item"><a href="index">
                                        <img src="./assets/img/Component2.png" alt="" class="src">

                                </div>
                            </div>
                        </div>
                    </header> -->
                    <div class="main-content bg-clouds">
                        <div class="container p-t-15">
                            <div class="row">
                                <div class="col-md-12" style="width:100%">
                                    <div class="box shadow-2dp b-r-2">
                                        <!-- <header class="b-b">
                                            <h4>Members</h4>
                                            <div class="box-tools"><span class="label label-success">5</span></div>
                                        </header> -->
                                        <div class="box-body">


                                            <form action="" method="post">
                                                <div class="row">

                                                    <div class="col-md-4">

                                                        <div class="form-group p-b-10">

                                                            <label for="sel1" class="form-label">Select Category
                                                            </label>

                                                            <select class="form-select"
                                                                aria-label="Default select example">
                                                                <option selected> select </option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>

                                                        </div>


                                                    </div>
                                                    <div class="col-md-4">

                                                        <div class="form-group p-b-10">

                                                            <label for="sel1" class="form-label">Select Category
                                                            </label>

                                                            <select class="form-select"
                                                                aria-label="Default select example">
                                                                <option selected> select </option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>

                                                        </div>


                                                    </div>
                                                    <div class="col-md-4">

                                                        <div class="form-group p-b-10">

                                                            <label for="sel1" class="form-label">Select Category
                                                            </label>

                                                            <select class="form-select"
                                                                aria-label="Default select example">
                                                                <option selected> select </option>
                                                                <option value="1">One</option>
                                                                <option value="2">Two</option>
                                                                <option value="3">Three</option>
                                                            </select>

                                                        </div>


                                                    </div>
                                                </div>
                                            </form>

                                            <div class="table-responsive">



                                                <!-- <table id="example" class="table table-bordered  table-striped "
                                                    cellspacing="0" width="100%">

                                                    <thead class="table-danger">
                                                        <tr>
                                                            <td>Customer Code</td>

                                                            <td>Customer Name</td>
                                                            <td>Pin Code</td>
                                                            <td>City</td>
                                                            <td>District</td>
                                                            <td>Contact Number</td>
                                                            <td>Country</td>
                                                            <td>Zone</td>
                                                            <td>State Name</td>
                                                            <td>Population Strata-1</td>
                                                            <td>Population Strata-2</td>
                                                            <td>Country Group</td>
                                                            <td>GTM Type</td>
                                                            <td>SuperStockist Y/N</td>
                                                            <td>Customer Active ?</td>
                                                            <td>Customer Type Code</td>
                                                            <td>Sales Org. Code</td>
                                                            <td>Customer Type Name</td>
                                                            <td>Customer Group Code</td>
                                                            <td>Customer Creation Date</td>
                                                            <td>Division Code</td>
                                                            <td>Sector Code</td>
                                                            <td>State Code</td>
                                                            <td>Zone Code</td>
                                                            <td>Distribution Channel Code</td>
                                                            <td>Distribution Channel Name</td>
                                                            <td>Customer Group Name</td>
                                                            <td>Sales Org. Name</td>
                                                            <td>Division Name</td>
                                                            <td>Sector Name</td>
                                                            <td>Levelx7_Designation Label</td>
                                                            <td>Levelx7_Name</td>
                                                            <td>_Levelx6_Designation Label</td>
                                                            <td>_Levelx6_Name</td>
                                                            <td>Levelx5Designation Label</td>
                                                            <td>Levelx5Name</td>
                                                            <td>_Levelx4Designation Label</td>
                                                            <td>_Levelx4Name</td>
                                                            <td>Levelx3Designation Label</td>
                                                            <td>Levelx3Name</td>
                                                            <td>_Levelx2Designation Label</td>
                                                            <td>_Levelx2Name</td>
                                                            <td>Levelx1 Designation Label</td>
                                                            <td>Level 1 Name</td>
                                                        </tr>
                                                    </thead>


                                                    <tr>
                                                        <td>0002110459</td>

                                                        <td>SEFALI COMMERCIAL PVT LTD</td>
                                                        <td>713101</td>
                                                        <td>BARDDHAMAN</td>
                                                        <td>BIRBHUM</td>
                                                        <td>9332241707</td>
                                                        <td>India</td>
                                                        <td>East</td>
                                                        <td>West Bengal</td>
                                                        <td>FLP</td>
                                                        <td>URBAN</td>
                                                        <td>Domestic</td>
                                                        <td>GTM</td>
                                                        <td>N</td>
                                                        <td>ACTIVE</td>
                                                        <td>04</td>
                                                        <td>1000</td>
                                                        <td>Overall Common</td>
                                                        <td>01</td>
                                                        <td>6/22/18</td>
                                                        <td>20</td>
                                                        <td>S061</td>
                                                        <td>19</td>
                                                        <td>05</td>
                                                        <td>10</td>
                                                        <td>Customer sale</td>
                                                        <td>Company Distributor</td>
                                                        <td>AWL Marketing</td>
                                                        <td>Besan traded</td>
                                                        <td>Barddham</td>
                                                        <td></td>
                                                        <td>DSM</td>
                                                        <td>Nakul</td>
                                                        <td>ASE</td>
                                                        <td>Bheema</td>
                                                        <td>ASM</td>
                                                        <td>Bipin</td>
                                                        <td>RSM</td>
                                                        <td>Sandeep</td>
                                                        <td>ZSM</td>
                                                        <td>Vishal</td>
                                                        <td>Cluster Head</td>
                                                        <td>Amar</td>
                                                        <td>Business Head</td>
                                                    </tr>



                                                </table> -->


                                                <div id="userTableContainer"></div>

                                                <!-- 
                                                <?php if (!empty($users['user'])): ?>
                                                <table id="example2" class="table table-bordered  table-striped "
                                                    cellspacing="0" width="100%">
                                                    <thead class="table-danger">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Pjp Code</th>
                                                            <th>Employee ID</th>
                                                            <th>Name</th>
                                                            <th>Email ID</th>
                                                            <th>Mobile No</th>
                                                            <th>Level</th>
                                                            <th>Designation</th>
                                                            <th>Designation Label</th>
                                                            <th>DOJ</th>
                                                            <th>Employee Status</th>
                                                            <th>Town</th>
                                                            <th>District Code</th>
                                                            <th>District</th>
                                                            <th>State</th>
                                                            <th>Address</th>
                                                            <th>Region</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><?php echo isset($users['user']['id']) ? $users['user']['id'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Pjp_Code']) ? $users['user']['Pjp_Code'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Employee_Id']) ? $users['user']['Employee_Id'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Name']) ? $users['user']['Name'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Email_Id']) ? $users['user']['Email_Id'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Mobile_No']) ? $users['user']['Mobile_No'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Level']) ? $users['user']['Level'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Designation']) ? $users['user']['Designation'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Designation_label']) ? $users['user']['Designation_label'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['DOJ']) ? $users['user']['DOJ'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Employee_Status']) ? $users['user']['Employee_Status'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Town']) ? $users['user']['Town'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['District_Code']) ? $users['user']['District_Code'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['District']) ? $users['user']['District'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['State']) ? $users['user']['State'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Address']) ? $users['user']['Address'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($users['user']['Region']) ? $users['user']['Region'] : 'Vacand'; ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <?php else: ?>
                                                <p>No user details available.</p>
                                                <?php endif; ?> -->

                                                <!-- Mappings Table -->
                                                <!-- <h2>Mappings</h2>
                                                <?php if (!empty($users['mappings'])): ?>
                                                <table id="example" class="table table-bordered  table-striped "
                                                    cellspacing="0" width="100%">
                                                    <thead class="table-danger">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>DB Code</th>
                                                            <th>Distinct Column</th>
                                                            <th>Level 1</th>
                                                            <th>Level 2</th>
                                                            <th>Level 3</th>
                                                            <th>Level 4</th>
                                                            <th>Level 5</th>
                                                            <th>Level 6</th>
                                                            <th>Level 7</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($users['mappings'] as $mapping): ?>
                                                        <tr>
                                                            <td><?php echo isset($mapping['id']) ? $mapping['id'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['DB_Code']) ? $mapping['DB_Code'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Distinct_Column']) ? $mapping['Distinct_Column'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Level_1']) ? $mapping['Level_1'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Level_2']) ? $mapping['Level_2'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Level_3']) ? $mapping['Level_3'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Level_4']) ? $mapping['Level_4'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Level_5']) ? $mapping['Level_5'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Level_6']) ? $mapping['Level_6'] : 'Vacand'; ?>
                                                            </td>
                                                            <td><?php echo isset($mapping['Level_7']) ? $mapping['Level_7'] : 'Vacand'; ?>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <?php else: ?>
                                                <p>No mappings available.</p>
                                                <?php endif; ?> -->


                                            </div>
                                        </div>
                                    </div>
                                </div>






                                <div class="col-md-12">
                                    <div class="box shadow-2dp b-r-2">
                                        <div class="box-body">
                                            <div id="userListContainer"></div>

                                        </div>
                                    </div>
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
    new DataTable('#example2');
    </script>







    <script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.has-children').forEach(item => {
            item.addEventListener('click', function() {
                const subMenu = this.nextElementSibling;
                const icon = this.querySelector('.toggle-icon');

                if (subMenu && subMenu.classList.contains('nav-sub')) {
                    subMenu.classList.toggle('show');
                    if (icon) {
                        icon.classList.toggle('fa-plus');
                        icon.classList.toggle('fa-minus');
                    }
                }
            });
        });
    });
    </script>

    <script>
    function transformHierarchy(flatData) {
        const hierarchy = {};

        flatData.Level_1.forEach(level1 => {
            if (level1.Level_1 !== "NULL") {
                if (!hierarchy[level1.Level_1]) {
                    hierarchy[level1.Level_1] = {
                        name: level1.Level_1,
                        distinct: level1.Distinct_Column,
                        dbCode: level1.DB_Code, // Include DB_Code
                        id: level1.id,

                        level: 1,
                        children: []
                    };
                }

                flatData.Level_2.forEach(level2 => {
                    if (level2.Distinct_Column === level1.Distinct_Column && level2.Level_2 !==
                        "NULL") {
                        const level1Children = hierarchy[level1.Level_1].children;

                        if (!level1Children.some(child => child.name === level2.Level_2)) {
                            level1Children.push({
                                name: level2.Level_2,
                                distinct: level2.Distinct_Column,
                                dbCode: level2.DB_Code, // Include DB_Code
                                id: level2.id,

                                level: 2,
                                children: []
                            });
                        }

                        flatData.Level_3.forEach(level3 => {
                            if (level3.Distinct_Column === level2.Distinct_Column && level3
                                .Level_3 !== "NULL") {
                                const level2Children = level1Children.find(child => child
                                    .name === level2.Level_2).children;

                                if (!level2Children.some(child => child.name === level3
                                        .Level_3)) {
                                    level2Children.push({
                                        name: level3.Level_3,
                                        distinct: level3.Distinct_Column,
                                        dbCode: level3.DB_Code, // Include DB_Code
                                        id: level3.id,

                                        level: 3,
                                        children: []
                                    });
                                }

                                flatData.Level_4.forEach(level4 => {
                                    if (level4.Distinct_Column === level3
                                        .Distinct_Column && level4.Level_4 !== "NULL") {
                                        const level3Children = level2Children.find(
                                                child => child.name === level3.Level_3)
                                            .children;

                                        if (!level3Children.some(child => child.name ===
                                                level4.Level_4)) {
                                            level3Children.push({
                                                name: level4.Level_4,
                                                distinct: level4
                                                    .Distinct_Column,
                                                dbCode: level4
                                                    .DB_Code, // Include DB_Code
                                                id: level4.id,

                                                level: 4,
                                                children: []
                                            });
                                        }

                                        flatData.Level_5.forEach(level5 => {
                                            if (level5.Distinct_Column ===
                                                level4.Distinct_Column && level5
                                                .Level_5 !== "NULL") {
                                                const level4Children =
                                                    level3Children.find(child =>
                                                        child.name === level4
                                                        .Level_4).children;

                                                if (!level4Children.some(
                                                        child => child.name ===
                                                        level5.Level_5)) {
                                                    level4Children.push({
                                                        name: level5
                                                            .Level_5,
                                                        distinct: level5
                                                            .Distinct_Column,
                                                        dbCode: level5
                                                            .DB_Code, // Include DB_Code
                                                        id: level5.id,

                                                        level: 5,
                                                        children: []
                                                    });
                                                }

                                                flatData.Level_6.forEach(
                                                    level6 => {
                                                        if (level6
                                                            .Distinct_Column ===
                                                            level5
                                                            .Distinct_Column &&
                                                            level6
                                                            .Level_6 !==
                                                            "NULL") {
                                                            const
                                                                level5Children =
                                                                level4Children
                                                                .find(
                                                                    child =>
                                                                    child
                                                                    .name ===
                                                                    level5
                                                                    .Level_5
                                                                )
                                                                .children;

                                                            if (!
                                                                level5Children
                                                                .some(
                                                                    child =>
                                                                    child
                                                                    .name ===
                                                                    level6
                                                                    .Level_6
                                                                )) {
                                                                level5Children
                                                                    .push({
                                                                        name: level6
                                                                            .Level_6,
                                                                        distinct: level6
                                                                            .Distinct_Column,
                                                                        dbCode: level6
                                                                            .DB_Code, // Include DB_Code
                                                                        id: level6
                                                                            .id,

                                                                        level: 6,
                                                                        children: []
                                                                    });
                                                            }

                                                            flatData.Level_7
                                                                .forEach(
                                                                    level7 => {
                                                                        if (level7
                                                                            .Distinct_Column ===
                                                                            level6
                                                                            .Distinct_Column &&
                                                                            level7
                                                                            .Level_7 !==
                                                                            "NULL"
                                                                        ) {
                                                                            const
                                                                                level6Children =
                                                                                level5Children
                                                                                .find(
                                                                                    child =>
                                                                                    child
                                                                                    .name ===
                                                                                    level6
                                                                                    .Level_6
                                                                                )
                                                                                .children;

                                                                            if (!
                                                                                level6Children
                                                                                .some(
                                                                                    child =>
                                                                                    child
                                                                                    .name ===
                                                                                    level7
                                                                                    .Level_7
                                                                                )
                                                                            ) {
                                                                                level6Children
                                                                                    .push({
                                                                                        name: level7
                                                                                            .Level_7,
                                                                                        distinct: level7
                                                                                            .Distinct_Column,
                                                                                        dbCode: level7
                                                                                            .DB_Code, // Include DB_Code
                                                                                        id: level7
                                                                                            .id,

                                                                                        level: 7,
                                                                                        children: []
                                                                                    });
                                                                            }
                                                                        }
                                                                    });
                                                        }
                                                    });
                                            }
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            }
        });

        return Object.values(hierarchy);
    }

    function generateMenu(hierarchy) {
        let menu = '';

        hierarchy.forEach(item => {

            console.log('====================================');
            console.log("itemitemitem", item);
            console.log('====================================');
            let isLeafNode = item.level === 7; // Check if the current level is 7
            let toggleIcon = isLeafNode ? '' : '<i class="fa-solid fa-plus fa-fw toggle-icon"></i>';
            let childrenMenu = item.children.length > 0 ? '<ul class="nav nav-sub">' + generateMenu(item
                .children) + '</ul>' : '';

            menu += `
            <li class="nav-divider"></li>
            <li data-level="${item.level}" onclick="setActive(this)">
                <a href="javascript:void(0);" class="has-children" data-name="${item.name}" data-id="${item.id}" data-dbcode="${item.dbCode}">
                    <span class="nav-icon">
                        <img src="./assets/img/profile.png" alt="" class="img-circle" style="height: 30px;">
                    </span>
                    <span class="nav-title">Level ${item.level} - ${item.name}</span>
                    <span class="nav-tools">
                        ${item.level < 7 ? '<i class="fa-solid fa-plus fa-fw toggle-icon"></i>' : ''}
                    </span>
                </a>
                ${item.children.length > 0 ? '<ul class="nav nav-sub">' + generateMenu(item.children) + '</ul>' : ''}
                <li class="nav-divider"></li>
            </li>
        `;;
        });

        return menu;
    }


    function initializeMenu() {
        const menuItems = document.querySelectorAll('.has-children');

        menuItems.forEach(item => {
            item.addEventListener('click', (event) => {
                // Get the name and dbCode from the data attributes
                const name = item.getAttribute('data-name');
                const dbCode = item.getAttribute('data-dbcode');
                const id = item.getAttribute('data-id');


                console.log(name, dbCode, id);
                dataload(name, dbCode, id); // or dataload(name) if that's what you need

                // Toggle the sub-menu visibility
                const subMenu = item.nextElementSibling;
                const toggleIcon = item.querySelector('.toggle-icon');

                if (subMenu) {
                    subMenu.classList.toggle('show');
                    toggleIcon.classList.toggle('fa-plus');
                    toggleIcon.classList.toggle('fa-minus');
                }

                // Prevent the event from bubbling up to parent levels
                event.stopPropagation();
            });
        });
    }

    // Initialize the menu when the document is ready
    document.addEventListener('DOMContentLoaded', initializeMenu);

    document.addEventListener('DOMContentLoaded', () => {
        var flatData = <?php echo json_encode($levels); ?>;

        // Log the data to the console
        console.log('Levels Data:', flatData);

        const hierarchy = transformHierarchy(flatData);
        const menuContainer = document.getElementById('menuContainer');
        menuContainer.innerHTML = generateMenu(hierarchy);
        initializeMenu();
    });
    </script>




    <script>
    function dataload(name, dbCode, id) {
        $.ajax({
            url: `<?php echo base_url('welcome/Usermaster_data'); ?>`,
            method: 'GET',
            data: {

                level: name,
                db_code: dbCode,
                id: id
            },
            dataType: 'json',
            success: function(data) {
                // Handle the data received from the server

                // Process and display the data as needed
                displayUserData(data);
                UserData(data)
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error loading data:', textStatus, errorThrown);
            }
        });
    }


    function displayUserData(data) {
        console.log('====================================');
        console.log('Data:', data);
        console.log('====================================');

        if (!data || !data.distributor || !data.get_sales_hierarchy) {
            console.error('Missing data.');
            return;
        }

        // Create a mapping from DB_Code to hierarchy data
        const hierarchyMap = new Map();
        if (Array.isArray(data.get_sales_hierarchy.mappings)) {
            data.get_sales_hierarchy.mappings.forEach(itm => {
                if (itm.DB_Code && itm.Levels) {
                    hierarchyMap.set(itm.DB_Code, itm.Levels);
                }
            });
        } else {
            console.error('Mappings is not an array:', data.get_sales_hierarchy.mappings);
        }

        // Log the hierarchyMap contents

        // Example user data


        // Initialize the Map
        // Example JSON data


        // Initialize the Map




        let tableHtml = `
        <table id="example" class="table table-bordered table-striped" cellspacing="0" width="100%">
            <thead class="table-danger">
                <tr>
                    <th>Customer Code</th>
                    <th>Customer Name</th>
                    <th>Pin Code</th>
                    <th>City</th>
                    <th>District</th>
                    <th>Contact Number</th>
                    <th>Country</th>
                    <th>Zone</th>
                    <th>State Name</th>
                    <th>Population Strata-1</th>
                    <th>Population Strata-2</th>
                    <th>Country Group</th>
                    <th>GTM Type</th>
                    <th>SuperStockist Y/N</th>
                    <th>Customer Active ?</th>
                    <th>Customer Type Code</th>
                    <th>Sales Org. Code</th>
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
                    <th>Sales Org. Name</th>
                    <th>Division Name</th>
                    <th>Sector Name</th>
                    <th>Level 1 Designation Label</th>
                    <th>Level 1 Name</th>
                    <th>Level 2 Designation Label</th>
                    <th>Level 2 Name</th>
                    <th>Level 3 Designation Label</th>
                    <th>Level 3 Name</th>

                    <th>Level 4 Designation Label</th>
                    <th>Level 4 Name</th>

                    <th>Level 5 Designation Label</th>
                    <th>Level 5 Name</th>

                    <th>Level 6 Designation Label</th>
                    <th>Level 6 Name</th>

                    <th>Level 7 Designation Label</th>
                    <th>Level 7 Name</th>
                 
                </tr>
            </thead>
            <tbody>
    `;

        data.distributor.forEach(user => {


            const hierarchy = hierarchyMap.get(user.Customer_Code) || {};

            // Log the hierarchy data for each user
            //  console.log(`Hierarchy for ${user.Customer_Code}:`, hierarchy);

            tableHtml += `
            <tr>
                <td>${user.Customer_Code}</td>
                <td>${user.Customer_Name}</td>
                <td>${user.Pin_Code}</td>
                <td>${user.City}</td>
                <td>${user.District}</td>
                <td>${user.Contact_Number}</td>
                <td>${user.Country}</td>
                <td>${user.Zone}</td>
                <td>${user.State}</td>
                <td>${user.Population_Strata_1}</td>
                <td>${user.Population_Strata_2}</td>
                <td>${user.Country_Group}</td>
                <td>${user.GTM_TYPE}</td>
                <td>${user.SUPERSTOCKIST}</td>
                <td>${user.STATUS}</td>
                <td>${user.Customer_Type_Code}</td>
                <td>${user.Sales_Code}</td>
                <td>${user.Customer_Type_Name}</td>
                <td>${user.Customer_Group_Code}</td>
                <td>${user.Customer_Creation_Date}</td>
                <td>${user.Division_Code}</td>
                <td>${user.Sector_Code}</td>
                <td>${user.State_Code}</td>
                <td>${user.Zone_Code}</td>
                <td>${user.Distribution_Channel_Code}</td>
                <td>${user.Distribution_Channel_Name}</td>
                <td>${user.Customer_Group_Name}</td>
                <td>${user.Sales_Name}</td>
                <td>${user.Division_Name}</td>
                <td>${user.Sector_Name}</td>
                <td>${hierarchy.Level_1 ? hierarchy.Level_1.Designation : ''}</td>
                <td>${hierarchy.Level_1 ? hierarchy.Level_1.Name : ''}</td>
                <td>${hierarchy.Level_2 ? hierarchy.Level_2.Designation : ''}</td>
                <td>${hierarchy.Level_2 ? hierarchy.Level_2.Name : ''}</td>
                <td>${hierarchy.Level_3 ? hierarchy.Level_3.Designation : ''}</td>
                <td>${hierarchy.Level_3 ? hierarchy.Level_3.Name : ''}</td>

                       <td>${hierarchy.Level_4 ? hierarchy.Level_4.Designation : ''}</td>
                <td>${hierarchy.Level_4 ? hierarchy.Level_4.Name : ''}</td>

                       <td>${hierarchy.Level_5 ? hierarchy.Level_5.Designation : ''}</td>
                <td>${hierarchy.Level_5 ? hierarchy.Level_5.Name : ''}</td>

                       <td>${hierarchy.Level_6 ? hierarchy.Level_6.Designation : ''}</td>
                <td>${hierarchy.Level_6 ? hierarchy.Level_6.Name : ''}</td>

                       <td>${hierarchy.Level_7 ? hierarchy.Level_7.Designation : ''}</td>
                <td>${hierarchy.Level_7 ? hierarchy.Level_7.Name : ''}</td>
                
            
            </tr>
        `;
        });

        tableHtml += `</tbody></table>`;

        // Assuming there's a div with id 'userTableContainer' to display the table
        document.getElementById('userTableContainer').innerHTML = tableHtml;
    }
    </script>

    <script>
    function UserData(data) {
        // Ensure data is in correct format
        if (!data || !data.usermaster) {
            console.error('No user data found.');
            return;
        }

        let userHtml = '';

        data.usermaster.forEach(user => {
            userHtml += `
            <ul class="members">
                <li class="member">
                    <div class="member-media">
                        <a class="member-media-link" href="#">
                            <img class="member-media-img" src="./assets/img/Group8143.png" alt="${user.Name}">
                        </a>
                    </div>
                    <div class="col-md-3">
                        <h4 class="member-name">${user.Name ? user.Name : 'Vacand'}</h4>
                        <div class="member-skills">${user.Designation_label ? user.Designation_label : 'Vacand'}</div>
                    </div>
                    <div class="col-md-3">
                        <p>${user.Email_Id ? user.Email_Id : 'Vacand'}</p>
                        <p>Mobile: ${user.Mobile_No ? user.Mobile_No : 'Vacand'}</p>
                    </div>
                    <div class="col-md-5">
                        <p>ID: ${user.id ? user.id : 'Vacand'} <br>
                           Region: ${user.State ? user.State : 'Vacand'}, Market: UP (East)</p>
                    </div>
                </li>
            </ul>
        `;
        });

        // Assuming there's a div with id 'userListContainer' to display the list
        document.getElementById('userListContainer').innerHTML = userHtml;
    }
    </script>


    <script>
    function setActive(element) {
        // Remove 'active' class from all items
        document.querySelectorAll('.nav > li').forEach(item => item.classList.remove('active'));

        // Add 'active' class to the clicked item
        element.classList.add('active');
    }
    </script>
</body>

</html>