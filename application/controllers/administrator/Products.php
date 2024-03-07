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
        $catwhere['parent_id!='] = 0;
        $catwhere['status'] = 'Active';
 		$data['categories'] = $this->Common_model->getDataFromTable('tbl_categories','',  $whereField=$catwhere, $whereValue=null, $orderBy='', $order='', $limit='', $offset=0, true);
		$this->home_template->load('home_template','admin/products',$data); 
	}

	public function add(){
		if(($this->input->post('add'))){		
			$this->form_validation->set_session_data($this->input->post());
			$this->form_validation->checkXssValidation($this->input->post());
			$mandatoryFields=array('product_name','category_id','image');    
			if(!isset($_POST['service_id'])){
				array_push($mandatoryFields,'services');
			}
            foreach($mandatoryFields as $row){
				$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
				$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
				$this->form_validation->set_session_data($this->input->post());
				$errorMessage=validation_errors();
				$this->messages->setMessage($errorMessage,'error');
			}else{
				foreach($this->input->post() as $fieldname=>$fieldvalue){
                	$data[$fieldname]= $this->input->post($fieldname);
                }
				$price = $data['price'];
				$services = $data['service_id'];
                unset($data['add']);
				unset($data['service_id']);
				unset($data['price']);
				$data['created_by'] = $this->session->id;
				$data['created_on'] = current_datetime();
				$id = $this->Common_model->addDataIntoTable('tbl_products',$data);
				if($id){
					for($i=0;$i<count($services);$i++){
						$servicesins['service_id'] = $services[$i];
						$servicesins['product_id'] = $id;
						$servicesins['price'] = $price[$i];
						$this->Common_model->addDataIntoTable('tbl_product_services',$servicesins);
					}
				}
				$this->form_validation->clear_field_data();
				$this->messages->setMessage('Product Created Successfully','success');
				redirect('administrator/Products');
			}
		}
		
		$this->loadUserForm(array(),'add');
	}

	public function edit($param1=''){
		if(($this->input->post('edit'))){
			$this->form_validation->set_session_data($this->input->post());
			$this->form_validation->checkXssValidation($this->input->post());
			$mandatoryFields=array('product_name','category_id','image');    
			if(!isset($_POST['service_id'])){
				array_push($mandatoryFields,'services');
			}
            foreach($mandatoryFields as $row){
				$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
				$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
				$this->form_validation->set_session_data($this->input->post());
				$errorMessage=validation_errors();
				$this->messages->setMessage($errorMessage,'error');
			}else{
				foreach($this->input->post() as $fieldname=>$fieldvalue){
                	$data[$fieldname]= $this->input->post($fieldname);
                }
				$price = $data['price'];
				$services = $data['service_id'];
                unset($data['add']);
				unset($data['service_id']);
				unset($data['price']);
                unset($data['edit']);
				$data['updated_by'] = loggedId();
				$data['updated_on'] = current_datetime();
				$upd = $this->Common_model->updateDataFromTable('tbl_products',$data,'id',$param1);
				if($upd){
					$this->Common_model->deleteRowFromTable($table='tbl_product_services', $field='product_id', $ID=$param1, $limit=0);
					for($i=0;$i<count($services);$i++){
						$servicesins['service_id'] = $services[$i];
						$servicesins['product_id'] = $param1;
						$servicesins['price'] = $price[$i];
						$this->Common_model->addDataIntoTable('tbl_product_services',$servicesins);
					}
				}
				$this->form_validation->clear_field_data();
				$this->messages->setMessage('Product Updated Successfully','success');
				redirect(base_url('administrator/Products'));
			}
		}
		$formData=array();
		if($param1!=''){
			$result = $this->Common_model->getDataFromTable('tbl_products','',  $whereField='id', $whereValue=$param1, $orderBy='', $order='', $limit=1, $offset=0, true);
			$formData=$result[0];	
		}
		
		$this->loadUserForm($formData, 'edit');
	}

	public function addService(){
		if($_POST){
			$id = $_POST['id'];
			if($id!=''){
				$data['productServices'] = $this->Common_model->getDataFromTable('tbl_product_services','',  $whereField='product_id', $whereValue=$id, $orderBy='', $order='', $limit='', $offset=0, true);
			}else{
				$data['productServices'] = '';
				$data['attr_id'] = time().rand(999,9999);
			}
			$data['services'] = $this->Common_model->getDataFromTable('tbl_services','',  $whereField='status', $whereValue='Active', $orderBy='', $order='', $limit='', $offset=0, true);
			$html = $this->load->view('admin/addNewService',$data,true);
			if(!empty($html)){
				$res['html'] = $html;
				$res['error'] = 0;
			}
		echo json_encode($res);
		}
		
	}

	public function ajaxListing(){
		$draw          =  $this->input->post('draw');
		$start         =  $this->input->post('start');
		$status         =  $this->input->post('status');
		$indexColumn ='tp.id';
		$selectColumns = ['tp.id','tp.product_name','tp.image','tc.category','tp.status','tp.created_on'];
		$dataTableSortOrdering = ['tp.id','tp.product_name','tp.image','tc.category','tp.status','tp.created_on'];
		$table_name ='tbl_products as tp';
		$joinsArray[] = ['table_name'=>'tbl_categories as tc','condition'=>"tc.id = tp.category_id",'join_type'=>'left'];;
		$wherecondition='tp.id!="0"';
		if($status=='Active'){
		    $wherecondition.=' and tp.status = "Active"';
		}else if($status=='Inactive'){
		    $wherecondition.=' and tp.status = "Inactive"';
		}

		$getRecordListing=$this->Datatables_model->datatablesQuery($selectColumns,$dataTableSortOrdering,$table_name,$joinsArray,$wherecondition,$indexColumn,'','POST');
		$totalRecords=$getRecordListing['recordsTotal'];
		$recordsFiltered=$getRecordListing['recordsFiltered'];
		$recordListing = array();
        $content='[';
		$i=0;		
		
        $srNumber=$start;	
    
        if(!empty($getRecordListing)) {
            $actionContent = '';
            foreach($getRecordListing['data'] as $recordData) {
				$action="";
				$content .='[';
				$recordListing[$i][0]= $i+1;
                $recordListing[$i][1]= $recordData->product_name;
                $recordListing[$i][2]= "<img src='".base_url($recordData->image)."' class='w-20'>";
				$recordListing[$i][3]= $recordData->category;
				if($recordData->status == 'Inactive'){
					$recordListing[$i][4]= '<span class="badge rounded-pill bg-danger">'.$recordData->status.'</span>';
				}else{
					$recordListing[$i][4]= '<span class="badge rounded-pill bg-success">'.$recordData->status.'</span>';
				}
                $recordListing[$i][5]= displayDateInWords($recordData->created_on);
				if($this->session->userdata('user_type') == 'Admin'){	
					if($recordData->status == 'Inactive'){
						$action.= '<a class="btn" title="Active" onclick="statusUpdate(this,'."'$recordData->id'".','."'Active'".')" style="margin-bottom: 2px;color:green;font-size: 16px;cursor:pointer;"><i class="ri-check-line"></i></a>';
					}else{
						$action.= '<a class="btn" title="Deactive" onclick="statusUpdate(this,'."'$recordData->id'".','."'Inactive'".')" style="margin-bottom: 2px;color:red;font-size: 16px;cursor:pointer;"><i class="ri-close-line"></i></a>';
					}
				}
				$action.= '<a href="'.CONFIG_SERVER_ADMIN_ROOT.'products/edit/'.$recordData->id.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill" aria-hidden="true"></i></a>';
				$recordListing[$i][6]= $action;
				$i++;
                $srNumber++;
            }
          
            $content .= ']';
            $final_data = json_encode($recordListing);
        } else {
            $final_data = '[]';
        }	
        echo '{"draw":'.$draw.',"recordsTotal":'.$recordsFiltered.',"recordsFiltered":'.$recordsFiltered.',"data":'.$final_data.'}';
	}

	public function updateStatus(){
		$u_id = $this->input->post('pid');
		if($this->input->post('status') == 'Active'){
			$data['status'] = $this->input->post('status');
			$succ_message = 'Product Actived Successfully';
		}else{
			$data['status'] = $this->input->post('status');
			$succ_message = 'Product Inactived Successfully';
		}
		
		$this->Common_model->updateDataFromTable('tbl_products',$data,'id',$u_id);
		$message = ['error'=>'0','message'=>$succ_message];
        echo json_encode($message);
        exit;
	}
	
}
?>