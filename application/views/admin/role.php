<!-- <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/dataTables.dataTables.css'); ?>"> -->
  <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">




<style>
    .setfont {
        font-size: 8px;
        padding: 3px 16px;
    }

    .rightbutton {
        float: right;
    }
</style>



<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Permission Manager</h3>
            </div>
            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / Role Manager
                </div>
            </div> -->
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <?php if ($this->session->flashdata('message')): ?>
                            <div class="alert alert-info">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?>


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

                        <!-- 
                        <?php if ($this->session->flashdata('message')): ?>
                            <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?> -->

                        <div class="box-body">
                            <table id="employeeTable" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="col-md-2 text-center">Name</th>
                                        <th class="col-md-2 text-center">Role</th>
                                        <th class="col-md-2 text-center">Date</th>
                                        <th class="col-md-2 text-center">Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $user['name']; ?></td>
                                            <td class="text-center"><?php echo $user['role_name']; ?></td>
                                            <td class="text-center">
                                                <?php echo date('Y-m-d', strtotime($user['created_date'])); ?></td>
                                            <td class="text-center">

                                                <?php

                                                $hasPermission = false;
                                                if (is_array($permissions)) {
                                                    foreach ($permissions as $p) {
                                                        if ($p['module_name'] === "Permission Manager" && $p['edit'] === "yes") {
                                                            $hasPermission = true;
                                                            break;
                                                        }
                                                    }
                                                }
                                                ?>



                                                <?php if ($hasPermission): ?>
                                                    <a href="<?php echo site_url('admin/Addrole/' . $user['id']); ?>" class="href">
                                                        <button class="btn btn-primary setfont">
                                                            <i class="fa-solid fa-pencil fa-fw"></i> Role
                                                        </button>
                                                    </a>

                                                    <a href="<?php echo site_url('admin/edit/' . $user['id']); ?>" class="href">
                                                        <button class="btn btn-primary setfont">
                                                            <i class="fa-solid fa-eye fa-fw"></i>
                                                        </button>
                                                    </a>

                                                    <a href="javascript:void(0);" data-id="<?php echo $user['id']; ?>" class="delete-btn">
                                                        <button class="btn btn-danger setfont">
                                                            <i class="fa-solid fa-trash fa-fw"></i>
                                                        </button>
                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-danger fw-bold">No Permission</span>
                                                <?php endif; ?>



                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('admin/assets/js/jquery-3.7.1.js'); ?>"></script>

<link rel="stylesheet" href="<?php echo base_url('admin/assets/css/sweetalert2.min.css'); ?>">

<script src="<?php echo base_url('admin/assets/js/sweetalert2.min.js'); ?>"></script>


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
                        window.location.href = "<?php echo site_url('admin/roledelete/'); ?>" + id;
                    } else {
                        swal("Cancelled", "Your item is safe :)", "error");
                    }
                });
        };
    });
</script>

<script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#employeeTable')) {
            $('#employeeTable').DataTable().clear().destroy();
        }

        var permissions = <?php echo json_encode($permissions); ?>;
        let rolePermission = permissions.some(p => p.module_name === "Permission Manager" && p.edit === "yes");
        let buttonsList = [];

        if (rolePermission) {
            buttonsList.push({
                text: '<i class="fa fa-plus"></i> Add New User',
                titleAttr: 'Add New User',
                action: function() {
                    window.location.href =
                        '<?php echo base_url("admin/Adduser"); ?>';
                }
            });

            buttonsList.push({
                text: '<i class="fa fa-list"></i> Role List',
                titleAttr: 'Role List',
                action: function() {
                    window.location.href =
                        '<?php echo base_url("admin/Rolelist"); ?>';
                }
            });
        }


        $('#employeeTable').DataTable({
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
            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',


            buttons: buttonsList,
        });

    });
</script>