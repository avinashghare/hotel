<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class hotel_model extends CI_Model
{
    public function create($name,$initialbalance,$location,$user)
    {
        $data=array("name" => $name,"initialbalance" => $initialbalance,"location" => $location,"user" => $user);
        $query=$this->db->insert( "hotel_hotel", $data );
        $id=$this->db->insert_id();
        if(!$query)
        return  0;
        else
        return  $id;
    }
    public function beforeedit($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("hotel_hotel")->row();
        return $query;
    }
    function getsinglehotel($id)
    {
        $this->db->where("id",$id);
        $query=$this->db->get("hotel_hotel")->row();
        return $query;
    }
    public function edit($id,$name,$initialbalance,$location,$user)
    {
        $data=array("name" => $name,"initialbalance" => $initialbalance,"location" => $location,"user" => $user);
        $this->db->where( "id", $id );
        $query=$this->db->update( "hotel_hotel", $data );
        return 1;
    }
    public function delete($id)
    {
        $query=$this->db->query("DELETE FROM `hotel_hotel` WHERE `id`='$id'");
        return $query;
    }
    
    public function gethoteldropdown()
	{
		$query=$this->db->query("SELECT * FROM `hotel_hotel`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
}
?>
