<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Distributor Hierarchy Filters</h3>
                </div>
                <div class="card-body">
                    <form id="distributor-hierarchy-filter-form">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sales Code</label>
                                    <select class="selectpicker form-control" data-actions-box="true" multiple name="Sales_Code" multiple>
                                        <?php foreach ($hierarchy_values['Sales_Code'] as $sales_code): ?>
                                            <option value="<?= $sales_code ?>"><?= $sales_code ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Distribution Channel Code</label>
                                    <select class="selectpicker form-control" data-actions-box="true" multiple name="Distribution_Channel_Code" multiple disabled>
                                        <?php foreach ($hierarchy_values['Distribution_Channel_Code'] as $channel_code): ?>
                                            <option value="<?= $channel_code ?>"><?= $channel_code ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Division Code</label>
                                    <select class="selectpicker form-control" data-actions-box="true" multiple name="Division_Code" multiple disabled>
                                        <?php foreach ($hierarchy_values['Division_Code'] as $division_code): ?>
                                            <option value="<?= $division_code ?>"><?= $division_code ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Type Code</label>
                                    <select class="selectpicker form-control" data-actions-box="true" multiple name="Customer_Type_Code" multiple disabled>
                                        <?php foreach ($hierarchy_values['Customer_Type_Code'] as $type_code): ?>
                                            <option value="<?= $type_code ?>"><?= $type_code ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Customer Group Code</label>
                                    <select class="selectpicker form-control" data-actions-box="true" multiple name="Customer_Group_Code" multiple disabled>
                                        <?php foreach ($hierarchy_values['Customer_Group_Code'] as $group_code): ?>
                                            <option value="<?= $group_code ?>"><?= $group_code ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Population Strata 2</label>
                                    <select class="selectpicker form-control" data-actions-box="true" multiple name="Population_Strata_2" multiple>
                                        <?php foreach ($hierarchy_values['Population_Strata_2'] as $strata): ?>
                                            <option value="<?= $strata ?>"><?= $strata ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="button" id="apply-hierarchy-filters" class="btn btn-primary">Apply Filters</button>
                                <button type="button" id="export-hierarchy-filters" class="btn btn-success ml-2">Export to CSV</button>
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
                    <h3 class="card-title">Distributor Hierarchy Results</h3>
                </div>
                <div class="card-body">
                    <table id="distributors-hierarchy-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Sales Code</th>
                                <th>Distribution Channel</th>
                                <th>Division Code</th>
                                <th>Customer Type</th>
                                <th>Customer Group</th>
                                <th>Population Strata 2</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Population Strata Statistics</h3>
                </div>
                <div class="card-body">
                    <div id="population-strata-stats" class="text-center">
                        <p>Select Population Strata to view detailed statistics</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
$(document).ready(function() {
    // Sales Code Dropdown
    $('select[name="Sales_Code"]').on('change', function() {
        var selectedSalesCodes = $(this).val();
        
        // Reset and disable Distribution Channel dropdown
        var $distributionChannelDropdown = $('select[name="Distribution_Channel_Code"]');
        $distributionChannelDropdown.empty().prop('disabled', true);
        
        // Reset and disable Division Code dropdown
        var $divisionCodeDropdown = $('select[name="Division_Code"]');
        $divisionCodeDropdown.empty().prop('disabled', true);
        
        // If sales codes are selected, fetch distribution channels
        if (selectedSalesCodes && selectedSalesCodes.length > 0) {
            $.ajax({
                url: '<?= base_url("admin/get-distribution-channels") ?>',
                type: 'POST',
                data: { sales_codes: selectedSalesCodes },
                dataType: 'json',
                success: function(response) {
                    console.log('Distribution Channels Response:', response);

                    // Check for error
                    if (response.error) {
                        alert(response.message || 'Error fetching distribution channels');
                        return;
                    }

                    // Populate Distribution Channel dropdown
                    $distributionChannelDropdown.prop('disabled', false);
                    
                    // Clear existing options
                    $distributionChannelDropdown.empty();
                    
                    // Add new options
                    if (response.distribution_channels && response.distribution_channels.length > 0) {
                        response.distribution_channels.forEach(function(channel) {
                            $distributionChannelDropdown.append(
                                $('<option>', {
                                    value: channel,
                                    text: channel
                                })
                            );
                        });
                    } else {
                        // Show message if no channels found
                        $distributionChannelDropdown.append(
                            $('<option>', {
                                value: '',
                                text: response.message || 'No distribution channels available'
                            })
                        );
                    }

                    // Refresh selectpicker
                    $distributionChannelDropdown.selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                    alert('Unable to fetch distribution channels. Please try again.');
                }
            });
        }
    });

    // Cascading Filter Mechanism
    const filterChain = [
        {
            name: 'Sales_Code',
            nextFilter: 'Distribution_Channel_Code',
            endpoint: '<?= base_url("admin/get-distribution-channels") ?>',
            paramKey: 'sales_codes'
        },
        {
            name: 'Distribution_Channel_Code',
            nextFilter: 'Division_Code',
            endpoint: '<?= base_url("admin/get-division-codes") ?>',
            paramKey: 'distribution_channels',
            additionalParams: ['Sales_Code']
        },
        {
            name: 'Division_Code',
            nextFilter: 'Customer_Type_Code',
            endpoint: '<?= base_url("admin/get-customer-types") ?>', // You'll need to implement this
            paramKey: 'division_codes'
        },
        {
            name: 'Customer_Type_Code',
            nextFilter: 'Customer_Group_Code',
            endpoint: '<?= base_url("admin/get-customer-groups") ?>', // You'll need to implement this
            paramKey: 'customer_type_codes'
        }
    ];

    // Function to handle cascading filter updates
    function setupCascadingFilter(filterConfig) {
        $(`select[name="${filterConfig.name}"]`).on('change', function() {
            const selectedValues = $(this).val();
            const $nextDropdown = $(`select[name="${filterConfig.nextFilter}"]`);
            
            // Reset and disable next dropdown
            $nextDropdown.empty().prop('disabled', true);
            
            // If values are selected, fetch next level options
            if (selectedValues && selectedValues.length > 0) {
                // Prepare parameters
                const params = {
                    [filterConfig.paramKey]: selectedValues
                };

                // Add additional parameters if specified
                if (filterConfig.additionalParams) {
                    filterConfig.additionalParams.forEach(param => {
                        params[param] = $(`select[name="${param}"]`).val();
                    });
                }

                // AJAX call to fetch next level options
                $.ajax({
                    url: filterConfig.endpoint,
                    type: 'POST',
                    data: params,
                    dataType: 'json',
                    success: function(options) {
                        // Populate next dropdown
                        $nextDropdown.prop('disabled', false);
                        options.forEach(function(option) {
                            $nextDropdown.append(
                                $('<option>', {
                                    value: option,
                                    text: option
                                })
                            );
                        });
                        $nextDropdown.selectpicker('refresh');
                    },
                    error: function() {
                        alert(`Error fetching ${filterConfig.nextFilter} options`);
                    }
                });
            }
        });
    }

    // Setup cascading filters
    filterChain.forEach(setupCascadingFilter);

    // Add Population Strata 2 change event with logging and AJAX
    $('select[name="Population_Strata_2"]').on('change', function() {
        // Get selected Population Strata 2 values
        const selectedPopulationStratas = $(this).val();
        
        // Log the selected values to browser console
        console.log('Selected Population Strata 2:', selectedPopulationStratas);
        
        // AJAX call to get additional data or perform filtering
        if (selectedPopulationStratas && selectedPopulationStratas.length > 0) {
            $.ajax({
                url: '<?= base_url("admin/get-population-strata-details") ?>', // You'll need to implement this endpoint
                type: 'POST',
                data: { 
                    population_stratas: selectedPopulationStratas 
                },
                dataType: 'json',
                success: function(response) {
                    // Log the full response
                    console.log('Population Strata Details:', response);
                    
                    // Optional: Update other UI elements or perform additional actions
                    // For example, you might want to update some statistics or filter other dropdowns
                    if (response.stats) {
                        $('#population-strata-stats').html(
                            `Total Distributors: ${response.stats.total_distributors}<br>` +
                            `Unique Sales Codes: ${response.stats.unique_sales_codes}`
                        );
                    }
                },
                error: function(xhr, status, error) {
                    // Log any errors
                    console.error('Error fetching Population Strata details:', error);
                    console.log('XHR Status:', status);
                    console.log('XHR Response:', xhr.responseText);
                    
                    // Optional: Show user-friendly error message
                    alert('Unable to fetch Population Strata details. Please try again.');
                }
            });
        } else {
            // Log when no values are selected
            console.log('No Population Strata selected');
        }
    });

    // Initialize DataTable (existing code)
    var distributorsHierarchyTable = $('#distributors-hierarchy-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url("admin/Distributor_filter/filter_hierarchy_distributors") ?>',
            type: 'POST',
            data: function(d) {
                // Add custom filters to the DataTables request
                $('#distributor-hierarchy-filter-form select').each(function() {
                    d[$(this).attr('name')] = $(this).val();
                });
                return d;
            }
        },
        columns: [
            { data: 'Customer_Name' },
            { data: 'Sales_Code' },
            { data: 'Distribution_Channel_Code' },
            { data: 'Division_Code' },
            { data: 'Customer_Type_Code' },
            { data: 'Customer_Group_Code' },
            { data: 'Population_Strata_2' },
            { 
                data: null, 
                render: function(data, type, row) {
                    return '<button class="btn btn-sm btn-info view-details" data-id="' + row.Customer_Code + '">View Details</button>';
                }
            }
        ]
    });

    // Apply Filters Button
    $('#apply-hierarchy-filters').on('click', function() {
        distributorsHierarchyTable.ajax.reload();
    });

    // Export to CSV Button
    $('#export-hierarchy-filters').on('click', function() {
        var filters = $('#distributor-hierarchy-filter-form').serialize();
        window.location.href = '<?= base_url("admin/Distributor_filter/export_distributors") ?>?' + filters;
    });

    // View Details Button
    $('#distributors-hierarchy-table').on('click', '.view-details', function() {
        var customerId = $(this).data('id');
        // Implement modal or navigation to detailed view
        alert('View details for Customer Code: ' + customerId);
    });
});
</script>