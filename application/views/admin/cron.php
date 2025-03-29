<style>

    .custom-cron-btn {
        background-color: #28a745 !important;
        color: white;
        border: none;
    }

    .custom-update-btn {
        background-color: #007bff !important;
        color: white;
        border: none;
    }
</style>

<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Data Scheduler</h3>
            </div>

        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <div class="row">
                                <form action="" method="post">
                                    <div class="col-md-6">


                                        <?php

                                        $hasPermission = false;
                                        if (is_array($permissions)) {
                                            foreach ($permissions as $p) {
                                                if ($p['module_name'] === "Data Scheduler" && $p['edit'] === "yes") {
                                                    $hasPermission = true;
                                                    break;
                                                }
                                            }
                                        }
                                        ?>


                                        <?php if ($hasPermission): ?>

                                            <button type="submit" class="btn custom-cron-btn pull-left">Cron Update</button>
                                            <button type="button" class="btn custom-update-btn pull-left" id="updateDistributor">Update Distributor</button>
                                        <?php else: ?>
                                            <span class="text-danger fw-bold">No Permission</span>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo base_url('admin/assets/js/jquery-3.7.1.js'); ?>"></script>




<script>
    $('#updateDistributor').on('click', function() {
   
        var $button = $(this);
        $button.prop('disabled', true); 
        $button.html('Loading ...'); 

        $.ajax({
            url: '<?= site_url("admin/checkAndDeleteDistributor") ?>',
            type: 'POST', 
            dataType: 'json',
            success: function(response) {
         
                if (response.status == 'success') {
                    toastr.success(response.message); 



                } else if (response.status == 'error') {
                    toastr.error(response.message); 
                } else {
                    toastr.info("Unexpected response status"); 
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            },
            complete: function() {
        
                $button.prop('disabled', false);
                $button.html('Update Distributor'); 
            }
        });
    });
</script>



<script>
    $('#dummmy').on('click', function() {
  
        var $button = $(this);
        $button.prop('disabled', true); 
        $button.html('Loading ...'); 

        $.ajax({
            url: '<?= site_url("admin/dummmymaping") ?>',
            type: 'POST', 
            dataType: 'json',
            success: function(response) {
           
                if (response.status == 'success') {
                    toastr.success(response.message); 

                } else if (response.status == 'error') {
                    toastr.error(response.message); 
                } else {
                    toastr.info("Unexpected response status"); 
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            },
            complete: function() {
          
                $button.prop('disabled', false);
                $button.html('Done'); 
            }
        });
    });
</script>