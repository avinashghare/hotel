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
//        , `hotel_transaction`.`amount`, `hotel_transaction`.`paymentmethod`, `hotel_transaction`.`bankname`,`hotel_transaction`. `branchname`,`hotel_transaction`. `chequeno`,`hotel_transaction`. `chequedate` 
        
//        ,CONCAT(`hotel_transaction`.`paymentmethod`,' ',`hotel_transaction`.`bankname`,' ',`hotel_transaction`.`branchname`,' ',`hotel_transaction`.`chequeno`,' ',when `hotel_transaction`.`chequedate` == '0000-00-00' then '') as `Chq/Cash`
        $hotelid=$this->session->userdata('hotel');
		$query=$this->db->query("SELECT `hotel_transaction`.`id`, `user`.`name` AS `paidto`,`hotel_hotel`.`name` AS `hotel`, `hotel_transaction`.`amount`, `hotel_transaction`.`paymentmethod`, `hotel_transaction`.`bankname`,`hotel_transaction`. `branchname`,`hotel_transaction`. `chequeno`,`hotel_transaction`. `chequedate`
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
		$query=$this->db->query("SELECT `hotel_transaction`.`id`, `user`.`name` AS `paidto`,`hotel_hotel`.`name` AS `hotel`, `hotel_transaction`.`amount`, `hotel_transaction`.`paymentmethod`, `hotel_transaction`.`bankname`,`hotel_transaction`. `branchname`,`hotel_transaction`. `chequeno`,`hotel_transaction`. `chequedate`
        FROM `hotel_transaction`
        LEFT OUTER JOIN `user` ON `user`.`id`=`hotel_transaction`.`user`
        LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_transaction`.`hotel`
WHERE `hotel_transaction`.`hotel`='$hotelid'");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
    
	public function updateorderstatusafterpayment($orderid,$transactionid)
    {
        $query=$this->db->query("UPDATE `hotel_transaction` SET `status`=2 , `transactionid`='$transactionid' WHERE `id`='$orderid'");
        return $query;
	}
    
	public function checkorderstatus($orderid)
    {
        $query=$this->db->query("SELECT `status` FROM `hotel_transaction` WHERE `id`='$orderid'")->row();
        $status=$query->requeststatus;
        if($status==2)
        {
            return 1;
        }
        else
        {
            return 0;
        }
//        return $query;
	}
    
	public function gettransactionimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `hotel_transaction` WHERE `id`='$id'")->row();
		return $query;
	}
    
    function exporttransactionreportbyadmin($hotel,$startdate,$enddate)
	{
        
		$this->load->dbutil();
        $where="WHERE `hotel_transaction`.`timestamp` BETWEEN '$startdate' AND '$enddate' ";
        if($hotel!="" || $hotel!=0)
        {
            $where.=" AND `hotel_transaction`.`hotel`='$hotel'";
        }
		$query=$this->db->query("SELECT `hotel_transaction`.`id`,`user`.`name` AS `username`,`hotel_hotel`.`name` AS `hotelname`,`hotel_transaction`. `amount`,`hotel_transaction`. `status`,`hotel_transaction`. `paymentmethod`,`hotel_transaction`. `bankname`,`hotel_transaction`. `branchname`,`hotel_transaction`. `chequeno`,`hotel_transaction`. `chequedate`,`hotel_transaction`. `timestamp`,`hotel_transaction`. `transactionid`,`hotel_transaction`. `image` 
FROM `hotel_transaction` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_transaction`.`hotel`
LEFT OUTER JOIN `user`ON `hotel_transaction`.`user`=`user`.`id` $where");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
    function exporttransactionreportbyadmintotal($hotel,$startdate,$enddate)
	{
        
		$this->load->dbutil();
        $where="WHERE `hotel_transaction`.`timestamp` BETWEEN '$startdate' AND '$enddate' ";
        if($hotel!="" || $hotel!=0)
        {
            $where.=" AND `hotel_transaction`.`hotel`='$hotel'";
        }
		$query=$this->db->query("SELECT SUM(`hotel_transaction`. `amount`) AS `amount`,`hotel_hotel`.`name` AS `hotelname` 
FROM `hotel_transaction` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_transaction`.`hotel`
LEFT OUTER JOIN `user`ON `hotel_transaction`.`user`=`user`.`id` $where");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
    function exporttransactionreportbyhotel($hotel,$startdate,$enddate)
	{
        
		$this->load->dbutil();
        $where="WHERE `hotel_transaction`.`timestamp` BETWEEN '$startdate' AND '$enddate' ";
        if($hotel!="" || $hotel!=0)
        {
            $where.=" AND `hotel_transaction`.`hotel`='$hotel'";
        }
		$query=$this->db->query("SELECT `hotel_transaction`.`id`,`user`.`name` AS `username`,`hotel_hotel`.`name` AS `hotelname`,`hotel_transaction`. `amount`,`hotel_transaction`. `status`,`hotel_transaction`. `paymentmethod`,`hotel_transaction`. `bankname`,`hotel_transaction`. `branchname`,`hotel_transaction`. `chequeno`,`hotel_transaction`. `chequedate`,`hotel_transaction`. `timestamp`,`hotel_transaction`. `transactionid`,`hotel_transaction`. `image` 
FROM `hotel_transaction` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_transaction`.`hotel`
LEFT OUTER JOIN `user`ON `hotel_transaction`.`user`=`user`.`id` $where");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
    function exporttransactionreportbyhoteltotal($hotel,$startdate,$enddate)
	{
        
		$this->load->dbutil();
        $where="WHERE `hotel_transaction`.`timestamp` BETWEEN '$startdate' AND '$enddate' ";
        if($hotel!="" || $hotel!=0)
        {
            $where.=" AND `hotel_transaction`.`hotel`='$hotel'";
        }
		$query=$this->db->query("SELECT SUM(`hotel_transaction`. `amount`) AS `amount`,`hotel_hotel`.`name` AS `hotelname` 
FROM `hotel_transaction` 
LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_transaction`.`hotel`
LEFT OUTER JOIN `user`ON `hotel_transaction`.`user`=`user`.`id` $where");
//        $query=$this->db->query($query)->result();
        return $query;
	}
    
}
?>
