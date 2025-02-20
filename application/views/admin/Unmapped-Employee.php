<style>
    .setfont {
        font-size: 8px;
        padding: 0px 16px;
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
                <h3 class="dashhead-title">Un mapped User</h3>
            </div>
            <!-- <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Hierarchy</a> / Un mapped User
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
                                            <th class="text-center ">City</th>
                                            <th class="text-center ">designation</th>
                                            <th class="text-center ">designation_label</th>
                                            <th class="text-center ">Gender</th>
                                            <th class="text-center ">Status</th>
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
        var table = $('#example11').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "autoWidth": true,
            "pageLength": 25,
            "lengthMenu": [25, 50, 100, 200],
            "scrollY": "550px",
            "scrollCollapse": true,
            "fixedHeader": true,
            "fixedFooter": true,
            "processing": true,
            "serverSide": true,
            order: [
                [0, 'asc']
            ],
            "ajax": {
                "url": "<?= site_url('admin/Unmapped_Employee_ajex_load') ?>",
                "type": "GET",
                "data": function(d) {
                    d.search = $('#dt-search-0').val();
                },
            },
            language: {
                processing: '<img class="spin-image" src="<?php echo base_url('admin/assets/Bloom_2.gif'); ?>" alt="Loading...">', // Custom loading message
            },
            columnDefs: [
                {
                    className: 'text-center',
                    targets: '_all'
                }
            ],
        });

        $('#dt-search-0').on('keyup', function() {
            table.ajax.reload();
        });
    });
</script>