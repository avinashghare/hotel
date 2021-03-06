<div id="page-title">
    <a href="<?php echo site_url('site/viewuserhotel?id=').$userid; ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>

    <h1 class="page-header text-overflow">Order For User Hotel Order Details</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
               <div class="panel-heading">
							<h3 class="panel-title">Create Order For User Hotel</h3>
						</div>
            <div class="panel-body">
                <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createorderforuserhotelsubmit");?>' enctype='multipart/form-data'>
                    <div class="panel-body">
                        <div class=" form-group" style="display:none;">
                            <label class="col-sm-2 control-label" for="normal-field">User</label>
                            <div class="col-sm-4">
                            <input type="text" id="normal-field" class="form-control" name="user" value='<?php echo set_value(' user ',$userid);?>'>
                            </div>
                        </div>
<!--
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Admin</label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown( "admin",$admin,set_value( 'admin'), "class='chzn-select form-control'");?>
                            </div>
                        </div>
-->
                        <div class=" form-group" style="display:none;">
                            <label class="col-sm-2 control-label" for="normal-field">Hotel</label>
                            <div class="col-sm-4">
                            <input type="text" id="normal-field" class="form-control" name="hotel" value='<?php echo set_value(' hotel ',$hotelid);?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Check In</label>
                            <div class="col-sm-4">
                                <input type="date" id="normal-field" class="form-control" name="checkin" value='<?php echo set_value(' checkin ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Check Out</label>
                            <div class="col-sm-4">
                                <input type="date" id="normal-field" class="form-control" name="checkout" value='<?php echo set_value(' checkout ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Adult</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="adult" value='<?php echo set_value(' adult ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Children</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="children" value='<?php echo set_value(' children ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Number Of Rooms</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="rooms" value='<?php echo set_value(' rooms ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Days</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="days" value='<?php echo set_value(' days ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">User Rate</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="userrate" value='<?php echo set_value(' userrate ');?>'>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Total</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="price" value='<?php echo set_value(' price ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Hotel Rate</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="hotelrate" value='<?php echo set_value(' hotelrate ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Profit</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="profit" value='<?php echo set_value(' profit ');?>'>
                            </div>
                        </div>
<!--
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Days</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="days" value='<?php echo set_value(' days ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">User Rate</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="userrate" value='<?php echo set_value(' userrate ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Hotel Rate</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="hotelrate" value='<?php echo set_value(' hotelrate ');?>'>
                            </div>
                        </div>
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Status</label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown( "status",$status,set_value( 'status'), "class='chzn-select form-control'");?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Price</label>
                            <div class="col-sm-4">
                                <input type="text" id="normal-field" class="form-control" name="price" value='<?php echo set_value(' price ');?>'>
                            </div>
                        </div>
-->
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <a href="<?php echo site_url("site/viewuserhotel?id=").$userid; ?>" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                </form>
                </div>
        </section>
        </div>
    </div>
    </div>
