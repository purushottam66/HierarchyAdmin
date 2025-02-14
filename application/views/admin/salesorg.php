<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Sales org</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Masters</a> / Sales org</div>
            </div>
        </div>
    </header>
    <div class="main-content bg-clouds">
        <div class="container-fluid p-t-15">
            <div class="row">
                <div class="col-md-12">
                    <div class="box shadow-2dp b-r-2">

                        <div class="box-body">
                            <table id="example" class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th class="text-center"> Sr no.</th>
                                        <th class="text-center"> Sales Org. Code</th>

                                        <th class="text-center">Sales Org. Name</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if (!empty($sales)): ?>

                                        <?php $sr_number = 1; ?>
                                        <?php foreach ($sales as $sales__): ?>
                                            <tr>
                                                <td class="text-center"><?php echo htmlspecialchars($sr_number++); ?></td>
                                                <td class="text-center"><?php echo htmlspecialchars($sales__['Sales_Code']); ?>
                                                </td>

                                                <td class="text-center"><?php echo htmlspecialchars($sales__['Sales_Name']); ?>
                                                </td>

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

<script>
    new DataTable('#example');
</script>