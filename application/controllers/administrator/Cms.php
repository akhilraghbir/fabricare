<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		check_UserSession();
    } 

	public function loadBreadCrumbs(){
		$data=array();
		$data['icon_class'] = "icon-settings";
		$data['title'] = "Cms";
		$data['helptext'] = "This Page Is Used To Manage The Cms.";
		$data['actions']['add'] = '';
		$data['actions']['list'] = '';
		return $data;
	}
/*
	public function index(){
		
		$data['breadcrumbs'] = $this->loadBreadCrumbs(); 
		$data['cancellation_policy'] = $this->Common_model->getDataFromTable('tbl_cancellation_policy','id,description', $whereField='', $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
		
		$this->home_template->load('home_template','admin/cancellation_policy',$data);  

		
	}*/
	
	
	
	public function privacy_policy(){


	    if($_POST){
	         $data['description'] = $_POST['description_p'];
			 $data['updated_by'] = $this->session->id;
			 $data['updated_on'] = current_datetime();
		
	         $id = $_POST['id'];
		  
			$this->Common_model->updateDataFromTable('tbl_cms',$data,'id',$id);
			$this->messages->setMessage('Data Updated Successfully','success');
			redirect(base_url('administrator/cms/privacy_policy'));
	    }
	
		$data['cms_data'] = $this->Common_model->getDataFromTable('tbl_cms','id,desc_type,description', $whereField=['desc_type' => 'privacy_policy'], $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
	
		
		$this->home_template->load('home_template','admin/privacy_policy',$data);
	
	}
	public function terms_conditions(){


		if($_POST){
			 $data['description'] = $_POST['description_p'];
			 $data['updated_by'] = $this->session->id;
			 $data['updated_on'] = current_datetime();
		
			 $id = $_POST['id'];
		  
			$this->Common_model->updateDataFromTable('tbl_cms',$data,'id',$id);
			$this->messages->setMessage('Data Updated Successfully','success');
			redirect(base_url('administrator/cms/terms_conditions'));
		}
	
		$data['cms_data'] = $this->Common_model->getDataFromTable('tbl_cms','id,desc_type,description', $whereField=['desc_type' => 'terms_conditions'], $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
		
		
		$this->home_template->load('home_template','admin/terms_conditions',$data);
	
	}
	
	public function cancellation_policy(){
	
	
		if($_POST){
			 $data['description'] = $_POST['description_p'];
			 $data['updated_by'] = $this->session->id;
			 $data['updated_on'] = current_datetime();
		
			 $id = $_POST['id'];
		  
			$this->Common_model->updateDataFromTable('tbl_cms',$data,'id',$id);
			$this->messages->setMessage('Data Updated Successfully','success');
			redirect(base_url('administrator/cms/cancellation_policy'));
		}
	
		$data['cms_data'] = $this->Common_model->getDataFromTable('tbl_cms','id,desc_type,description', $whereField=['desc_type' => 'cancellation_policy'], $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
		
		
		$this->home_template->load('home_template','admin/cancellation_policy',$data);
	
	}
	
	public function refund_policy(){
	
	
		if($_POST){
			 $data['description'] = $_POST['description_p'];
			 $data['updated_by'] = $this->session->id;
			 $data['updated_on'] = current_datetime();
		
			 $id = $_POST['id'];
		  
			$this->Common_model->updateDataFromTable('tbl_cms',$data,'id',$id);
			$this->messages->setMessage('Data Updated Successfully','success');
			redirect(base_url('administrator/cms/refund_policy'));
		}
	
		$data['cms_data'] = $this->Common_model->getDataFromTable('tbl_cms','id,desc_type,description', $whereField=['desc_type' => 'refund_policy'], $whereValue='', $orderBy='', $order='', $limit='', $offset=0, true);
		
		
		$this->home_template->load('home_template','admin/refund_policy',$data);
	
	}
	
	
}




