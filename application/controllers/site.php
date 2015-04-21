<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Site extends CI_Controller 
{
	public function __construct( )
	{
		parent::__construct();
		
		$this->is_logged_in();
	}
	function is_logged_in( )
	{
		$is_logged_in = $this->session->userdata( 'logged_in' );
		if ( $is_logged_in !== 'true' || !isset( $is_logged_in ) ) {
			redirect( base_url() . 'index.php/login', 'refresh' );
		} //$is_logged_in !== 'true' || !isset( $is_logged_in )
	}
	function checkaccess($access)
	{
		$accesslevel=$this->session->userdata('accesslevel');
		if(!in_array($accesslevel,$access))
			redirect( base_url() . 'index.php/site?alerterror=You do not have access to this page. ', 'refresh' );
	}
	public function index()
	{
		$access = array("1","2");
		$this->checkaccess($access);
		$data[ 'page' ] = 'dashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createuser';
		$data[ 'title' ] = 'Create User';
		$this->load->view( 'template', $data );	
	}
	function createusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'page' ] = 'createuser';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=$this->input->post('accesslevel');
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
//            $category=$this->input->post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="New user could not be created.";
			else
			$data['alertsuccess']="User created Successfully.";
			$data['redirect']="site/viewusers";
			$this->load->view("redirect",$data);
		}
	}
    function viewusers()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewusers';
        $data['base_url'] = site_url("site/viewusersjson");
        
		$data['title']='View Users';
		$this->load->view('template',$data);
	} 
    function viewusersjson()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`user`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        
        $elements[1]=new stdClass();
        $elements[1]->field="`user`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`user`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`user`.`socialid`";
        $elements[3]->sort="1";
        $elements[3]->header="SocialId";
        $elements[3]->alias="socialid";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`logintype`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="Logintype";
        $elements[4]->alias="logintype";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`json`";
        $elements[5]->sort="1";
        $elements[5]->header="Json";
        $elements[5]->alias="json";
       
        $elements[6]=new stdClass();
        $elements[6]->field="`accesslevel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Accesslevel";
        $elements[6]->alias="accesslevelname";
       
        $elements[7]=new stdClass();
        $elements[7]->field="`statuses`.`name`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
       
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('templatewith2',$data);
	}
	function editusersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email');
		$this->form_validation->set_rules('password','Password','trim|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|matches[password]');
		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
			$data[ 'status' ] =$this->user_model->getstatusdropdown();
			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='edituser';
//			$data['page2']='block/userblock';
			$data['title']='Edit User';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=$this->input->get_post('accesslevel');
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
//            $category=$this->input->get_post('category');
            
            $config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$this->load->library('upload', $config);
			$filename="image";
			$image="";
			if (  $this->upload->do_upload($filename))
			{
				$uploaddata = $this->upload->data();
				$image=$uploaddata['file_name'];
                
                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
                $config_r['maintain_ratio'] = TRUE;
                $config_t['create_thumb'] = FALSE;///add this
                $config_r['width']   = 800;
                $config_r['height'] = 800;
                $config_r['quality']    = 100;
                //end of configs

                $this->load->library('image_lib', $config_r); 
                $this->image_lib->initialize($config_r);
                if(!$this->image_lib->resize())
                {
                    echo "Failed." . $this->image_lib->display_errors();
                    //return false;
                }  
                else
                {
                    //print_r($this->image_lib->dest_image);
                    //dest_image
                    $image=$this->image_lib->dest_image;
                    //return false;
                }
                
			}
            
            if($image=="")
            {
            $image=$this->user_model->getuserimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deleteuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="User Deleted Successfully";
		$data['redirect']="site/viewusers";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
	function changeuserstatus()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->changestatus($this->input->get('id'));
		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewusers";
        $data['other']="template=$template";
        $this->load->view("redirect",$data);
	}
    
    
    
    public function viewhotel()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewhotel";
        $data["base_url"]=site_url("site/viewhoteljson");
        $data["title"]="View hotel";
        $this->load->view("template",$data);
    }
    function viewhoteljson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`hotel_hotel`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`hotel_hotel`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`hotel_hotel`.`initialbalance`";
        $elements[2]->sort="1";
        $elements[2]->header="Initial Balance";
        $elements[2]->alias="initialbalance";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`hotel_hotel`.`location`";
        $elements[3]->sort="1";
        $elements[3]->header="Location";
        $elements[3]->alias="location";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`hotel_hotel`.`user`";
        $elements[4]->sort="1";
        $elements[4]->header="Userid";
        $elements[4]->alias="user";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="User";
        $elements[5]->alias="username";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
        $maxrow=20;
        }
        if($orderby=="")
        {
        $orderby="id";
        $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_hotel` LEFT OUTER JOIN `user` ON `user`.`id`=`hotel_hotel`.`user`");
        $this->load->view("json",$data);
    }

    public function createhotel()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createhotel";
        $data["title"]="Create hotel";
        $data['user']=$this->user_model->getuserdropdown();
        $this->load->view("template",$data);
    }
    public function createhotelsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("initialbalance","Initial Balance","trim");
        $this->form_validation->set_rules("location","Location","trim");
        $this->form_validation->set_rules("user","User","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createhotel";
            $data["title"]="Create hotel";
            $data['user']=$this->user_model->getuserdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $name=$this->input->get_post("name");
            $initialbalance=$this->input->get_post("initialbalance");
            $location=$this->input->get_post("location");
            $user=$this->input->get_post("user");
            if($this->hotel_model->create($name,$initialbalance,$location,$user)==0)
                $data["alerterror"]="New hotel could not be created.";
            else
                $data["alertsuccess"]="hotel created Successfully.";
            $data["redirect"]="site/viewhotel";
            $this->load->view("redirect",$data);
        }
    }
    public function edithotel()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="edithotel";
        $data["title"]="Edit hotel";
        $data['user']=$this->user_model->getuserdropdown();
        $data["before"]=$this->hotel_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function edithotelsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("initialbalance","Initial Balance","trim");
        $this->form_validation->set_rules("location","Location","trim");
        $this->form_validation->set_rules("user","User","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="edithotel";
            $data["title"]="Edit hotel";
            $data['user']=$this->user_model->getuserdropdown();
            $data["before"]=$this->hotel_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            $initialbalance=$this->input->get_post("initialbalance");
            $location=$this->input->get_post("location");
            $user=$this->input->get_post("user");
            if($this->hotel_model->edit($id,$name,$initialbalance,$location,$user)==0)
                $data["alerterror"]="New hotel could not be Updated.";
            else
                $data["alertsuccess"]="hotel Updated Successfully.";
            $data["redirect"]="site/viewhotel";
            $this->load->view("redirect",$data);
        }
    }
    public function deletehotel()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->hotel_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewhotel";
        $this->load->view("redirect",$data);
    }
    public function vieworder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="vieworder";
        $data["base_url"]=site_url("site/vieworderjson");
        $data["title"]="View order";
        $this->load->view("template",$data);
    }
    function vieworderjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`hotel_order`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`hotel_order`.`user`";
        $elements[1]->sort="1";
        $elements[1]->header="User";
        $elements[1]->alias="user";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`hotel_order`.`admin`";
        $elements[2]->sort="1";
        $elements[2]->header="Admin";
        $elements[2]->alias="admin";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`hotel_order`.`hotel`";
        $elements[3]->sort="1";
        $elements[3]->header="Hotel";
        $elements[3]->alias="hotel";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`hotel_order`.`days`";
        $elements[4]->sort="1";
        $elements[4]->header="Days";
        $elements[4]->alias="days";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`hotel_order`.`userrate`";
        $elements[5]->sort="1";
        $elements[5]->header="User Rate";
        $elements[5]->alias="userrate";
        
        $elements[6]=new stdClass();
        $elements[6]->field="`hotel_order`.`hotelrate`";
        $elements[6]->sort="1";
        $elements[6]->header="Hotel Rate";
        $elements[6]->alias="hotelrate";
        
        $elements[7]=new stdClass();
        $elements[7]->field="`hotel_order`.`status`";
        $elements[7]->sort="1";
        $elements[7]->header="Status";
        $elements[7]->alias="status";
        
        $elements[8]=new stdClass();
        $elements[8]->field="`hotel_order`.`price`";
        $elements[8]->sort="1";
        $elements[8]->header="Price";
        $elements[8]->alias="price";
        
        $elements[9]=new stdClass();
        $elements[9]->field="`tab1`.`name`";
        $elements[9]->sort="1";
        $elements[9]->header="User";
        $elements[9]->alias="username";
        
        $elements[10]=new stdClass();
        $elements[10]->field="`tab2`.`name`";
        $elements[10]->sort="1";
        $elements[10]->header="Admin";
        $elements[10]->alias="adminname";
        
        $elements[11]=new stdClass();
        $elements[11]->field="`hotel_hotel`.`name`";
        $elements[11]->sort="1";
        $elements[11]->header="Hotel";
        $elements[11]->alias="hotelname";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_order` LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel`");
        $this->load->view("json",$data);
    }

    public function createorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createorder";
        $data["title"]="Create order";
        $data['user']=$this->user_model->getuserdropdown();
        $data['admin']=$this->user_model->getadmindropdown();
        $data['status']=$this->user_model->getstatusdropdown();
        $data['hotel']=$this->hotel_model->gethoteldropdown();
        $this->load->view("template",$data);
    }
    public function createordersubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("admin","Admin","trim");
        $this->form_validation->set_rules("hotel","Hotel","trim");
        $this->form_validation->set_rules("days","Days","trim");
        $this->form_validation->set_rules("userrate","User Rate","trim");
        $this->form_validation->set_rules("hotelrate","Hotel Rate","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("price","Price","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createorder";
            $data["title"]="Create order";
            $data['user']=$this->user_model->getuserdropdown();
            $data['admin']=$this->user_model->getadmindropdown();
            $data['status']=$this->user_model->getstatusdropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $user=$this->input->get_post("user");
            $admin=$this->input->get_post("admin");
            $hotel=$this->input->get_post("hotel");
            $days=$this->input->get_post("days");
            $userrate=$this->input->get_post("userrate");
            $hotelrate=$this->input->get_post("hotelrate");
            $status=$this->input->get_post("status");
            $price=$this->input->get_post("price");
            if($this->order_model->create($user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price)==0)
            $data["alerterror"]="New order could not be created.";
            else
            $data["alertsuccess"]="order created Successfully.";
            $data["redirect"]="site/vieworder";
            $this->load->view("redirect",$data);
        }
    }
    public function editorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editorder";
        $data["title"]="Edit order";
        $data['user']=$this->user_model->getuserdropdown();
        $data['admin']=$this->user_model->getadmindropdown();
        $data['status']=$this->user_model->getstatusdropdown();
        $data['hotel']=$this->hotel_model->gethoteldropdown();
        $data["before"]=$this->order_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function editordersubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("admin","Admin","trim");
        $this->form_validation->set_rules("hotel","Hotel","trim");
        $this->form_validation->set_rules("days","Days","trim");
        $this->form_validation->set_rules("userrate","User Rate","trim");
        $this->form_validation->set_rules("hotelrate","Hotel Rate","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("price","Price","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editorder";
            $data["title"]="Edit order";
            $data['user']=$this->user_model->getuserdropdown();
            $data['admin']=$this->user_model->getadmindropdown();
            $data['status']=$this->user_model->getstatusdropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
            $data["before"]=$this->order_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $user=$this->input->get_post("user");
            $admin=$this->input->get_post("admin");
            $hotel=$this->input->get_post("hotel");
            $days=$this->input->get_post("days");
            $userrate=$this->input->get_post("userrate");
            $hotelrate=$this->input->get_post("hotelrate");
            $status=$this->input->get_post("status");
            $price=$this->input->get_post("price");
            if($this->order_model->edit($id,$user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price)==0)
                $data["alerterror"]="New order could not be Updated.";
            else
                $data["alertsuccess"]="order Updated Successfully.";
            $data["redirect"]="site/vieworder";
            $this->load->view("redirect",$data);
        }
    }
    public function deleteorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->order_model->delete($this->input->get("id"));
        $data["redirect"]="site/vieworder";
        $this->load->view("redirect",$data);
    }
    public function viewtransaction()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewtransaction";
        $data["base_url"]=site_url("site/viewtransactionjson");
        $data["title"]="View transaction";
        $this->load->view("template",$data);
    }
    function viewtransactionjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`hotel_transaction`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`hotel_transaction`.`user`";
        $elements[1]->sort="1";
        $elements[1]->header="User";
        $elements[1]->alias="user";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`hotel_transaction`.`hotel`";
        $elements[2]->sort="1";
        $elements[2]->header="Hotel";
        $elements[2]->alias="hotel";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`hotel_transaction`.`amount`";
        $elements[3]->sort="1";
        $elements[3]->header="Amount";
        $elements[3]->alias="amount";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`hotel_transaction`.`status`";
        $elements[4]->sort="1";
        $elements[4]->header="Status";
        $elements[4]->alias="status";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`user`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="User";
        $elements[5]->alias="username";
        
        $elements[6]=new stdClass();
        $elements[6]->field="`hotel_hotel`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="Hotel";
        $elements[6]->alias="hotelname";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_transaction` LEFT OUTER JOIN `hotel_hotel` ON `hotel_transaction`.`hotel`=`hotel_hotel`.`id` LEFT OUTER JOIN `user` ON `hotel_transaction`.`user`=`user`.`id`");
        $this->load->view("json",$data);
    }

    public function createtransaction()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createtransaction";
        $data["title"]="Create transaction";
        $data['user']=$this->user_model->getuserdropdown();
        $data['status']=$this->user_model->getstatusdropdown();
        $data['hotel']=$this->hotel_model->gethoteldropdown();
        $this->load->view("template",$data);
    }
    public function createtransactionsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("hotel","Hotel","trim");
        $this->form_validation->set_rules("amount","Amount","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createtransaction";
            $data["title"]="Create transaction";
            $data['user']=$this->user_model->getuserdropdown();
            $data['status']=$this->user_model->getstatusdropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $user=$this->input->get_post("user");
            $hotel=$this->input->get_post("hotel");
            $amount=$this->input->get_post("amount");
            $status=$this->input->get_post("status");
            if($this->transaction_model->create($user,$hotel,$amount,$status)==0)
                $data["alerterror"]="New transaction could not be created.";
            else
                $data["alertsuccess"]="transaction created Successfully.";
            $data["redirect"]="site/viewtransaction";
            $this->load->view("redirect",$data);
        }
    }
    public function edittransaction()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="edittransaction";
        $data["title"]="Edit transaction";
        $data['user']=$this->user_model->getuserdropdown();
        $data['status']=$this->user_model->getstatusdropdown();
        $data['hotel']=$this->hotel_model->gethoteldropdown();
        $data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function edittransactionsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("hotel","Hotel","trim");
        $this->form_validation->set_rules("amount","Amount","trim");
        $this->form_validation->set_rules("status","Status","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="edittransaction";
            $data["title"]="Edit transaction";
            $data['user']=$this->user_model->getuserdropdown();
            $data['status']=$this->user_model->getstatusdropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
            $data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $user=$this->input->get_post("user");
            $hotel=$this->input->get_post("hotel");
            $amount=$this->input->get_post("amount");
            $status=$this->input->get_post("status");
            if($this->transaction_model->edit($id,$user,$hotel,$amount,$status)==0)
                $data["alerterror"]="New transaction could not be Updated.";
            else
                $data["alertsuccess"]="transaction Updated Successfully.";
            $data["redirect"]="site/viewtransaction";
            $this->load->view("redirect",$data);
        }
    }
    public function deletetransaction()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->transaction_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewtransaction";
        $this->load->view("redirect",$data);
    }
    public function viewlog()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewlog";
        $data["base_url"]=site_url("site/viewlogjson");
        $data["title"]="View log";
        $this->load->view("template",$data);
    }
    function viewlogjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`hotel_log`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`hotel_log`.`admin`";
        $elements[1]->sort="1";
        $elements[1]->header="Admin";
        $elements[1]->alias="admin";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`hotel_log`.`user`";
        $elements[2]->sort="1";
        $elements[2]->header="User";
        $elements[2]->alias="user";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`hotel_log`.`text`";
        $elements[3]->sort="1";
        $elements[3]->header="Text";
        $elements[3]->alias="text";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`tab1`.`name`";
        $elements[4]->sort="1";
        $elements[4]->header="User";
        $elements[4]->alias="username";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`tab2`.`name`";
        $elements[5]->sort="1";
        $elements[5]->header="Admin";
        $elements[5]->alias="adminname";
        
        $search=$this->input->get_post("search");
        $pageno=$this->input->get_post("pageno");
        $orderby=$this->input->get_post("orderby");
        $orderorder=$this->input->get_post("orderorder");
        $maxrow=$this->input->get_post("maxrow");
        if($maxrow=="")
        {
            $maxrow=20;
        }
        if($orderby=="")
        {
            $orderby="id";
            $orderorder="ASC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_log` LEFT OUTER JOIN `user` AS `tab1` ON `hotel_log`.`user`=`tab1`.`id` LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_log`.`admin`");
        $this->load->view("json",$data);
    }

    public function createlog()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createlog";
        $data["title"]="Create log";
        $data['user']=$this->user_model->getuserdropdown();
        $data['admin']=$this->user_model->getadmindropdown();
        $this->load->view("template",$data);
    }
    public function createlogsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("admin","Admin","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("text","Text","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createlog";
            $data["title"]="Create log";
            $data['user']=$this->user_model->getuserdropdown();
            $data['admin']=$this->user_model->getadmindropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $admin=$this->input->get_post("admin");
            $user=$this->input->get_post("user");
            $text=$this->input->get_post("text");
            if($this->log_model->create($admin,$user,$text)==0)
            $data["alerterror"]="New log could not be created.";
            else
            $data["alertsuccess"]="log created Successfully.";
            $data["redirect"]="site/viewlog";
            $this->load->view("redirect",$data);
        }
    }
    public function editlog()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editlog";
        $data["title"]="Edit log";
        $data['user']=$this->user_model->getuserdropdown();
        $data['admin']=$this->user_model->getadmindropdown();
        $data["before"]=$this->log_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function editlogsubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("admin","Admin","trim");
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("text","Text","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="editlog";
            $data["title"]="Edit log";
            $data['user']=$this->user_model->getuserdropdown();
            $data['admin']=$this->user_model->getadmindropdown();
            $data["before"]=$this->log_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $admin=$this->input->get_post("admin");
            $user=$this->input->get_post("user");
            $text=$this->input->get_post("text");
            if($this->log_model->edit($id,$admin,$user,$text)==0)
            $data["alerterror"]="New log could not be Updated.";
            else
            $data["alertsuccess"]="log Updated Successfully.";
            $data["redirect"]="site/viewlog";
            $this->load->view("redirect",$data);
        }
    }
    public function deletelog()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->log_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewlog";
        $this->load->view("redirect",$data);
    }

}
?>
