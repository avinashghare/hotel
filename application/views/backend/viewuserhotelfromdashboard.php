<div class=" row" style="padding:1% 0;">
	<div class="col-md-12">
<!--	<div class=" pull-right col-md-1 createbtn" ><a class="btn btn-primary" href="<?php echo site_url('site/createuserhotel'); ?>"><i class="icon-plus"></i>Create </a></div>-->
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<section class="panel">
			<header class="page-header text-overflow" style="margin-left:10px;">
                User Hotel Details
            </header>
			<table class="table table-striped table-hover border-top " id="sample_1" cellpadding="0" cellspacing="0" >
			<thead>
				<tr>
					<!--<th>Id</th>-->
					<th>Hotel</th>
					<th>Timestamp(if ordered)</th>
					<th>Days</th>
					<th>Price</th>
<!--					<th>Order</th>-->
					<th> Actions </th>
				</tr>
			</thead>
			<tbody>
			   <?php foreach($table as $row) { ?>
					<tr>
						<!--<td><?php echo $row->id; ?></td>-->
						<td><?php echo $row->name; ?></td>
						<td><?php echo $row->timestamp; ?></td>
						<td><?php echo $row->days; ?></td>
						<td><?php echo $row->price; ?></td>
<!--						<td><?php echo $row->order; ?></td>-->
						<td>
                        <?php 
                             if($row->orderid=="")
                             {
                                 ?>
                                  
                                <a class="btn btn-primary" href="<?php echo site_url('site/createorderforuserhotelfromdashboard?userid=').$userid.'&hotelid='.$row->id; ?>"><i class=""></i>Make Order </a>
                                <?php
                             }
                            else
                            {
                            }
                            ?>
<!--
                                     <a class="btn btn-primary btn-xs" href="<?php echo site_url('site/edituserhotel?id=').$row->id;?>"><i class="icon-pencil"></i></a>
                                      <a class="btn btn-danger btn-xs" href="<?php echo site_url('site/deleteuserhotel?id=').$row->id; ?>"><i class="icon-trash "></i></a>
-->
									 
					  </td>
					</tr>
					<?php } ?>
			</tbody>
			</table>
		</section>
	</div>
  </div>
