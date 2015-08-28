<div id="page-title">
       <a class="btn btn-primary btn-labeled fa fa-plus margined pull-right" href="<?php echo site_url('site/createpaymentorder'); ?>">Create</a>

    <h1 class="page-header text-overflow">Payment Order Details</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel drawchintantable">

                <?php $this->chintantable->createsearch("Payment List");?>


                <div class="fixed-table-container">
                    <div class="fixed-table-body">
                        <table class="table table-hover" id="" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr>
                                    <th data-field="id">ID</th>
                                    <th data-field="user">User</th>
                                    <th data-field="email">Email</th>
                                    <th data-field="name">Name</th>
                                    <th data-field="transactionid">Transactionid</th>
                                    <th data-field="orderstatus">Status</th>
                                    <th data-field="amount">Amount</th>
                                    <th data-field="action">Action</th>
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
                if(resultrow.orderstatus==1)
                {
                    resultrow.orderstatus="Success";
                }
                else if(resultrow.orderstatus==2)
                {
                    resultrow.orderstatus="Fail";
                }
                return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.user + "</td><td>" + resultrow.email + "</td><td>" + resultrow.name + "</td><td>" + resultrow.transactionid + "</td><td>" + resultrow.orderstatus + "</td><td>" + resultrow.amount + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editpaymentorder?id=');?>" + resultrow.id + "'><i class='icon-pencil'></i></a></td></tr>";
            }
            generatejquery("<?php echo $base_url;?>");
        </script>
    </div>
</div>
