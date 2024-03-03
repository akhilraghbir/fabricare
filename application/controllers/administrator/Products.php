<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {


	public function __construct(){
		parent::__construct();
		check_UserSession();
    } 

	public function loadBreadCrumbs(){
		$data=array();
		$data['icon_class']="icon-user";
		$data['title']="Products";
		$data['helptext']="This Page Is Used To Manage The Products.";
		$data['actions']['add']=CONFIG_SERVER_ADMIN_ROOT.'products/add';
		$data['actions']['list']=CONFIG_SERVER_ADMIN_ROOT.'products';
		return $data;
	}

	public function index(){
		$data['breadcrumbs'] = $this->loadBreadCrumbs(); 
		$this->home_template->load('home_template','admin/products',$data);   
	}

	public function loadUserForm($formContent=array(), $formName=''){
		$data['breadcrumbs'] = $this->loadBreadCrumbs();
		$data['data'] = $formContent;
		$data['form_action'] = $formName;
        $catwhere['parent_id!'] = null;
        $catwhere['status'] = 'Active';
 		$data['categories'] = $this->Common_model->getDataFromTable('tbl_categories','',  $whereField=$catwhere, $whereValue=null, $orderBy='', $order='', $limit='', $offset=0, true);
		$this->home_template->load('home_template','admin/products',$data); 
	}
}
?>