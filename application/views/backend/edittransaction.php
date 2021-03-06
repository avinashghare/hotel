<section class="panel">
    <header class="panel-heading">
        <h3 class="panel-title">Transaction Details</h3>
    </header>
    <div class="panel-body">
        <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/edittransactionsubmit");?>' enctype='multipart/form-data'>
            <input type="hidden" id="normal-field" class="form-control" name="id" value="<?php echo set_value('id',$before->id);?>" style="display:none;">
            
            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Hotel</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "hotel",$hotel,set_value( 'hotel',$before->hotel),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                <div class="col-sm-4">
                    <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ',$before->amount);?>'>
                </div>
            </div>

<!--
            <div class=" form-group">
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
-->
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">Payment Method</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( 'paymentmethod',$paymentmethod,set_value( 'paymentmethod',$before->paymentmethod), 'id="select10"  onchange="changepaymentmode()" class="form-control populate placeholder "'); ?>
                </div>
            </div>

            <div class="displaychequedetails" style="display:none;">


                <div class="form-group">
                    <label class="col-sm-2 control-label" for="normal-field">Bank Name</label>
                    <div class="col-sm-4">
                        <input type="text" id="normal-field" class="form-control" name="bankname" value="<?php echo set_value('bankname',$before->bankname);?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="normal-field">Branch Name</label>
                    <div class="col-sm-4">
                        <input type="text" id="normal-field" class="form-control" name="branchname" value="<?php echo set_value('branchname',$before->branchname);?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="normal-field">Cheque Number</label>
                    <div class="col-sm-4">
                        <input type="text" id="normal-field" class="form-control" name="chequeno" value="<?php echo set_value('chequeno',$before->chequeno);?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="normal-field">Cheque Date</label>
                    <div class="col-sm-4">
                        <input type="date" id="normal-field" class="form-control" name="chequedate" value="<?php echo set_value('chequedate',$before->chequedate);?>">
                    </div>
                </div>
            </div>

            <div class=" form-group">
                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                <div class="col-sm-4">
                    <?php echo form_dropdown( "status",$status,set_value( 'status',$before->status),"class='chzn-select form-control'");?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href='<?php echo site_url("site/viewtransaction"); ?>' class='btn btn-secondary'>Cancel</a>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    $(document).ready(function () {
                $('#select10').trigger("change");
    });

    function changepaymentmode() {
        console.log($('#select10').val());
        //        alert($('#select10').val());
        if ($('#select10').val() == 'Cash') {
            $(".displaychequedetails").hide();
        } else if ($('#select10').val() == 'Cheque') {
            $(".displaychequedetails").show();
        }

    }

    function getorderremaining() {
        //alert($('#select3').val());
        console.log("Changed");
        $.getJSON(
            "<?php echo base_url(); ?>index.php/site/getorderremaining/" + $('#select2').val(), {
                i6d: "123"
            },
            function (data) {
                console.log(data);
                $(".remaining22").html("Remaining Amount In this Course: " + data.remainingamount);
            }

        );

    }
</script>
