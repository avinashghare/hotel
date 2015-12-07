<div id="page-title">
    <a href="<?php echo site_url('site/vieworder'); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>

    <h1 class="page-header text-overflow">Payment Order Details</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
               <div class="panel-heading">
							<h3 class="panel-title">Create Payment</h3>
						</div>
            <div class="panel-body">
                <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createpaymentordersubmit");?>' enctype='multipart/form-data'>
                    <div class="panel-body">
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">User</label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown( "user",$user,set_value( 'user'), "class='chzn-select form-control'");?>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Name</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value('name');?>'>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Email</label>
                            <div class="col-sm-4">
                                    <input type="email" id="normal-field" class="form-control" name="email" value='<?php echo set_value(' email ');?>'>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Address</label>
                            <div class="col-sm-4">
                                <textarea rows="4" cols="12" id="normal-field" class="form-control" name="billingaddress" value='<?php echo set_value(' billingaddress ');?>'></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing City</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingcity" value='<?php echo set_value(' billingcity ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing State</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingstate" value='<?php echo set_value(' billingstate ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Zipcode</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingzipcode" value='<?php echo set_value(' billingzipcode ');?>'>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Contact</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingcontact" value='<?php echo set_value(' billingcontact ');?>'>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Country</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingcountry" value='<?php echo set_value(' billingcountry ');?>'>
                            </div>
                        </div>  
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Transaction id</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="transactionid" value='<?php echo set_value(' transactionid ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Order Status</label>
                            <div class="col-sm-4">
                             <?php echo form_dropdown( "orderstatus",$orderstatus,set_value( 'orderstatus'),"class='chzn-select form-control'");?>
                            </div>
                        </div>
                 
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?php echo site_url("site/viewpaymentorder"); ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                </form>
                </div>
        </section>
        </div>
    </div>
    </div>
