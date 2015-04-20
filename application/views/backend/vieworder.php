<div class="row" style="padding:1% 0">
<div class="col-md-12">
<a class="btn btn-primary pull-right"  href="<?php echo site_url("site/createorder"); ?>"><i class="icon-plus"></i>Create </a> &nbsp; 
</div>
</div>
<div class="row">
<div class="col-lg-12">
<section class="panel">
<header class="panel-heading">
order Details
</header>
<div class="drawchintantable">
<?php $this->chintantable->createsearch("order List");?>
<table class="table table-striped table-hover" id="" cellpadding="0" cellspacing="0" >
<thead>
<tr>
<th data-field="id">ID</th>
<th data-field="user">User</th>
<th data-field="admin">Admin</th>
<th data-field="hotel">Hotel</th>
<th data-field="days">Days</th>
<th data-field="userrate">User Rate</th>
<th data-field="hotelrate">Hotel Rate</th>
<th data-field="status">Status</th>
<th data-field="price">Price</th>
</tr>
</thead>
<tbody>
</tbody>
</table>
<?php $this->chintantable->createpagination();?>
</div>
</section>
<script>
function drawtable(resultrow) {
return "<tr><td>" + resultrow.id + "</td><td>" + resultrow.user + "</td><td>" + resultrow.admin + "</td><td>" + resultrow.hotel + "</td><td>" + resultrow.days + "</td><td>" + resultrow.userrate + "</td><td>" + resultrow.hotelrate + "</td><td>" + resultrow.status + "</td><td>" + resultrow.price + "</td><td><a class='btn btn-primary btn-xs' href='<?php echo site_url('site/editorder?id=');?>"+resultrow.id+"'><i class='icon-pencil'></i></a><a class='btn btn-danger btn-xs' href='<?php echo site_url('site/deleteorder?id='); ?>"+resultrow.id+"'><i class='icon-trash '></i></a></td></tr>";
}
generatejquery("<?php echo $base_url;?>");
</script>
</div>
</div>
