<section class="panel">
<header class="panel-heading">
order Details
</header>
<div class="panel-body">
<form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/editordersubmit");?>' enctype= 'multipart/form-data'>
<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">User</label>
<div class="col-sm-4">
<?php echo form_dropdown("user",$user,set_value('user',$before->user),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Admin</label>
<div class="col-sm-4">
<?php echo form_dropdown("admin",$admin,set_value('admin',$before->admin),"class='chzn-select form-control'");?>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Hotel</label>
<div class="col-sm-4">
<?php echo form_dropdown("hotel",$hotel,set_value('hotel',$before->hotel),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Days</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="days" value='<?php echo set_value('days',$before->days);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">User Rate</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="userrate" value='<?php echo set_value('userrate',$before->userrate);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Hotel Rate</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="hotelrate" value='<?php echo set_value('hotelrate',$before->hotelrate);?>'>
</div>
</div>
<div class=" form-group">
<label class="col-sm-2 control-label" for="normal-field">Status</label>
<div class="col-sm-4">
<?php echo form_dropdown("status",$status,set_value('status',$before->status),"class='chzn-select form-control'");?>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">Price</label>
<div class="col-sm-4">
<input type="text" id="normal-field" class="form-control" name="price" value='<?php echo set_value('price',$before->price);?>'>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
<div class="col-sm-4">
<button type="submit" class="btn btn-primary">Save</button>
<a href='<?php echo site_url("site/view'.price.'"); ?>' class='btn btn-secondary'>Cancel</a>
</div>
</div>
</form>
</div>
</section>
