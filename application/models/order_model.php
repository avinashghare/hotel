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
		$query=$this->db->query("SELECT `user`.`vouchernumber` AS `Voucher Number`, DATE(`hotel_order`.`timestamp`) AS `Booking`,`user`.`name` as `Customer Name`, `hotel_order`.`checkin` AS `Check-In`, `hotel_order`.`checkout` AS `Check-Out`, `hotel_order`.`adult` AS `Adult`, `hotel_order`.`children` AS `Children`, `hotel_order`.`rooms` AS `Number Of Rooms`, `hotel_order`.`days` AS `Number Of Days`, `hotel_order`.`userrate` AS `Per Person`, `hotel_order`.`price` AS `Total`, `hotel_order`.`hotelrate` AS `Hotel`, `hotel_order`.`amount` AS `Amt.`, `hotel_order`.`profit` AS `Profit`
FROM `hotel_order` 
LEFT OUTER JOIN `user` ON `hotel_order`.`user`=`user`.`id`");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
}
?>
