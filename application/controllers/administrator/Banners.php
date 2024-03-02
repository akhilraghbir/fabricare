<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banners extends CI_Controller {


	public function __construct(){
		parent::__construct();
		check_UserSession();
    } 

	public function loadBreadCrumbs(){
		$data=array();
		$data['icon_class']="icon-user";
		$data['title']="Banners";
		$data['helptext']="This Page Is Used To Manage The Banners.";
		$data['actions']['add']=CONFIG_SERVER_ADMIN_ROOT.'banners/add';
		$data['actions']['list']=CONFIG_SERVER_ADMIN_ROOT.'banners';
		return $data;
	}

	public function index(){
		$data['breadcrumbs'] = $this->loadBreadCrumbs(); 
		$this->home_template->load('home_template','admin/banners',$data);   
	}

	public function loadBannersForm($formContent=array(), $formName=''){
		$data['breadcrumbs'] = $this->loadBreadCrumbs();
		$data['data'] = $formContent;
		$data['form_action'] = $formName;
		$data['banners'] = $this->Common_model->getDataFromTable('tbl_banners','*', $whereField='status', $whereValue='Active', $orderBy='', $order='', $limit='', $offset=0, true);
		
			$this->home_template->load('home_template','admin/banners',$data); 
		
		
	}

	public function add(){
		if(($this->input->post('add'))){		
			$this->form_validation->set_session_data($this->input->post());
			$this->form_validation->checkXssValidation($this->input->post());
			$mandatoryFields=array('banner_title','banner_sub_title','action_link','status');    
			
            foreach($mandatoryFields as $row){
				$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
				$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }

			$this->form_validation->set_rules('banner_title','Banner Name', 'required|callback_alpha_dash_space');
			

            if($this->form_validation->run() == FALSE){
				$this->form_validation->set_session_data($this->input->post());
				$errorMessage=validation_errors();
				$this->messages->setMessage($errorMessage,'error');
			}else{
				foreach($this->input->post() as $fieldname=>$fieldvalue){
                	$data[$fieldname]= $this->input->post($fieldname);

                }
                unset($data['add']);
				
				$data['created_by'] = $this->session->id;
				$data['created_on'] = current_datetime();
				
				$user_id = $this->Common_model->addDataIntoTable('tbl_banners',$data);
				
				$this->form_validation->clear_field_data();
				$this->messages->setMessage('Banner Added Successfully','success');
				redirect('administrator/banners');
			}
		}
			$this->loadBannersForm(array(),'add');
	}

	public function edit($param1=''){

		if(($this->input->post('edit'))){

			$this->form_validation->checkXssValidation($this->input->post());
			$mandatoryFields=array('banner_title','banner_sub_title','action_link','status');    
		   
            foreach($mandatoryFields as $row){
            $fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            $this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
			if($this->form_validation->run() == FALSE){
				$errorMessage=validation_errors();
				$this->messages->setMessage($errorMessage,'error');
			}else{
				foreach($this->input->post() as $fieldname=>$fieldvalue){
                	$data[$fieldname]= $this->input->post($fieldname);
                }
                
                unset($data['edit']);
				$data['updated_on'] = current_datetime();

			$this->Common_model->updateDataFromTable('tbl_banners',$data,'id',$param1);
				

				$this->messages->setMessage('Banner Updated Successfully','success');
				redirect(base_url('administrator/banners'));
			}
		}
		$formData=array();
		if($param1!=''){
			$result = $this->Common_model->getDataFromTable('tbl_banners','',  $whereField='id', $whereValue=$param1, $orderBy='', $order='', $limit=1, $offset=0, true);
			$formData=$result[0];	
		}
		$this->loadBannersForm($formData, 'edit');
	}


	public function updateStatus(){

		 $u_id = $this->input->post('banner_id');

		if($this->input->post('status') == 'Active'){
			$data['status'] = $this->input->post('status');
			$succ_message = 'Banner Active Successfully';
		}else{
			$data['status'] = $this->input->post('status');
			$succ_message = 'Banner Inactive Successfully';
		}
		
		$this->Common_model->updateDataFromTable('tbl_banners',$data,'id',$u_id);
		$message=array('error'=>'0','message'=>$succ_message);
        echo json_encode($message);
        exit;
	}

    public function delete_user($id)
    {
        $del = $this->Common_model->delete_user($id);
        if($del)
        {
            $message=array('error'=>'0','message'=>'User Deleted Successfully');
			echo json_encode($message);
			exit;
        }
    }

	public function ajaxListing(){

		$draw          =  $this->input->post('draw');
		$start         =  $this->input->post('start');
		$status         =  $this->input->post('status');
		
		$indexColumn='id';
		$selectColumns=array('*');
		$dataTableSortOrdering=array('id','banner_title','banner_sub_title','banner_img','action_link','status','created_on');
		$table_name='tbl_banners';
		$joinsArray=array();
		$wherecondition='id!="0"';
		if($status=='Active'){
		    $wherecondition.=' and status = "Active"';
		}else if($status=='Inactive'){
		    $wherecondition.=' and status = "Inactive"';
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
                $recordListing[$i][1]= $recordData->banner_title;
				$recordListing[$i][2]= $recordData->banner_sub_title;
                $recordListing[$i][3]= '<img src="'.base_url($recordData->banner_img).'"'.' style="width:100px;height:100px;">';
				$recordListing[$i][4]= $recordData->action_link;
				if($recordData->status == 'Inactive'){
					$recordListing[$i][5]= '<span class="badge rounded-pill bg-danger">'.$recordData->status.'</span>';
				}else{
					$recordListing[$i][5]= '<span class="badge rounded-pill bg-success">'.$recordData->status.'</span>';
				}
                $recordListing[$i][6]= displayDateInWords($recordData->created_on);
				if($this->session->userdata('user_type') == 'Admin'){	
					if($recordData->status == 'Inactive'){
						$action.= '<a class="btn" title="Active" onclick="statusUpdate(this,'."'$recordData->id'".','."'Active'".')" style="margin-bottom: 2px;color:green;font-size: 16px;cursor:pointer;"><i class="ri-check-line"></i></a>';
					}else{
						$action.= '<a class="btn" title="Deactive" onclick="statusUpdate(this,'."'$recordData->id'".','."'Inactive'".')" style="margin-bottom: 2px;color:red;font-size: 16px;cursor:pointer;"><i class="ri-close-line"></i></a>';
					}
				}
				$action.= '<a href="'.CONFIG_SERVER_ADMIN_ROOT.'banners/edit/'.$recordData->id.'" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i class="ri-pencil-fill" aria-hidden="true"></i></a>';
				$recordListing[$i][7]= $action;
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





	function alpha_dash_space($fullname){
		if (! preg_match('/^[a-zA-Z\s]+$/', $fullname)) {
			$this->form_validation->set_message('alpha_dash_space', 'The %s field may only contain alpha characters & White spaces');
			return FALSE;
		} else {
			return TRUE;
		}
	}
	
	public function getUsers()
	{
		$vmsNo = $_POST['term'];
		$accountant = $_POST['accountant'];
		$wherecondition = " user_type='Client' and status='Active' and (first_name LIKE '%" . $_POST['term'] . "%' or email_id LIKE '%" . $_POST['term'] . "%' or phno LIKE '%" . $_POST['term'] . "%')";
		if ($accountant != '') {
			$wherecondition .= " and accountant = " .$accountant;
		} 
		$vmsRefdata = $this->Common_model->getSelectedFields('tbl_users', 'id,concat(first_name," ",last_name) as name', $wherecondition, $limit = '100', $orderby = 'id', $sortby = 'DESC');
		echo json_encode($vmsRefdata);
	}
}
