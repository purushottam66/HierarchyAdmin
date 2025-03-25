<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />
    <title>Masters</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta http-equiv="Cache-Control" content="no-store" />


    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url('admin/assets/img/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/fontawesome/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/vendor.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/dashboard-menu-theme-default.css'); ?>">

    <link rel='stylesheet' href='https://cdn.rawgit.com/t4t5/sweetalert/v0.2.0/lib/sweet-alert.css'>

    <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/dataTables.dataTables.css'); ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css" class="rel">

    <link rel='stylesheet'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css'>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">




    <style></style>


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
                    <div class="navbar-header" style="    background-image: linear-gradient(3deg, #FB7D02 0%, #FDE20D 100%) !important;">
                        <div class="navbar-header-left b-r"><a class="logo" href="?"><span
                                    class="logo-xs hidden-md"><img
                                        src="<?php echo base_url('admin/assets/img/logo-sm.png'); ?>"
                                        alt="logo-sm"></span><span class="logo-lg visible-md"><img
                                        src="<?php echo base_url('admin/assets/img/logo.png'); ?>"
                                        alt="logo"></span></a> </div>
                        <nav class="nav navbar-header-nav">
                            <a class="hidden-md b-r" href="#" data-side="collapse">
                                <i class="fa-solid fa-bars fa-fw"></i></a>
                            <a class="visible-md b-r" href="#" data-side="mini"><i
                                    class="fa-solid fa-bars fa-fw"></i></a>
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
                                        class="fa-solid fa-magnifying-glass fa-fw"></i>
                                </a>
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
                                <!-- <a href="#">
                                    <img class="img-circle" src="<?php echo base_url('admin/assets/img/m1.jpg'); ?>"
                                        alt="John Doe"></a> -->
                            </div>
                            <div class="user-info">
                                <ul class="nav">
                                    <li class="dropdown">
                                        <a href="#" class="text-success">
                                            <i class="fa-solid fa-circle fa-fw"></i>
                                            Welcome, <?php echo isset($user_name) ? htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8') : 'Guest'; ?>!
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>



                        <nav class="side-nav dmvertical-menu">
                            <ul class="metismenu nav nav-inverse nav-bordered" data-plugin="dashboardmenu">
                                <!-- Masters -->
                                <?php $current_page = uri_string(); ?>

                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Masters' && $permission['view'] == 'yes') : ?>
                                            <li class="nav-item <?php echo (in_array($current_page, ['admin/zone', 'admin/distributors', 'admin/salesorg', 'admin/distributionchannel', 'admin/division', 'admin/gcpdata'])) ? 'menu-open' : ''; ?>">
                                                <a href="javascript:void(0);" class="dropdown-toggle <?php echo (in_array($current_page, ['admin/zone', 'admin/distributors', 'admin/salesorg', 'admin/distributionchannel', 'admin/division', 'admin/gcpdata'])) ? 'active' : ''; ?>" data-toggle="collapse" data-target="#level1">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/Masters.png'); ?>" alt="" style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Masters</span>
                                                    <span class="nav-tools">
                                                        <i class="fa-solid fa-angles-left fa-fw" id="icon-level1"></i>
                                                    </span>
                                                </a>
                                                <ul class="nav nav-sub collapse navselect <?php echo (in_array($current_page, ['admin/zone', 'admin/distributors', 'admin/salesorg', 'admin/distributionchannel', 'admin/division', 'admin/gcpdata'])) ? 'show' : ''; ?>" id="level1">
                                                    <?php
                                                    $menu_items = [
                                                        ['path' => 'admin/zone', 'label' => 'Zone', 'img' => 'admin/assets/icons/Zone.png'],
                                                        ['path' => 'admin/salesorg', 'label' => 'Sales Org', 'img' => 'admin/assets/icons/sales_org.png'],
                                                        ['path' => 'admin/distributionchannel', 'label' => 'Distribution Channel', 'img' => 'admin/assets/icons/distribution_channel.png'],
                                                        ['path' => 'admin/division', 'label' => 'Division', 'img' => 'admin/assets/icons/division.png'],
                                                        ['path' => 'admin/gcpdata', 'label' => 'Distributors', 'img' => 'admin/assets/icons/distributors.png'],
                                                    ];
                                                    ?>
                                                    <?php foreach ($menu_items as $item): ?>
                                                        <li class="nav-divider"></li>
                                                        <li>
                                                            <a class="<?php echo ($current_page == $item['path']) ? 'active' : ''; ?>" href="<?php echo base_url($item['path']); ?>">
                                                                <span class="nav-icon">
                                                                    <img src="<?php echo base_url($item['img']); ?>" alt="<?php echo $item['label']; ?>" style="height:20px">
                                                                </span>
                                                                <span class="nav-title"><?php echo $item['label']; ?></span>
                                                            </a>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>


                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'User Movement' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/UserMovement') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/UserMovement'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/employee_details.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">User Movement</span>
                                                </a>
                                            </li>
                                            <li class="nav-divider"></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>






                                <li class="nav-divider"></li>



                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'User - Dist.Mapping' && $permission['view'] == 'yes') : ?>
                                            <!-- Product Hierarchy -->
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/maping') ? 'active' : ''; ?>" href="<?php echo base_url('admin/maping'); ?>">
                                                    <span class="nav-icon">

                                                        <img src="<?php echo base_url('admin/assets/icons/mapping.png'); ?>" alt=""
                                                            style="height:20px">

                                                    </span>
                                                    <span class="nav-title">User - Dist.Mapping</span>
                                                </a>
                                            </li>
                                            <li class="nav-divider"></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>




                                <li class="nav-divider"></li>


                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Report' && $permission['view'] == 'yes') : ?>
                                            <?php
                                            $isActiveTab = strpos($_SERVER['REQUEST_URI'], 'admin/hierarchydata') !== false ||
                                                strpos($_SERVER['REQUEST_URI'], 'admin/geography') !== false ||
                                                strpos($_SERVER['REQUEST_URI'], 'admin/ZoneHierarchy') !== false;
                                            ?>
                                            <li class="nav-item <?php echo $isActiveTab ? 'menu-open' : ''; ?>">
                                                <a class="dropdown-toggle <?php echo $isActiveTab ? 'active' : ''; ?>" href="javascript:void(0);" data-toggle="collapse" data-target="#level1_u">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/hierarchy.png'); ?>" alt="" style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Report</span>
                                                    <span class="nav-tools">
                                                        <i class="fa-solid fa-angles-left fa-fw" id="icon-level1_u"></i>
                                                    </span>
                                                </a>
                                                <ul class="nav nav-sub navselect <?php echo $isActiveTab ? 'show' : ''; ?>" id="level1_u">

                                                    <li class="nav-divider"></li>

                                                    <li>
                                                        <a class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin/hierarchydata') !== false) ? 'active' : ''; ?>"
                                                            href="<?php echo base_url('admin/hierarchydata'); ?>">
                                                            <span class="nav-icon">
                                                                <img src="<?php echo base_url('admin/assets/icons/division.png'); ?>" alt="" style="height:20px">
                                                            </span>
                                                            <span class="nav-title">Business Division wise</span>
                                                        </a>
                                                    </li>

                                                    <li class="nav-divider"></li>
                                                    <li>
                                                        <a class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin/geography') !== false) ? 'active' : ''; ?>"
                                                            href="<?php echo base_url('admin/geography'); ?>">
                                                            <span class="nav-icon">
                                                                <img src="<?php echo base_url('admin/assets/icons/data_wise.png'); ?>" alt="" style="height:20px">
                                                            </span>
                                                            <span class="nav-title">Geography wise</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-divider"></li>
                                                    <li>
                                                        <a class="<?php echo (strpos($_SERVER['REQUEST_URI'], 'admin/ZoneHierarchy') !== false) ? 'active' : ''; ?>"
                                                            href="<?php echo base_url('admin/ZoneHierarchy'); ?>">

                                                            <span class="nav-icon">
                                                                <img src="<?php echo base_url('admin/assets/icons/hierarchy_wise.png'); ?>" alt="" style="height:20px">
                                                            </span>
                                                            <span class="nav-title" style="float: inline-end;">Reporting Hierarchy wise</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-divider"></li>
                                                </ul>
                                            </li>
                                            <li class="nav-divider"></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>


                                

                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Un mapped Distributors' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/distributors') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/distributors'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/profile.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Un mapped Distributors</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <li class="nav-divider"></li>

                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Un mapped User' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/Unmapped_Employee') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/Unmapped_Employee'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/unmapped_employee.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Un mapped User</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

<!-- 
                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Inactive Distributors' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/InactiveDistributors') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/InactiveDistributors'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/inactive_distributor.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title"> Close Distributors
                                                    </span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?> -->


                                
                                
                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Inactive SAP CD' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/mapinginactive') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/mapinginactive'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/employee_details.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Inactive SAP CDs</span>
                                                </a>
                                            </li>
                                            <li class="nav-divider"></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>


                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Positions' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/designation-list') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/designation-list'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/designation.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Positions</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <li class="nav-divider"></li>

                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'User Manager' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/userdetails') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/userdetails'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/empoyee_movement.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">User Manager</span>
                                                </a>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>




                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Permission Manager' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/role') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/role'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/role_manager.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Permission Manager</span>
                                                </a>
                                            </li>
                                            <li class="nav-divider"></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if (!empty($permissions)) : ?>
                                    <?php foreach ($permissions as $permission) : ?>
                                        <?php if ($permission['module_name'] == 'Data Scheduler' && $permission['view'] == 'yes') : ?>
                                            <li>
                                                <a class="<?php echo ($current_page == 'admin/cron') ? 'active' : ''; ?>"
                                                    href="<?php echo base_url('admin/cron'); ?>">
                                                    <span class="nav-icon">
                                                        <img src="<?php echo base_url('admin/assets/icons/cron.png'); ?>" alt=""
                                                            style="height:20px">
                                                    </span>
                                                    <span class="nav-title">Data Scheduler</span>
                                                </a>
                                            </li>
                                            <li class="nav-divider"></li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                                <li>
                                    <a href="<?php echo base_url('admin/logout'); ?>">
                                        <span class="nav-icon">
                                            <img src="https://cdn1.iconfinder.com/data/icons/heroicons-ui/24/logout-512.png"
                                                alt="" style="height:30px">
                                        </span>
                                        <span class="nav-title btn btn-danger setfont_Logout">Logout</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>

                <div class="side-visible-line visible-md" data-side="collapse">
                    <!-- <i class="fa-solid fa-caret-left"></i>
                    <i class="fa-solid fa-arrow-right-arrow-left"></i> -->
                </div>