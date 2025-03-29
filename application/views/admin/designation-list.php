  <link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">


<style>
    .setfont {
        font-size: 8px;
        padding: 3px 16px;
    }

    .rightbutton {
        float: right;
    }

    .btn-primary {
        color: #fff;
        border-radius: 3px;
        background-image: linear-gradient(122deg, #633991 0%, #c1156c 100%);
        box-shadow: 0px 9px 32px 0px rgba(0, 0, 0, 0.2);
        font-weight: 500;
        border: 0;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active,
    .btn-primary:not([disabled]):not(.disabled).active,
    .btn-primary:not([disabled]):not(.disabled):active,
    .show>.btn-primary.dropdown-toggle {
        background-image: linear-gradient(122deg, #4e2a75 0%, #a01059 100%);
        box-shadow: 0px 9px 32px 0px rgba(0, 0, 0, 0.3);
        color: #FFF;
    }
</style>



<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Position</h3>
            </div>
            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Position</a> / designation List
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
                            <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="box-body">
                            <table id="employeeTable" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="col-md-2 text-center">designation Name</th>
                                        <th class="col-md-2 text-center">designation Label</th>
                                        <th class="col-md-2 text-center">Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($designations as $user): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $user['Designation']; ?></td>
                                            <td class="text-center"><?php echo $user['Designation_Label']; ?></td>

                                            <td class="text-center">


                                                <?php

                                                $hasPermission = false;
                                                if (is_array($permissions)) {
                                                    foreach ($permissions as $p) {
                                                        if ($p['module_name'] === "Positions" && $p['edit'] === "yes") {
                                                            $hasPermission = true;
                                                            break;
                                                        }
                                                    }
                                                }
                                                ?>


                                                <?php if ($hasPermission): ?>
                                                    <a href="<?php echo site_url('admin/designation-edit/' . $user['id']); ?>"
                                                        class="href">
                                                        <button class="btn btn-primary setfont">
                                                            <i class="fa-solid fa-pencil fa-fw"></i>
                                                        </button>
                                                    </a>

                                                    <a href="javascript:void(0);" data-id="<?php echo $user['id']; ?>"
                                                        class="delete-btn">
                                                        <button class="btn btn-primary setfont ">
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
                        window.location.href = "<?php echo site_url('admin/designationdelete/'); ?>" + id;
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

            "buttons": [{
                    text: '<i class="fa fa-plus"></i> Add Designation',
                    titleAttr: 'create',
                    action: function() {
                        window.location.href = '<?php echo base_url("admin/designation-create"); ?>';
                    }
                },

            ],

        });

    });
</script>