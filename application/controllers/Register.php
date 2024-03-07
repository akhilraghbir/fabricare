<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct()
	{
        parent::__construct();
        //getcountrybyip();
        $this->load->model(['login_model'=>'login_model']);
	} 

    public function index(){
        if($_POST){
            $this->form_validation->set_session_data($this->input->post());
			$this->form_validation->checkXssValidation($this->input->post());
            $mandatoryFields=array('first_name','username','phno','password');    
            foreach($mandatoryFields as $row){
				$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
				$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
				$this->form_validation->set_session_data($this->input->post());
			     $errorMessage=validation_errors();
			    $this->session->set_flashdata('emsg',$errorMessage);
               redirect(base_url('register'));
			}else{
			    foreach($this->input->post() as $fieldname=>$fieldvalue){
                    $data[$fieldname]= $this->input->post($fieldname);
                }
                $data['status'] = 'Inactive';
                $data['password'] = hash('sha256',$data['password']);
                $data['user_type'] = 'User';
                $data['created_on'] = date('Y-m-d H:i:s'); 
                $result = $this->Common_model->check_exists('tbl_users','username',$data['username'],'','');
                if($result == 0){
                    $res =  $this->Common_model->addDataIntoTable('tbl_users',$data);  
                    $getTemplate = $this->Common_model->getDataFromTable('tbl_emailtemplates','*', $whereField='id', $whereValue='1',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                    $activationLink = base_url('activate-account/'.base64_encode($res));
                    $Subject = $getTemplate[0]['template_subject'];
                    $otherCC = $getTemplate[0]['other_emails'];
                    $emaildata['email_body'] = $getTemplate[0]['template_body'];
                    $emaildata['email_body'] = str_replace("##SITEURL##",base_url('login'),$emaildata['email_body']);
                    $emaildata['email_body'] = str_replace("##NAME##",$data['name'],$emaildata['email_body']);
                    $emaildata['email_body'] = str_replace("##SITENAME##",SITENAME,$emaildata['email_body']);
                    $emaildata['email_body'] = str_replace("##ACTIVATIONLINK##",$activationLink,$emaildata['email_body']);
                    $enduserHTML = $this->load->view('email_template',$emaildata,true);
                    $send = $this->Email_model->send($data['username'],$Subject,$enduserHTML,$otherCC);
                    $this->form_validation->clear_field_data();
                    $this->session->set_flashdata('smsg','Registered Successfully');
                    redirect(base_url('login'));
                }else{
                     $this->session->set_flashdata('emsg','Email already exists');
                     redirect(base_url('register'));
                }
			}
        }
        $data['meta_title'] = SITENAME;
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
        $this->home_template->load('front_template','register',$data);   
    }

    public function login(){
        if($_POST){
            if($_POST['username'] && $_POST['password']){
                $response = $this->login_model->validate_user($_POST);
                if($response=='Error'){
                    $this->session->set_flashdata('emsg','Invalid Username or Password');
                    redirect(base_url('login'));
                }else if($response=='Status Error'){
                    $this->session->set_flashdata('emsg','Your account is inactivated. Please contact admin');
                    redirect(base_url('login'));
                }else if($response=='Success'){
                    $updata = ['user_id'=>$this->session->id];
                    $this->Common_model->updateDataFromTabel('tbl_cart',$updata,'session_id',sessionId());
                    redirect(base_url());
                }
            }
        }
        $data['meta_title'] = "Login";
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
        $this->home_template->load('front_template','user_login',$data); 
    }
    
    public function forgot_password()
    {
        if($_POST)
        {
            $data['username'] = $this->input->post('username');
            $checkuser = $this->Common_model->check_exists('users','username',$data['username'],'','');
            if($checkuser==1)
            {
                $insdata['password_reset_token'] = substr(uniqid(),0,9);
                $insdata['password_reset_created'] = date('Y-m-d h:i:s');
                $data['record'] = $this->Common_model->getDataFromTable('users','*', $whereField='username', $whereValue=$data['username'],$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                $getTemplate = $this->Common_model->getDataFromTable('email_templates','*', $whereField='id', $whereValue='4',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                $password ='';
                $Subject = $getTemplate[0]['subject'];
                $otherCC = $getTemplate[0]['other_emails'];
                $emaildata['email_body'] = $getTemplate[0]['template_body'];

                $emaildata['email_body'] = str_replace("##NAME##",$data['record'][0]['name'],$emaildata['email_body']);
                $emaildata['email_body'] = str_replace("##SITEURL##",base_url(),$emaildata['email_body']);
                $emaildata['email_body'] = str_replace("##SITENAME##",SITENAME,$emaildata['email_body']);
                $emaildata['email_body'] = str_replace("##RESETURL##",base_url('userreset-password'),$emaildata['email_body']);
                $emaildata['email_body'] = str_replace("##TOKEN##",$insdata['password_reset_token'],$emaildata['email_body']);
                $emaildata['email_body'] = str_replace("##EMAIL##",$data['username'],$emaildata['email_body']);
                $emaildata['email_body'] = str_replace("##PASSWORD##",$password,$emaildata['email_body']);

                $enduserHTML = $this->load->view('admin/reset_password_email_template',$emaildata,true);
                $update =  $this->Common_model->updateDataFromTabel('users',$insdata,'id',$data['record'][0]['id']);
                $send = $this->Email_model->send($data['username'],$Subject,$enduserHTML,$otherCC);
                if(!$send)
                {
                  print_r($this->email->print_debugger());exit;
                }
                $this->session->set_flashdata('smsg','Reset Token sent to your email');
                redirect(base_url('login'));
            }else{
                $this->session->set_flashdata('emsg','Invalid Email Id');
                redirect(base_url('userforgot-password'));
            }
            
        }
         $data['meta_title'] = "Forgot Password";
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
         $this->frontend_template->load('frontend_template','forgot_password',$data); 
    }
    
    public function reset_password(){
        if($_POST)
        {
            $data['username'] = $this->input->post('username');
            $data['password_reset_token'] = $this->input->post('password_reset_token');
            $checkuser = $this->db->get_where('users',$data);
            if($checkuser->num_rows()==1)
            {
                $userdata = $checkuser->row();
                $created_date = strtotime($userdata->password_reset_created);
                $current_date = strtotime(date('Y-m-d h:i:s'));
                $diff = $current_date-$created_date;
                $hours = $diff/60/60;
                if($hours<=24)
                {
                    $updata['password'] = hash('sha256',$this->input->post('password')); 
                    $update =  $this->Common_model->updateDataFromTabel('users',$updata,'id',$userdata->id);
                    if($updata)
                    {
                        $this->session->set_flashdata('smsg','Password Updated Successfully');
                        redirect(base_url('login'));
                    }
                }else{
                    $this->session->set_flashdata('emsg','One Time Access Code Expired, Please Try Again');
                    redirect(base_url('userforgot-password'));
                }
            }else{
                $this->session->set_flashdata('emsg','Invalid Details, Please Try Again');
                redirect(base_url('userforgot-password'));
            }
        }
         $data['meta_title'] = "Reset Password";
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
         $this->frontend_template->load('frontend_template','reset_password',$data); 
    }
    
    public function my_account()
    {
        check_FUserSession();
        if($_POST)
        {
            $this->form_validation->set_session_data($this->input->post());
			$this->form_validation->checkXssValidation($this->input->post());
            $mandatoryFields=array('name','phno1','username');    
            foreach($mandatoryFields as $row){
				$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
				$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
				$this->form_validation->set_session_data($this->input->post());
			     $errorMessage=validation_errors();
			    $this->session->set_flashdata('emsg',$errorMessage);
               redirect(base_url('my-account'));
			}else{
                foreach($this->input->post() as $fieldname=>$fieldvalue){
                    $updata[$fieldname]= $this->input->post($fieldname);
                }
                $update =  $this->Common_model->updateDataFromTabel('users',$updata,'id',$this->session->id);
                if($updata)
                {
                    $this->session->set_flashdata('smsg','Details Updated Successfully');
                    redirect(base_url('my-account'));
                }
            }
        }
        if(isset($this->session->id) && $this->session->role=='User')
        {
            $data['meta_title'] = "My Account";
            $data['meta_keywords'] = SITENAME;
            $data['meta_description'] = SITENAME;
            $data['details'] = $this->Common_model->getDataFromTable('users','*', $whereField='id', $whereValue=$this->session->id,$orderBy='id', $order='DESC', $limit='', $offset=0, true);
             $data['refer'] = $this->Common_model->getDataFromTable('referal_options','*', $whereField='id', $whereValue='1',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
            $user_id = $this->session->id;
            $added_amount = $this->db->query("select sum(points) as total_add from user_referals where user_id='".$user_id."' and status='Added' ")->result_array();
            $debit_amount = $this->db->query("select sum(points) as total_add from user_referals where user_id='".$user_id."' and status='Deducted' ")->result_array();
            $data['refer_points'] = $added_amount[0]['total_add'] - $debit_amount[0]['total_add'];
            $this->frontend_template->load('frontend_template','my_account',$data); 
        }else{
            redirect(base_url());
        }
    }
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    
    public function activate_account($id){
        if(!empty($id)){
            $id = base64_decode($id);
            $user = $this->Common_model->getDataFromTable('tbl_users','id,email_verified', $whereField='id', $whereValue=$id,$orderBy='id', $order='DESC', $limit='', $offset=0, true);
            if($user[0]['email_verified'] == 'Yes'){
                $this->session->set_flashdata('smsg','Your Account Already Activated');
                redirect(base_url('login'));
            }else{
                $userUpdate['email_verified'] = 'Yes';
                $userUpdate['status'] = 'Active';
                $userUpdate['email_verified_on'] = current_datetime();
                $update =  $this->Common_model->updateDataFromTabel('tbl_users',$userUpdate,'id',$id);
                $this->session->set_flashdata('smsg','Your Account Activated Successfully');
                redirect(base_url('login'));
            }
        }else{
            redirect(base_url());
        }
    }
}
?>