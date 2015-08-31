<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");
class Json extends CI_Controller 
{function getallhotel()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`hotel_hotel`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`hotel_hotel`.`name`";
$elements[1]->sort="1";
$elements[1]->header="Name";
$elements[1]->alias="name";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`hotel_hotel`.`initialbalance`";
$elements[2]->sort="1";
$elements[2]->header="Initial Balance";
$elements[2]->alias="initialbalance";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`hotel_hotel`.`location`";
$elements[3]->sort="1";
$elements[3]->header="Location";
$elements[3]->alias="location";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`hotel_hotel`.`user`";
$elements[4]->sort="1";
$elements[4]->header="User";
$elements[4]->alias="user";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_hotel`");
$this->load->view("json",$data);
}
public function getsinglehotel()
{
$id=$this->input->get_post("id");
$data["message"]=$this->hotel_model->getsinglehotel($id);
$this->load->view("json",$data);
}
function getallorder()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`hotel_order`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`hotel_order`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`hotel_order`.`admin`";
$elements[2]->sort="1";
$elements[2]->header="Admin";
$elements[2]->alias="admin";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`hotel_order`.`hotel`";
$elements[3]->sort="1";
$elements[3]->header="Hotel";
$elements[3]->alias="hotel";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`hotel_order`.`days`";
$elements[4]->sort="1";
$elements[4]->header="Days";
$elements[4]->alias="days";

$elements=array();
$elements[5]=new stdClass();
$elements[5]->field="`hotel_order`.`userrate`";
$elements[5]->sort="1";
$elements[5]->header="User Rate";
$elements[5]->alias="userrate";

$elements=array();
$elements[6]=new stdClass();
$elements[6]->field="`hotel_order`.`hotelrate`";
$elements[6]->sort="1";
$elements[6]->header="Hotel Rate";
$elements[6]->alias="hotelrate";

$elements=array();
$elements[7]=new stdClass();
$elements[7]->field="`hotel_order`.`status`";
$elements[7]->sort="1";
$elements[7]->header="Status";
$elements[7]->alias="status";

$elements=array();
$elements[8]=new stdClass();
$elements[8]->field="`hotel_order`.`price`";
$elements[8]->sort="1";
$elements[8]->header="Price";
$elements[8]->alias="price";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_order`");
$this->load->view("json",$data);
}
public function getsingleorder()
{
$id=$this->input->get_post("id");
$data["message"]=$this->order_model->getsingleorder($id);
$this->load->view("json",$data);
}
function getalltransaction()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`hotel_transaction`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`hotel_transaction`.`user`";
$elements[1]->sort="1";
$elements[1]->header="User";
$elements[1]->alias="user";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`hotel_transaction`.`hotel`";
$elements[2]->sort="1";
$elements[2]->header="Hotel";
$elements[2]->alias="hotel";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`hotel_transaction`.`amount`";
$elements[3]->sort="1";
$elements[3]->header="Amount";
$elements[3]->alias="amount";

$elements=array();
$elements[4]=new stdClass();
$elements[4]->field="`hotel_transaction`.`status`";
$elements[4]->sort="1";
$elements[4]->header="Status";
$elements[4]->alias="status";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_transaction`");
$this->load->view("json",$data);
}
public function getsingletransaction()
{
$id=$this->input->get_post("id");
$data["message"]=$this->transaction_model->getsingletransaction($id);
$this->load->view("json",$data);
}
function getalllog()
{
$elements=array();
$elements[0]=new stdClass();
$elements[0]->field="`hotel_log`.`id`";
$elements[0]->sort="1";
$elements[0]->header="ID";
$elements[0]->alias="id";

$elements=array();
$elements[1]=new stdClass();
$elements[1]->field="`hotel_log`.`admin`";
$elements[1]->sort="1";
$elements[1]->header="Admin";
$elements[1]->alias="admin";

$elements=array();
$elements[2]=new stdClass();
$elements[2]->field="`hotel_log`.`user`";
$elements[2]->sort="1";
$elements[2]->header="User";
$elements[2]->alias="user";

$elements=array();
$elements[3]=new stdClass();
$elements[3]->field="`hotel_log`.`text`";
$elements[3]->sort="1";
$elements[3]->header="Text";
$elements[3]->alias="text";

$search=$this->input->get_post("search");
$pageno=$this->input->get_post("pageno");
$orderby=$this->input->get_post("orderby");
$orderorder=$this->input->get_post("orderorder");
$maxrow=$this->input->get_post("maxrow");
if($maxrow=="")
{
}
if($orderby=="")
{
$orderby="id";
$orderorder="ASC";
}
$data["message"]=$this->chintantable->query($pageno,$maxrow,$orderby,$orderorder,$search,$elements,"FROM `hotel_log`");
$this->load->view("json",$data);
}
 
public function loginfromback()
{
//$email=$this->input->get('email');
//$password=$this->input->get('password');
$adminuser=$this->db->query("SELECT * FROM `user` WHERE `status`=1 AND `accesslevel`=1")->row();
$email=$adminuser->email;
$id=$adminuser->id;
$name=$adminuser->name;
$accesslevel=$adminuser->accesslevel;
$newdata        = array(
'id' => $id,
'email' => $email,
'name' => $name ,
'accesslevel' => $accesslevel,
'logged_in' => 'true',
);
$this->session->set_userdata( $newdata );
redirect( base_url() . 'index.php/site', 'refresh' );
}
public function getsinglelog()
{
$id=$this->input->get_post("id");
$data["message"]=$this->log_model->getsinglelog($id);
$this->load->view("json",$data);
}
 
 public function payumoneysuccess()
 {
     $orderid=$this->input->get('orderid');
     $transactionid=$this->input->get_post('transactionid');
     $data['message']=$this->transaction_model->updateorderstatusafterpayment($orderid,$transactionid);
	 $this->load->view('json',$data);
 }
 public function payumoneysuccess1()
 {
     $orderid=$this->input->get('orderid');
     $transactionid=$this->input->get('transactionid');
     $data['message']=$this->restapi_model->updateorderstatusafterpayment($orderid,$transactionid);
       redirect('http://localhost/myholidays/#/thankyou', 'refresh');
	 $this->load->view('json',$data);
 }
 public function checkorderstatus()
 {
     $orderid=$this->input->get('orderid');
     $redirecturl=$this->input->get('redirecturl');
     $data['message']=$this->transaction_model->checkorderstatus($orderid);
     redirect($redirecturl, 'refresh');
	 $this->load->view('json',$data);
 }
 public function createprofile(){
 $data = json_decode(file_get_contents('php://input'), true);
$name=$data['name'];
$email=$data['email'];
$username=$data['username'];
$gender=$data['gender'];
$address=$data['address'];
$contact=$data['contact'];
$dob=$data['dob'];
$profession=$data['profession'];
$data['message']=$this->restapi_model->createprofile($name,$email,$username,$gender,$address,$contact,$dob,$profession);
$this->load->view('json',$data);
 }
 public function createpaymentorder(){
 $data = json_decode(file_get_contents('php://input'), true);
$user=$data['user'];
$name=$data['name'];
$email=$data['email'];
$amount=$data['amount'];
$billingaddress=$data['billingaddress'];
$billingcity=$data['billingcity'];
$billingstate=$data['billingstate'];
$billingzipcode=$data['billingzipcode'];
$billingcontact=$data['billingcontact'];
$billingcountry=$data['billingcountry'];
$data['message']=$this->restapi_model->createpaymentorder($user,$name,$email,$amount,$billingaddress,$billingcity,$billingstate,$billingzipcode,$billingcontact,$billingcountry);
$this->load->view('json',$data);
 }
  public function login(){
//  $voucherno=$this->input->get("voucherno");
//        $password=$this->input->get("password");
       $data = json_decode(file_get_contents('php://input'), true);
        $voucherno=$data['voucherno'];
        $password=$data['password'];
        $data['message']=$this->user_model->login($voucherno,$password);
        $this->load->view('json',$data);
 }
  public function authenticate() {
    $data['message']=$this->user_model->authenticate();
	 $this->load->view('json',$data);
        }
  public function logout()
    {
        $this->session->sess_destroy();
		$this->load->view('json',true);
    }
  public function checkstatus() {
      $orderid=$this->input->get('orderid');
    $data['message']=$this->paymentorder_model->checkstatus($orderid);
	 $this->load->view('json',$data);
        }
    }
 ?>