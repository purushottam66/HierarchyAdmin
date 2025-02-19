<div class="app-main">
    <header class="main-heading shadow-2dp">
        <div class="dashhead bg-white">
            <div class="dashhead-titles">
                <h3 class="dashhead-title">Distribution Channel</h3>
            </div>
            <div class="dashhead-toolbar">
                <div class="dashhead-toolbar-item"><a href="#">Masters</a> / Distribution
                    Channel
                </div>
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
                                            <th class="text-center"> Sr no.</th>
                                            <th class="text-center"> Distributor Channel Code</th>



                                            <th class="text-center"> Distributor Channel Name</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php if (!empty($distributionchannel)): ?>

                                            <?php $sr_number = 1; ?>
                                            <?php foreach ($distributionchannel as $distributionchannels): ?>
                                                <tr>
                                                    <td class="text-center"><?php echo htmlspecialchars($sr_number++); ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo htmlspecialchars($distributionchannels['Distribution_Channel_Code']); ?>
                                                    </td>

                                                    <td class="text-center">
                                                        <?php echo htmlspecialchars($distributionchannels['Distribution_Channel_Name']); ?>
                                                    </td>


                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="2">No distributionchannel found</td>
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