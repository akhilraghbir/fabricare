<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_conditions extends CI_Controller {


	public function __construct(){
		parent::__construct();
		check_UserSession();
    } 

	public function loadBreadCrumbs(){
		$data=array();
		$data['icon_class']="icon-user";
		$data['title']="Terms and Conditions";
		$data['helptext']="This Page Is Used To Manage Terms and Conditions.";
		$data['actions']['add']=CONFIG_SERVER_ADMIN_ROOT.'terms_conditions';
		$data['actions']['list']=CONFIG_SERVER_ADMIN_ROOT.'terms_conditions';
		return $data;
	}

	public function index(){
		
		$data['breadcrumbs'] = $this->loadBreadCrumbs(); 
		$data['terms_conditions'] = $this->Common_model->getDataFromTable('tbl_terms_conditions','id,description', $whereField='', $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
		
		$this->home_template->load('home_template','admin/terms_conditions',$data);  
		
	}
	
	
	
	public function terms_conditions(){
	    if($_POST){
	         $data['description'] = $_POST['description_p'];
			 $data['updated_by'] = $this->session->id;
			 $data['updated_on'] = current_datetime();
		
	        $id = $_POST['id'];
		  
			$this->Common_model->updateDataFromTable('tbl_terms_conditions',$data,'id',$id);
			$this->messages->setMessage('Terms and Conditions Updated Successfully','success');
			redirect(base_url('administrator/terms_conditions'));
	    }

	 
	}
	
}