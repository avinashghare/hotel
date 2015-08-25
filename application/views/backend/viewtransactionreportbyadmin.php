<div id="page-title">
    <a href="<?php echo site_url('site/vieworder'); ?>" class="btn btn-primary btn-labeled fa fa-arrow-left margined pull-right">Back</a>

    <h1 class="page-header text-overflow">Transaction Reports</h1>
</div>

<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
               <div class="panel-heading">
							<h3 class="panel-title">Reports</h3>
						</div>
            <div class="panel-body">
                <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/createtransactionreportbyadminsubmit");?>' enctype='multipart/form-data' target="_blank">
                    <div class="panel-body">
                        
                        <div class=" form-group">
                            <label class="col-sm-2 control-label" for="normal-field">Hotel</label>
                            <div class="col-sm-4">
                                <?php echo form_dropdown( "hotel",$hotel,set_value( 'hotel'), "class='chzn-select form-control'");?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">From Date</label>
                            <div class="col-sm-4">
                                <input type="date" id="normal-field" class="form-control" name="startdate" value='<?php echo set_value(' startdate ');?>'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">To Date</label>
                            <div class="col-sm-4">
                                <input type="date" id="normal-field" class="form-control" name="enddate" value='<?php echo set_value(' enddate ');?>'>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="normal-field">&nbsp;</label>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary">Generate Reports</button>
<!--                                <a href="<?php echo site_url("site/vieworder"); ?>" class="btn btn-secondary">Cancel</a>-->
                            </div>
                        </div>
                </form>
                </div>
        </section>
        </div>
    </div>
    </div>
