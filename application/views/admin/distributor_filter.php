<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Distributor Filters</h3>
                </div>
                <div class="card-body">
                    <form id="distributor-filter-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Zone</label>
                                    <select class="form-control select2" name="Zone" multiple>
                                        <?php foreach($unique_zones as $zone): ?>
                                            <option value="<?= $zone ?>"><?= $zone ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <select class="form-control select2" name="State" multiple>
                                        <?php foreach($unique_states as $state): ?>
                                            <option value="<?= $state ?>"><?= $state ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sales Code</label>
                                    <select class="form-control select2" name="Sales_Code" multiple>
                                        <?php foreach($unique_sales_codes as $sales_code): ?>
                                            <option value="<?= $sales_code ?>"><?= $sales_code ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Distribution Channel</label>
                                    <select class="form-control select2" name="Distribution_Channel_Code" multiple>
                                        <?php foreach($unique_distribution_channels as $channel): ?>
                                            <option value="<?= $channel ?>"><?= $channel ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Global Search</label>
                                    <input type="text" class="form-control" name="global_search" placeholder="Search by Customer Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="apply-filters" class="btn btn-primary">Apply Filters</button>
                                <button type="button" id="export-filters" class="btn btn-success ml-2">Export to CSV</button>
                                <button type="reset" class="btn btn-secondary ml-2">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Distributor Results</h3>
                </div>
                <div class="card-body">
                    <table id="distributors-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Customer Code</th>
                                <th>Zone</th>
                                <th>State</th>
                                <th>Sales Code</th>
                                <th>Distribution Channel</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- DataTables will populate this -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();

    // Initialize DataTable
    var distributorsTable = $('#distributors-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url("admin/Distributor_filter/filter_distributors") ?>',
            type: 'POST',
            data: function(d) {
                // Add custom filters to the DataTables request
                $('#distributor-filter-form select, #distributor-filter-form input[name="global_search"]').each(function() {
                    d[$(this).attr('name')] = $(this).val();
                });
                return d;
            }
        },
        columns: [
            { data: 'Customer_Name' },
            { data: 'Customer_Code' },
            { data: 'Zone' },
            { data: 'State' },
            { data: 'Sales_Code' },
            { data: 'Distribution_Channel_Code' },
            { 
                data: null, 
                render: function(data, type, row) {
                    return '<button class="btn btn-sm btn-info view-details" data-id="' + row.Customer_Code + '">View Details</button>';
                }
            }
        ]
    });

    // Apply Filters Button
    $('#apply-filters').on('click', function() {
        distributorsTable.ajax.reload();
    });

    // Export to CSV Button
    $('#export-filters').on('click', function() {
        var filters = $('#distributor-filter-form').serialize();
        window.location.href = '<?= base_url("admin/Distributor_filter/export_distributors") ?>?' + filters;
    });

    // View Details Button
    $('#distributors-table').on('click', '.view-details', function() {
        var customerId = $(this).data('id');
        // Implement modal or navigation to detailed view
        alert('View details for Customer Code: ' + customerId);
    });
});
</script>
