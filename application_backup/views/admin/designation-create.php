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
                <h3 class="dashhead-title">Designation create</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Position</a> / designation create</div>
            </div>
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">

                        <?php if ($this->session->flashdata('message')): ?>
                            <div class="alert alert-<?php echo $this->session->flashdata('message_type') ?: 'danger'; ?>">
                                <?php echo $this->session->flashdata('message'); ?>
                            </div>
                        <?php endif; ?>

                        <div class="box-body">
                            <div class="form-container">



                                <form action="<?php echo site_url('admin/designation-save'); ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Designation	">designation Name</label>
                                                <input type="text" id="Designation	" class="form-control" name="Designation"
                                                    placeholder="Designation Name" required>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Designation_Label">designation label</label>
                                                <input type="text" id="Designation_Label" class="form-control" name="Designation_Label"
                                                    placeholder="Designation label" required>
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