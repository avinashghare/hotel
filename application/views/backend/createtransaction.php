<div id="page-title">
    <a href="<?php echo site_url('site/viewtransaction'); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>

    <h1 class="page-header text-overflow">Transaction Details</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Create Transaction</h3>
                </div>
                <div class="panel-body">
                    <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createtransactionsubmit");?>' enctype='multipart/form-data'>
                        <div class="panel-body">
                            
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Hotel</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "hotel",$hotel,set_value( 'hotel'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Amount</label>
                                <div class="col-sm-4">
                                    <input type="text" id="normal-field" class="form-control" name="amount" value='<?php echo set_value(' amount ');?>'>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Payment Method</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( 'paymentmethod',$paymentmethod,set_value( 'paymentmethod'), 'id="select10"  onchange="changepaymentmode()" class="form-control populate placeholder "'); ?>
                                </div>
                            </div>

                            <div class="displaychequedetails" style="display:none;">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="normal-field">Bank Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="normal-field" class="form-control" name="bankname" value="<?php echo set_value('bankname');?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="normal-field">Branch Name</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="normal-field" class="form-control" name="branchname" value="<?php echo set_value('branchname');?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="normal-field">Cheque Number</label>
                                    <div class="col-sm-4">
                                        <input type="text" id="normal-field" class="form-control" name="chequeno" value="<?php echo set_value('chequeno');?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="normal-field">Cheque Date</label>
                                    <div class="col-sm-4">
                                        <input type="date" id="normal-field" class="form-control" name="chequedate" value="<?php echo set_value('chequedate');?>">
                                    </div>
                                </div>
                            </div>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label" for="normal-field">Status</label>
                                <div class="col-sm-4">
                                    <?php echo form_dropdown( "status",$status,set_value( 'status'), "class='chzn-select form-control'");?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                                <div class="col-sm-4">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <a href="<?php echo site_url(" site/viewtransaction "); ?>" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                    </form>
                    </div>
            </section>
            </div>
        </div>
    </div>

    <script>
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
