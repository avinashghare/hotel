<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class log_model extends CI_Model
{
public function create($admin,$user,$text)
{
$data=array("admin" => $admin,"user" => $user,"text" => $text);
$query=$this->db->insert( "hotel_log", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("hotel_log")->row();
return $query;
}
function getsinglelog($id){
$this->db->where("id",$id);
$query=$this->db->get("hotel_log")->row();
return $query;
}
public function edit($id,$admin,$user,$text)
{
$data=array("admin" => $admin,"user" => $user,"text" => $text);
$this->db->where( "id", $id );
$query=$this->db->update( "hotel_log", $data );
return 1;
}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `hotel_log` WHERE `id`='$id'");
return $query;
}
}
?>
