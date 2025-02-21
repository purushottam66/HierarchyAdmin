<style>
    .setfont {
        font-size: 8px;
        padding: 0px 16px;
    }

    .rightbutton {
        float: right;
    }
</style>


<style>
    :root {
        --switches-bg-color: red;
        --switches-label-color: #ffff;
        --switch-bg-color: green;
        --switch-text-color: #ffff;
    }



    .switches-container {
        width: 10rem;
        position: relative;
        display: flex;
        padding: 0;
        position: relative;
        background: var(--switches-bg-color);
        line-height: 1rem;
        border-radius: 3rem;
        margin-left: auto;
        margin-right: auto;
    }

    .switches-container input {
        visibility: hidden;
        position: absolute;
        top: 0;
    }

    .switches-container label {
        width: 50%;
        padding: 0;
        margin: 0;
        text-align: center;
        cursor: pointer;
        color: var(--switches-label-color);
    }


    .switch-wrapper {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 50%;
        padding: 0.15rem;
        z-index: 3;
        transition: transform .5s cubic-bezier(.77, 0, .175, 1);
    }

    .switch {
        border-radius: 3rem;
        background: var(--switch-bg-color);
        height: 100%;
    }


    .switch div {
        width: 100%;
        text-align: center;
        opacity: 0;
        display: block;
        color: var(--switch-text-color);
        transition: opacity .2s cubic-bezier(.77, 0, .175, 1) .125s;
        will-change: opacity;
        position: absolute;
        top: 0;
        left: 0;
    }

    .switches-container input:nth-of-type(1):checked~.switch-wrapper {
        transform: translateX(0%);
    }

    .switches-container input:nth-of-type(2):checked~.switch-wrapper {
        transform: translateX(100%);
    }

    .switches-container input:nth-of-type(1):checked~.switch-wrapper .switch div:nth-of-type(1) {
        opacity: 1;
    }

    .switches-container input:nth-of-type(2):checked~.switch-wrapper .switch div:nth-of-type(2) {
        opacity: 1;
    }
</style>



<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">User Manager</h3>
            </div>



            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / User Details
                </div>
            </div> -->
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">
                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example11"
                                    class="display nowrap table table-bordered table-hover text-center"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="text-center ">Name</th>
                                            <th class="text-center ">employer name</th>
                                            <th class="text-center ">Email</th>
                                            <th class="text-center ">Contact No.</th>
                                            <th class="text-center ">employee_id</th>
                                            <th class="text-center ">level</th>
                                            <th class="text-center ">state</th>
                                            <th class="text-center ">City</th>
                                            <th class="text-center ">zone</th>
                                            <th class="text-center ">designation</th>
                                            <th class="text-center ">designation_label</th>
                                            <th class="text-center ">Gender</th>
                                            <th class="text-center ">Status</th>
                                            <th class="text-center ">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>

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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>

<script>
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to undo this action!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: "No, cancel!",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo site_url('admin/Employeedelete/'); ?>" + id;
            } else {
                Swal.fire("Cancelled", "Your item is safe :)", "error");
            }
        });
    });
</script>



<script>
    $(document).ready(function() {

        var permissions = <?php echo json_encode($permissions); ?>;
        let addEmployeePermission = permissions.some(p => p.module_name === "User Master" && p.edit === "yes");
        let buttonsList = [];

        if (addEmployeePermission) {
            buttonsList.push({
                text: '<i class="fa fa-plus"></i> Add Employee',
                titleAttr: 'Add Employee',
                action: function() {
                    window.location.href = '<?php echo base_url("admin/Employee"); ?>';
                }
            });
        }
        buttonsList.push({
            text: '<i class="fa fa-user-times"></i> Unmapped Employee',
            titleAttr: 'Unmapped Employee',
            action: function() {
                window.location.href = '<?php echo base_url("admin/Unmapped_Employee"); ?>';
            }
        });
        var table = $('#example11').DataTable({
            paging: true,
            searching: true,
            info: true,
            autoWidth: true,
            pageLength: 15,
            lengthMenu: [15, 30, 60, 100],
            scrollY: "550px",
            scrollCollapse: true,
            fixedHeader: true,
            fixedFooter: true,
            processing: true,
            serverSide: true,
            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',

            buttons: buttonsList,


            order: [
                [0, 'asc']
            ], 

            ajax: {
                url: "<?= site_url('admin/Employee_ajex_load') ?>",
                type: "POST",
                data: function(d) {
                    d.search = $('#dt-search-0').val();
                }
            },

            language: {
                processing: '<img class="spin-image" src="<?php echo base_url('admin/assets/Bloom_2.gif'); ?>" alt="Loading...">'
            },

            columnDefs: [{
                className: 'text-center',
                targets: '_all'
            }],
        });

        $('#dt-search-0').on('keyup', function() {
            table.ajax.reload();
        });
    });
</script>



<script>
    function logStatusChange(element) {
        const status = element.value;
    }
</script>

<script>
    function changeEmployeeStatus(employeeId, status) {
        console.log(`Changing status of Employee ID: ${employeeId} to ${status}`);
        $.ajax({
            url: '<?= site_url('admin/updateEmployeeStatus') ?>',
            type: 'POST',
            dataType: 'json',
            data: {
                employee_id: employeeId,
                employee_status: status
            },
            success: function(data) {

                if (data.status == 'success') {
                    toastr.success(data.message); 
                } else if (data.status == 'error') {
                    toastr.error(data.message); 
                } else {
                    toastr.info("Unexpected response status");
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('An error occurred while updating the employee status.');
            }
        });
    }
</script>