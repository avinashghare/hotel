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
<div class="row wrongvalue" style="display:none;">
    <div class="col-md-4">
    </div>
    <div class="col-md-4">

        <div style="text-align:center; color:red;">
            <p>No Such Vouchor Number.
                <br>Please Enter Valid Voucher Number.</p>
        </div>

    </div>
    <div class="col-md-4">

    </div>
</div>

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
<div class="row">
    <div class="col-lg-5 col-sm-5">
        <section>

            <div class="form-group">
                <div class="col-sm-6">
                    <input type="text" id="normal-field" class="form-control vouchernumber" name="vouchernumber" value="<?php echo set_value('vouchernumber');?>">
                    <br>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-info myformsubmit">Enter</a>
                </div>
            </div>
        </section>
    </div>
</div>

<div class="row panel hoteltable" style="margin:0 15px">


    <div id="userhotel" class="">
    <div class="alluserhotels">
    </div>
<!--
        <div class="col-xs-2 ffff" style="border:1px solid red;">
            <div class=""><span>Demo</span>
                <a href="" class="btn btn-primary">Book Now</a>
            </div>
        </div>
-->




    </div>


</div>
<!--
<div class="row panel hoteltable" style="display:none;">
    <div class="col-lg-12 col-sm-12">
        <section class="panel2">
            <div id="userhotel" class="form-group" style="margin-top:10px;">
                <div class="col-sm-12 ">
                    <div class="row">
                        <div class="alluserhotels">

                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</div>
-->
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
        for (var i = 0; i < data['hotels'].length; i++) {
            console.log(data['hotels'][i].name);
            console.log(data['userid']);
            var id = data['hotels'][i].id;
            var name = data['hotels'][i].name;
            var timestamp = data['hotels'][i].timestamp;
            var days = data['hotels'][i].days;
            var price = data['hotels'][i].price;
            var orderid = data['hotels'][i].orderid;
            var userid = data['userid'];
            var makeorder = "";
            var classvalue="border-right:1px solid white;border-bottom:1px solid white;background-color:green;color:white";
            if (orderid == "" || orderid == null) {
                var classvalue="border-right:1px solid white;border-bottom:1px solid white;background-color:red;color:white";
                var makeorder = "<a class='btn btn-primary' href='<?php echo site_url('site/createorderforuserhotelfromdashboard?userid=');?>" + userid + "&hotelid=" + id + "'><i class=''></i>Book Now</a>"
                
            $("#userhotel .alluserhotels").append("<div class='col-xs-2 ffff' style='"+classvalue+"; height:100px'><div class=''><span>"+name+"</span><br>"+makeorder+"</div></div>");
            }
            else
            {
            
            $("#userhotel .alluserhotels").append("<a href='<?php echo site_url('site/viewuserhotelorder?orderid=');?>" + orderid + "&hotelid=" + id + "&userid="+userid+"'><div class='col-xs-2 ffff' style='"+classvalue+"; height:100px'><div class=''><span>"+name+"</span><br>"+makeorder+"</div></div></a>");
            }

            //            $("#userhotel .alluserhotels").append("<tr><td>" + name + "</td><td>" + timestamp + "</td><td>" + days + "</td><td>" + price + "</td><td>" + makeorder + "</td>");
//            $("#userhotel .alluserhotels").append("<div class='row'>" + name + " " + timestamp + " " + days + " " + price + " " + makeorder + "</div>");
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