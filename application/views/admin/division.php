<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Division</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Masters</a> / Division</div>
            </div>
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">

                        <div class="box-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Sr.no</th>
                                            <th class="text-center">Division Code</th>
                                            <th class="text-center">Division Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($division)): ?>

                                            <?php $sr_number = 1; ?>

                                            <?php foreach ($division as $divisions): ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlspecialchars($sr_number++); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($divisions['Division_Code']); ?>
                                                    </td>
                                                    <td class="text-center"><?php echo htmlspecialchars($divisions['Division_Name']); ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="2">No zone found</td>
                                            </tr>
                                        <?php endif; ?>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- <script>
    $(document).ready(function() {
        var table = $('#example_division').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "autoWidth": true,
            "pageLength": 25,
            "lengthMenu": [25, 50, 60, 100],
            "scrollY": "550px",
            "scrollCollapse": true,
            "fixedHeader": true,
            "fixedFooter": true,
            "processing": true,
            "serverSide": true,
            "order": [[1, 'asc']],
            "ajax": {
                "url": "<?= site_url('admin/division_Ajex_Load_Data') ?>",
                "type": "GET",
                "data": function(d) {
                    d.search = $('#dt-search-0').val();
                }
            },
            language: {
                processing: '<img class="spin-image" src="<?php echo base_url('admin/assets/Bloom_2.gif'); ?>" alt="Loading...">', // Custom loading message
            }
        });
        $('#dt-search-0').on('keyup', function() {
            table.ajax.reload();
        });
    });
</script> -->