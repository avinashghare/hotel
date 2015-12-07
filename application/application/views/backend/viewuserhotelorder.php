<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Order Details</h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editordersubmit");?>' enctype='multipart/form-data'>
       
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                <?php echo $before->username;?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Guest Name</label>
                <div class="col-sm-4">
                <?php echo $before->guestname;?>
                </div>
            </div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Hotel</label>
                <div class="col-sm-4">
                <?php echo $before->hotelname;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check In</label>
                <div class="col-sm-4">
                <?php echo $before->checkin;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check Out</label>
                <div class="col-sm-4">
                <?php echo $before->checkout;?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check In Time</label>
                <div class="col-sm-4">
                <?php echo $before->checkintime;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Check Out Time</label>
                <div class="col-sm-4">
                <?php echo $before->checkouttime;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Adult</label>
                <div class="col-sm-4">
                <?php echo $before->adult;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Children</label>
                <div class="col-sm-4">
                <?php echo $before->children;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Number Of Rooms</label>
                <div class="col-sm-4">
                <?php echo $before->rooms;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Number of Days</label>
                <div class="col-sm-4">
                <?php echo $before->days;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">User Rate</label>
                <div class="col-sm-4">
                <?php echo $before->userrate;?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Total</label>
                <div class="col-sm-4">
                <?php echo $before->price;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Hotel Rate</label>
                <div class="col-sm-4">
                <?php echo $before->hotelrate;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                <div class="col-sm-4">
                <?php echo $before->amount;?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Profit</label>
                <div class="col-sm-4">
                <?php echo $before->profit;?>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">foodpackage</label>
                <div class="col-sm-4">
                <?php echo $before->foodpackage;?>
                </div>
            </div>
<!--
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "status",$status,set_value( 'status',$before->status),"class='chzn-select form-control'");?>
                </div>
            </div>
-->

            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">extra</label>
                <div class="col-sm-4">
                <?php echo $before->extra;?>
                </div>
            </div>
<!--
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/vieworder"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
-->
            
        </form>
    </div>
</section>


