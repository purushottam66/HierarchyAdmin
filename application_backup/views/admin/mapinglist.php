<style>
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
                <h3 class="dashhead-title">User Details</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / User Details
                </div>
            </div>
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">

                        <div class="box-body">

                            <div class="task-me rightbutton ">
                                <a href="<?php echo base_url('admin/Employee'); ?>" class="href">
                                    <button class="btn btn-primary">
                                        <i class="fa-solid fa-plus fa-fw"></i> Add Employee
                                    </button>
                                </a>

                            </div>
                            <table id="example" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact No.</th>

                                        <th>pjp_code</th>
                                        <th>employee_id</th>
                                        <th>level</th>
                                        <th>designation</th>
                                        <th>designation_label</th>
                                        <th>DOJ</th>


                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($userAll as $user): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($user['name']); ?></td>
                                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                                            <td><?php echo htmlspecialchars($user['mobile']); ?></td>
                                            <td><?php echo htmlspecialchars($user['pjp_code']); ?></td>
                                            <td><?php echo htmlspecialchars($user['employee_id']); ?></td>
                                            <td><?php echo htmlspecialchars($user['level']); ?></td>

                                            <td><?php echo htmlspecialchars($user['designation_name']); ?></td>
                                            <td><?php echo htmlspecialchars($user['designation_label_name']); ?></td>

                                            <td><?php echo htmlspecialchars($user['DOJ']); ?></td>

                                            <!-- <td><?php echo htmlspecialchars($user['Employee_Status']); ?></td> -->

                                            <td>


                                                <a href="<?php echo site_url('admin/Employeeedit/' . $user['id']); ?>"
                                                    class="href">
                                                    <button class="btn btn-primary">
                                                        <i class="fa-solid fa-pencil fa-fw"></i>
                                                    </button>
                                                </a>

                                                <a href="<?php echo site_url('admin/Employeeview/' . $user['id']); ?>"
                                                    class="href">
                                                    <button class="btn btn-primary">
                                                        <i class="fa-solid fa-eye fa-fw"></i>
                                                    </button>
                                                </a>

                                                <a href="<?php echo site_url('admin/Employeedelete/' . $user['id']); ?>"
                                                    class="href">
                                                    <button class="btn btn-primary">
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

<script>
    new DataTable('#example');
</script>