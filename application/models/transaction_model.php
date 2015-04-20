<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class transaction_model extends CI_Model
{
public function create($user,$hotel,$amount,$status)
{
$data=array("user" => $user,"hotel" => $hotel,"amount" => $amount,"status" => $status);
$query=$this->db->insert( "hotel_transaction", $data );
$id=$this->db->insert_id();
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
function getsingletransaction($id){
$this->db->where("id",$id);
$query=$this->db->get("hotel_transaction")->row();
return $query;
}
public function edit($id,$user,$hotel,$amount,$status)
{
$data=array("user" => $user,"hotel" => $hotel,"amount" => $amount,"status" => $status);
$this->db->where( "id", $id );
$query=$this->db->update( "hotel_transaction", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `hotel_transaction` WHERE `id`='$id'");
return $query;
}
}
?>
