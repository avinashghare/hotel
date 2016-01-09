<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Order Details</h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editpaymentordersubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
                   <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">User</label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown( "user",$user,set_value( 'user',$before->user), "class='chzn-select form-control'");?>
                            </div>
                        </div>
                        
                          <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Name</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ',$before->name);?>'>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Email</label>
                            <div class="col-sm-4">
                                    <input type="email" id="normal-field" class="form-control" name="email" value='<?php echo set_value(' email ',$before->email);?>'>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Address</label>
                            <div class="col-sm-4">
                                <textarea rows="4" cols="12" id="normal-field" class="form-control" name="billingaddress" value='<?php echo set_value(' billingaddress ',$before->billingaddress);?>'><?php echo set_value('address',$before->billingaddress);?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing City</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingcity" value='<?php echo set_value(' billingcity ',$before->billingcity);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing State</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingstate" value='<?php echo set_value(' billingstate ',$before->billingstate);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Zipcode</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingzipcode" value='<?php echo set_value(' billingzipcode ',$before->billingzipcode);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Contact</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingcontact" value='<?php echo set_value(' billingcontact ',$before->billingcontact);?>'>
                            </div>
                        </div>    
            <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Billing Country</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="billingcountry" value='<?php echo set_value(' billingcountry ',$before->billingcountry);?>'>
                            </div>
                        </div> 
             <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Check In Date</label>
                            <div class="col-sm-4">
                                <input type="date" id="normal-field" class="form-control" name="checkindate" value='<?php echo set_value('checkindate',$before->checkindate);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Check Out Date</label>
                            <div class="col-sm-4">
                                <input type="date" id="normal-field" class="form-control" name="checkoutdate" value='<?php echo set_value('checkoutdate',$before->checkoutdate);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Resort</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="resort" value='<?php echo set_value('resort',$before->resort);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">No of Packs</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="noofpacks" value='<?php echo set_value('noofpacks ',$before->noofpacks);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">No Of Children Above 5</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="noofchildrenabove5" value='<?php echo set_value(' noofchildrenabove5',$before->noofchildrenabove5);?>'>
                            </div>
                        </div>
            <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ',$before->amount);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Transaction id</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="transactionid" value='<?php echo set_value(' transactionid ',$before->transactionid);?>'>
                            </div>
                        </div>
                         <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Order Status</label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown( "orderstatus",$orderstatus,set_value( 'orderstatus',$before->orderstatus), "class='chzn-select form-control'");?>
                            </div>
                        </div>
                      
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewpaymentorder"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
