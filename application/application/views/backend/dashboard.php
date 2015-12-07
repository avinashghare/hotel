<?php
//$ip  = !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
//$url = "http://freegeoip.net/json/$ip";
//$ch  = curl_init();
//echo $ip." ip";
//curl_setopt($ch, CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
//$data = curl_exec($ch);
//curl_close($ch);
//print_r($data);
//if ($data) {
//    $location = json_decode($data);
//
//    $lat = $location->latitude;
//    $lon = $location->longitude;
//echo $lat;
//    echo $lon;
//    $sun_info = date_sun_info(time(), $lat, $lon);
//    print_r($sun_info);
//}

?>
   

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
    <div class="alluserhotels col-md-8">
    </div>
    <div class="alluserdetails col-md-4">
    </div>
<!--
        <div class="col-xs-2 ffff" style="border:2px solid red;">
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
                userdetails(data);

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
            var classvalue="border-right:2px solid white;border-bottom:2px solid white;background-color:red;color:white";
            if (orderid == "" || orderid == null) {
                var classvalue="border-right:2px solid white;border-bottom:2px solid white;background-color:green;color:white";
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
    function userdetails(data) {
        $(".hoteltable").show();
        $("#userhotel .alluserdetails").html("");
            console.log(data['userdetails'].name);
            console.log(data['userid']);
            var id = data['userdetails'].id;
            var name = data['userdetails'].name;
            var email = data['userdetails'].email;
            var address = data['userdetails'].address;
            var contact = data['userdetails'].contact;
            var mobile = data['userdetails'].mobile;
            var dob = data['userdetails'].dob;
            var vouchernumber = data['userdetails'].vouchernumber;
        console.log(name);
        $("#userhotel .alluserdetails").append("<table class='table table-hover'><tr><td>Name: </td><td>"+name+"</td></tr><tr><td>email: </td><td>"+email+"</td></tr><tr><td>address: </td><td>"+address+"</td></tr><tr><td>contact: </td><td>"+contact+"</td></tr><tr><td>mobile: </td><td>"+mobile+"</td></tr><tr><td>dob: </td><td>"+dob+"</td></tr><tr><td>vouchernumber: </td><td>"+vouchernumber+"</td></tr></table>");

    };
</script>