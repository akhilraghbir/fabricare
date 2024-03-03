<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Refund_policy extends CI_Controller {


	public function __construct(){
		parent::__construct();
		check_UserSession();
    } 

	public function loadBreadCrumbs(){
		$data=array();
		$data['icon_class']="icon-user";
		$data['title']="Refund Policy";
		$data['helptext']="This Page Is Used To Manage Refund Policy.";
		$data['actions']['add']=CONFIG_SERVER_ADMIN_ROOT.'refund_policy';
		$data['actions']['list']=CONFIG_SERVER_ADMIN_ROOT.'refund_policy';
		return $data;
	}

	public function index(){
		
		$data['breadcrumbs'] = $this->loadBreadCrumbs(); 
		$data['refund_policy'] = $this->Common_model->getDataFromTable('tbl_refund_policy','id,description', $whereField='', $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
		
		$this->home_template->load('home_template','admin/refund_policy',$data);  
		
	}
	
	
	
	public function refund_policy(){
	    if($_POST){
	         $data['description'] = $_POST['description_p'];
			 $data['updated_by'] = $this->session->id;
			 $data['updated_on'] = current_datetime();
		
	        $id = $_POST['id'];
		  
			$this->Common_model->updateDataFromTable('tbl_refund_policy',$data,'id',$id);
			$this->messages->setMessage('Refund Policy Updated Successfully','success');
			redirect(base_url('administrator/refund_policy'));
	    }

	 
	}
	
}
