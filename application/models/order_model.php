<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class order_model extends CI_Model
{
public function create($user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price)
{
$data=array("user" => $user,"admin" => $admin,"hotel" => $hotel,"days" => $days,"userrate" => $userrate,"hotelrate" => $hotelrate,"status" => $status,"price" => $price);
$query=$this->db->insert( "hotel_order", $data );
$id=$this->db->insert_id();
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
function getsingleorder($id){
$this->db->where("id",$id);
$query=$this->db->get("hotel_order")->row();
return $query;
}
public function edit($id,$user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price)
{
$data=array("user" => $user,"admin" => $admin,"hotel" => $hotel,"days" => $days,"userrate" => $userrate,"hotelrate" => $hotelrate,"status" => $status,"price" => $price);
$this->db->where( "id", $id );
$query=$this->db->update( "hotel_order", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `hotel_order` WHERE `id`='$id'");
return $query;
}
}
?>
