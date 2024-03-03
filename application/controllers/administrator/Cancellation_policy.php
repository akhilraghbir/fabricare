<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancellation_policy extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		check_UserSession();
    } 

	public function loadBreadCrumbs(){
		$data=array();
		$data['icon_class']="icon-user";
		$data['title']="Cancellation Policy";
		$data['helptext']="This Page Is Used To Manage Cancellation Policy.";
		$data['actions']['add']=CONFIG_SERVER_ADMIN_ROOT.'cancellation_policy';
		$data['actions']['list']=CONFIG_SERVER_ADMIN_ROOT.'cancellation_policy';
		return $data;
	}

	public function index(){
		
		$data['breadcrumbs'] = $this->loadBreadCrumbs(); 
		$data['cancellation_policy'] = $this->Common_model->getDataFromTable('tbl_cancellation_policy','id,description', $whereField='', $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
		
		$this->home_template->load('home_template','admin/cancellation_policy',$data);  
		
	}
	
	
	
	public function cancellation_policy(){
	    if($_POST){
	         $data['description'] = $_POST['description_p'];
			 $data['updated_by'] = $this->session->id;
			 $data['updated_on'] = current_datetime();
		
	        $id = $_POST['id'];
		  
			$this->Common_model->updateDataFromTable('tbl_cancellation_policy',$data,'id',$id);
			$this->messages->setMessage('Cancellation Policy Updated Successfully','success');
			redirect(base_url('administrator/cancellation_policy'));
	    }

	 
	}
	
}
