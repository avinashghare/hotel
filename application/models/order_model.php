<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class order_model extends CI_Model
{
    public function create($user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage,$extra,$guestname)
    {
        $newinitialbalance=0;
        $data=array(
                    "user" => $user,
                    "admin" => $admin,
                    "hotel" => $hotel,
                    "days" => $days,
                    "userrate" => $userrate,
                    "hotelrate" => $hotelrate,
                    "status" => $status,
                    "price" => $price,
                    "checkin" => $checkin,
                    "checkout" => $checkout,
                    "adult" => $adult,
                    "children" => $children,
                    "rooms" => $rooms,
                    "amount" => $amount,
                    "profit" => $profit,
                    "checkintime" => $checkintime,
                    "checkouttime" => $checkouttime,
                    "foodpackage" => $foodpackage,
                    "guestname" => $guestname,
                    "extra" => $extra
                    );
        $query=$this->db->insert( "hotel_order", $data );
        $id=$this->db->insert_id();
        
        $selecthotelquery=$this->db->query("SELECT * FROM `hotel_hotel` WHERE `id`='$hotel'")->row();
        $initialbalancebefore=$selecthotelquery->initialbalance;
        
        $newinitialbalance=$initialbalancebefore+$amount;
        $updatehotelquery=$this->db->query("UPDATE `hotel_hotel` SET `initialbalance`='$newinitialbalance' WHERE `id`='$hotel'");
        $table=$this->db->query("SELECT DATE(`hotel_order`.`timestamp`) AS `booking`, `hotel_order`.`checkin` AS `checkin`, `hotel_order`.`checkout` AS `checkout`, `hotel_order`.`checkintime` AS `checkintime`, `hotel_order`.`checkouttime` AS `checkouttime`, `hotel_order`.`foodpackage` AS `foodpackage`, `hotel_order`.`adult` AS `adult`, `hotel_order`.`children` AS `children`, `hotel_order`.`rooms` AS `rooms`, `hotel_order`.`days` AS `days`, `hotel_order`.`userrate` AS `userrate`, `hotel_order`.`price` AS `total`, `hotel_order`.`hotelrate` AS `hotelrate`, `hotel_order`.`amount` AS `amount`, `hotel_order`.`profit` AS `profit`, `hotel_order`.`extra` AS `extra`, `hotel_order`.`guestname` AS `guestname`,`tab1`.`name` AS `username`,`tab1`.`vouchernumber` AS `vouchernumber`,`tab2`.`name` AS `adminname`,`hotel_hotel`.`name` AS `hotelname`,`hotel_hotel`.`address` AS `hoteladdress`,`hotel_hotel`.`image` AS `hotelimage`,`tab1`.`mobile` AS `mobile`,`tab1`.`email` AS `email`
FROM `hotel_order` 
LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` 
LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` 
LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status` 
WHERE `hotel_order`.`id`='$id'")->row();
        
        
        $message="<!DOCTYPE html>
<html lang=''>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='description' content=''>
    <meta name='author' content=''>
    <title>Reservation Confirmation</title>
    <link rel='shortcut icon' href=''>
    <style>
        @font-face {
            font-family: 'Verdana';
            src: url('fonts/Verdana.ttf');
            font-weight: normal;
        }
        
        @font-face {
            font-family: 'Monotype Corsiva';
            src: url('fonts/MTCORSVA.ttf');
            font-weight: normal;
        }
        
        body {
            padding-top: 50px;
            font-family: 'Tinos', serif;
        }
        
        .starter-template {
            padding: 40px 15px;
            text-align: center;
        }
        
        .hd {
            background: #948a54;
            text-align: center;
            font-family: 'monotype corsiva';
            color: #ffff00;
        }
        
        .hd p {
            font-size: 35px;
            text-decoration: underline;
            border: 1px solid black;
        }
        
        .dear p {
            font-family: 'verdana';
            font-size: 17px;
        }
        
        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
            border: 1px solid black;
            border-collapse: separate;
            font-family: 'verdana';
            font-size: 17px;
        }
        
        .table>tbody>tr>td,
        .table>tbody>tr>th,
        .table>tfoot>tr>td,
        .table>tfoot>tr>th,
        .table>thead>tr>td,
        .table>thead>tr>th {
            padding: 8px;
            line-height: 1.42857143;
            vertical-align: top;
            border: 1px solid black;
        }
        
        .fot p {
            font-family: 'verdana';
            font-size: 17px;
        }
        
        .fots {
            padding-top: 30px;
        }
        
        .fots p {
            font-family: 'monotype corsiva';
            font-size: 25px;
            line-height: 20px;
        }
        .cont{
        padding-top: 10px;
        }
        .cont p {
  font-family: 'times new roman';
  font-size: 15px;
            font-weight: bold;
}
    </style>


</head>

<body>

    <div class='container'>
        <div class='row'>
            <div class='col-md-12'>
                <div class='hd'>
                    <p>Reservation Confirmation</p>
                </div>
                <div class='dear'>
                    <p style='font-weight:bold'>
                        Dear '$table->username',
                    </p>
                    <p>Thank you for your reservation request and we are pleased to confirm that we are holding the following accommodations for you. Please review this information to insure your understanding is the same as ours:-</p>
                </div>
                <div class='tbl'>
                    <table class='table table-striped'>

                        <tbody>
                            <tr>
                                <th>Resort Name</th>
                                <th>'$table->hotelname'</th>


                            </tr>



                            <tr>
                                <td>COMPANY NAME: -</td>
                                <td></td>

                            </tr>
                            <tr>
                                <th>CONTACT PERSON:-</th>
                                <th>'$table->username'</th>
                            </tr>
                            <tr>
                                <th>Guest PERSON (If Any):-</th>
                                <th>'$table->guestname'</th>
                            </tr>
                            <tr>
                                <td>Guest Mobile number:'$table->mobile'</td>
                                <td>Voucher No:- '$table->vouchernumber'</td>

                            </tr>
                            <tr>
                                <th>Check In Date:</th>
                                <th>'$table->checkin'</th>


                            </tr>
                            <tr>
                                <th>Check Out Date:-</th>
                                <th>'$table->checkout'</th>


                            </tr>
                            <tr>
                                <td>Number of Guests:</td>
                                <td>'$table->adult' Adults + '$table->children' Child</td>

                            </tr>
                            <tr>
                                <td>Tariff per person:-</td>
                                <td></td>

                            </tr>
                            <tr>
                                <td>Check-in Time:</td>
                                <th>'$table->checkintime'</th>

                            </tr>
                            <tr>
                                <td>Check-out Time:</td>
                                <th>'$table->checkouttime'</th>

                            </tr>
                            <tr>
                                <th>No of Rooms</th>
                                <th>'$table->rooms'</th>
                            </tr>
                            <tr>
                                <th>Total :- Full Amt. Paid
                                    <br> Advance :- Full Amt. Paid
                                    <br> Balance :- Rs. 0/-
                                </th>
                                <td></td>
                            </tr>
                            <tr>
                                <td>FOOD PACKAGE:</td>
                                <th>'$table->foodpackage'</th>
                            </tr>
                            <tr>
                                <td>Extra:</td>
                                <th>'$table->extra'</th>
                            </tr>
                            <tr>
                                <td></td>
                                <th>Note: Please carry valid Photo Id & Address Proof
                                    <br> Like –Aadhar card, Driving license, Passport or
                                    <br> Voter ID (except Pancard) Of all guests.. Issued by
                                    <br>Central /State Government..</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class='fot'>
                    <p>We are eagerly anticipating your arrival and would like to advise you of the following in order to help you with your trip planning:</p>
                    <p>We look forward to the pleasure of having you as our guest at My Holidays. If you have any Quarry & questions, please call us at <span style='font-weight:bold'>9920847014/15  Between Monday to Saturday Between 10.00 Am to 6.00 Pm</span> Cordially,</p>
                </div>
                <div class='fots'>
                    <p>Sincerely</p>
                    <p>My Holidays</p>
                </div>
                <div class='fots'>
                    <p>Signature</p>
                    <p>'$table->adminname'</p>
                </div>
                <div class='cont'>
                    <p>NOTE:- IF THE PAX INCREASES, KINDLY PAYTHE AMOUNT  IN THE MY HOLIDAYS BANK ACCOUNT OR MY HOLIDAYS OFFICE  AND INFORM ATLEAST BEFORE 36 HOURS. IF THE PAX DECREASES FOR ANY REASON MY HOLIDAYS WILL NOT ABLE TO GIVE YOU ANY CANCELLATION AMOUNT WHICH HAS DEPOSITED BY YOU.ONCE  YOU DONE THE BOOKING  IT CAN NOT BE CANCELLED,CAN NOT  BE FILTER OR POSPONED IN ANY CERCUMSTANCES.</p>
                    <p style='font-family:'monotype corsiva';font-size:22px;padding-bottom:10px;color:#984806;'>'$table->hoteladdress'</p>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>";
//        echo $message;
        $email=$table->email;
     $this->load->library('email');
        $this->email->from('avinash@wohlig.com', 'Myholidaysresort');
        $this->email->to($email);
        $this->email->subject('Thank You For Ordering in myholidaysresort');
        $this->email->message($message);

        $this->email->send();
//        echo "<br><br>";
//        echo $this->email->print_debugger();
        if(!$query)
            return  0;
        else
            return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("hotel_order")->row();
        return $query;
    }
    public function getuserhotelorderdetails($orderid,$hotelid)
    {
        $query=$this->db->query("SELECT `hotel_order`.`id`,`hotel_order`. `user`,`hotel_order`. `admin`,`hotel_order`. `hotel`,`hotel_order`. `days`,`hotel_order`. `userrate`,`hotel_order`. `hotelrate`,`hotel_order`. `status`,`hotel_order`. `price`,`hotel_order`. `timestamp`,`hotel_order`. `checkin`,`hotel_order`. `checkout`,`hotel_order`. `adult`,`hotel_order`. `children`,`hotel_order`. `rooms`,`hotel_order`. `amount`,`hotel_order`. `profit`,`hotel_order`. `checkintime`,`hotel_order`. `checkouttime`,`hotel_order`. `foodpackage`,`hotel_order`. `extra`,`hotel_order`. `guestname` ,`hotel_hotel`.`name` AS `hotelname`,`user`.`name` AS `username`
FROM `hotel_order` 
LEFT OUTER JOIN `user` ON `user`.`id`=`hotel_order`.`user`
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel`
WHERE `hotel_order`.`id`='$orderid'")->row();
        return $query;
    }
    function getsingleorder($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("hotel_order")->row();
        return $query;
    }
    public function edit($id,$user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage,$extra,$guestname)
    {
        $orderdetails=$this->order_model->beforeedit($id);
        $oldamount=$orderdetails->amount;
        $hotelid=$orderdetails->hotel;
        
        $selecthotelquery=$this->db->query("SELECT * FROM `hotel_hotel` WHERE `id`='$hotel'")->row();
        $initialbalancebefore=$selecthotelquery->initialbalance;
        
        $newamount=$initialbalancebefore+$amount;
        $finalamount=$newamount-$oldamount;
            
        $newinitialbalance=$initialbalancebefore+$amount;
        $updatehotelquery=$this->db->query("UPDATE `hotel_hotel` SET `initialbalance`='$finalamount' WHERE `id`='$hotel'");
        $data=array(
                    "user" => $user,
                    "admin" => $admin,
                    "hotel" => $hotel,
                    "days" => $days,
                    "userrate" => $userrate,
                    "hotelrate" => $hotelrate,
                    "status" => $status,
                    "price" => $price,
                    "checkin" => $checkin,
                    "checkout" => $checkout,
                    "adult" => $adult,
                    "children" => $children,
                    "rooms" => $rooms,
                    "amount" => $amount,
                    "profit" => $profit,
                    "checkintime" => $checkintime,
                    "checkouttime" => $checkouttime,
                    "foodpackage" => $foodpackage,
                    "guestname" => $guestname,
                    "extra" => $extra
                    );
        $this->db->where( "id", $id );
        $query=$this->db->update( "hotel_order", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `hotel_order` WHERE `id`='$id'");
        return $query;
    }
    
    public function getorderstatusdropdown()
	{
		$query=$this->db->query("SELECT * FROM `orderstatus`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
    function exportordercsvbyhotel()
	{
		$this->load->dbutil();
        $hotelid=$this->session->userdata('hotel');
		$query=$this->db->query("SELECT `user`.`vouchernumber` AS `Voucher Number`, DATE(`hotel_order`.`timestamp`) AS `Booking`,`user`.`name` as `Customer Name`, `hotel_order`.`checkin` AS `Check-In`, `hotel_order`.`checkout` AS `Check-Out`, `hotel_order`.`adult` AS `Adult`, `hotel_order`.`children` AS `Children`, `hotel_order`.`rooms` AS `Number Of Rooms`, `hotel_order`.`days` AS `Number Of Days`, `hotel_order`.`hotelrate` AS `Hotel`, `hotel_order`.`amount` AS `Amt.`
FROM `hotel_order` 
LEFT OUTER JOIN `user` ON `hotel_order`.`user`=`user`.`id`
WHERE `hotel_order`.`hotel`='$hotelid'");
        
//		$query=$this->db->query("SELECT `user`.`vouchernumber` AS `Voucher Number`, DATE(`hotel_order`.`timestamp`) AS `Booking`,`user`.`name` as `Customer Name`, `hotel_order`.`checkin` AS `Check-In`, `hotel_order`.`checkout` AS `Check-Out`, `hotel_order`.`adult` AS `Adult`, `hotel_order`.`children` AS `Children`, `hotel_order`.`rooms` AS `Number Of Rooms`, `hotel_order`.`days` AS `Number Of Days`, `hotel_order`.`userrate` AS `Per Person`, `hotel_order`.`price` AS `Total`, `hotel_order`.`hotelrate` AS `Hotel`, `hotel_order`.`amount` AS `Amt.`, `hotel_order`.`profit` AS `Profit`,`hotel_order`.`id`, `hotel_order`.`user`, `hotel_order`.`admin`, `hotel_order`.`hotel`, `hotel_order`.`status`, `hotel_order`.`checkintime`, `hotel_order`.`checkouttime`, `hotel_order`.`foodpackage`
//FROM `hotel_order` 
//LEFT OUTER JOIN `user` ON `hotel_order`.`user`=`user`.`id`
//WHERE `hotel_order`.`hotel`='$hotelid'");

       $content= $this->dbutil->csv_from_result($query);
        //$data = 'Some file data';

        if ( ! write_file('./csvgenerated/hotelcsvbyhotel.csv', $content))
        {
             echo 'Unable to write the file';
        }
        else
        {
            redirect(base_url('csvgenerated/hotelcsvbyhotel.csv'), 'refresh');
             echo 'File written!';
        }
	}
    
    function exportordercsvbyadmin()
	{
		$this->load->dbutil();
		$query=$this->db->query("SELECT `user`.`vouchernumber` AS `Voucher Number`, DATE(`hotel_order`.`timestamp`) AS `Booking`,`user`.`name` as `Customer Name`, `hotel_order`.`checkin` AS `Check-In`, `hotel_order`.`checkout` AS `Check-Out`, `hotel_order`.`adult` AS `Adult`, `hotel_order`.`children` AS `Children`, `hotel_order`.`rooms` AS `Number Of Rooms`, `hotel_order`.`days` AS `Number Of Days`, `hotel_order`.`userrate` AS `Per Person`, `hotel_order`.`price` AS `Total`, `hotel_order`.`hotelrate` AS `Hotel`, `hotel_order`.`amount` AS `Amt.`, `hotel_order`.`profit` AS `Profit`
FROM `hotel_order` 
LEFT OUTER JOIN `user` ON `hotel_order`.`user`=`user`.`id`");

       $content= $this->dbutil->csv_from_result($query);
        //$data = 'Some file data';

        if ( ! write_file('./csvgenerated/hotelcsvbyadmin.csv', $content))
        {
             echo 'Unable to write the file';
        }
        else
        {
            redirect(base_url('csvgenerated/hotelcsvbyadmin.csv'), 'refresh');
             echo 'File written!';
        }
	}
    
    function exportordercsvbyadmin1()
	{
        $where="";
        $accesslevel=$this->session->userdata('accesslevel');
        $hotel=$this->session->userdata('hotel');
        if($accesslevel==3)
        {
        $where.=" WHERE `hotel_order`.`hotel`='$hotel'";
        }
		$query=$this->db->query("SELECT `user`.`vouchernumber` AS `Voucher Number`, DATE(`hotel_order`.`timestamp`) AS `Booking`,`user`.`name` as `Customer Name`, `hotel_order`.`checkin` AS `Check-In`, `hotel_order`.`checkout` AS `Check-Out`, `hotel_order`.`adult` AS `Adult`, `hotel_order`.`children` AS `Children`, `hotel_order`.`rooms` AS `Number Of Rooms`, `hotel_order`.`days` AS `Number Of Days`, `hotel_order`.`userrate` AS `Per Person`, `hotel_order`.`price` AS `Total`, `hotel_order`.`hotelrate` AS `Hotel`, `hotel_order`.`amount` AS `Amt.`, `hotel_order`.`profit` AS `Profit`
FROM `hotel_order` 
LEFT OUTER JOIN `user` ON `hotel_order`.`user`=`user`.`id` $where");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
    
    function exportordercsvbyhotel1()
	{
        $hotelid=$this->session->userdata('hotel');
		$query=$this->db->query("SELECT `user`.`vouchernumber` AS `Voucher Number`, DATE(`hotel_order`.`timestamp`) AS `Booking`,`user`.`name` as `Customer Name`, `hotel_order`.`checkin` AS `Check-In`, `hotel_order`.`checkout` AS `Check-Out`, `hotel_order`.`adult` AS `Adult`, `hotel_order`.`children` AS `Children`, `hotel_order`.`rooms` AS `Number Of Rooms`, `hotel_order`.`days` AS `Number Of Days`, `hotel_order`.`hotelrate` AS `Hotel`, `hotel_order`.`amount` AS `Amt.`
FROM `hotel_order` 
LEFT OUTER JOIN `user` ON `hotel_order`.`user`=`user`.`id`
WHERE `hotel_order`.`hotel`='$hotelid'");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
    function exportorderforadmin()
	{
		$query=$this->db->query("SELECT `tab1`.`vouchernumber` AS `Voucher Number`, DATE(`hotel_order`.`timestamp`) AS `Booking`,`tab1`.`name` as `Customer Name`, `hotel_order`.`checkin` AS `Check-In`, `hotel_order`.`checkout` AS `Check-Out`, `hotel_order`.`adult` AS `Adult`, `hotel_order`.`children` AS `Children`, `hotel_order`.`rooms` AS `Number Of Rooms`, `hotel_order`.`days` AS `Number Of Days`,`hotel_order`.`userrate` AS `Per Person`,`hotel_order`.`price` AS `Total`, `hotel_order`.`hotelrate` AS `Hotel`, `hotel_order`.`amount` AS `Amt.`,`hotel_order`.`profit` AS `Profit`
FROM `hotel_order` 
LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` 
LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` 
LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status`");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
    function getorderdetails($id)
	{
		$query=$this->db->query("SELECT DATE(`hotel_order`.`timestamp`) AS `booking`, `hotel_order`.`checkin` AS `checkin`, `hotel_order`.`checkout` AS `checkout`, `hotel_order`.`checkintime` AS `checkintime`, `hotel_order`.`checkouttime` AS `checkouttime`, `hotel_order`.`foodpackage` AS `foodpackage`, `hotel_order`.`adult` AS `adult`, `hotel_order`.`children` AS `children`, `hotel_order`.`rooms` AS `rooms`, `hotel_order`.`days` AS `days`, `hotel_order`.`userrate` AS `userrate`, `hotel_order`.`price` AS `total`, `hotel_order`.`hotelrate` AS `hotelrate`, `hotel_order`.`amount` AS `amount`, `hotel_order`.`profit` AS `profit`, `hotel_order`.`extra` AS `extra`, `hotel_order`.`guestname` AS `guestname`,`tab1`.`name` AS `username`,`tab1`.`vouchernumber` AS `vouchernumber`,`tab2`.`name` AS `adminname`,`hotel_hotel`.`name` AS `hotelname`,`hotel_hotel`.`address` AS `hoteladdress`,`hotel_hotel`.`image` AS `hotelimage`,`tab1`.`mobile` AS `mobile`
FROM `hotel_order` 
LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` 
LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` 
LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status` 
WHERE `hotel_order`.`id`='$id'")->row();
        return $query;

	}
    
    function gettotalamountofuser($id)
	{
		$query=$this->db->query("SELECT SUM(`hotel_order`.`amount`) as `totalamount`
FROM `hotel_order`  
WHERE `hotel_order`.`user`='$id'")->row();
        $query=$query->totalamount;
        return $query;

	}
    
}
?>
