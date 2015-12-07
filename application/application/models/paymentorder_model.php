<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class paymentorder_model extends CI_Model
{
    public function create($name,$billingaddress,$billingcity,$billingstate,$billingzipcode,$billingcontact,$email,$transactionid,$orderstatus,$user,$billingcountry,$amount)
    {
        $data=array(
            "name" => $name,
            "billingaddress" => $billingaddress,
            "billingcity" => $billingcity,
            "billingstate" => $billingstate,
            "billingzipcode" => $billingzipcode,
            "billingcontact" => $billingcontact,
            "email" => $email,
            "transactionid" => $transactionid,
            "orderstatus" => $orderstatus,
            "user" => $user,
            "billingcountry" => $billingcountry,
            "amount" => $amount,
            "timestamp" => $timestamp
        );
        $query=$this->db->insert( "paymentorder", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("paymentorder")->row();
        return $query;
    }
    function getsinglehotel($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("paymentorder")->row();
        return $query;
    }
    public function edit($id,$name,$billingaddress,$billingcity,$billingstate,$billingzipcode,$billingcontact,$email,$transactionid,$orderstatus,$user,$billingcountry,$amount,$timestamp)
    {
        $data=array(
           "name" => $name,
            "billingaddress" => $billingaddress,
            "billingcity" => $billingcity,
            "billingstate" => $billingstate,
            "billingzipcode" => $billingzipcode,
            "billingcontact" => $billingcontact,
            "email" => $email,
            "transactionid" => $transactionid,
            "orderstatus" => $orderstatus,
            "user" => $user,
             "billingcountry" => $billingcountry,
            "amount" => $amount,
            "timestamp" => $timestamp
        );
        $this->db->where( "id",$id );
        $query=$this->db->update( "paymentorder", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `paymentorder` WHERE `id`='$id'");
        return $query;
    }
        public function getpaymentorderstatusdropdown()
	{
		
		$return=array(
            "1" =>"Success",
            "2" =>"Fail"
		);
		
		return $return;
	}
    public function checkstatus($orderid){
      $query=$this->db->query("SELECT * FROM `paymentorder` WHERE `id`='$orderid'")->row;
        $orderstatus=$query->orderstatus;
        if($orderstatus==1){
        return 1;
        }
        else
        {
        return 0;
        }
    }
   
    
}
?>
