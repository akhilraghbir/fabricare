<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct(){
		parent::__construct();
    } 

    public function index(){
        $data['sliders'] = $this->Common_model->getDataFromTable('tbl_banners','*', $whereField='status', $whereValue='Active', $orderBy='', $order='', $limit='', $offset=0, true);
        $data['services'] = $this->Common_model->getDataFromTable('tbl_services','*', $whereField='status', $whereValue='Active', $orderBy='', $order='', $limit='', $offset=0, true);
        $this->home_template->load('front_template','home',$data); 
    }

    public function login(){
        $this->home_template->load('front_template','user_login'); 
    }

    public function about(){
        $this->home_template->load('front_template','about');        
    }

    public function services(){
        $this->home_template->load('front_template','services');        
    }

    public function schedule_pickup(){
        $this->home_template->load('front_template','schedule_pickup');
    }

    public function terms_and_conditions(){
        $data['terms_conditions'] = $this->Common_model->getDataFromTable('tbl_cms','*', $whereField='desc_type', $whereValue='terms_conditions', $orderBy='', $order='', $limit='', $offset=0, true);
        $this->home_template->load('front_template','terms_and_conditions',$data);
    }
    public function privacy_policy(){
        $data['privacy_policy'] = $this->Common_model->getDataFromTable('tbl_cms','*', $whereField='desc_type', $whereValue='privacy_policy', $orderBy='', $order='', $limit='', $offset=0, true);
        $this->home_template->load('front_template','privacy_policy',$data);
    }
    public function refund_policy(){
        $data['refund_policy'] = $this->Common_model->getDataFromTable('tbl_cms','*', $whereField='desc_type', $whereValue='refund_policy', $orderBy='', $order='', $limit='', $offset=0, true);
        $this->home_template->load('front_template','refund_policy',$data);
    }
    public function cancellation_policy(){
        $data['cancellation_policy'] = $this->Common_model->getDataFromTable('tbl_cms','*', $whereField='desc_type', $whereValue='cancellation_policy', $orderBy='', $order='', $limit='', $offset=0, true);
        $this->home_template->load('front_template','cancellation_policy',$data);
    }


    public function forgot_password(){
        $this->home_template->load('front_template','forgotpassword');
    }


    public function contact(){
        if($_POST)
          {
              $this->form_validation->set_session_data($this->input->post());
              $this->form_validation->checkXssValidation($this->input->post());
              $mandatoryFields=array('name','email_id','phno','message');    
              foreach($mandatoryFields as $row){
                  $fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
                  $this->form_validation->set_rules($row, $fieldname, 'required'); 
              }
              if($this->form_validation->run() == FALSE){
                  $this->form_validation->set_session_data($this->input->post());
                   $errorMessage=validation_errors();
                  $this->session->set_flashdata('emsg',$errorMessage);
                 redirect(base_url('contact'));
              }
              else{
                   foreach($this->input->post() as $fieldname=>$fieldvalue){
                      $data[$fieldname]= $this->input->post($fieldname);
                  }
                  $data['created_on'] = current_datetime();
                  $res =  $this->Common_model->addDataIntoTable('tbl_enquiries',$data);
                  $this->form_validation->clear_field_data();
                  $this->session->set_flashdata('smsg','Query Submitted Successfully');
                  redirect(base_url('contact'));
              }
          } else{
            $data['details'] = $this->Common_model->getDataFromTable('tbl_contact_details','*', $whereField='', $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);;
            $this->home_template->load('front_template','contact',$data); 
          }
    }

    public function validatePincode(){
        if($_POST){
            $data['pincode']=$where['zipcode'] = $this->input->post('pincode');
            $where['status'] = 'Active';
            $checkPincode = $this->Common_model->countResult($table='tbl_zipcodes',$field=$where,$value='', $limit=0,$groupBy = '');
            if($checkPincode>0){
                $this->session->set_userdata($data);
                $res['error'] = 0;
            }else{
                $res['error'] = 1;
            }
            echo json_encode($res);exit;
        }
    }
}
?>