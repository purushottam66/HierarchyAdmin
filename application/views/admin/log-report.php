<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css" class="rel">


<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Log Report</h3>
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
                                <table id="example__" class="display nowrap table table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                   
                                            <th class="text-center">Key ID</th>
                                            <th class="text-center">table name</th>
                                            <th class="text-center">Variable</th>
                                            <th class="text-center">old_value</th>
                                            <th class="text-center">New Value</th>
                                            <th class="text-center">Timestamp</th>
                                            <th class="text-center">Updated by</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($log)): ?>
                                            <?php $sr_number = 1; ?>
                                            <?php foreach ($log as $logs): ?>
                                                <tr>
                                                <td class="text-center"><?php echo htmlspecialchars($logs['id'] ?? 'N/A'); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($logs['table_name'] ?? 'N/A'); ?></td>

                                                    <td class="text-center"><?php echo htmlspecialchars($logs['variable'] ?? 'N/A'); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($logs['old_value'] ?? 'N/A'); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($logs['new_value'] ?? 'N/A'); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($logs['timestamp'] ?? 'N/A'); ?></td>
                                                    <td class="text-center"><?php echo htmlspecialchars($logs['updated_by'] ?? 'N/A'); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                             
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function () {
        $('#example__').DataTable({
            paging: true,
            searching: true,
            info: true,
            autoWidth: false,  
            responsive: true,  
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            dom: '<"d-flex bd-highlight"<"p-2 flex-grow-1 bd-highlight"l><"p-2 bd-highlight"f><"p-2 bd-highlight"B>>t<"bottom"ip><"clear">',

            buttons: [
                {
                    extend: 'csv',
                    text: 'Download CSV',
                    title: 'Log_Report'
                }
            ]
        });
    });
</script>