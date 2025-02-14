<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">view role</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="">Permission Manager</a> / view role</div>
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
                                <h2>User Details</h2>
                                <table id="" class="table table-bordered table-hover" cellspacing="0" width="100%">

                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Mobile</th>
                                        <td><?php echo htmlspecialchars($user['mobile']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address</th>
                                        <td><?php echo htmlspecialchars($user['address']); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Created Date</th>
                                        <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($user['created_date']))); ?>
                                        </td>
                                    </tr>
                                </table>

                                <h2>Permissions</h2>
                                <table id="" class="table table-bordered table-hover" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Module Name</th>
                                            <th>View</th>
                                            <th>Edit</th>
                                            <th>role_name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($permissions as $permission): ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($permission['module_name']); ?></td>
                                                <td><?php echo htmlspecialchars($permission['view']); ?></td>
                                                <td><?php echo htmlspecialchars($permission['edit']); ?></td>
                                                <td><?php echo htmlspecialchars($permission['role_name']); ?></td>
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
</div>