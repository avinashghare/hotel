<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class order_model extends CI_Model
{
    public function create($user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage)
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
                    "foodpackage" => $foodpackage
                    );
        $query=$this->db->insert( "hotel_order", $data );
        $id=$this->db->insert_id();
        
        $selecthotelquery=$this->db->query("SELECT * FROM `hotel_hotel` WHERE `id`='$hotel'")->row();
        $initialbalancebefore=$selecthotelquery->initialbalance;
        
        $newinitialbalance=$initialbalancebefore+$amount;
        $updatehotelquery=$this->db->query("UPDATE `hotel_hotel` SET `initialbalance`='$newinitialbalance' WHERE `id`='$hotel'");
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
    function getsingleorder($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("hotel_order")->row();
        return $query;
    }
    public function edit($id,$user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage)
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
                    "foodpackage" => $foodpackage
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
    
    function getorderdetails($id)
	{
		$query=$this->db->query("SELECT DATE(`hotel_order`.`timestamp`) AS `booking`, `hotel_order`.`checkin` AS `checkin`, `hotel_order`.`checkout` AS `checkout`, `hotel_order`.`checkintime` AS `checkintime`, `hotel_order`.`checkouttime` AS `checkouttime`, `hotel_order`.`foodpackage` AS `foodpackage`, `hotel_order`.`adult` AS `adult`, `hotel_order`.`children` AS `children`, `hotel_order`.`rooms` AS `rooms`, `hotel_order`.`days` AS `days`, `hotel_order`.`userrate` AS `userrate`, `hotel_order`.`price` AS `total`, `hotel_order`.`hotelrate` AS `hotelrate`, `hotel_order`.`amount` AS `amount`, `hotel_order`.`profit` AS `profit`,`tab1`.`name` AS `username`,`tab1`.`vouchernumber` AS `vouchernumber`,`tab2`.`name` AS `adminname`,`hotel_hotel`.`name` AS `hotelname`,`tab1`.`mobile` AS `mobile`
FROM `hotel_order` 
LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` 
LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` 
LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status` 
WHERE `hotel_order`.`id`='$id'")->row();
        return $query;

	}
    
}
?>
