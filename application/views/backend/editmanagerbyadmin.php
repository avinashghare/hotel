<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Manager Details</h3>
    </header>
    <div class="panel-body">
			  <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('site/editmanagerbyadminsubmit');?>" enctype= "multipart/form-data">
				<input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Email</label>
				  <div class="col-sm-4">
					<?php echo $before->email; ?>
				  </div>
				</div>
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Name</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="name" value="<?php echo set_value('name',$before->name);?>">
				  </div>
				</div>
<!--
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Username</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="username" value="<?php echo set_value('username',$before->username);?>">
				  </div>
				</div>
-->
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Email</label>
				  <div class="col-sm-4">
					<input type="email" id="normal-field" class="form-control" name="email" value="<?php echo set_value('email',$before->email);?>">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="description-field">Password</label>
				  <div class="col-sm-4">
					<input type="password" id="description-field" class="form-control" name="password" value="">
				  </div>
				</div>
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="description-field">Confirm Password</label>
				  <div class="col-sm-4">
					<input type="password" id="description-field" class="form-control" name="confirmpassword" value="">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Age</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="age" value="<?php echo set_value('age',$before->age);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Gender</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('gender',$gender,set_value('gender'),'class="chzn-select form-control" 	data-placeholder="Choose a Logintype..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Address</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="address" value="<?php echo set_value('address',$before->address);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Contact</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="contact" value="<?php echo set_value('contact',$before->contact);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Mobile</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="mobile" value="<?php echo set_value('mobile',$before->mobile);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">DOB</label>
				  <div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="dob" value="<?php echo set_value('dob',$before->dob);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Profession</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="profession" value="<?php echo set_value('profession',$before->profession);?>">
				  </div>
				</div>
				
<!--
                <div class=" form-group">
                    <label class="col-sm-2 control-label" for="normal-field">Executive</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown( "executive",$executive,set_value( 'executive',$before->executive), "class='chzn-select form-control'");?>
                    </div>
                </div>
-->
                
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Voucher Number</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="vouchernumber" value="<?php echo set_value('vouchernumber',$before->vouchernumber);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Valid Till</label>
				  <div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="validtill" value="<?php echo set_value('validtill',$before->validtill);?>">
				  </div>
				</div>
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label" for="normal-field">SocialId</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="socialid" value="<?php echo set_value('socialid',$before->socialid);?>">
				  </div>
				</div>
				
				<div class=" form-group"style="display:none;">
				  <label class="col-sm-2 control-label">logintype</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('logintype',$logintype,set_value('logintype',$before->logintype),'class="chzn-select form-control" 	data-placeholder="Choose a Logintype..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Status</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('status',$status,set_value('status',$before->status),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
				
<!--
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Select Accesslevel</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('accesslevel',$accesslevel,set_value('accesslevel',$before->accesslevel),'onchange="operatorcategories()"class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
-->
				
<!--
				<div class=" form-group categoryclass" 
                   <?php if(empty($selectedcategory))
                        echo 'style="display:none;"';
                    else
                       echo '';
                     ?>
                     >
				  <label class="col-sm-2 control-label">Category</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('category[]',$category,$selectedcategory,'id="select10" class="chzn-select form-control" 	data-placeholder="Choose a category..." multiple');
					?>
				  </div>
				</div>
-->
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label" for="normal-field">Image</label>
				  <div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image',$before->image);?>">
					<?php if($before->image == "")
						 { }
						 else
						 { ?>
							<img src="<?php echo base_url('uploads')."/".$before->image; ?>" width="140px" height="140px">
						<?php }
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">json</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="json" value="<?php echo set_value('json',$before->json);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">&nbsp;</label>
				  <div class="col-sm-4">
				  <button type="submit" class="btn btn-primary">Save</button>
				  <a href="<?php echo site_url('site/viewmanagerbyadmin'); ?>" class="btn btn-secondary">Cancel</a>
				</div>
				</div>
			  </form>
			</div>
		</section>
<script type="text/javascript">
    function operatorcategories() {
        console.log($('#accesslevelid').val());
        if($('#accesslevelid').val()==2)
        {
            $( ".categoryclass" ).show();
        }
       
        else
        {
            $( ".categoryclass" ).hide();
        }
       
    }
</script>