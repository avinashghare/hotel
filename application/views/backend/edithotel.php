<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Hotel Details</h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/edithotelsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Name</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="name" value='<?php echo set_value(' name ',$before->name);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Initial Balance</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="initialbalance" value='<?php echo set_value(' initialbalance ',$before->initialbalance);?>'>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Location</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="location" value='<?php echo set_value(' location ',$before->location);?>'>
                </div>
            </div>

            <div class="form-group" style="display:none">
                <label class="col-sm-2 control-label" for="normal-field">Address</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="address" value='<?php echo set_value(' address ',$before->address);?>'>
                </div>
            </div>
            <div class=" form-group" style="display:none">
				  <label class="col-sm-2 control-label" for="normal-field">Image</label>
				  <div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image',$before->image);?>">
					<?php if($before->image == "")
						 { }
						 else
						 { ?>
							<img src="<?php echo base_url('uploads').'/'.$before->image; ?>" width="140px" height="140px">
						<?php }
					?>
				  </div>
				</div>
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">User</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "user",$user,set_value( 'user',$before->user),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewhotel"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>
