<style>
    .form-group {
        margin-bottom: 15px;
    }

    .btnss {
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        float: right;
        margin-left: 20px;
    }

    .btnss:hover {
        background-color: #0056b3;
    }
</style>



<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Add User</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Permission Manager</a> / Add User</div>
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
                                <form action="<?php echo site_url('admin/create'); ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" id="name" class="form-control" name="name"
                                                    placeholder="Enter Name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" class="form-control" name="email"
                                                    placeholder="Enter Email" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="tel" id="mobile" maxlength="10" class="form-control"
                                                    name="mobile" placeholder="Enter Mobile" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="role">Role</label>
                                                <select class="selectpicker  form-control" id="role" name="role"
                                                    aria-label="Default select example" required>

                                                    <option value="" disabled="disabled">Select Role</option>
                                                    <?php foreach ($roles as $role): ?>
                                                        <option value="<?php echo $role['id']; ?>">
                                                            <?php echo $role['role_name']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="text" id="password" max="8" class="form-control" name="password"
                                                    placeholder="Enter Password" required>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>

                                                <textarea id="address" class="form-control" name="address"
                                                    placeholder="Enter Address" required></textarea>
                                            </div>
                                        </div>


                                    </div>

                                    <button type="submit" class="btn btnss ">Submit</button> &#8202;
                                    <a href="#" class="href"> <button onclick="history.back()" type="button"
                                            class="btn btnss bg-danger ">Back</button> </a>
                                    <br> <br>

                                </form>

                            </div>

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