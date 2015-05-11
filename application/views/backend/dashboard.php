<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div class="well" style="text-align:center;">
            <p>Welcome
                <?php echo $this->session->userdata('name');?></p>
        </div>

    </div>
    <div class="col-md-4">

    </div>
</div>
<?php
if(isset($alerterror))
{
?>
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        
    <div style="text-align:center; color:red;">
            <p>No Such Vouchor Number.<br>Please Enter Valid Voucher Number.</p>
        </div>

    </div>
    <div class="col-md-4">

    </div>
</div>
<?php
}
?>

<!--
<div class="row">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <section>

            <div class="form-group">
            <form class='form-horizontal tasi-form' method='post' action='<?php echo site_url("site/submitvouchernumber");?>' enctype='multipart/form-data'>
                    
                        <div class="col-sm-6">
                            <input type="text" id="normal-field" class="form-control vouchernumber" name="vouchernumber" value="<?php echo set_value('vouchernumber');?>" placeholder="Enter Voucher Number">
                            <br>
                        </div>
                        <div class="col-sm-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                </form>
                <div class="col-sm-6">
                    <input type="text" id="normal-field" class="form-control vouchernumber" name="vouchernumber" value="<?php echo set_value('vouchernumber');?>" placeholder="Enter Voucher Number">
                    <br>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-info myformsubmit">Enter</a>
                </div>
            </div>
        </section>
    </div>
    <div class="col-md-4">
   
    </div>
    
</div>
-->
<div class="row"  >
    <div class="col-lg-5 col-sm-5">
        <section>
            
					<div class="form-group">
						<div class="col-sm-6">
						  <input type="text" id="normal-field" class="form-control vouchernumber" name="vouchernumber" value="<?php echo set_value('vouchernumber');?>" ><br>
						  </div>
						  <div class="col-sm-6">
						  <a class="btn btn-info myformsubmit">Enter</a>
						</div>
					</div>	
        </section>
    </div>
</div>

          <div class="row panel hoteltable" style="display:none;">
                <div class="col-lg-12 col-sm-12">
                    <section class="panel2">
                        <div id="userhotel" class="form-group" style="margin-top:10px;">
                            <div class="col-sm-12 ">

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
                            <tbody class="alluserhotels">
                               </tbody>
                                </table>
                            </div>
                          </div>
                    </section>
                </div>
            </div>
<script>
    $(".myformsubmit").click(function () {
//        alert($(".vouchernumber").val());
        $.getJSON(
            "<?php echo base_url(); ?>index.php/site/submitvouchernumber", {
                vouchernumber: $(".vouchernumber").val()
            },
            function (data) {
                console.log(data);
//                alert(data);
                nodata = data;
                // $("#store").html(data);
                hotelorders(data);

            }
        );
        //        return false;
    });
    
    function hotelorders(data) {
        $(".hoteltable").show();
//        $(".formlisting").show();
        $("#userhotel .alluserhotels").html("");
        for(var i=0;i<data['hotels'].length;i++)
        {
            console.log(data['hotels'][i].name);
            console.log(data['userid']);
            var id=data['hotels'][i].id;
            var name=data['hotels'][i].name;
            var timestamp=data['hotels'][i].timestamp;
            var days=data['hotels'][i].days;
            var price=data['hotels'][i].price;
            var orderid=data['hotels'][i].orderid;
            var userid=data['userid'];
            var makeorder="";
            
            if(orderid=="" || orderid==null)
                             {
                                  
                               var makeorder="<a class='btn btn-primary' href='<?php echo site_url('site/createorderforuserhotelfromdashboard?userid=');?>" + userid + "&hotelid="+id+"'><i class=''></i>Make Order</a>"
                             }
            
            $("#userhotel .alluserhotels").append("<tr><td>"+name+"</td><td>"+timestamp+"</td><td>"+days+"</td><td>"+price+"</td><td>"+makeorder+"</td>");
//            var listingname=data['allenquiries'][i].listingname;
//            var categoryname=data['allenquiries'][i].categoryname;
//            var comment=data['allenquiries'][i].comment;
////            $("#enquiries .allenquiries").append(data['allenquiries'][i].id);
//             $("#enquiries .allenquiries").append("<div class='well'><div>Listing:"+listingname+"</div><div>Category:"+categoryname+"</div><div>Comment:"+comment+"</div></div>");
        }
//        for (var key in userdetail) {
//  console.log(key);
//}
//        console.log(data(userdetail.id));

    };
</script>