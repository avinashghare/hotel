<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">User Details</h3>
    </header>
    <div class="panel-body">
			  <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('site/editusersubmit');?>" enctype= "multipart/form-data">
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
				  <label class="col-sm-2 control-label" for="normal-field">age</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="age" value="<?php echo set_value('age',$before->age);?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">gender</label>
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
				  <label class="col-sm-2 control-label">Manager</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('manager',$manager,set_value('manager',$before->manager),'id="managerid" class="chzn-select form-control" 	data-placeholder="Choose a manager..."  onchange="changeexecutive()"');
					?>
				  </div>
				</div>
				
				<div class="form-group" id="onmanagerselect">
						<label class="col-sm-2 control-label">Executive</label>
						<div class="col-sm-4 managerselect">
						   <?php echo form_dropdown( "executive",$executive,set_value( 'executive',$before->executive), "class='chzn-select form-control'");?>
						</div>
				</div>
-->
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
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Select Accesslevel</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('accesslevel',$accesslevel,set_value('accesslevel',$before->accesslevel),'onchange="operatorcategories()" id="accesslevelid" class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group managermainclass" style="display:none;">
				  <label class="col-sm-2 control-label">Manager</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('manager',$manager,set_value('manager',$before->manager),'id="managerid" class="chzn-select form-control" 	data-placeholder="Choose a manager..."  onchange="changetrainee()"');
					?>
				  </div>
				</div>
				
				<div class=" form-group traineemainclass" style="display:none;">
				  <label class="col-sm-2 control-label">Select trainee</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('trainee',$trainee,set_value('trainee',$before->trainee),'id="traineeid" class="chzn-select form-control" 	data-placeholder="Choose a trainee..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group executivemainclass" style="display:none;">
				  <label class="col-sm-2 control-label">Select executive</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('executive',$executive,set_value('executive',$before->executive),'id="executiveid" class="chzn-select form-control" 	data-placeholder="Choose a executive..."');
					?>
				  </div>
				</div>
				
				<?php
                  if($before->accesslevel==3)
                  {
                  ?>
				<div class=" form-group hotelclass">
				  <label class="col-sm-2 control-label">Select Hotel</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('hotel',$hotel,set_value('hotel',$before->hotel),'id="hotelid" class="chzn-select form-control" 	data-placeholder="Choose a hotel..."');
					?>
				  </div>
				</div>
				
				<?php
                  }
                  ?>
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
				  <a href="<?php echo site_url('site/viewusers'); ?>" class="btn btn-secondary">Cancel</a>
				</div>
				</div>
			  </form>
			</div>
		</section>
<script type="text/javascript">
    
    $(document).ready(function () {
        
        $('#accesslevelid').trigger("change");
//        $('#select99').trigger("change");
    
     
    });
//    function operatorcategories() {
//        console.log($('#accesslevelid').val());
//        if ($('#accesslevelid').val()==3)
//        {
//            $( ".hotelclass" ).show();
//        }
//        else
//        {
//            $( ".hotelclass" ).hide();
//        }
//       
//    }
    
    function operatorcategories() {
        console.log($('#accesslevelid').val());
        if ($('#accesslevelid').val()<=2)
        {
            $( ".hotelclass" ).hide();
            $( ".managermainclass" ).hide();
            $( ".traineemainclass" ).hide();
            $( ".executivemainclass" ).hide();
        }
        else if($('#accesslevelid').val()==3)
        {
            $( ".hotelclass" ).show();
            $( ".managermainclass" ).hide();
            $( ".traineemainclass" ).hide();
            $( ".executivemainclass" ).hide();
        }
        else if($('#accesslevelid').val()==5)
        {
            $( ".hotelclass" ).hide();
            $( ".managermainclass" ).show();
            $( ".traineemainclass" ).hide();
            $( ".executivemainclass" ).hide();
        }
        else if($('#accesslevelid').val()==6)
        {
            $( ".hotelclass" ).hide();
            $( ".managermainclass" ).hide();
            $( ".traineemainclass" ).show();
            $( ".executivemainclass" ).hide();
        }
        else if($('#accesslevelid').val()==7)
        {
            $( ".hotelclass" ).hide();
            $( ".managermainclass" ).hide();
            $( ".traineemainclass" ).hide();
            $( ".executivemainclass" ).show();
        }
        else
        {
            $( ".hotelclass" ).hide();
            $( ".managermainclass" ).hide();
            $( ".traineemainclass" ).hide();
            $( ".executivemainclass" ).hide();
        }
       
    }
    function changeexecutive() {
        console.log($('#managerid').val());
        $.getJSON(
            "<?php echo base_url(); ?>index.php/site/getexecutivedropdown/" + $('#managerid').val(), {
                id: "123"
            },
            function (data) {
                console.log(data);
                nodata=data;
                changeexecutivedropdown(data);

            }

        );
    }
                  var mallbycity=$(".storesforuser1 select").select2({allowClear: true,width:343});
                  
    function changeexecutivedropdown(data) {
        $(".managerselect select").html("");
        for(var i=0;i<data.length;i++)
        {
//            console.log(data[i].id);
            $(".managerselect select").append("<option value='"+data[i].id+"'>"+data[i].name+"</option>");
            
        }
        

    };
    
</script>