<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Order Details</h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editordersubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "user",$user,set_value( 'user',$before->user),"class='chzn-select form-control'");?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Guest Name</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="guestname" value='<?php echo set_value(' guestname ',$before->guestname);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Admin</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "admin",$admin,set_value( 'admin',$before->admin),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Hotel</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "hotel",$hotel,set_value( 'hotel',$before->hotel),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check In</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="checkin" value='<?php echo set_value(' checkin ',$before->checkin);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check Out</label>
                <div class="col-sm-4">
                    <input type="date" id="normal-field" class="form-control" name="checkout" value='<?php echo set_value(' checkout ',$before->checkout);?>'>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check In Time</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="checkintime" value='<?php echo set_value(' checkintime ',$before->checkintime);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check Out Time</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="checkouttime" value='<?php echo set_value(' checkouttime ',$before->checkouttime);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Adult</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="adult" value='<?php echo set_value(' adult ',$before->adult);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Children</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="children" value='<?php echo set_value(' children ',$before->children);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Number Of Rooms</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="rooms" value='<?php echo set_value(' rooms ',$before->rooms);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Number of Days</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="days" value='<?php echo set_value(' days ',$before->days);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">User Rate</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="userrate" value='<?php echo set_value(' userrate ',$before->userrate);?>'>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Total</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="price" value='<?php echo set_value(' price ',$before->price);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Hotel Rate</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="hotelrate" value='<?php echo set_value(' hotelrate ',$before->hotelrate);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ',$before->amount);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Profit</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="profit" value='<?php echo set_value(' profit ',$before->profit);?>'>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">foodpackage</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="foodpackage" value='<?php echo set_value(' foodpackage ',$before->foodpackage);?>'>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "status",$status,set_value( 'status',$before->status),"class='chzn-select form-control'");?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">extra</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="extra" value='<?php echo set_value(' extra ',$before->extra);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/vieworder"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
