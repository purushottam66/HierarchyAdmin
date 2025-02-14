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
                <h3 class="dashhead-title">designation Edit</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Position</a> / designation Edit</div>
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
                                <form action="<?php echo site_url('admin/designation-update'); ?>" method="post">
                                    <input type="hidden" name="id" value="<?php echo $designation['id']; ?>">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Designation">Designation Name</label>
                                                <input type="text" id="Designation" class="form-control" name="Designation"
                                                    value="<?php echo $designation['Designation']; ?>" placeholder="Designation Name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Designation_Label">Designation Label</label>
                                                <input type="text" id="Designation_Label" class="form-control" name="Designation_Label"
                                                    value="<?php echo $designation['Designation_Label']; ?>" placeholder="Designation Label" required>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="<?php echo site_url('admin/designation-list'); ?>" class="btn btn-danger">Cancel</a>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>