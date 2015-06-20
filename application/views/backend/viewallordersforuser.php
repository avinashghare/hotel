<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">

                <?php $this->chintantable->createsearch("Order List");?>


                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <div>Total Order Amount <?php echo $totalorderamount;?></div>
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="username">User</th>
                                    <th data-field="adminname">Admin</th>
                                    <th data-field="hotel">Hotel</th>
                                    <th data-field="days">Days</th>
                                    <th data-field="userrate">User Rate</th>
                                    <th data-field="hotelrate">Hotel Rate</th>
                                    <th data-field="status">Status</th>
                                    <th data-field="price">Price</th>
                                    <th data-field="action">Action</th>
                                    <th data-field="Invoice">Invoice</th>
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
//                if(resultrow.status==1)
//                {
//                    resultrow.status="Inactive";
//                }
//                else if(resultrow.status==2)
//                {
//                    resultrow.status="Active";
//                }
                return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.username + "</td><td>" + resultrow.adminname + "</td><td>" + resultrow.hotelname + "</td><td>" + resultrow.days + "</td><td>" + resultrow.userrate + "</td><td>" + resultrow.hotelrate + "</td><td>" + resultrow.statusname + "</td><td>" + resultrow.price + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editorder?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deleteorder?id='); ?>" + resultrow.id + "'><i class='icon-trash '></i></a></td><td><a class='btn btn-secondary btn-s' target='_blank' href='<?php echo site_url('site/printorderinvoice?id='); ?>" + resultrow.id + "'>Download</a></td></tr>";
            }
            generatejquery("<?php echo $base_url;?>");
        </script>
    </div>
</div>
