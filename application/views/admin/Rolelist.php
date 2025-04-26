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
                <h3 class="dashhead-title">Role List</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Permission Manager
                    </a> / Role List
                </div>
                <a href="#" class="href">
                    <button type="button" onclick="history.back()"
                        class="btnss btn bg-danger text-white ">Back</button>
                </a>
            </div>
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
                                        <th class="col-md-2 text-center">Name</th>
                                        <th class="col-md-2 text-center">email</th>
                                        <th class="col-md-2 text-center">mobile</th>
                                        <th class="col-md-2 text-center">Role</th>
                                        <th class="col-md-2 text-center">Date</th>
                                        <th class="col-md-2 text-center">Action</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($users as $user): ?>
                                        <tr>
                                            <td class="text-center"><?php echo $user['name']; ?></td>
                                            <td class="text-center"><?php echo $user['email']; ?></td>
                                            <td class="text-center"><?php echo $user['mobile']; ?></td>


                                            <td class="text-center"><?php echo $user['role_name']; ?></td>
                                            <td class="text-center">
                                                <?php echo date('Y-m-d', strtotime($user['created_date'])); ?></td>
                                            <td class="text-center">

                                                <a href="<?php echo site_url('admin/Rolelistedit/' . $user['id']); ?>"
                                                    class="href">
                                                    <button class="btn btn-primary setfont">
                                                        <i class="fa-solid fa-pencil fa-fw"></i>
                                                    </button>
                                                </a>

                                                <a href="<?php echo site_url('admin/edit/' . $user['id']); ?>" class="href">
                                                    <button class="btn btn-primary setfont">
                                                        <i class="fa-solid fa-eye fa-fw"></i>
                                                    </button>
                                                </a>
                                                <a href="javascript:void(0);" data-id="<?php echo $user['id']; ?>"
                                                    class="delete-btn">
                                                    <button class="btn btn-primary setfont ">
                                                        <i class="fa-solid fa-trash fa-fw"></i>
                                                    </button>
                                                </a>
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

        });

    });
</script>