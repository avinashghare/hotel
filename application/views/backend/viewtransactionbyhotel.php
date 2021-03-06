<div id="page-title">
<!--       <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url('site/createtransaction'); ?>">Create</a>-->

<div class=" pull-right col-md-1 createbtn" ><a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url('site/exporttransactionbyhotel'); ?>" target="_blank"><i class="icon-plus"></i>Export to Excel </a></div>
    <h1 class="page-header text-overflow">Transaction Details</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">

                <?php $this->chintantable->createsearch("");?>


                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="username">User</th>
                                    <th data-field="hotelname">Hotel</th>
                                    <th data-field="amount">Amount</th>
                                    <th data-field="paymentmethod">paymentmethod</th>
                                    <th data-field="timestamp">timestamp</th>
                                    <th data-field="image">Image</th>
<!--                                    <th data-field="status">Status</th>-->
<!--                                    <th data-field="action">Action</th>-->
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <div class="fixed-table-pagination" style="display: block;">
                        <div class="pull-left pagination-detail">
                                    <?php $this->chintantable->createpagination();?>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>

       
        <script>
            function drawtable(resultrow) {
                var image="<a href='<?php echo base_url('uploads').'/'; ?>"+resultrow.image+"' target='_blank'><img src='<?php echo base_url('uploads').'/'; ?>"+resultrow.image+"' width='140px' height='140px'></a>";
                if(resultrow.image=="")
                {
                    image="No Receipt Available";
                }
                return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.username + "</td><td>" + resultrow.hotelname + "</td><td>" + resultrow.amount + "</td><td>" + resultrow.paymentmethod + "</td><td>" + resultrow.timestamp + "</td><td>" + image + "</td></tr>";
            }
            generatejquery("<?php echo $base_url;?>");
        </script>
    </div>
</div>
