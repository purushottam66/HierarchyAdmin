<style>
    /* Custom Cron Update Button Color */
    .custom-cron-btn {
        background-color: #28a745 !important;
        /* Green */
        color: white;
        border: none;
    }



    /* Custom Update Distributor Button Color */
    .custom-update-btn {
        background-color: #007bff !important;
        /* Blue */
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
            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / Cron</div>
            </div> -->
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
                                        <button type="submit" class="btn custom-cron-btn pull-left">Cron Update</button>
                                        <button type="button" class="btn custom-update-btn pull-left" id="updateDistributor">Update Distributor</button>
                                        <!-- <button type="button" class="btn custom-update-btn pull-left" id="dummmy">dummy mapping</button> -->


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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script>
    $('#updateDistributor').on('click', function() {
        // Disable the button and show loading text or spinner
        var $button = $(this);
        $button.prop('disabled', true); // Disable the button
        $button.html('Loading ...'); // Change button text to indicate loading (or add a spinner here)

        $.ajax({
            url: '<?= site_url("admin/checkAndDeleteDistributor") ?>',
            type: 'POST', // Use POST for state-changing requests
            dataType: 'json',
            success: function(response) {
                // Check the response status
                if (response.status == 'success') {
                    toastr.success(response.message); // Show success toast with dynamic message



                } else if (response.status == 'error') {
                    toastr.error(response.message); // Show error toast with dynamic message
                } else {
                    toastr.info("Unexpected response status"); // Handle unexpected status
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            },
            complete: function() {
                // Re-enable the button and reset the text once the request is complete
                $button.prop('disabled', false);
                $button.html('Update Distributor'); // Reset button text
            }
        });
    });
</script>



<script>
    $('#dummmy').on('click', function() {
        // Disable the button and show loading text or spinner
        var $button = $(this);
        $button.prop('disabled', true); // Disable the button
        $button.html('Loading ...'); // Change button text to indicate loading (or add a spinner here)

        $.ajax({
            url: '<?= site_url("admin/dummmymaping") ?>',
            type: 'POST', // Use POST for state-changing requests
            dataType: 'json',
            success: function(response) {
                // Check the response status
                if (response.status == 'success') {
                    toastr.success(response.message); // Show success toast with dynamic message

                } else if (response.status == 'error') {
                    toastr.error(response.message); // Show error toast with dynamic message
                } else {
                    toastr.info("Unexpected response status"); // Handle unexpected status
                }
            },
            error: function() {
                alert('An error occurred while processing the request.');
            },
            complete: function() {
                // Re-enable the button and reset the text once the request is complete
                $button.prop('disabled', false);
                $button.html('Done'); // Reset button text
            }
        });
    });
</script>