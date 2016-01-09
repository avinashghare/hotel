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
		$access = array("1","2","3","4");
		$this->checkaccess($access);
        $accesslevel=$this->session->userdata('accesslevel');
        if($accesslevel<=2)
        {
		$data[ 'page' ] = 'dashboard';
        }
        else if($accesslevel==3)
        {
        $data['page'] = 'hoteldashboard';
        }
        else if($accesslevel==4)
        {
        $data['page'] = 'managerdashboard';
        }
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
	public function createuser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'gender' ] =$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['manager']=$this->user_model->getmanagerdropdown();
        $data['trainee']=$this->user_model->gettraineedropdown();
        $data['executive']=$this->user_model->getexecutivedropdown();
        $data['alluser']=$this->user_model->getuserdropdown();
        $data['hotel']=$this->hotel_model->gethoteldropdown();
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
//            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['manager']=$this->user_model->getmanagerdropdown();
            $data['trainee']=$this->user_model->gettraineedropdown();
            $data['executive']=$this->user_model->getexecutivedropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
            $data['alluser']=$this->user_model->getuserdropdown();
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
            
            $age=$this->input->post('age');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $contact=$this->input->post('contact');
            $mobile=$this->input->post('mobile');
            $dob=$this->input->post('dob');
            $profession=$this->input->post('profession');
            $vouchernumber=$this->input->post('vouchernumber');
            $validtill=$this->input->post('validtill');
            $executive=$this->input->post('executive');
            $hotel=$this->input->post('hotel');
            $trainee=$this->input->post('trainee');
            $manager=$this->input->post('manager');
//            if($accesslevel==5)
//            {
//                $manager=$this->user_model->getmanagerbyexecutive($trainee);
//                $manager=$manager->manager;
//            }
            if($accesslevel==6)
            {
                $manager=$this->user_model->getmanagerbyexecutive($trainee);
                $manager=$manager->manager;
            }
            if($accesslevel==7)
            {
                $manager=$this->user_model->getmanagerbyexecutive($executive);
                $trainee=$manager->trainee;
                $manager=$manager->manager;
            }
            
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
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager,$hotel,$trainee)==0)
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
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`vouchernumber`";
        $elements[8]->sort="1";
        $elements[8]->header="Voucher Number";
        $elements[8]->alias="vouchernumber";
        
       
        
        $elements[9]=new stdClass();
        $elements[9]->field="`user`.`accesslevel`";
        $elements[9]->sort="1";
        $elements[9]->header="Accesslevel";
        $elements[9]->alias="accesslevel";
        
        
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
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","WHERE `user`.`accesslevel` < 7");
        
		$this->load->view("json",$data);
	} 
    function viewmember()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewmember';
        $data['base_url'] = site_url("site/viewmemberjson");
        
		$data['title']='View member';
		$this->load->view('template',$data);
	} 
    function viewmemberjson()
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
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`vouchernumber`";
        $elements[8]->sort="1";
        $elements[8]->header="Voucher Number";
        $elements[8]->alias="vouchernumber";
        
        $elements[9]=new stdClass();
        $elements[9]->field="`user`.`points`";
        $elements[9]->sort="1";
        $elements[9]->header="Points";
        $elements[9]->alias="points";
        
        $elements[10]=new stdClass();
        $elements[10]->field="`user`.`accesslevel`";
        $elements[10]->sort="1";
        $elements[10]->header="Accesslevel";
        $elements[10]->alias="accesslevel";
        
        
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
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","WHERE `user`.`accesslevel`=7");
        
		$this->load->view("json",$data);
	} 
    
    
	function edituser()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data[ 'gender' ] =$this->user_model->getgenderdropdown();
//        $data['manager']=$this->user_model->getmanagerdropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
        $managerid=$data['before']->manager;
        $data['hotel']=$this->hotel_model->gethoteldropdown();
        
        $data['manager']=$this->user_model->getmanagerdropdown();
        $data['trainee']=$this->user_model->gettraineedropdown();
        $data['executive']=$this->user_model->getexecutivedropdown($managerid);
        
//        $data['executive']=$this->user_model->getexecutivedropdownbymanagerid($managerid);
		$data['page']='edituser';
		$data['page2']='block/userblock';
		$data['title']='Edit User';
		$this->load->view('template',$data);
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
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['executive']=$this->user_model->getexecutivedropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['manager']=$this->user_model->getmanagerdropdown();
            $data['trainee']=$this->user_model->gettraineedropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
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
            
            
            $age=$this->input->post('age');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $contact=$this->input->post('contact');
            $mobile=$this->input->post('mobile');
            $dob=$this->input->post('dob');
            $profession=$this->input->post('profession');
            $vouchernumber=$this->input->post('vouchernumber');
            $validtill=$this->input->post('validtill');
            $executive=$this->input->post('executive');
            $hotel=$this->input->post('hotel');
            $trainee=$this->input->post('trainee');
            $manager=$this->input->post('manager');
//            if($accesslevel==5)
//            {
//                $manager=$this->user_model->getmanagerbyexecutive($trainee);
//                $manager=$manager->manager;
//            }
            if($accesslevel==6)
            {
                $manager=$this->user_model->getmanagerbyexecutive($trainee);
                $manager=$manager->manager;
            }
            if($accesslevel==7)
            {
                $manager=$this->user_model->getmanagerbyexecutive($executive);
                $trainee=$manager->trainee;
                $manager=$manager->manager;
            }
            
//            $manager=$this->user_model->getmanagerbyexecutive($executive);
//            $manager=$manager->manager;
            
            
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
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager,$hotel,$trainee)==0)
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
            $address=$this->input->get_post("address");
            $user=$this->input->get_post("user");
            
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
            if($this->hotel_model->create($name,$initialbalance,$location,$user,$address,$image)==0)
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
            $address=$this->input->get_post("address");
            $user=$this->input->get_post("user");
            
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
            $image=$this->hotel_model->gethotelimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            if($this->hotel_model->edit($id,$name,$initialbalance,$location,$user,$address,$image)==0)
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
        
        $elements[12]=new stdClass();
        $elements[12]->field="`orderstatus`.`name`";
        $elements[12]->sort="1";
        $elements[12]->header="statusname";
        $elements[12]->alias="statusname";
        
        $elements[13]=new stdClass();
        $elements[13]->field="`hotel_order`.`timestamp`";
        $elements[13]->sort="1";
        $elements[13]->header="timestamp";
        $elements[13]->alias="timestamp";
        
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
            $orderby="timestamp";
            $orderorder="DESC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_order` LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status`");
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
        $data['status']=$this->order_model->getorderstatusdropdown();
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
        $this->form_validation->set_rules("extra","extra","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createorder";
            $data["title"]="Create order";
            $data['user']=$this->user_model->getuserdropdown();
            $data['admin']=$this->user_model->getadmindropdown();
            $data['status']=$this->order_model->getorderstatusdropdown();
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
            
            $checkin=$this->input->get_post("checkin");
            $checkout=$this->input->get_post("checkout");
            $adult=$this->input->get_post("adult");
            $children=$this->input->get_post("children");
            $rooms=$this->input->get_post("rooms");
            $amount=$this->input->get_post("amount");
            $profit=$this->input->get_post("profit");
            $checkintime=$this->input->get_post("checkintime");
            $checkouttime=$this->input->get_post("checkouttime");
            $foodpackage=$this->input->get_post("foodpackage");
            $extra=$this->input->get_post("extra");
            if($this->order_model->create($user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage,$extra)==0)
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
        $data['status']=$this->order_model->getorderstatusdropdown();
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
            $data['status']=$this->order_model->getorderstatusdropdown();
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
            
            $checkin=$this->input->get_post("checkin");
            $checkout=$this->input->get_post("checkout");
            $adult=$this->input->get_post("adult");
            $children=$this->input->get_post("children");
            $rooms=$this->input->get_post("rooms");
            $amount=$this->input->get_post("amount");
            $profit=$this->input->get_post("profit");
            $checkintime=$this->input->get_post("checkintime");
            $checkouttime=$this->input->get_post("checkouttime");
            $foodpackage=$this->input->get_post("foodpackage");
            $extra=$this->input->get_post("extra");
            if($this->order_model->edit($id,$user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage,$extra)==0)
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
        
        $elements[7]=new stdClass();
        $elements[7]->field="`hotel_transaction`.`paymentmethod`";
        $elements[7]->sort="1";
        $elements[7]->header="Payment Method";
        $elements[7]->alias="paymentmethod";
        
        $elements[8]=new stdClass();
        $elements[8]->field="`hotel_transaction`.`timestamp`";
        $elements[8]->sort="1";
        $elements[8]->header="Timestamp";
        $elements[8]->alias="timestamp";
        
       
        
        
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
        $data['paymentmethod']=$this->transaction_model->gettypedropdown();
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
            $data['paymentmethod']=$this->transaction_model->gettypedropdown();
            $data['user']=$this->user_model->getuserdropdown();
            $data['status']=$this->user_model->getstatusdropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $user=$this->session->userdata('id');
            $hotel=$this->input->get_post("hotel");
            $amount=$this->input->get_post("amount");
            $status=$this->input->get_post("status");
            
            $paymentmethod=$this->input->get_post('paymentmethod');
            $bankname=$this->input->get_post('bankname');
            $branchname=$this->input->get_post('branchname');
            $chequeno=$this->input->get_post('chequeno');
            $chequedate=$this->input->get_post('chequedate');
            
//            $config['upload_path'] = './uploads/';
//			$config['allowed_types'] = 'gif|jpg|png|jpeg';
//			$this->load->library('upload', $config);
//			$filename="image";
//			$image="";
//			if (  $this->upload->do_upload($filename))
//			{
//				$uploaddata = $this->upload->data();
//				$image=$uploaddata['file_name'];
//                
//                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
//                $config_r['maintain_ratio'] = TRUE;
//                $config_t['create_thumb'] = FALSE;///add this
//                $config_r['width']   = 800;
//                $config_r['height'] = 800;
//                $config_r['quality']    = 100;
//                //end of configs
//
//                $this->load->library('image_lib', $config_r); 
//                $this->image_lib->initialize($config_r);
//                if(!$this->image_lib->resize())
//                {
//                    echo "Failed." . $this->image_lib->display_errors();
//                    //return false;
//                }  
//                else
//                {
//                    //print_r($this->image_lib->dest_image);
//                    //dest_image
//                    $image=$this->image_lib->dest_image;
//                    //return false;
//                }
//                
//			}
            if($this->transaction_model->create($user,$hotel,$amount,$status,$paymentmethod,$bankname,$branchname,$chequeno,$chequedate)==0)
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
        $data['paymentmethod']=$this->transaction_model->gettypedropdown();
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
            $data['paymentmethod']=$this->transaction_model->gettypedropdown();
            $data['user']=$this->user_model->getuserdropdown();
            $data['status']=$this->user_model->getstatusdropdown();
            $data['hotel']=$this->hotel_model->gethoteldropdown();
            $data["before"]=$this->transaction_model->beforeedit($this->input->get("id"));
            $this->load->view("template",$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $user=$this->session->userdata('id');
            $hotel=$this->input->get_post("hotel");
            $amount=$this->input->get_post("amount");
            $status=$this->input->get_post("status");
            
            $paymentmethod=$this->input->get_post('paymentmethod');
            $bankname=$this->input->get_post('bankname');
            $branchname=$this->input->get_post('branchname');
            $chequeno=$this->input->get_post('chequeno');
            $chequedate=$this->input->get_post('chequedate');
            
//            $config['upload_path'] = './uploads/';
//			$config['allowed_types'] = 'gif|jpg|png|jpeg';
//			$this->load->library('upload', $config);
//			$filename="image";
//			$image="";
//			if (  $this->upload->do_upload($filename))
//			{
//				$uploaddata = $this->upload->data();
//				$image=$uploaddata['file_name'];
//                
//                $config_r['source_image']   = './uploads/' . $uploaddata['file_name'];
//                $config_r['maintain_ratio'] = TRUE;
//                $config_t['create_thumb'] = FALSE;///add this
//                $config_r['width']   = 800;
//                $config_r['height'] = 800;
//                $config_r['quality']    = 100;
//                //end of configs
//
//                $this->load->library('image_lib', $config_r); 
//                $this->image_lib->initialize($config_r);
//                if(!$this->image_lib->resize())
//                {
//                    echo "Failed." . $this->image_lib->display_errors();
//                    //return false;
//                }  
//                else
//                {
//                    //print_r($this->image_lib->dest_image);
//                    //dest_image
//                    $image=$this->image_lib->dest_image;
//                    //return false;
//                }
//                
//			}
//            
//            if($image=="")
//            {
//            $image=$this->transaction_model->gettransactionimagebyid($id);
//               // print_r($image);
//                $image=$image->image;
//            }
            if($this->transaction_model->edit($id,$user,$hotel,$amount,$status,$paymentmethod,$bankname,$branchname,$chequeno,$chequedate)==0)
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

    function viewuserhotel()
	{
		$access = array("1");
		$this->checkaccess($access);
        $id=$this->input->get('id');
        $data['userid']=$this->input->get('id');
		$data['table']=$this->hotel_model->gethotels($id);
		$data['page']='viewuserhotel';
		$data['title']='User Hotels';
		$this->load->view('template',$data);
	}
    function createorderforuserhotel()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createorderforuserhotel";
        $data["title"]="Make order";
        $data['userid']=$this->input->get('userid');
        $data['hotelid']=$this->input->get('hotelid');
        $data['status']=$this->user_model->getstatusdropdown();
        $this->load->view("template",$data);
    
    }
    public function createorderforuserhotelsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("hotel","Hotel","trim");
        $this->form_validation->set_rules("days","Days","trim");
        $this->form_validation->set_rules("userrate","User Rate","trim");
        $this->form_validation->set_rules("hotelrate","Hotel Rate","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("price","Price","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createorderforuserhotel";
            $data["title"]="Make order";
            $data['userid']=$this->input->get_post('user');
            $data['hotelid']=$this->input->get_post('hotel');
            $data['status']=$this->user_model->getstatusdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $user=$this->input->get_post("user");
            $admin=$this->session->userdata('id');
            $hotel=$this->input->get_post("hotel");
            $days=$this->input->get_post("days");
            $userrate=$this->input->get_post("userrate");
            $hotelrate=$this->input->get_post("hotelrate");
            $status=$this->input->get_post("status");
            $price=$this->input->get_post("price");
            
            $checkin=$this->input->get_post("checkin");
            $checkout=$this->input->get_post("checkout");
            $adult=$this->input->get_post("adult");
            $children=$this->input->get_post("children");
            $rooms=$this->input->get_post("rooms");
            $amount=$this->input->get_post("amount");
            $profit=$this->input->get_post("profit");
            
            $checkintime=$this->input->get_post("checkintime");
            $checkouttime=$this->input->get_post("checkouttime");
            $foodpackage=$this->input->get_post("foodpackage");
            
            if($this->order_model->create($user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage)==0)
            $data["alerterror"]="Your Order could not be created.";
            else
            $data["alertsuccess"]="Order created Successfully.";
            $data["redirect"]="site/viewuserhotel?id=".$user;
            $this->load->view("redirect2",$data);
        }
    }
    
    
   //managerbyadmin 
    public function createmanagerbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
//		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'gender' ] =$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['executive']=$this->user_model->getexecutivedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createmanagerbyadmin';
		$data[ 'title' ] = 'Create Manager';
		$this->load->view( 'template', $data );	
	}
	function createmanagerbyadminsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
//		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
//			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
//            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['executive']=$this->user_model->getexecutivedropdown();
            $data[ 'page' ] = 'createmanagerbyadmin';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=4;
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            
            $age=$this->input->post('age');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $contact=$this->input->post('contact');
            $mobile=$this->input->post('mobile');
            $dob=$this->input->post('dob');
            $profession=$this->input->post('profession');
            $vouchernumber=$this->input->post('vouchernumber');
            $validtill=$this->input->post('validtill');
            $executive="";
            $manager=0;
            
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
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager)==0)
			$data['alerterror']="New Manager could not be created.";
			else
			$data['alertsuccess']="Manager created Successfully.";
			$data['redirect']="site/viewmanagerbyadmin";
			$this->load->view("redirect",$data);
		}
	}
    function viewmanagerbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewmanagerbyadmin';
        $data['base_url'] = site_url("site/viewmanagerbyadminjson");
        
		$data['title']='View Managers';
		$this->load->view('template',$data);
	} 
    function viewmanagerbyadminjson()
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
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","WHERE `user`.`accesslevel`=4");
        
		$this->load->view("json",$data);
	} 
    
    
	function editmanagerbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data[ 'gender' ] =$this->user_model->getgenderdropdown();
        $data['executive']=$this->user_model->getexecutivedropdown();
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='editmanagerbyadmin';
		$data['page2']='block/userblock';
		$data['title']='Edit Manager';
		$this->load->view('template',$data);
	}
	function editmanagerbyadminsubmit()
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
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['executive']=$this->user_model->getexecutivedropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='editmanagerbyadmin';
//			$data['page2']='block/userblock';
			$data['title']='Edit Manager';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=4;
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
            
            
            $age=$this->input->post('age');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $contact=$this->input->post('contact');
            $mobile=$this->input->post('mobile');
            $dob=$this->input->post('dob');
            $profession=$this->input->post('profession');
            $vouchernumber=$this->input->post('vouchernumber');
            $validtill=$this->input->post('validtill');
            $executive=0;
            $manager=0;
            
            
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
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager)==0)
			$data['alerterror']="Manager Editing was unsuccesful";
			else
			$data['alertsuccess']="Manager edited Successfully.";
			
			$data['redirect']="site/viewmanagerbyadmin";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	
	function deletemanagerbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Manager Deleted Successfully";
		$data['redirect']="site/viewmanagerbyadmin";
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
    
   //executivebymanager 
    public function createexecutivebymanager()
	{
		$access = array("1");
		$this->checkaccess($access);
//		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data[ 'gender' ] =$this->user_model->getgenderdropdown();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
        $data['executive']=$this->user_model->getexecutivedropdown();
//        $data['category']=$this->category_model->getcategorydropdown();
		$data[ 'page' ] = 'createexecutivebymanager';
		$data[ 'title' ] = 'Create Manager';
		$this->load->view( 'template', $data );	
	}
	function createexecutivebymanagersubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->form_validation->set_rules('name','Name','trim|required|max_length[30]');
		$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules('password','Password','trim|required|min_length[6]|max_length[30]');
		$this->form_validation->set_rules('confirmpassword','Confirm Password','trim|required|matches[password]');
//		$this->form_validation->set_rules('accessslevel','Accessslevel','trim');
		$this->form_validation->set_rules('status','status','trim|');
		$this->form_validation->set_rules('socialid','Socialid','trim');
		$this->form_validation->set_rules('logintype','logintype','trim');
		$this->form_validation->set_rules('json','json','trim');
		if($this->form_validation->run() == FALSE)	
		{
			$data['alerterror'] = validation_errors();
//			$data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['category']=$this->category_model->getcategorydropdown();
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['executive']=$this->user_model->getexecutivedropdown();
            $data[ 'page' ] = 'createexecutivebymanager';
            $data[ 'title' ] = 'Create User';
            $this->load->view( 'template', $data );	
		}
		else
		{
            $name=$this->input->post('name');
            $email=$this->input->post('email');
            $password=$this->input->post('password');
            $accesslevel=5;
            $status=$this->input->post('status');
            $socialid=$this->input->post('socialid');
            $logintype=$this->input->post('logintype');
            $json=$this->input->post('json');
            
            $age=$this->input->post('age');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $contact=$this->input->post('contact');
            $mobile=$this->input->post('mobile');
            $dob=$this->input->post('dob');
            $profession=$this->input->post('profession');
            $vouchernumber=$this->input->post('vouchernumber');
            $validtill=$this->input->post('validtill');
            $manager=$this->input->post('manager');
            $executive="";
            
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
            
			if($this->user_model->create($name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager)==0)
			$data['alerterror']="New Manager could not be created.";
			else
			$data['alertsuccess']="Manager created Successfully.";
			$data['redirect']="site/viewexecutivebymanager?id=".$manager;
			$this->load->view("redirect",$data);
		}
	}
    function viewexecutivebymanager()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['page']='viewexecutivebymanager';
        $managerid=$this->input->get('id');
        $data['manager']=$this->input->get('id');
        $data['base_url'] = site_url("site/viewexecutivebymanagerjson?id=".$managerid);
        
		$data['title']='View Managers';
		$this->load->view('template',$data);
	} 
    function viewexecutivebymanagerjson()
	{
        $managerid=$this->input->get('id');
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
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`manager`";
        $elements[8]->sort="1";
        $elements[8]->header="Manager";
        $elements[8]->alias="manager";
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`points`";
        $elements[8]->sort="1";
        $elements[8]->header="points";
        $elements[8]->alias="points";
       
        
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
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","WHERE (`user`.`accesslevel`=5 OR `user`.`accesslevel`=6) AND `user`.`manager`='$managerid'");
        
		$this->load->view("json",$data);
	} 
    
    
	function editexecutivebymanager()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data[ 'gender' ] =$this->user_model->getgenderdropdown();
        $data['executive']=$this->user_model->getexecutivedropdown();
        $data['manager']=$this->input->get('manager');
		$data['before']=$this->user_model->beforeedit($this->input->get('id'));
		$data['page']='editexecutivebymanager';
		$data['page2']='block/userblock';
		$data['title']='Edit Manager';
		$this->load->view('template',$data);
	}
	function editexecutivebymanagersubmit()
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
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['executive']=$this->user_model->getexecutivedropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
			$data['before']=$this->user_model->beforeedit($this->input->post('id'));
			$data['page']='editexecutivebymanager';
//			$data['page2']='block/userblock';
			$data['title']='Edit Manager';
			$this->load->view('template',$data);
		}
		else
		{
            
            $id=$this->input->get_post('id');
            $name=$this->input->get_post('name');
            $email=$this->input->get_post('email');
            $password=$this->input->get_post('password');
            $accesslevel=5;
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
            
            
            $age=$this->input->post('age');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $contact=$this->input->post('contact');
            $mobile=$this->input->post('mobile');
            $dob=$this->input->post('dob');
            $profession=$this->input->post('profession');
            $vouchernumber=$this->input->post('vouchernumber');
            $validtill=$this->input->post('validtill');
            $manager=$this->input->get_post('manager');
            $executive=0;
            
            
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
            
			if($this->user_model->edit($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager)==0)
			$data['alerterror']="Manager Editing was unsuccesful";
			else
			$data['alertsuccess']="Manager edited Successfully.";
			
			$data['redirect']="site/viewexecutivebymanager?id=".$manager;
			//$data['other']="template=$template";
			$this->load->view("redirect2",$data);
			
		}
	}
	
	function deleteexecutivebymanager()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->user_model->deleteuser($this->input->get('id'));
        $manager=$this->input->get('manager');
//		$data['table']=$this->user_model->viewusers();
		$data['alertsuccess']="Manager Deleted Successfully";
		$data['redirect']="site/viewexecutivebymanager?id=".$manager;
			//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}
    
    //for dashboard
    
//    public function submitvouchernumber()
//    {
//        $vouchernumber=$this->input->get_post("vouchernumber");
//        $userid=$this->user_model->getuseridfromvouchernumber($vouchernumber);
//        $data['table']=$this->user_model->getdetailsofuser($vouchernumber);
////        print_r($data['table']);
//        if($data['table']==0)
//        {
//            $data['alerterror']="No Such Voucher Number";
//            $data['page']='dashboard';
//            $data['title']='Dashboard';
//            $this->load->view('template',$data);
//        }
//        else
//        {
//            $data['userid']=$userid;
//            $data['page']='viewuserhotelfromdashboard';
//            $data['title']='User Hotels';
//            $this->load->view('template',$data);
//        }
//    }
    
    public function submitvouchernumber()
    {
        $vouchernumber=$this->input->get_post("vouchernumber");
//        $userid=$this->user_model->getuseridfromvouchernumber($vouchernumber);
//        $data['table']=$this->user_model->getdetailsofuser($vouchernumber);
        $data1=$this->user_model->getdetailsofuser($vouchernumber);
        $data["message"]=$data1;
//        print_r($data);
        $this->load->view("json",$data);
    }
    
    function createorderforuserhotelfromdashboard()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createorderforuserhotelfromdashboard";
        $data["title"]="Make order";
        $data['paymenttype']=$this->transaction_model->gettypedropdown();
        $data['userid']=$this->input->get('userid');
        $data['hotelid']=$this->input->get('hotelid');
        $data['status']=$this->user_model->getstatusdropdown();
        $this->load->view("template",$data);
    
    }
    public function createorderforuserhotelfromdashboardsubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->form_validation->set_rules("user","User","trim");
        $this->form_validation->set_rules("hotel","Hotel","trim");
        $this->form_validation->set_rules("days","Days","trim");
        $this->form_validation->set_rules("userrate","User Rate","trim");
        $this->form_validation->set_rules("hotelrate","Hotel Rate","trim");
        $this->form_validation->set_rules("status","Status","trim");
        $this->form_validation->set_rules("price","Price","trim");
        $this->form_validation->set_rules("extra","extra","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data["page"]="createorderforuserhotelfromdashboard";
            $data["title"]="Make order";
            $data['userid']=$this->input->get_post('user');
            $data['hotelid']=$this->input->get_post('hotel');
            $data['status']=$this->user_model->getstatusdropdown();
            $this->load->view("template",$data);
        }
        else
        {
            $user=$this->input->get_post("user");
            $admin=$this->session->userdata('id');
            $hotel=$this->input->get_post("hotel");
            $days=$this->input->get_post("days");
            $userrate=$this->input->get_post("userrate");
            $hotelrate=$this->input->get_post("hotelrate");
            $status=1;
            $price=$this->input->get_post("price");
            
            $checkin=$this->input->get_post("checkin");
            $checkout=$this->input->get_post("checkout");
            $adult=$this->input->get_post("adult");
            $children=$this->input->get_post("children");
            $rooms=$this->input->get_post("rooms");
            $amount=$this->input->get_post("amount");
            $profit=$this->input->get_post("profit");
            
            $checkintime=$this->input->get_post("checkintime");
            $checkouttime=$this->input->get_post("checkouttime");
            $foodpackage=$this->input->get_post("foodpackage");
            $extra=$this->input->get_post("extra");
            $guestname=$this->input->get_post("guestname");
            $paymenttype=$this->input->get_post("paymenttype");
            $bankname=$this->input->get_post("bankname");
            
            $totalmembers=intval($adult)+intval($children);
            $total=((floatval($userrate)*$totalmembers)*intval($days))+$extra;
            $amount=((floatval($hotelrate)*$totalmembers)*intval($days))+$extra;
            $profit=$total-$amount;
            $price=$total;
//            echo $price;
            if($this->order_model->create($user,$admin,$hotel,$days,$userrate,$hotelrate,$status,$price,$checkin,$checkout,$adult,$children,$rooms,$amount,$profit,$checkintime,$checkouttime,$foodpackage,$extra,$guestname,$paymenttype,$bankname)==0)
            $data["alerterror"]="Your Order could not be created.";
            else
            $data["alertsuccess"]="Order created Successfully.";
            $data["redirect"]="site/index";
            $this->load->view("redirect",$data);
        }
    }
    
    public function getexecutivedropdown($id) {
        $data1 = $this->user_model->getexecutivedropdownbymanager($id);
        $data["message"] = $data1;
        $this->load->view("json", $data);
    }
    
    
    //hotelaccesslevel
    
	public function hoteldashboard()
	{
		$access = array("3");
		$this->checkaccess($access);
        $data['page'] = 'hoteldashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
    
	function edithoteluserbyhotel()
	{
		$access = array("3");
		$this->checkaccess($access);
		$data[ 'status' ] =$this->user_model->getstatusdropdown();
		$data['accesslevel']=$this->user_model->getaccesslevels();
		$data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
		$data[ 'gender' ] =$this->user_model->getgenderdropdown();
		$data[ 'user' ] =$this->user_model->getuserdropdown();
        $data['manager']=$this->user_model->getmanagerdropdown();
		$data['before']=$this->user_model->beforeedit($this->session->userdata('id'));
		$data['beforehotel']=$this->hotel_model->beforeedit($this->session->userdata('hotel'));
        $managerid=$data['before']->manager;
        $data['executive']=$this->user_model->getexecutivedropdownbymanagerid($managerid);
		$data['page']='edithoteluserbyhotel';
		$data['page2']='block/userblock';
		$data['title']='Edit Profile';
		$this->load->view('template',$data);
	}
	function edithoteluserbyhotelsubmit()
	{
		$access = array("3");
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
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data['executive']=$this->user_model->getexecutivedropdown();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data['manager']=$this->user_model->getmanagerdropdown();
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
            $accesslevel=3;
            $status=$this->input->get_post('status');
            $socialid=$this->input->get_post('socialid');
            $logintype=$this->input->get_post('logintype');
            $json=$this->input->get_post('json');
            
            
            $age=$this->input->post('age');
            $gender=$this->input->post('gender');
            $address=$this->input->post('address');
            $contact=$this->input->post('contact');
            $mobile=$this->input->post('mobile');
            $dob=$this->input->post('dob');
            $profession=$this->input->post('profession');
            $vouchernumber=$this->input->post('vouchernumber');
            $validtill=$this->input->post('validtill');
            $executive=$this->input->post('executive');
            $hotel=$this->session->userdata('hotel');
            $manager=$this->user_model->getmanagerbyexecutive($executive);
            $manager=$manager->manager;
            
            
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
            
			if($this->user_model->edituserbyhotel($id,$name,$email,$password,$accesslevel,$status,$socialid,$logintype,$image,$json,$age,$gender,$address,$contact,$mobile,$dob,$profession,$vouchernumber,$validtill,$executive,$manager,$hotel)==0)
			$data['alerterror']="User Editing was unsuccesful";
			else
			$data['alertsuccess']="User edited Successfully.";
			
			$data['redirect']="site/edithoteluserbyhotel";
			//$data['other']="template=$template";
			$this->load->view("redirect",$data);
			
		}
	}
	 public function viewhotelorderbyhotel()
    {
        $access=array("3");
        $this->checkaccess($access);
        $data["page"]="viewhotelorderbyhotel";
        $data["base_url"]=site_url("site/viewhotelorderbyhoteljson");
        $data["title"]="View order";
        $this->load->view("template",$data);
    }
    function viewhotelorderbyhoteljson()
    {
        $hotelid=$this->session->userdata('hotel');
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
        $elements[6]->header=" Rate";
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
        
        $elements[12]=new stdClass();
        $elements[12]->field="`orderstatus`.`name`";
        $elements[12]->sort="1";
        $elements[12]->header="statusname";
        $elements[12]->alias="statusname";
        
        $elements[13]=new stdClass();
        $elements[13]->field="`hotel_order`.`amount`";
        $elements[13]->sort="1";
        $elements[13]->header="Amount";
        $elements[13]->alias="amount";
        
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
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_order` LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status`","WHERE `hotel_order`.`hotel`='$hotelid'");
        $this->load->view("json",$data);
    }

    
    public function viewtransactionbyhotel()
    {
        $access=array("3");
        $this->checkaccess($access);
        $data["page"]="viewtransactionbyhotel";
        $data["base_url"]=site_url("site/viewtransactionbyhoteljson");
        $data["title"]="View transaction";
        $this->load->view("template",$data);
    }
    function viewtransactionbyhoteljson()
    {
        
        $hotelid=$this->session->userdata('hotel');
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
        
        $elements[7]=new stdClass();
        $elements[7]->field="`hotel_transaction`.`paymentmethod`";
        $elements[7]->sort="1";
        $elements[7]->header="Payment Method";
        $elements[7]->alias="paymentmethod";
        
        $elements[8]=new stdClass();
        $elements[8]->field="`hotel_transaction`.`timestamp`";
        $elements[8]->sort="1";
        $elements[8]->header="Timestamp";
        $elements[8]->alias="timestamp";
        
        $elements[9]=new stdClass();
        $elements[9]->field="`hotel_transaction`.`image`";
        $elements[9]->sort="1";
        $elements[9]->header="Image";
        $elements[9]->alias="image";
        
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
            $orderby="timestamp";
            $orderorder="DESC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_transaction` LEFT OUTER JOIN `hotel_hotel` ON `hotel_transaction`.`hotel`=`hotel_hotel`.`id` LEFT OUTER JOIN `user` ON `hotel_transaction`.`user`=`user`.`id`","WHERE `hotel_transaction`.`hotel`='$hotelid'");
        $this->load->view("json",$data);
    }
    public function edithotelbyhotelsubmit()
    {
        $access=array("3");
        $this->checkaccess($access);
        $this->form_validation->set_rules("id","ID","trim");
        $this->form_validation->set_rules("name","Name","trim");
        $this->form_validation->set_rules("initialbalance","Initial Balance","trim");
        $this->form_validation->set_rules("location","Location","trim");
        $this->form_validation->set_rules("user","User","trim");
        if($this->form_validation->run()==FALSE)
        {
            $data["alerterror"]=validation_errors();
            $data[ 'status' ] =$this->user_model->getstatusdropdown();
            $data['accesslevel']=$this->user_model->getaccesslevels();
            $data[ 'logintype' ] =$this->user_model->getlogintypedropdown();
            $data[ 'gender' ] =$this->user_model->getgenderdropdown();
            $data[ 'user' ] =$this->user_model->getuserdropdown();
            $data['manager']=$this->user_model->getmanagerdropdown();
            $data['before']=$this->user_model->beforeedit($this->session->userdata('id'));
            $data['beforehotel']=$this->hotel_model->beforeedit($this->session->userdata('hotel'));
            $managerid=$data['before']->manager;
            $data['executive']=$this->user_model->getexecutivedropdownbymanagerid($managerid);
            $data['page']='edithoteluserbyhotel';
            $data['page2']='block/userblock';
            $data['title']='Edit Profile';
            $this->load->view('template',$data);
        }
        else
        {
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            $initialbalance=$this->input->get_post("initialbalance");
            $location=$this->input->get_post("location");
            $address=$this->input->get_post("address");
            $user=$this->input->get_post("user");
            
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
            $image=$this->hotel_model->gethotelimagebyid($id);
               // print_r($image);
                $image=$image->image;
            }
            if($this->hotel_model->edit($id,$name,$initialbalance,$location,$user,$address,$image)==0)
                $data["alerterror"]="New hotel could not be Updated.";
            else
                $data["alertsuccess"]="hotel Updated Successfully.";
            $data["redirect"]="site/edithoteluserbyhotel";
            $this->load->view("redirect",$data);
        }
    }
    
    //csv
    
    public function exportordercsvbyhotel()
	{
		$access = array("3");
		$this->checkaccess($access);
		$this->order_model->exportordercsvbyhotel();
        $data['redirect']="site/viewhotelorderbyhotel";
		//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}

    public function exportordercsvbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
		$this->order_model->exportordercsvbyadmin();
        $data['redirect']="site/vieworder";
		//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}

    public function exportordercsvbyadmin1()
	{
		$access = array("1","3");
		$this->checkaccess($access);
//		$this->order_model->exportordercsvbyadmin();
//        $data['redirect']="site/vieworder";
//		//$data['other']="template=$template";
//		$this->load->view("redirect",$data);
        $hotelid=$this->session->userdata('hotel');
        $hotelname="";
        if($hotelid=="" || $hotelid==0)
        {
        }
        else
        {
        $hoteldetails=$this->hotel_model->beforeedit($hotelid);
        $hotelname=$hoteldetails->name;
        }
        $this->load->library('export');
////        $this->load->model('mymodel');
        $sql = $this->order_model->exportordercsvbyadmin1();
//        print_r($sql);
        $this->export->to_excel($sql, 'check',$hotelname);
        
        
//        $this->load->plugin('to_excel');
//        $this->db->use_table('tablename');
//        $this->db->select('field1', 'field2');
        // run joins, order by, where, or anything else here
//        $query = $this->db->get();
//        to_excel($query, ['filename']);
//        to_excel($sql,'check');
	}

    public function exportordercsvbyhotel1()
	{
		$access = array("3");
		$this->checkaccess($access);
        $hotelid=$this->session->userdata('hotel');
        $hotelname="";
        if($hotelid=="" || $hotelid==0)
        {
        }
        else
        {
        $hoteldetails=$this->hotel_model->beforeedit($hotelid);
        $hotelname=$hoteldetails->name;
        }
        $this->load->library('export');
        $sql = $this->order_model->exportordercsvbyhotel1();
        $this->export->to_excel($sql, 'byhotel',$hotelname);
        
	}

    public function exportorderexcelbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
        $this->load->library('exportorderforadmin');
        $sql = $this->order_model->exportorderforadmin();
        $this->exportorderforadmin->to_excel($sql, 'orderDetails');
        
	}

    public function exporttransactionbyadmin()
	{
		$access = array("1","3");
		$this->checkaccess($access);
        $this->load->library('transactionbyadmin');
        $hotelname="";
        $sql = $this->transaction_model->exporttransactionbyadmin();
//        print_r($sql);
        $this->transactionbyadmin->to_excel($sql, 'transactionByAdmin');
        
	}
    public function exporttransactionbyhotel()
	{
		$access = array("3");
		$this->checkaccess($access);
        $hotelid=$this->session->userdata('hotel');
        $hotelname="";
        if($hotelid=="" || $hotelid==0)
        {
        }
        else
        {
            $hoteldetails=$this->hotel_model->beforeedit($hotelid);
            $hotelname=$hoteldetails->name;
        }
        $this->load->library('transactionbyhotel');
        $sql = $this->transaction_model->exporttransactionbyhotel();
//        print_r($sql);
        $this->transactionbyhotel->to_excel($sql, 'transactionByHotel',$hotelname);
        
	}
    
    
    
	function printorderinvoice()
	{
		$access = array("1","3");
		$this->checkaccess($access);
		$data[ 'table' ] =$this->order_model->getorderdetails($this->input->get('id'));
//		$data['before']=$this->order_model->beforeedit($this->input->get('id'));
        $data['id']=$this->input->get('id');
		$data['page']='orderinvoice';
		$this->load->view('templateinvoice',$data);
	}
    

    //manager accesslevel
    
	public function managerdashboard()
	{
		$access = array("4");
		$this->checkaccess($access);
        $data['page'] = 'managerdashboard';
		$data[ 'title' ] = 'Welcome';
		$this->load->view( 'template', $data );	
	}
    
	
//	public function viewtraineebymanager()
//	{
//		$access = array("4");
//		$this->checkaccess($access);
//        $data['page'] = 'viewtraineebymanager';
//		$data[ 'table' ] =$this->user_model->viewtraineebymanager($this->session->userdata('id'));
//		$data[ 'title' ] = 'View All Trainee';
//		$this->load->view( 'template', $data );	
//	}
    function viewtraineebymanager()
	{
		$access = array("4");
		$this->checkaccess($access);
		$data['page']='viewtraineebymanager';
        $data['base_url'] = site_url("site/viewtraineebymanagerjson");
        
		$data['title']='View traineebymanager';
		$this->load->view('template',$data);
	} 
    function viewtraineebymanagerjson()
	{
        $manager=$this->session->userdata('id');
        
		$access = array("4");
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
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","WHERE `user`.`manager`='$manager' AND `user`.`accesslevel`=5");
        
		$this->load->view("json",$data);
	} 
    function viewexecutiveoftraineebymanager()
	{
		$access = array("4");
		$this->checkaccess($access);
		$data['page']='viewexecutiveoftraineebymanager';
        $id=$this->input->get('id');
        $data['base_url'] = site_url("site/viewexecutiveoftraineebymanagerjson?id=".$id);
        
		$data['title']='View Executive Of Trainee';
		$this->load->view('template',$data);
	} 
    function viewexecutiveoftraineebymanagerjson()
	{
        $id=$this->input->get('id');
        
		$access = array("4");
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
       
        $elements[8]=new stdClass();
        $elements[8]->field="`user`.`points`";
        $elements[8]->sort="1";
        $elements[8]->header="points";
        $elements[8]->alias="points";
       
        
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
       
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `user` LEFT OUTER JOIN `logintype` ON `logintype`.`id`=`user`.`logintype` LEFT OUTER JOIN `accesslevel` ON `accesslevel`.`id`=`user`.`accesslevel` LEFT OUTER JOIN `statuses` ON `statuses`.`id`=`user`.`status`","WHERE `user`.`trainee`='$id' AND (`user`.`accesslevel`=5 OR `user`.`accesslevel`=6) ");
        
		$this->load->view("json",$data);
	} 
    
    public function viewuserhotelorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewuserhotelorder";
        $data["title"]="Order Details";
        $orderid=$this->input->get("orderid");
        $hotelid=$this->input->get("hotelid");
        $userid=$this->input->get("userid");
        $data['userid']=$userid;
        $data['hotelid']=$hotelid;
        $data['orderid']=$orderid;
        $data["before"]=$this->order_model->getuserhotelorderdetails($orderid,$hotelid);
        $this->load->view("template",$data);
    }
    
    public function viewallordersforuser()
    {
        $access=array("1");
        $this->checkaccess($access);
        $userid=$this->input->get('userid');
        $data["page"]="viewallordersforuser";
        $data['totalorderamount']=$this->order_model->gettotalamountofuser($userid);
        $data["base_url"]=site_url("site/viewallordersforuserjson?userid=".$userid);
        $data["title"]="View order";
        $this->load->view("template",$data);
    }
    function viewallordersforuserjson()
    {
        $userid=$this->input->get('userid');
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
        
        $elements[12]=new stdClass();
        $elements[12]->field="`orderstatus`.`name`";
        $elements[12]->sort="1";
        $elements[12]->header="statusname";
        $elements[12]->alias="statusname";
        
        $elements[13]=new stdClass();
        $elements[13]->field="`hotel_order`.`timestamp`";
        $elements[13]->sort="1";
        $elements[13]->header="timestamp";
        $elements[13]->alias="timestamp";
        
        $elements[14]=new stdClass();
        $elements[14]->field="`hotel_order`.`checkin`";
        $elements[14]->sort="1";
        $elements[14]->header="checkin";
        $elements[14]->alias="checkin";
        
        $elements[15]=new stdClass();
        $elements[15]->field="`hotel_order`.`checkout`";
        $elements[15]->sort="1";
        $elements[15]->header="checkout";
        $elements[15]->alias="checkout";
        
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
            $orderby="timestamp";
            $orderorder="DESC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_order` LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status`","WHERE `hotel_order`.`user`='$userid'");
        $this->load->view("json",$data);
    }
    
    public function viewtodayorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewtodayorder";
        $data["base_url"]=site_url("site/viewtodayorderjson");
        $data["title"]="View order";
        $this->load->view("template",$data);
    }
    function viewtodayorderjson()
    {
        $date = date("Y-m-d");
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
        
        $elements[12]=new stdClass();
        $elements[12]->field="`orderstatus`.`name`";
        $elements[12]->sort="1";
        $elements[12]->header="statusname";
        $elements[12]->alias="statusname";
        
        $elements[13]=new stdClass();
        $elements[13]->field="`hotel_order`.`timestamp`";
        $elements[13]->sort="1";
        $elements[13]->header="timestamp";
        $elements[13]->alias="timestamp";
        
        $elements[14]=new stdClass();
        $elements[14]->field="`hotel_order`.`checkin`";
        $elements[14]->sort="1";
        $elements[14]->header="checkin";
        $elements[14]->alias="checkin";
        
        $elements[15]=new stdClass();
        $elements[15]->field="`hotel_order`.`checkout`";
        $elements[15]->sort="1";
        $elements[15]->header="checkout";
        $elements[15]->alias="checkout";
        
        $elements[16]=new stdClass();
        $elements[16]->field="`tab1`.`contact`";
        $elements[16]->sort="1";
        $elements[16]->header="contact";
        $elements[16]->alias="contact";
        
        $elements[17]=new stdClass();
        $elements[17]->field="`tab1`.`contact`";
        $elements[17]->sort="1";
        $elements[17]->header="contact";
        $elements[17]->alias="contact";
        
        $elements[18]=new stdClass();
        $elements[18]->field="`tab1`.`mobile`";
        $elements[18]->sort="1";
        $elements[18]->header="mobile";
        $elements[18]->alias="mobile";
        
        $elements[19]=new stdClass();
        $elements[19]->field="`tab1`.`vouchernumber`";
        $elements[19]->sort="1";
        $elements[19]->header="vouchernumber";
        $elements[19]->alias="vouchernumber";
        
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
            $orderby="timestamp";
            $orderorder="DESC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_order` LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status`","WHERE `hotel_order`.`checkin`='$date'");
        $this->load->view("json",$data);
    }

    
    public function viewtomorroworder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewtomorroworder";
        $data["base_url"]=site_url("site/viewtomorroworderjson");
        $data["title"]="View order";
        $this->load->view("template",$data);
    }
    function viewtomorroworderjson()
    {
        $date = date("Y-m-d", strtotime("tomorrow"));
//        echo $date;
//        $today=NOW();
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
        
        $elements[12]=new stdClass();
        $elements[12]->field="`orderstatus`.`name`";
        $elements[12]->sort="1";
        $elements[12]->header="statusname";
        $elements[12]->alias="statusname";
        
        $elements[13]=new stdClass();
        $elements[13]->field="`hotel_order`.`timestamp`";
        $elements[13]->sort="1";
        $elements[13]->header="timestamp";
        $elements[13]->alias="timestamp";
        
        $elements[14]=new stdClass();
        $elements[14]->field="`hotel_order`.`checkin`";
        $elements[14]->sort="1";
        $elements[14]->header="checkin";
        $elements[14]->alias="checkin";
        
        $elements[15]=new stdClass();
        $elements[15]->field="`hotel_order`.`checkout`";
        $elements[15]->sort="1";
        $elements[15]->header="checkout";
        $elements[15]->alias="checkout";
        
        $elements[16]=new stdClass();
        $elements[16]->field="`tab1`.`contact`";
        $elements[16]->sort="1";
        $elements[16]->header="contact";
        $elements[16]->alias="contact";
        
        $elements[17]=new stdClass();
        $elements[17]->field="`tab1`.`contact`";
        $elements[17]->sort="1";
        $elements[17]->header="contact";
        $elements[17]->alias="contact";
        
        $elements[18]=new stdClass();
        $elements[18]->field="`tab1`.`mobile`";
        $elements[18]->sort="1";
        $elements[18]->header="mobile";
        $elements[18]->alias="mobile";
        
        $elements[19]=new stdClass();
        $elements[19]->field="`tab1`.`vouchernumber`";
        $elements[19]->sort="1";
        $elements[19]->header="vouchernumber";
        $elements[19]->alias="vouchernumber";
        
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
            $orderby="timestamp";
            $orderorder="DESC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_order` LEFT OUTER JOIN `user` AS `tab1` ON `hotel_order`.`user`=`tab1`.`id` LEFT OUTER JOIN `user` AS `tab2` ON `tab2`.`id`=`hotel_order`.`admin` LEFT OUTER JOIN `hotel_hotel` ON `hotel_hotel`.`id`=`hotel_order`.`hotel` LEFT OUTER JOIN `orderstatus` ON `orderstatus`.`id`=`hotel_order`.`status`","WHERE `hotel_order`.`checkin`='$date'");
        $this->load->view("json",$data);
    }
function changeorderstatusbyhotel()
	{
		$access = array("1","3");
		$this->checkaccess($access);
		$this->hotel_model->changeorderstatusbyhotel($this->input->get('id'));
		$data['alertsuccess']="Status Changed Successfully";
		$data['redirect']="site/viewhotelorderbyhotel";
		//$data['other']="template=$template";
		$this->load->view("redirect",$data);
	}

    //reports for admin
    
	function vieworderreportbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['hotel']=$this->hotel_model->gethoteldropdown();
		$data['page']='vieworderreportbyadmin';
		$data['title']='Order Excel';
		$this->load->view('template',$data);
	}
    
	function vieworderreportbyhotel()
	{
		$access = array("3");
		$this->checkaccess($access);
		$data['hotel']=$this->hotel_model->gethoteldropdown();
		$data['page']='vieworderreportbyhotel';
		$data['title']='Order Excel';
		$this->load->view('template',$data);
	}
    
	function viewtransactionreportbyadmin()
	{
		$access = array("1");
		$this->checkaccess($access);
		$data['hotel']=$this->hotel_model->gethoteldropdown();
		$data['page']='viewtransactionreportbyadmin';
		$data['title']='Order Excel';
		$this->load->view('template',$data);
	}
    
	function viewtransactionreportbyhotel()
	{
		$access = array("3");
		$this->checkaccess($access);
		$data['hotel']=$this->hotel_model->gethoteldropdown();
		$data['page']='viewtransactionreportbyhotel';
		$data['title']='Order Excel';
		$this->load->view('template',$data);
	}
    
//    	public function createorderreportbyadminsubmit()
//	{
//		$access = array("1");
//		$this->checkaccess($access);
//        $hotel=$this->input->post('hotel');
//        $startdate=$this->input->post('startdate');
//        $enddate=$this->input->post('enddate');
//		$this->order_model->exportorderreportbyadmincsv($hotel,$startdate,$enddate);
//            
//        $data['hotel']=$this->hotel_model->gethoteldropdown();
//		$data['page']='vieworderreportbyadmin';
//		$data['title']='Order Excel';
//		$this->load->view('template',$data);
//	}
    
    
    public function createorderreportbyadminsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        $hotel=$this->input->post('hotel');
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        
        $timestamp=new DateTime();
        $timestamp=$timestamp->format('Y-m-d_H.i.s');
        
        $this->load->library('exportorderreportbyadmin');
        $sql = $this->order_model->exportorderreportbyadmin($hotel,$startdate,$enddate);
        $sql2 = $this->order_model->exportorderreportbyadmintotal($hotel,$startdate,$enddate);
        $name="Order Reports_".$timestamp;
        $this->exportorderreportbyadmin->to_excel($sql, $name, $sql2);
	}
    
    public function createorderreportbyhotelsubmit()
	{
		$access = array("3");
		$this->checkaccess($access);
        
        $hotel=$this->session->userdata('hotel');
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        
        $timestamp=new DateTime();
        $timestamp=$timestamp->format('Y-m-d_H.i.s');
        
        $this->load->library('exportorderreportbyhotel');
        $sql = $this->order_model->exportorderreportbyhotel($hotel,$startdate,$enddate);
        $sql2 = $this->order_model->exportorderreportbyhoteltotal($hotel,$startdate,$enddate);
        $name="Order Reports_".$timestamp;
        $this->exportorderreportbyhotel->to_excel($sql, $name,$sql2);
	}
    
    public function createtransactionreportbyadminsubmit()
	{
		$access = array("1");
		$this->checkaccess($access);
        
        $hotel=$this->input->post('hotel');
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        
        $timestamp=new DateTime();
        $timestamp=$timestamp->format('Y-m-d_H.i.s');
        
        $this->load->library('exporttransactionreportbyadmin');
        $sql = $this->transaction_model->exporttransactionreportbyadmin($hotel,$startdate,$enddate);
        $sql2 = $this->transaction_model->exporttransactionreportbyadmintotal($hotel,$startdate,$enddate);
        $name="Transaction Reports_".$timestamp;
        $this->exporttransactionreportbyadmin->to_excel($sql, $name,$sql2);
	}
    public function createtransactionreportbyhotelsubmit()
	{
		$access = array("3");
		$this->checkaccess($access);
        
        $hotel=$this->session->userdata('hotel');
        $startdate=$this->input->post('startdate');
        $enddate=$this->input->post('enddate');
        
        $timestamp=new DateTime();
        $timestamp=$timestamp->format('Y-m-d_H.i.s');
        
        $this->load->library('exporttransactionreportbyadmin');
        $sql = $this->transaction_model->exporttransactionreportbyhotel($hotel,$startdate,$enddate);
        $sql2 = $this->transaction_model->exporttransactionreportbyhoteltotal($hotel,$startdate,$enddate);
        $name="Transaction Reports_".$timestamp;
        $this->exporttransactionreportbyadmin->to_excel($sql, $name,$sql2);
	}
    
    // PAYMENT ORDER BY POOJA
    
     public function viewpaymentorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="viewpaymentorder";
        $data["base_url"]=site_url("site/viewpaymentorderjson");
        $data["title"]="View paymentorder";
        $this->load->view("template",$data);
    }
    function viewpaymentorderjson()
    {
        $elements=array();
        $elements[0]=new stdClass();
        $elements[0]->field="`paymentorder`.`id`";
        $elements[0]->sort="1";
        $elements[0]->header="ID";
        $elements[0]->alias="id";
        
        $elements[1]=new stdClass();
        $elements[1]->field="`paymentorder`.`name`";
        $elements[1]->sort="1";
        $elements[1]->header="Name";
        $elements[1]->alias="name";
        
        $elements[2]=new stdClass();
        $elements[2]->field="`paymentorder`.`email`";
        $elements[2]->sort="1";
        $elements[2]->header="Email";
        $elements[2]->alias="email";
        
        $elements[3]=new stdClass();
        $elements[3]->field="`paymentorder`.`orderstatus`";
        $elements[3]->sort="1";
        $elements[3]->header="Status";
        $elements[3]->alias="orderstatus";
        
        $elements[4]=new stdClass();
        $elements[4]->field="`paymentorder`.`transactionid`";
        $elements[4]->sort="1";
        $elements[4]->header="Transactionid";
        $elements[4]->alias="transactionid";
        
        $elements[5]=new stdClass();
        $elements[5]->field="`paymentorder`.`billingcontact`";
        $elements[5]->sort="1";
        $elements[5]->header="Contact";
        $elements[5]->alias="billingcontact";
        
        $elements[6]=new stdClass();
        $elements[6]->field="`user`.`name`";
        $elements[6]->sort="1";
        $elements[6]->header="User";
        $elements[6]->alias="user";
        
        $elements[7]=new stdClass();
        $elements[7]->field="`paymentorder`.`timestamp`";
        $elements[7]->sort="1";
        $elements[7]->header="Timestamp";
        $elements[7]->alias="timestamp"; 
        
        $elements[8]=new stdClass();
        $elements[8]->field="`paymentorder`.`amount`";
        $elements[8]->sort="1";
        $elements[8]->header="Amount";
        $elements[8]->alias="amount";
        
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
            $orderby="timestamp";
            $orderorder="DESC";
        }
        $data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `paymentorder` LEFT OUTER JOIN `user` ON `user`.`id`=`paymentorder`.`user`");
        $this->load->view("json",$data);
    }

    public function createpaymentorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="createpaymentorder";
        $data["title"]="Create paymentorder";
        $data['user']=$this->user_model->getuserdropdown();
        $data['admin']=$this->user_model->getadmindropdown();
        $data['orderstatus']=$this->paymentorder_model->getpaymentorderstatusdropdown();
        $data['hotel']=$this->hotel_model->gethoteldropdown();
        $this->load->view("template",$data);
    }
    public function createpaymentordersubmit() 
    {
        $access=array("1");
        $this->checkaccess($access);
            $name=$this->input->get_post("name");
            $billingaddress=$this->input->get_post("billingaddress");
            $billingcity=$this->input->get_post("billingcity");
            $billingstate=$this->input->get_post("billingstate");
            $billingzipcode=$this->input->get_post("billingzipcode");
            $billingcontact=$this->input->get_post("billingcontact");
            $email=$this->input->get_post("email");
            $transactionid=$this->input->get_post("transactionid");
            $orderstatus=$this->input->get_post("orderstatus");
            $user=$this->input->get_post("user");
            $billingcountry=$this->input->get_post("billingcountry");
            $amount=$this->input->get_post("amount");
            $checkindate=$this->input->get_post("checkindate");
            $checkoutdate=$this->input->get_post("checkoutdate");
            $resort=$this->input->get_post("resort");
            $noofpacks=$this->input->get_post("noofpacks");
            $noofchildrenabove5=$this->input->get_post("noofchildrenabove5");
            if($this->paymentorder_model->create($name,$billingaddress,$billingcity,$billingstate,$billingzipcode,$billingcontact,$email,$transactionid,$orderstatus,$user,$billingcountry,$amount,$checkindate,$checkoutdate,$resort,$noofpacks,$noofchildrenabove5)==0)
            $data["alerterror"]="New paymentorder could not be created.";
            else
            $data["alertsuccess"]="paymentorder created Successfully.";
            $data["redirect"]="site/viewpaymentorder";
            $this->load->view("redirect",$data);
        
    }
    public function editpaymentorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $data["page"]="editpaymentorder";
        $data["title"]="Edit paymentorder";
        $data['user']=$this->user_model->getuserdropdown();
        $data['orderstatus']=$this->paymentorder_model->getpaymentorderstatusdropdown();
        $data['hotel']=$this->hotel_model->gethoteldropdown();
        $data["before"]=$this->paymentorder_model->beforeedit($this->input->get("id"));
        $this->load->view("template",$data);
    }
    public function editpaymentordersubmit()
    {
        $access=array("1");
        $this->checkaccess($access);
            $id=$this->input->get_post("id");
            $name=$this->input->get_post("name");
            $billingaddress=$this->input->get_post("billingaddress");
            $billingcity=$this->input->get_post("billingcity");
            $billingstate=$this->input->get_post("billingstate");
            $billingzipcode=$this->input->get_post("billingzipcode");
            $billingcontact=$this->input->get_post("billingcontact");
            $email=$this->input->get_post("email");
            $transactionid=$this->input->get_post("transactionid");
            $orderstatus=$this->input->get_post("orderstatus");
            $user=$this->input->get_post("user");
            $billingcountry=$this->input->get_post("billingcountry");
            $amount=$this->input->get_post("amount");
            $timestamp=$this->input->get_post("timestamp");
            $checkindate=$this->input->get_post("checkindate");
            $checkoutdate=$this->input->get_post("checkoutdate");
            $resort=$this->input->get_post("resort");
            $noofpacks=$this->input->get_post("noofpacks");
            $noofchildrenabove5=$this->input->get_post("noofchildrenabove5");
            if($this->paymentorder_model->edit($id,$name,$billingaddress,$billingcity,$billingstate,$billingzipcode,$billingcontact,$email,$transactionid,$orderstatus,$user,$billingcountry,$amount,$timestamp,$checkindate,$checkoutdate,$resort,$noofpacks,$noofchildrenabove5)==0)
                $data["alerterror"]="New paymentorder could not be Updated.";
            else
                $data["alertsuccess"]="paymentorder Updated Successfully.";
            $data["redirect"]="site/viewpaymentorder";
            $this->load->view("redirect",$data);
        
    }
    
    public function deletepaymentorder()
    {
        $access=array("1");
        $this->checkaccess($access);
        $this->paymentorder_model->delete($this->input->get("id"));
        $data["redirect"]="site/viewpaymentorder";
        $this->load->view("redirect",$data);
    }
}
?>
