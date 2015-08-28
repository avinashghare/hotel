<?php
if ( !defined( 'BASEPATH' ) )
	exit( 'No direct script access allowed' );
class User_model extends CI_Model
{
	protected $id,$username ,$password;
	public function validate($username,$password )
	{
		
		$password=md5($password);
		$query ="SELECT `user`.`id`,`user`.`name` as `name`,`email`,`user`.`accesslevel`,`accesslevel`.`name`as `access`,`user`.`hotel`  FROM `user`
		INNER JOIN `accesslevel` ON `user`.`accesslevel` = `accesslevel`.`id` 
		WHERE `email` LIKE '$username' AND `password` LIKE '$password' AND `status`=1 AND `accesslevel` IN (1,2,3,4) ";
		$row =$this->db->query( $query );
		if ( $row->num_rows() > 0 ) {
			$row=$row->row();
			$this->id       = $row->id;
			$this->name = $row->name;
			$this->email = $row->email;
			$this->hotel = $row->hotel;
			$newdata        = array(
				'id' => $this->id,
				'email' => $this->email,
				'name' => $this->name ,
				'hotel' => $this->hotel ,
				'accesslevel' => $row->accesslevel ,
				'logged_in' => 'true'
			);
			$this->session->set_userdata( $newdata );
			return true;
		} //count( $row_array ) == 1
		else
			return false;
	}
	
	
	public function create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager,$hotel,$trainee)
	{
        echo "executive is ".$executive;
        if($accesslevel==7)
        {
            $getaccesslevelofselecteduser=$this->db->query("SELECT * FROM `user` WHERE `id`='$executive'")->row();
            $selecteduseraccesslevel=$getaccesslevelofselecteduser->accesslevel;
            echo $selecteduseraccesslevel;
//            $manager=$getaccesslevelofselecteduser->manager;
//            $trainee=$getaccesslevelofselecteduser->trainee;
//            $executive=$getaccesslevelofselecteduser->executive;
//            echo "executive2 is ".$executive." manager is ".$manager." trainee is".$trainee;
            if($selecteduseraccesslevel==4)
            {
//                $manager=$getaccesslevelofselecteduser->manager;
                $manager=$executive;
                $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$executive'")->row();
                $points=$getmanagerpoints->points;
                $points=$points+1;
                $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$executive'");
                $executive=0;
                $trainee=0;
            }
            else if($selecteduseraccesslevel==5)
            {
                $trainee=$executive;
//                $managerdetails=$this->db->query("SELECT * FROM `user` WHERE `id`='$trainee'")->row();
//                $manager=$managerdetails->manager;
                $gettraineepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$trainee'")->row();
                $manager=$gettraineepoints->manager;
                $points=$gettraineepoints->points;
                $points=$points+1;
                $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$trainee'");

                $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$manager'")->row();
                $points=$getmanagerpoints->points;
                $points=$points+1;
                $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$manager'");
                $executive=0;
            }
            else if($selecteduseraccesslevel==6)
            {
                $getexecutivepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$executive'")->row();
                $manager=$getexecutivepoints->manager;
                $trainee=$getexecutivepoints->trainee;
                $points=$getexecutivepoints->points;
                $points=$points+1;
                $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$executive'");

                $gettraineepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$trainee'")->row();
                $points=$gettraineepoints->points;
                $points=$points+1;
                $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$trainee'");

                $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$manager'")->row();
                $points=$getmanagerpoints->points;
                $points=$points+1;
                $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$manager'");
            }
            
//            $getexecutivepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$executive'")->row();
//            $points=$getexecutivepoints->points;
//            $points=$points+1;
//            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$executive'");
//            
//            $gettraineepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$trainee'")->row();
//            $points=$gettraineepoints->points;
//            $points=$points+1;
//            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$trainee'");
//            
//            $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$manager'")->row();
//            $points=$getmanagerpoints->points;
//            $points=$points+1;
//            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$manager'");
        }
		$data  = array(
			'name' => $name,
			'email' => $email,
			'password' =>md5($password),
			'accesslevel' => $accesslevel,
			'status' => $status,
            'socialid'=> $socialid,
            'image'=> $image,
            'json'=> $json,
            'age'=> $age,
            'gender'=> $gender,
            'address'=> $address,
            'contact'=> $contact,
            'mobile'=> $mobile,
            'dob'=> $dob,
            'profession'=> $profession,
            'vouchernumber'=> $vouchernumber,
            'validtill'=> $validtill,
            'executive'=> $executive,
            'manager'=> $manager,
            'hotel'=> $hotel,
            'trainee'=> $trainee,
			'logintype' => $logintype
		);
		$query=$this->db->insert( 'user', $data );
		$id=$this->db->insert_id(); 
        
		if(!$query)
			return  0;
		else
			return  1;
	}
    
	function viewusers($startfrom,$totallength)
	{
		$user = $this->session->userdata('accesslevel');
		$query="SELECT DISTINCT `user`.`id` as `id`,`user`.`firstname` as `firstname`,`user`.`lastname` as `lastname`,`accesslevel`.`name` as `accesslevel`	,`user`.`email` as `email`,`user`.`contact` as `contact`,`user`.`status` as `status`,`user`.`accesslevel` as `access`
		FROM `user`
	   INNER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id`  ";
	   $accesslevel=$this->session->userdata('accesslevel');
	   if($accesslevel==1)
		{
			$query .= " ";
		}
		else if($accesslevel==2)
		{
			$query .= " WHERE `user`.`accesslevel`> '$accesslevel' ";
		}
		
	   $query.=" ORDER BY `user`.`id` ASC LIMIT $startfrom,$totallength";
		$query=$this->db->query($query)->result();
        
        $return=new stdClass();
        $return->query=$query;
        $return->totalcount=$this->db->query("SELECT count(*) as `totalcount` FROM `user`
	   INNER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id`  ")->row();
        $return->totalcount=$return->totalcount->totalcount;
		return $return;
	}
	public function beforeedit( $id )
	{
		$this->db->where( 'id', $id );
		$query=$this->db->get( 'user' )->row();
		return $query;
	}
	
	public function edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager,$hotel,$trainee)
	{
        
        if($accesslevel==7)
        {
            $beforevalues=$this->db->query("SELECT * FROM `user` WHERE `id`='$id'")->row();
            $beforemanagerid=$beforevalues->manager;
            $beforeexecutiveid=$beforevalues->executive;
            $beforetraineeid=$beforevalues->trainee;

            $getexecutivepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$beforeexecutiveid'")->row();
            $points=$getexecutivepoints->points;
            $points=$points-1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$beforeexecutiveid'");

            $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$beforemanagerid'")->row();
            $points=$getmanagerpoints->points;
            $points=$points-1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$beforemanagerid'");

            $gettraineepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$beforetraineeid'")->row();
            $points=$gettraineepoints->points;
            $points=$points-1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$beforetraineeid'");
        
        }
        
		$data  = array(
			'name' => $name,
			'email' => $email,
			'accesslevel' => $accesslevel,
			'status' => $status,
            'socialid'=> $socialid,
            'image'=> $image,
            'json'=> $json,
            'age'=> $age,
            'gender'=> $gender,
            'address'=> $address,
            'contact'=> $contact,
            'mobile'=> $mobile,
            'dob'=> $dob,
            'profession'=> $profession,
            'vouchernumber'=> $vouchernumber,
            'validtill'=> $validtill,
            'executive'=> $executive,
            'manager'=> $manager,
            'hotel'=> $hotel,
            'trainee'=> $trainee,
			'logintype' => $logintype
		);
		if($password != "")
			$data['password'] =md5($password);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
        if($accesslevel==7)
        {
            $getexecutivepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$executive'")->row();
            $points=$getexecutivepoints->points;
            $points=$points+1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$executive'");
            
            $gettraineepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$trainee'")->row();
            $points=$gettraineepoints->points;
            $points=$points+1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$trainee'");
            
            $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$manager'")->row();
            $points=$getmanagerpoints->points;
            $points=$points+1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$manager'");
        }
        
		return 1;
	}
    public function edituserbyhotel($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager,$hotel)
	{
        
        if($accesslevel==7)
        {
            $beforevalues=$this->db->query("SELECT * FROM `user` WHERE `id`='$id'")->row();
            $beforemanagerid=$beforevalues->manager;
            $beforeexecutiveid=$beforevalues->executive;
            $beforetraineeid=$beforevalues->trainee;

            $getexecutivepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$beforeexecutiveid'")->row();
            $points=$getexecutivepoints->points;
            $points=$points-1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$beforeexecutiveid'");

            $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$beforemanagerid'")->row();
            $points=$getmanagerpoints->points;
            $points=$points-1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$beforemanagerid'");

            $gettraineepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$beforetraineeid'")->row();
            $points=$gettraineepoints->points;
            $points=$points-1;
            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$beforetraineeid'");
        
        }
        
		$data  = array(
			'name' => $name,
			'email' => $email,
            'socialid'=> $socialid,
            'image'=> $image,
            'json'=> $json,
            'age'=> $age,
            'gender'=> $gender,
            'address'=> $address,
            'contact'=> $contact,
            'mobile'=> $mobile,
            'dob'=> $dob,
            'profession'=> $profession,
            'vouchernumber'=> $vouchernumber,
            'validtill'=> $validtill,
			'logintype' => $logintype
		);
		if($password != "")
			$data['password'] =md5($password);
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
//        if($accesslevel==7)
//        {
//            $getexecutivepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$executive'")->row();
//            $points=$getexecutivepoints->points;
//            $points=$points+1;
//            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$executive'");
//            
//            $gettraineepoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$trainee'")->row();
//            $points=$gettraineepoints->points;
//            $points=$points+1;
//            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$trainee'");
//            
//            $getmanagerpoints=$this->db->query("SELECT * FROM `user` WHERE `id`='$manager'")->row();
//            $points=$getmanagerpoints->points;
//            $points=$points+1;
//            $this->db->query("UPDATE `user` SET `points`='$points' WHERE `id`='$manager'");
//        }
        
		return 1;
	}
    
	public function getuserimagebyid($id)
	{
		$query=$this->db->query("SELECT `image` FROM `user` WHERE `id`='$id'")->row();
		return $query;
	}
	public function getmanagerbyexecutive($user)
	{
		$query=$this->db->query("SELECT * FROM `user` WHERE `id`='$user'")->row();
		return $query;
	}
	function deleteuser($id)
	{
		$query=$this->db->query("DELETE FROM `user` WHERE `id`='$id'");
	}
	function changepassword($id,$password)
	{
		$data  = array(
			'password' =>md5($password),
		);
		$this->db->where('id',$id);
		$query=$this->db->update( 'user', $data );
		if(!$query)
			return  0;
		else
			return  1;
	}
    
    public function getuserdropdown()
	{
		$query=$this->db->query("SELECT * FROM `user`  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name."(".$row->email.")";
		}
		
		return $return;
	}
    
    public function getexecutivedropdown()
	{
		$query=$this->db->query("SELECT * FROM `user` WHERE `accesslevel`=6  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
    public function getmanagerdropdown()
	{
		$query=$this->db->query("SELECT * FROM `user` WHERE `accesslevel`=4  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
    public function gettraineedropdown()
	{
		$query=$this->db->query("SELECT * FROM `user` WHERE `accesslevel`=5  ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
    public function getadmindropdown()
	{
		$query=$this->db->query("SELECT * FROM `user`  WHERE `accesslevel`=1 ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
	public function getaccesslevels()
	{
		$return=array();
		$query=$this->db->query("SELECT * FROM `accesslevel` ORDER BY `id` ASC")->result();
		$accesslevel=$this->session->userdata('accesslevel');
			foreach($query as $row)
			{
				if($accesslevel==1)
				{
					$return[$row->id]=$row->name;
				}
				else if($accesslevel==2)
				{
					if($row->id > $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
				else if($accesslevel==3)
				{
					if($row->id > $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
				else if($accesslevel==4)
				{
					if($row->id == $accesslevel)
					{
						$return[$row->id]=$row->name;
					}
				}
			}
	
		return $return;
	}
    public function getstatusdropdown()
	{
		$query=$this->db->query("SELECT * FROM `statuses`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
	function changestatus($id)
	{
		$query=$this->db->query("SELECT `status` FROM `user` WHERE `id`='$id'")->row();
		$status=$query->status;
		if($status==1)
		{
			$status=0;
		}
		else if($status==0)
		{
			$status=1;
		}
		$data  = array(
			'status' =>$status,
		);
		$this->db->where('id',$id);
		$query=$this->db->update( 'user', $data );
		if(!$query)
			return  0;
		else
			return  1;
	}
	function editaddress($id,$address,$city,$pincode)
	{
		$data  = array(
			'address' => $address,
			'city' => $city,
			'pincode' => $pincode,
		);
		
		$this->db->where( 'id', $id );
		$query=$this->db->update( 'user', $data );
		if($query)
		{
			$this->saveuserlog($id,'User Address Edited');
		}
		return 1;
	}
	
	function saveuserlog($id,$status)
	{
//		$fromuser = $this->session->userdata('id');
		$data2  = array(
			'onuser' => $id,
			'status' => $status
		);
		$query2=$this->db->insert( 'userlog', $data2 );
        $query=$this->db->query("UPDATE `user` SET `status`='$status' WHERE `id`='$user'");
	}
    function signup($email,$password) 
    {
         $password=md5($password);   
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `email`='$email' ");
        if($query->num_rows == 0)
        {
            $this->db->query("INSERT INTO `user` (`id`, `firstname`, `lastname`, `password`, `email`, `website`, `description`, `eventinfo`, `contact`, `address`, `city`, `pincode`, `dob`, `accesslevel`, `timestamp`, `facebookuserid`, `newsletterstatus`, `status`,`logo`,`showwebsite`,`eventsheld`,`topeventlocation`) VALUES (NULL, NULL, NULL, '$password', '$email', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, CURRENT_TIMESTAMP, NULL, NULL, NULL,NULL, NULL, NULL,NULL);");
            $user=$this->db->insert_id();
            $newdata = array(
                'email'     => $email,
                'password' => $password,
                'logged_in' => true,
                'id'=> $user
            );

            $this->session->set_userdata($newdata);
            
          //  $queryorganizer=$this->db->query("INSERT INTO `organizer`(`name`, `description`, `email`, `info`, `website`, `contact`, `user`) VALUES(NULL,NULL,NULL,NULL,NULL,NULL,'$user')");
            
            
           return $user;
        }
        else
         return false;
        
        
    }
    function login($voucherno,$password) 
    {
        $password=md5($password);
        $query=$this->db->query("SELECT `id` FROM `user` WHERE `vouchernumber`='$voucherno' AND `password`= '$password'");
        if($query->num_rows > 0)
        {
            $user=$query->row();
            $user=$user->id;
            

            $newdata = array(
                'vouchernumber' => $voucherno,
                'password' => $password,
                'logged_in' => true,
                'id'=> $user
            );

            $this->session->set_userdata($newdata);
            $sessiondata=$this->session->all_userdata();
            //print_r($newdata);
            return true;
        }
        else
        return false;


    }
    function authenticate() {
         $is_logged_in = $this->session->userdata( 'logged_in' );
//        return $is_logged_in;
        //print_r($this->session->userdata( 'logged_in' ));
        if ( $is_logged_in != true) {
            return false;
        } //$is_logged_in !== 'true' || !isset( $is_logged_in )
        else {
		$userid=$this->session->userdata('id');
		$query=$this->db->query("SELECT * FROM `user` WHERE `id`='$userid'")->row();
           // $userid = $this->session->userdata( );
         return $query;
        }
    }
    
    function frontendauthenticate($email,$password) 
    {
        $query=$this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json` FROM `user` WHERE `email` LIKE '$email' AND `password`='$password' LIMIT 0,1");
        if ($query->num_rows() > 0)
        {
        	$query=$query->row();
            $data['user']=$query;
            $id=$query->id;
            $status=$query->status;
            if($status==3)
            {
//                $updatequery=$this->db->query("UPDATE `user` SET `status`=4 WHERE `id`='$id'");
                $status=4;
//                if($updatequery)
//                {
                    $this->saveuserlog($id,$status);
//                }
            }
            else if($status==1)
            {
                $status=2;
//                $updatequery=$this->db->query("UPDATE `user` SET `status`=2 WHERE `id`='$id'");
//                if($updatequery)
//                {
                    $this->saveuserlog($id,$status);
//                }
            }
            
        $query2=$this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json` FROM `user` WHERE `id`='$id' LIMIT 0,1")->row();
            
        $newdata        = array(
				'id' => $query2->id,
				'email' => $query2->email,
				'name' => $query2->name ,
				'accesslevel' => $query2->accesslevel ,
				'status' => $query2->status ,
				'logged_in' => 'true',
			);
			$this->session->set_userdata( $newdata );
            
            
            $accesslevel=$query->accesslevel;
            if($accesslevel==2)
            {
            $data['category']=$this->db->query("SELECT `id`,`categoryid`,`operatorid` FROM `operatorcategory` WHERE `operatorid`='$id'")->result();
            }
        	return $data;
        }
        else 
        {
        	return false;
        }
    }
    
    function frontendregister($name,$email,$password,$socialid,$logintype,$json) 
    {
        $data  = array(
			'name' => $name,
			'email' => $email,
			'password' =>md5($password),
			'accesslevel' => 3,
			'status' => 2,
            'socialid'=> $socialid,
            'json'=> $json,
			'logintype' => $logintype
		);
		$query=$this->db->insert( 'user', $data );
		$id=$this->db->insert_id();
        $queryselect=$this->db->query("SELECT * FROM `user` WHERE `id` LIKE '$id' LIMIT 0,1")->row();
        
        $accesslevel=$queryselect->accesslevel;
//        $queryselect=$query;
        $data1['user']=$queryselect;
        if($accesslevel==2)
        {
            $data1['category']=$this->db->query("SELECT `id`,`categoryid`,`operatorid` FROM `operatorcategory` WHERE `operatorid`='$id'")->result();
        }
        return $data1;
    }
    
	function getallinfoofuser($id)
	{
		$user = $this->session->userdata('accesslevel');
		$query="SELECT DISTINCT `user`.`id` as `id`,`user`.`firstname` as `firstname`,`user`.`lastname` as `lastname`,`accesslevel`.`name` as `accesslevel`	,`user`.`email` as `email`,`user`.`contact` as `contact`,`user`.`status` as `status`,`user`.`accesslevel` as `access`
		FROM `user`
	   INNER JOIN `accesslevel` ON `user`.`accesslevel`=`accesslevel`.`id` 
       WHERE `user`.`id`='$id'";
		$query=$this->db->query($query)->row();
		return $query;
	}
    
	public function getlogintypedropdown()
	{
		$query=$this->db->query("SELECT * FROM `logintype`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
	public function frontendlogout($user)
	{
        $query=$this->db->query("SELECT `id`, `name`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json` FROM `user` WHERE `id`='$user' LIMIT 0,1")->row();
        $status=$query->status;
        if($status==4)
        {
            $status=3;
//            $updatequery=$this->db->query("UPDATE `user` SET `status`=3 WHERE `id`='$user'");
//            if($updatequery)
//            {
                $this->saveuserlog($id,$status);
//            }
        }
        else if($status==2)
        {
            $status=1;
//            $updatequery=$this->db->query("UPDATE `user` SET `status`=1 WHERE `id`='$user'");
//            if($updatequery)
//            {
                $this->saveuserlog($id,$status);
//            }
        }
//        $updatequery=$this->db->query("UPDATE `user` SET `status`=5 WHERE `id`='$user'");
        
//        if(!$updatequery)
//            return 0;
//        else
//        {
            
		$this->session->sess_destroy();
            return 1;
//        }
	}
	
    function sociallogin($user_profile,$provider)
    {
        $query=$this->db->query("SELECT * FROM `user` WHERE `user`.`socialid`='$user_profile->identifier'");
        if($query->num_rows == 0)
        {

					$googleid="";
					$facebookid="";
					$twitterid="";
					switch($provider)
					{
						case "Google":
						$googleid=$user_profile->identifier;
						break;
						case "Facebook":
						$facebookid=$user_profile->identifier;
						break;
						case "Twitter":
						$twitterid=$user_profile->identifier;
						break;
					}

            $query2=$this->db->query("INSERT INTO `user` (`id`, `name`, `password`, `email`, `accesslevel`, `timestamp`, `status`, `image`, `username`, `socialid`, `logintype`, `json`, `dob`, `street`, `address`, `city`, `state`, `country`, `pincode`, `facebook`, `google`, `twitter`) VALUES (NULL, '$user_profile->displayName', '', '$user_profile->email', '3', CURRENT_TIMESTAMP, '1', '$user_profile->photoURL', '', '$user_profile->identifier', '$provider', '', '$user_profile->birthYear-$user_profile->birthMonth-$user_profile->birthDay', '', '$user_profile->address,$user_profile->region', '$user_profile->city', '', '$user_profile->country', '', '$facebookid', '$googleid', '$twitterid')");
            $id=$this->db->insert_id();
            $newdata = array(
                'email'     => $user_profile->email,
                'password' => "",
                'logged_in' => true,
                'id'=> $id,
                'name'=> $user_profile->displayName,
                'image'=> $user_profile->photoURL,
                'logintype'=>$provider
            );

            $this->session->set_userdata($newdata);

            return $newdata;

        }
        else
        {
            $query=$query->row();
            $newdata = array(
                'email'     => $user_profile->email,
                'password' => "",
                'logged_in' => true,
                'id'=> $query->id,
                'name'=> $user_profile->displayName,
                'image'=> $user_profile->photoURL,
                'logintype'=>$provider
            );

            $this->session->set_userdata($newdata);

            return $newdata;
        }
    }
    
	public function getgenderdropdown()
	{
		$gender= array(
			 "1" => "Male",
			 "0" => "Female",
			);
		return $gender;
	}
    
    
    //for dashboard
     public function getdetailsorcreate($number)
	{
		$query="SELECT * FROM `user` WHERE  `vouchernumber` ='$number'";
		$enquirypresentornot=$this->db->query($query);
         if($enquirypresentornot->num_rows()==0)
         {
             $queryinsert=$this->db->query("INSERT INTO `enquiry`(`phone`) VALUES('$number')");
             $enquiryid=$this->db->insert_id();
             $queryselect="SELECT `enquirylistingcategory`.`id`, `enquirylistingcategory`.`enquiryid`, `enquirylistingcategory`.`typeofenquiry`, `enquirylistingcategory`.`listing`, `enquirylistingcategory`.`category`,`enquirylistingcategory`. `comment`, `enquirylistingcategory`.`timestamp` ,IFNULL(`category`.`name`,'NA') AS `categoryname`,IFNULL(`listing`.`name`,'NA') AS `listingname`
        FROM `enquirylistingcategory` 
        LEFT OUTER JOIN `listing` ON `enquirylistingcategory`.`listing`=`listing`.`id`
        INNER JOIN `enquiry` ON `enquirylistingcategory`.`enquiryid`=`enquiry`.`id`
        LEFT OUTER JOIN `category` ON `enquirylistingcategory`.`category`=`category`.`id`
        WHERE `enquiry`.`phone`='$number'";
		     $queryselect=$this->db->query($queryselect);
             $data['allenquiries']=$queryselect->result();
             $userdetailsquery=$this->db->query("SELECT `id`, `name`, `email`, `phone`, `timestamp`, `deletestatus` FROM `enquiry` WHERE `phone`='$number'");
             $data['userdetail']=$userdetailsquery->row();
             return $data;
         }
         else
         {
             $userpresentornot=$enquirypresentornot->row();
             $enquiryid=$userpresentornot->id;
             $queryselect="SELECT `enquirylistingcategory`.`id`, `enquirylistingcategory`.`enquiryid`, `enquirylistingcategory`.`typeofenquiry`, `enquirylistingcategory`.`listing`, `enquirylistingcategory`.`category`,`enquirylistingcategory`. `comment`, `enquirylistingcategory`.`timestamp` ,IFNULL(`category`.`name`,'NA') AS `categoryname`,IFNULL(`listing`.`name`,'NA') AS `listingname`
        FROM `enquirylistingcategory` 
        LEFT OUTER JOIN `listing` ON `enquirylistingcategory`.`listing`=`listing`.`id`
        INNER JOIN `enquiry` ON `enquirylistingcategory`.`enquiryid`=`enquiry`.`id`
        LEFT OUTER JOIN `category` ON `enquirylistingcategory`.`category`=`category`.`id`
        WHERE `enquiry`.`phone`='$number'";
		     $queryselect=$this->db->query($queryselect);
             $data['allenquiries']=$queryselect->result();
             $userdetailsquery=$this->db->query("SELECT `id`, `name`, `email`, `phone`, `timestamp`, `deletestatus` FROM `enquiry` WHERE `phone`='$number'");
             $data['userdetail']=$userdetailsquery->row();
             return $data;
         }
	}
    
    public function getdetailsofuser($vouchernumber)
    {
        $getidbyvoucher=$this->db->query("SELECT * FROM `user` WHERE `vouchernumber`='$vouchernumber'");
        if($getidbyvoucher->num_rows()==0)
        {
            return 0;
        }
        else
        {
            $getidbyvoucher=$getidbyvoucher->row();
            $userid=$getidbyvoucher->id;
        }
        $query['userid']=$userid;
        $query['userdetails']=$this->db->query("SELECT `user`.`id`, `name`,`user`. `email`,`user`. `accesslevel`,`user`. `timestamp`,`user`. `status`,`user`. `image`,`user`. `username`,`user`. `socialid`,`user`. `logintype`,`user`. `json`,`user`. `age`,`user`. `gender`,`user`. `address`,`user`. `contact`,`user`. `mobile`,`user`. `dob`,`user`. `profession`,`user`. `vouchernumber`,`user`. `validtill`,`user`. `executive`,`user`. `manager`,`user`. `hotel`,`user`. `trainee`,`user`. `points` 
FROM `user` WHERE `id`='$userid'")->row();
        $query['hotels']=$this->db->query("SELECT `hotel_hotel`.`id`, `hotel_hotel`.`name`, `hotel_hotel`.`initialbalance`, `hotel_hotel`.`location` ,`hotel_order`.`id` AS `orderid`, `hotel_order`.`user`, `hotel_order`.`admin`, `hotel_order`.`hotel`, `hotel_order`.`days`, `hotel_order`.`userrate`, `hotel_order`.`hotelrate`, `hotel_order`.`status`, `hotel_order`.`price`, `hotel_order`.`timestamp` FROM `hotel_order` RIGHT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` AND `hotel_order`.`user`='$userid'")->result();
        return $query;
    }
    public function getuseridfromvouchernumber($vouchernumber)
    {
        $getidbyvoucher=$this->db->query("SELECT * FROM `user` WHERE `vouchernumber`='$vouchernumber'");
        if($getidbyvoucher->num_rows()==0)
        {
            return 0;
        }
        else
        {
            $getidbyvoucher=$getidbyvoucher->row();
            $userid=$getidbyvoucher->id;
            return $userid;
        }
    }
    
    public function getexecutivedropdownbymanager($manager) {
        $query = "SELECT * FROM `user` WHERE `manager`='$manager' AND `accesslevel`=5 ORDER BY `id` ASC";
        $user = $this->db->query($query)->result();
        return $user;
    }
    
    public function getexecutivedropdownbymanagerid($manager)
	{
		$query=$this->db->query("SELECT * FROM `user` WHERE `manager`='$manager' AND `accesslevel`=5 ORDER BY `id` ASC")->result();
		$return=array(
		"" => ""
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
    
	public function viewtraineebymanager($id)
	{
		$query=$this->db->query("SELECT * FROM `user` WHERE `manager`='$id' AND `accesslevel`=5")->result();
		return $query;
	}
    
}
?>