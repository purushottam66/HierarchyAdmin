</div>
<footer id="footer" class="footer app-footer">
    <div class="container">
        <div class="row">
            <div class="footer-top col-sm-12">
                <p class="text-center copyright">&copy; <span id="mgsYear"></span> <a href="" target="_blank">Sales
                        Hierarchy</a> All rights
                    reserved. </p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!-- <a href="#" class="scrollup"><i class="fa-solid fa-circle-arrow-up"></i></a> -->

<style>
    /* Highlight for selected row */
    .selected_data {
        background-image: linear-gradient(122deg, #633991 0%, #c1156c 100%) !important;
    }
</style>

<style>
    /* Loader container */
    #loader {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255, 255, 255, 0.4);
        /* Semi-transparent background */
        width: 100vw;
        height: 100vh;
    }

    /* Spinning Image */
    .spin-image {
        animation: spin 1s linear infinite;
        height: 60px !important;
    }

    @keyframes spin {
        from {
            transform: rotate(0deg);
        }

        to {
            transform: rotate(360deg);
        }
    }

    /* Blur effect for body */
    .blurred {
        filter: blur(5px);
        pointer-events: none;
        /* Disable clicks */
        user-select: none;
        /* Disable text selection */
    }
</style>

<!-- Loader HTML -->
<div id="loader" style="display: none;">
    <img src="<?php echo base_url('admin/assets/Bloom_2.gif'); ?>" alt="Loading..." class="spin-image">
</div>

<!-- <script>
    function showLoader() {
        document.getElementById("loader").style.display = "flex";
        document.body.classList.add("blurred");
    }

    function hideLoader() {
        document.getElementById("loader").style.display = "none";
        document.body.classList.remove("blurred");
    }
</script> -->

<script src="<?php echo base_url('admin/assets/js/jquery-3.7.1.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/bootstrap.bundle.min.js'); ?>"></script>






<script src="<?php echo base_url('admin/assets/js/popper.min.js'); ?>"></script>
<!-- <script src="<?php echo base_url('admin/assets/js/bootstrap.min.js'); ?>"></script> -->
<script src="<?php echo base_url('admin/assets/js/vendor.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/mgsdashboard.js'); ?>"></script>

<script src="<?php echo base_url('admin/assets/js/dataTables.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/dataTables.buttons.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/buttons.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/jszip.min.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/pdfmake.min.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/vfs_fonts.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/buttons.html5.min.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/buttons.print.min.js'); ?>"></script>








<!-- <script src="<?php echo base_url('admin/assets/js/jquery-3.5.1.min.js'); ?>"></script> -->

<!-- 
<script src='https://cdn.datatables.net/2.0.8/js/dataTables.js'></script>
<script src='https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js'></script> -->

<script src="<?php echo base_url('admin/assets/js/sweet-alert.min.js'); ?>"></script>



<script src="<?php echo base_url('admin/assets/js/bootstrap-select.min.js'); ?>"></script>
<script src="<?php echo base_url('admin/assets/js/toastr.min.js'); ?>"></script>




<script type="text/javascript">
    // Default Configuration
    $(document).ready(function() {
        toastr.options = {
            'closeButton': true,
            'debug': false,
            'newestOnTop': false,
            'progressBar': false,
            'positionClass': 'toast-top-right',
            'preventDuplicates': false,
            'showDuration': '1000',
            'hideDuration': '1000',
            'timeOut': '5000',
            'extendedTimeOut': '1000',
            'showEasing': 'swing',
            'hideEasing': 'linear',
            'showMethod': 'fadeIn',
            'hideMethod': 'fadeOut',
        }
    });

    // Toast Type
    // toastr.info('You clicked Info toast')
    // toastr.error('You clicked Error Toast')

    // toastr.warning('You clicked Warning Toast')

    // toastr.options.positionClass = "toast-top-right";
    // toastr.options.preventDuplicates = false;
    // toastr.info('This sample position', 'Toast Position')
</script>

<script>
    $('#example').DataTable({
        paging: false,
        searching: true,
        info: true,
        autoWidth: true,
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
    });
</script>


<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".alert").fadeOut("slow");
        }, 5000); // 5000ms = 5 seconds
    });
</script>










<script>
    $(document).ready(function() {
        var currentUrl = window.location.href;

        var menuPaths = [
            'admin/zone',

            'admin/salesorg',
            'admin/distributionchannel',
            'admin/division',
            'admin/gcpdata'
        ];

        menuPaths.forEach(function(path) {
            if (currentUrl.includes(path)) {
                $('#level1').addClass('mm-show');
            }
        });

        if (currentUrl.includes("admin/hierarchydata") || currentUrl.includes("admin/geography") || currentUrl.includes("admin/ZoneHierarchy")) {
            $('#level1_u').addClass('mm-show');
        }
    });
</script>


<script>
    $(document).ready(function() {
        // Focus on hidden input when table is clicked
        $("table").on("click", function(e) {
            $("#tableEventShifter").focus();
        });

        // Row click event for selection
        $("table tbody").on("click", "tr", function(e) {
            $(this).siblings().removeClass("selected");
            $(this).addClass("selected");
        });

        // Keyboard navigation
        $("#tableEventShifter").on("keydown", function(e) {
            switch (e.keyCode) {
                case 38: // Arrow Up
                    $('table tbody tr.selected')
                        .removeClass('selected')
                        .prev()
                        .addClass('selected');
                    break;

                case 40: // Arrow Down
                    $('table tbody tr.selected')
                        .removeClass('selected')
                        .next()
                        .addClass('selected');
                    break;
            }
            // Prevent default scrolling behavior
            e.preventDefault();
        });
    });
</script>




</body>

</html>