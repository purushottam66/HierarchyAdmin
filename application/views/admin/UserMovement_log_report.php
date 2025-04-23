<link rel="stylesheet" href="<?php echo base_url('admin/assets/css/buttons.dataTables.css'); ?>">

<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">User Movement Log Report</h3>
                <a href="<?php echo base_url('admin/UserMovement_log_report_json'); ?>" class="btn "> api test</a>

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
                                <table id="mapping_logs_table" class="display nowrap table table-bordered table-hover text-center" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Action Type</th>
                                            <th>Action By</th>
                                            <th>Level</th>
                                            <th>Old Employee</th>
                                            <th>New Employee</th>
                                            <th>DB Code Data</th>
                                            <th>Vacant Employee</th>
                                            <th>Created At</th>
                                            <th>Status</th>
                                            <th>Message</th>
                                        </tr>
                                    </thead>
                                </table>
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
    $(document).ready(function() {
        var table = $('#mapping_logs_table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '<?php echo base_url("admin/UserMovement_log_report_ajex"); ?>',
                type: 'GET',
                dataSrc: function(response) {
                    return response.data;
                }
            },
            columns: [
                { data: '0' },  // ID
                { data: '1' },  // Action Type
                { data: '2' },  // Action By
                { data: '3' },  // Level
                { data: '4' },  // Selected Employee
                { data: '5' },  // Set PJP Code
                { 
                    data: '6',  // DB Code Data
                    render: function(data, type, row) {
                        if (!data) return '';
                        try {
                            // Remove extra escaping and parse JSON
                            const cleanData = data.replace(/\\/g, '');
                            const jsonArray = JSON.parse(cleanData);
                            // Create a formatted preview
                            const preview = JSON.parse(jsonArray.length) + ' distributor(s)';
                            return '<button class="btn btn-sm btn-info" onclick="viewJsonData(\'' + 
                                   btoa(cleanData) + '\')">' + preview + '</button>';
                        } catch (e) {
                            console.error('Error parsing DB Code Data:', e);
                            return data.substring(0, 50) + '...';
                        }
                    }
                },
                { data: '7' },  // Vacant Data
                { data: '8' },  // Created At
                { data: '9' },  // Status
                { data: '10' }  // Message
            ],
            scrollX: true,
            scrollY: "550px",
            scrollCollapse: true,
            pageLength: 15,
            lengthMenu: [15, 30, 60, 100],
            order: [[0, 'desc']]
        });
    
        // Log table events
        table.on('xhr', function() {
            var json = table.ajax.json();
            console.log('DataTables XHR Response:', json);
        });
    });

    // Add function to handle JSON data viewing
    function viewJsonData(encodedData) {
        try {
            const jsonData = atob(encodedData);
            const jsonArray = JSON.parse(jsonData);
            
            // Format each distributor's data
            const formattedData = jsonArray.map((item, index) => {
                const parsed = JSON.parse(item);
                return `Distributor ${index + 1}:\n${JSON.stringify(parsed, null, 2)}`;
            }).join('\n\n-------------------\n\n');
            
            alert(formattedData);
        } catch (e) {
            console.error('Error in viewJsonData:', e);
            alert('Error parsing JSON data');
        }
    }
</script>
