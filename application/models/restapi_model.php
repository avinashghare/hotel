<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
    public function createprofile($name,$email,$username,$gender,$address,$contact,$dob,$profession)
    {
        $data=array(
            "name"=> $name,
            "email"=> $email,
            "username"=> $username,
            "gender"=> $gender,
            "address"=> $address,
            "contact"=> $contact,
            "dob"=> $dob,
            "profession"=> $profession
        );
        $query=$this->db->insert( "user", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  1;
    }
    public function createpaymentorder($user,$name,$email,$amount,$billingaddress,$billingcity,$billingstate,$billingzipcode,$billingcontact,$billingcountry){
      $data=array(
            "user"=> $user,
            "name"=> $name,
            "email"=> $email,
            "amount"=> $amount,
            "billingaddress" => $billingaddress,
            "billingcity" => $billingcity,
            "billingstate" => $billingstate,
            "billingzipcode" => $billingzipcode,
            "billingcontact" => $billingcontact,
            "billingcountry" => $billingcountry
        );
        $query=$this->db->insert( "paymentorder", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    
    }
    public function updateorderstatusafterpayment($orderid,$transactionid){
          $query=$this->db->query("UPDATE `paymentorder` SET `orderstatus`=1,`transactionid`='$transactionid' WHERE `id`='$orderid'");
        return 1;
    
    }
}
?>