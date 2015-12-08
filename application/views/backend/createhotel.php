<div id="page-title">
    <a href="<?php echo site_url('site/viewhotel'); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>

    <h1 class="page-header text-overflow">Hotel Details</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Create Hotel</h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createhotelsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Initial Balance</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="initialbalance" value='<?php echo set_value(' initialbalance ');?>'>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Location</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="location" value='<?php echo set_value(' location ');?>'>
                                </div>
                            </div>

                            <div class="form-group" style="display:none">
                                <label class="col-sm-2 control-label" for="normal-field">Address</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="address" value='<?php echo set_value(' address ');?>'>
                                </div>
                            </div>
                            <div class=" form-group" style="display:none">
                                <label class="col-sm-2 control-label" for="normal-field">Image</label>
                                <div class="col-sm-4">
                                    <input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image');?>">
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">User</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "user",$user,set_value( 'user'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url(" site/viewhotel "); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>