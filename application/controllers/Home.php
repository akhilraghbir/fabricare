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

    public function cart(){

        $orderByColumn = "tc.id";
        $sortType = 'DESC';
        $indexColumn='tc.id';
        $selectColumns = ['tc.*','tp.product_name','tp.image','ts.service_name'];
        $dataTableSortOrdering='';
        $table_name='tbl_cart as tc';
        $joinsArray[] = ['table_name'=>'tbl_products as tp','condition'=>"tp.id = tc.product_id",'join_type'=>'left'];
        $joinsArray[] = ['table_name'=>'tbl_services as ts','condition'=>"ts.id = tc.service_id",'join_type'=>'left'];
        $userid = userLoggedIn();
        if($userid){
            $whereCondition  = "tc.user_id=".$userid;
        }else{
            $whereCondition = "tc.session_id=".sessionId();
        }
        $listData = $this->Datatables_model->getDataFromDB($selectColumns,$dataTableSortOrdering,$table_name,$joinsArray,$whereCondition,$indexColumn,'',$orderByColumn,$sortType,true,'POST');
        $data['items'] = $listData['data'];
        $data['address'] = $this->Common_model->getDataFromTable('tbl_addresses','*',  $whereField=array('user_id'=>userLoggedIn(),'pincode'=>$this->session->pincode_id), $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
        $this->home_template->load('front_template','cart',$data);        
    }

    public function schedule_pickup(){
        $data['categories'] = $this->Common_model->getDataFromTable('tbl_categories','',  $whereField='parent_id', $whereValue=0, $orderBy='', $order='', $limit='', $offset=0, true);
        $this->home_template->load('front_template','schedule_pickup',$data);
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
            $data['pincode'] = $where['zipcode'] = $this->input->post('pincode');
            $where['status'] = 'Active';
            $checkPincode = $this->Common_model->getDataFromTable('tbl_zipcodes','id,zipcode,service_charge',  $whereField=$where, $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
            if(is_array($checkPincode) && count($checkPincode)>0){
                $data['service_charge'] = $checkPincode[0]['service_charge'];
                $data['pincode_id'] = $checkPincode[0]['id'];
                $this->session->set_userdata($data);
                $res['error'] = 0;
            }else{
                $res['error'] = 1;
            }
            echo json_encode($res);exit;
        }
    }

    public function getProducts(){
        if($_POST){
            $catid = $_POST['cat_id'];
            if($catid!=''){
                $data['categories'] = $this->Common_model->getDataFromTable('tbl_categories','id,category',  $whereField='parent_id', $whereValue=$catid, $orderBy='', $order='', $limit='', $offset=0, true);
                if(is_array($data['categories']) && count($data['categories'])){
                    $categories = array_column($data['categories'],'id');
                    $data['products'] = $this->Common_model->getDataFromTableWhereIn('tbl_products', $field='id,product_name,image,category_id',  $whereField='category_id', $whereValue=$categories, $orderBy='id', $order='ASC', $whereNotIn=0);
                    $productids = join("','",array_column($data['products'],'id'));
                    $data['services'] = $this->Common_model->getProductServiceWithPrices($productids);
                    $html = $this->load->view('getProducts',$data,true);
                    if($html!=''){
                        $res['html'] = $html;
                        $res['error'] = 0;
                    }
                }else{
                    $res['html'] = '';
                    $res['error'] = 0;
                }
            }else{
                $res['error'] = 1;
                $res['html'] = 'Invalid Param';
            }
            echo json_encode($res);
        }
    }

    public function addtocart(){
        if($_POST){
            foreach($this->input->post() as $fieldname=>$fieldvalue){
                $data[$fieldname]= $this->input->post($fieldname);
            }
            $userid = userLoggedIn();
            if($userid){
                $countwhere['user_id'] = $where['user_id'] = $data['user_id'] = $userid;
            }else{
                $countwhere['session_id'] = $where['session_id'] = $data['session_id'] = sessionId();
            }
            $where['product_id'] = $data['product_id'];
            $where['service_id'] = $data['service_id'];
            $data['created_on'] = current_datetime();
            $check = $this->Common_model->check_exists('tbl_cart',$where,'','','');
            if($check==0){
                $query =  $this->Common_model->addDataIntoTable('tbl_cart',$data);
                $res['msg'] = 'Product Added to Bag';
            }else{
                $query = $this->Common_model->updateDataFromTable('tbl_cart',['quantity'=>$data['quantity']],$where,'');
                $res['msg'] = 'Product Quantity Updated to Bag';
            }
            if($query){
                $res['error'] = 0;
                $res['count'] = $this->Common_model->check_exists('tbl_cart',$countwhere,'','','');
            }else{
                $res['error'] = 1;
                $res['msg'] = 'Something went wrong';
            }
            echo json_encode($res);exit;
        }
    }

    public function getCartCount(){
        $userid = userLoggedIn();
        if($userid){
            $countwhere['user_id'] = $userid;
        }else{
            $countwhere['session_id']  = sessionId();
        }
        $res['count'] = $this->Common_model->check_exists('tbl_cart',$countwhere,'','','');  
        $res['error'] = 0;
        echo json_encode($res);exit;
    }

    public function removecart(){
        if($_POST){
            $cartId = $this->input->post('cart_id');
            $del = $this->Common_model->deleteRowFromTable('tbl_cart', $field='id', $ID=$cartId, $limit=0);
            if($del){
                $res['error'] = 0;
                $res['html'] = $this->getCartPriceDetails();
            }else{
                $res['error'] = 1;
            }
            echo json_encode($res);
        }
    }

    public function updateCart(){
        if($_POST){
            $data['quantity'] = $_POST['qty'];
            $id = $_POST['cart_id'];
            $upd = $this->Common_model->updateDataFromTabel('tbl_cart',$data,'id',$id);
            if($upd){
                $res['error'] = 0;
                $res['html'] = $this->getCartPriceDetails();
            }else{
                $res['error'] = 1;
            }
            echo json_encode($res);exit;
        }
    }

    public function manage_addresses(){
        check_FUserSession();
        $data['meta_title'] = "Manage Address";
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
        $data['addresses'] = $this->Common_model->getDataFromTable('tbl_addresses','*',  $whereField=array('user_id'=>userLoggedIn()), $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
        $this->home_template->load('front_template','manage_address',$data); 
    }
    
    public function add_address(){
        check_FUserSession();
        $data['meta_title'] = "Add Address";
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
        if($_POST){
            $this->form_validation->set_session_data($this->input->post());
			$this->form_validation->checkXssValidation($this->input->post());
             $mandatoryFields=array('address_title','name','phone_number','email_address','address1','pincode');    
            foreach($mandatoryFields as $row){
				$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
				$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
				$this->form_validation->set_session_data($this->input->post());
			     $errorMessage=validation_errors();
			    $this->session->set_flashdata('emsg',$errorMessage);
               redirect(base_url('add-address'));
			}else{
                foreach($this->input->post() as $fieldname=>$fieldvalue){
                    $insdata[$fieldname]= $this->input->post($fieldname);
                }
                unset($insdata['submit']);
                $insdata['user_id'] = userLoggedIn();
                $insdata['created_on'] = date('Y-m-d h:i:s');
                $ins = $this->Common_model->addDataIntoTable('tbl_addresses',$insdata);
                if($ins){
                    $this->session->set_flashdata('smsg','Address Saved Successfully');
                    redirect(base_url('manage-address'));
                }
			}
        }
        $data['pincodes'] = $this->Common_model->getDataFromTable('tbl_zipcodes','id,zipcode',  $whereField=['status'=>'Active'], $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
        $this->home_template->load('front_template','add_address',$data);
    }
    
    public function edit_address($id){
        check_FUserSession();
        if(!empty($id)){
            $data['meta_title'] = "Edit Address";
            $data['meta_keywords'] = SITENAME;
            $data['meta_description'] = SITENAME;
            if($_POST){
            $this->form_validation->set_session_data($this->input->post());
			$this->form_validation->checkXssValidation($this->input->post());
            $mandatoryFields=array('address_title','name','phone_number','email_address','address1','pincode'); 
            foreach($mandatoryFields as $row){
				$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
				$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
				$this->form_validation->set_session_data($this->input->post());
			     $errorMessage=validation_errors();
			    $this->session->set_flashdata('emsg',$errorMessage);
               redirect(base_url('edit-address/'.$id));
			}else{
                foreach($this->input->post() as $fieldname=>$fieldvalue){
                    $insdata[$fieldname]= $this->input->post($fieldname);
                }
                unset($insdata['submit']);
                $ins = $this->Common_model->updateDataFromTabel('tbl_addresses',$insdata,'id',$id);
                if($ins){
                    $this->session->set_flashdata('smsg','Address Saved Successfully');
                    redirect(base_url('manage-address'));
                }
			}
        }
            $data['address'] = $this->Common_model->getDataFromTable('tbl_addresses','*',  $whereField=array('user_id'=>userLoggedIn(),'id'=>$id), $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
            $data['pincodes'] = $this->Common_model->getDataFromTable('tbl_zipcodes','id,zipcode',  $whereField=['status'=>'Active'], $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
            $this->home_template->load('front_template','add_address',$data);
        }
    }
    
    public function delete_address($id){
        check_FUserSession();
        if(!empty($id)){
            $del = $this->Common_model->deleteRowFromTable('tbl_addresses','id',$id,0);
            if($del){
                $this->session->set_flashdata('smsg','Address Delete Successfully');
                redirect(base_url('manage-address'));
            }
        }
    }

    public function getCartPriceDetails(){
        $userid = userLoggedIn();
        if($userid){
            $whereCondition['user_id']  = $userid;
        }else{
            $whereCondition['session_id'] = sessionId();
        }
        $data['service_charge'] = $this->session->service_charge;
        $data['items'] = $this->Common_model->getDataFromTable('tbl_cart','*',  $whereField=$whereCondition, $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
        return $html = $this->load->view('price_details',$data,true);
    }

    public function coupons(){
        check_FUserSession();
        $data['meta_title'] = "My Coupons";
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
        $whr['from_date<='] = date('Y-m-d');
        $whr['to_date>='] = date('Y-m-d');
        $data['coupons'] = $this->Common_model->getDataFromTable('tbl_promocodes','*',  $whereField=$whr, $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
        $this->home_template->load('front_template','coupons',$data);
    }

    public function applyCoupon(){
        if($_POST){
            $sub_total = $_POST['sub_total'];
            $where['promocode'] = $_POST['coupon'];
            $where['from_date<='] = date('Y-m-d');
            $where['to_date>='] = date('Y-m-d');
            $coupons = $this->Common_model->getDataFromTable('tbl_promocodes','*',  $whereField=$where, $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
            if(is_array($coupons) && count($coupons)>0){
                $mincart = $coupons[0]['min_cart_value'];
                if($mincart!=null && $sub_total<$mincart){
                    $res['error'] = 1;
                    $res['msg'] = '<span class="text-danger">Min Bag value should be '.$mincart.'</span>';        
                }else{
                    
                }
            }else{
                $res['error'] = 1;
                $res['msg'] = '<span class="text-danger">Invalid Coupon</span>';
            }
            echo json_encode($res);exit;
        }
    }
}
?>