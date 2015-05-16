<div id="page-title">
    <a href="<?php echo site_url('site/viewusers'); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>

    <h1 class="page-header text-overflow">User Details</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
               <div class="panel-heading">
							<h3 class="panel-title">Create User</h3>
						</div>
                <div class="panel-body">
			  <form class="form-horizontal tasi-form" method="post" action="<?php echo site_url('site/createusersubmit');?>" enctype= "multipart/form-data">
				<div class="form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Name</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="name" value="<?php echo set_value('name');?>">
				  </div>
				</div>
<!--
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Username</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="username" value="<?php echo set_value('username');?>">
				  </div>
				</div>
-->
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Email</label>
				  <div class="col-sm-4">
					<input type="email" id="normal-field" class="form-control" name="email" value="<?php echo set_value('email');?>">
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
					<input type="text" id="normal-field" class="form-control" name="age" value="<?php echo set_value('age');?>">
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
					<input type="text" id="normal-field" class="form-control" name="address" value="<?php echo set_value('address');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Contact</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="contact" value="<?php echo set_value('contact');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Mobile</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="mobile" value="<?php echo set_value('mobile');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">DOB</label>
				  <div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="dob" value="<?php echo set_value('dob');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Profession</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="profession" value="<?php echo set_value('profession');?>">
				  </div>
				</div>
				
				
<!--
                <div class=" form-group">
                    <label class="col-sm-2 control-label" for="normal-field">Manager</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown( "manager",$manager,set_value( 'manager'), "class='chzn-select form-control'");?>
                    </div>
                </div>
                
                <div class=" form-group">
                    <label class="col-sm-2 control-label" for="normal-field">Executive</label>
                    <div class="col-sm-4">
                        <?php echo form_dropdown( "executive",$executive,set_value( 'executive'), "class='chzn-select form-control'");?>
                    </div>
                </div>
-->
                
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Voucher Number</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="vouchernumber" value="<?php echo set_value('vouchernumber');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label" for="normal-field">Valid Till</label>
				  <div class="col-sm-4">
					<input type="date" id="normal-field" class="form-control" name="validtill" value="<?php echo set_value('validtill');?>">
				  </div>
				</div>
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label" for="normal-field">SocialId</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="socialid" value="<?php echo set_value('socialid');?>">
				  </div>
				</div>
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label">logintype</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('logintype',$logintype,set_value('logintype'),'class="chzn-select form-control" 	data-placeholder="Choose a Logintype..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Status</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('status',$status,set_value('status'),'class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label" for="normal-field">Image</label>
				  <div class="col-sm-4">
					<input type="file" id="normal-field" class="form-control" name="image" value="<?php echo set_value('image');?>">
				  </div>
				</div>
				
				<div class=" form-group">
				  <label class="col-sm-2 control-label">Select Accesslevel</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('accesslevel',$accesslevel,set_value('accesslevel'),'id="accesslevelid" onchange="operatorcategories()" class="chzn-select form-control" 	data-placeholder="Choose a Accesslevel..." ');
					?>
				  </div>
				</div>
				
				<div class=" form-group managermainclass" style="display:none;">
				  <label class="col-sm-2 control-label">Manager</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('manager',$manager,set_value('manager'),'id="managerid" class="chzn-select form-control" 	data-placeholder="Choose a manager..."  onchange="changetrainee()"');
					?>
				  </div>
				</div>
				
				<div class=" form-group traineemainclass" style="display:none;">
				  <label class="col-sm-2 control-label">Select trainee</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('trainee',$trainee,set_value('trainee'),'id="traineeid" class="chzn-select form-control" 	data-placeholder="Choose a trainee..."');
					?>
				  </div>
				</div>
				
				<div class=" form-group executivemainclass" style="display:none;">
				  <label class="col-sm-2 control-label">Select executive</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('executive',$executive,set_value('executive'),'id="executiveid" class="chzn-select form-control" 	data-placeholder="Choose a executive..."');
					?>
				  </div>
				</div>
				
<!--
				<div class="form-group traineemainclass" id="onmanagerselect" style="display:none;">
						<label class="col-sm-2 control-label">trainee</label>
						<div class="col-sm-4 managerselect">
                       <select name="trainee" class="chzn-select form-control" onchange="changeexecutive()">
						   
						   </select>
						</div>
				</div>
				<div class="form-group executivemainclass" id="ontraineeselect" style="display:none;">
						<label class="col-sm-2 control-label">Executive</label>
						<div class="col-sm-4 traineeselect">
                       <select name="executive" class="chzn-select form-control">
						   
						   </select>
						</div>
				</div>
-->
				<div class=" form-group hotelclass" style="display:none;">
				  <label class="col-sm-2 control-label">Select Hotel</label>
				  <div class="col-sm-4">
					<?php 	 echo form_dropdown('hotel',$hotel,set_value('hotel'),'id="hotelid" class="chzn-select form-control" 	data-placeholder="Choose a hotel..."');
					?>
				  </div>
				</div>
<!--
				<div class=" form-group categoryclass" style="display:none;">
				  <label class="col-sm-2 control-label">Category</label>
				  <div class="col-sm-4">
					<?php
						
						echo form_dropdown('category[]',$category,set_value('category'),'id="select10" class="chzn-select form-control" 	data-placeholder="Choose a category..." multiple');
					?>
				  </div>
				</div>
-->
				
				<div class=" form-group" style="display:none;">
				  <label class="col-sm-2 control-label" for="normal-field">json</label>
				  <div class="col-sm-4">
					<input type="text" id="normal-field" class="form-control" name="json" value="<?php echo set_value('json');?>">
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
	</div>
</div>
</div>
<script type="text/javascript">
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