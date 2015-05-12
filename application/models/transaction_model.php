<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class transaction_model extends CI_Model
{
    public function create($user,$hotel,$amount,$status,$paymentmethod,$bankname,$branchname,$chequeno,$chequedate)
    {
        $data=array(
                    "user" => $user,
                    "hotel" => $hotel,
                    "amount" => $amount,
                    "paymentmethod" => $paymentmethod,
                    "bankname" => $bankname,
                    "branchname" => $branchname,
                    "chequeno" => $chequeno,
                    "chequedate" => $chequedate,
                    "status" => $status
                    );
        $query=$this->db->insert( "hotel_transaction", $data );
        $id=$this->db->insert_id();
        
        $hoteldetails=$this->hotel_model->beforeedit($hotel);
        $initialbalance=$hoteldetails->initialbalance;
        
        $remainingamount=$initialbalance-$amount;
        
        $updatehotelquery=$this->db->query("UPDATE `hotel_hotel` SET `initialbalance`='$remainingamount' WHERE `id`='$hotel'");
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("hotel_transaction")->row();
        return $query;
    }
    function getsingletransaction($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("hotel_transaction")->row();
        return $query;
    }
    public function edit($id,$user,$hotel,$amount,$status,$paymentmethod,$bankname,$branchname,$chequeno,$chequedate)
    {
        
        $hoteldetails=$this->hotel_model->beforeedit($hotel);
        $initialbalance=$hoteldetails->initialbalance;
        
        $transactiondetails=$this->transaction_model->beforeedit($id);
        $previousvalue=$transactiondetails->amount;
        
        $previousaddedvalue=$initialbalance+$previousvalue;
        
        $finalamount=$previousaddedvalue-$amount;
        
        
        $updatehotelquery=$this->db->query("UPDATE `hotel_hotel` SET `initialbalance`='$finalamount' WHERE `id`='$hotel'");
        
        $data=array(
                    "user" => $user,
                    "hotel" => $hotel,
                    "amount" => $amount,
                    "paymentmethod" => $paymentmethod,
                    "bankname" => $bankname,
                    "branchname" => $branchname,
                    "chequeno" => $chequeno,
                    "chequedate" => $chequedate,
                    "status" => $status
                    );
        $this->db->where( "id", $id );
        $query=$this->db->update( "hotel_transaction", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `hotel_transaction` WHERE `id`='$id'");
        return $query;
    }
    
	public function gettypedropdown()
	{
		$type= array(
			 "Cash" => "Cash",
			 "Cheque" => "Cheque",
			);
		return $type;
	}
    
    
    function exporttransactionbyadmin()
	{
        $hotelid=$this->session->userdata('hotel');
		$query=$this->db->query("SELECT `hotel_transaction`.`id`, `user`.`name` AS `Paid To`,`hotel_hotel`.`name` AS `Hotel`, `hotel_transaction`.`amount`, `hotel_transaction`.`paymentmethod`, `hotel_transaction`.`bankname`,`hotel_transaction`. `branchname`,`hotel_transaction`. `chequeno`,`hotel_transaction`. `chequedate` 
        FROM `hotel_transaction`
        LEFT OUTER JOIN `user` ON `user`.`id`=`hotel_transaction`.`user`
        LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_transaction`.`hotel`
        ");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    function exporttransactionbyhotel()
	{
        $hotelid=$this->session->userdata('hotel');
		$query=$this->db->query("SELECT `hotel_transaction`.`id`, `user`.`name` AS `Paid To`,`hotel_hotel`.`name` AS `Hotel`, `hotel_transaction`.`amount`, `hotel_transaction`.`paymentmethod`, `hotel_transaction`.`bankname`,`hotel_transaction`. `branchname`,`hotel_transaction`. `chequeno`,`hotel_transaction`. `chequedate` 
        FROM `hotel_transaction`
        LEFT OUTER JOIN `user` ON `user`.`id`=`hotel_transaction`.`user`
        LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_transaction`.`hotel`
WHERE `hotel_transaction`.`hotel`='$hotelid'");
//        $query=$this->db->query($query)->result();
        return $query;
	}
}
?>
