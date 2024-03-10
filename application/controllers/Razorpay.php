<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Razorpay extends CI_Controller {
    public function __construct()
	{
        parent::__construct();
	} 	
	public function index($id){
        if(!empty($id)){
            $id = base64_decode($id);
            $userData = $this->Common_model->getDataFromTable('tbl_users','first_name,username,phno',  $whereField=array('id'=>$this->session->id), $whereValue='',$orderBy='id', $order='ASC', $limit='', $offset='', true);
            $checkorder = $this->Common_model->getDataFromTable('tbl_orders','*',  $whereField=array('reference_number'=>$id,'payment_status'=>'Pending'), $whereValue='',$orderBy='id', $order='ASC', $limit='', $offset='', true);
            if(!empty($checkorder[0])){
                $data['id'] = base64_encode($id);
                $this->session->amount = $data['amount'] = $checkorder[0]['grand_total'];
                $this->session->currency =  'INR';
                $this->session->reference_number = $data['reference_number'] = $id;
                $this->session->orderid = $checkorder[0]['id'];
                $data['username'] = $userData[0]['first_name'];
                $data['email'] = $userData[0]['username'];
                $data['phno'] = $userData[0]['phno'];
                $data['callback_url']       = base_url().'razorpay/callback';
                $data['surl']               = base_url().'razorpay/success';;
                $data['furl']               = base_url().'razorpay/failed';;
                $data['currency_code']      = 'INR';
                $this->load->view('razorpay',$data);
            }else{
                redirect(base_url());    
            }
        }else{
            redirect(base_url());
        }
    }
     private function curl_handler($payment_id, $amount)  {
        $url            = 'https://api.razorpay.com/v1/payments/'.$payment_id.'/capture';
        $key_id         = RAZORPAY_KEY;
        $key_secret     = RAZORPAY_SECRET;
        $fields_string  = "amount=$amount";
        //cURL Request
        $ch = curl_init();
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id.':'.$key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        return $ch;
    }   
        
    // callback method
    public function callback() {   
        print_r($this->input->post());     
        if (!empty($this->input->post('razorpay_payment_id')) && !empty($this->input->post('merchant_order_id'))) {
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $merchant_order_id = $this->input->post('merchant_order_id');
            
            $this->session->set_flashdata('razorpay_payment_id', $this->input->post('razorpay_payment_id'));
            $this->session->set_flashdata('merchant_order_id', $this->input->post('merchant_order_id'));
            $currency_code = 'INR';
            $amount = $this->input->post('merchant_total');
            $success = false;
            $error = '';
            try {                
                $ch = $this->curl_handler($razorpay_payment_id, $amount);
                //execute post
                $result = curl_exec($ch);
                $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                if ($result === false) {
                    $success = false;
                    $error = 'Curl error: '.curl_error($ch);
                } else {
                    $response_array = json_decode($result, true);
                        //Check success response
                        if ($http_status === 200 and isset($response_array['error']) === false) {
                            $success = true;
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'].':'.$response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR:Invalid Response <br/>'.$result;
                            }
                        }
                }
                //close curl connection
                curl_close($ch);
            } catch (Exception $e) {
                $success = false;
                $error = 'Request to Razorpay Failed';
            }
            
            if ($success === true) {
                if(!empty($this->session->userdata('ci_subscription_keys'))) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                if (!$order_info['order_status_id']) {
                    redirect($this->input->post('merchant_surl_id'));
                } else {
                    redirect($this->input->post('merchant_surl_id'));
                }

            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    } 
    public function success() {
        $order_details = $this->Common_model->getDataFromTable('tbl_orders','user_id',  $whereField='reference_number', $whereValue=$this->session->flashdata('merchant_order_id'),$orderBy='id', $order='desc', $limit='', $offset='0', true);
        $user_details = $this->Common_model->getDataFromTable('tbl_users','first_name,phno',  $whereField='id', $whereValue=$order_details[0]['user_id'],$orderBy='id', $order='desc', $limit='', $offset='0', true);
        $data['payment_response'] = $this->session->flashdata('razorpay_payment_id');
        $data['payment_status'] = 'Paid';
        $this->Common_model->updateDataFromTabel('tbl_orders',$data,'reference_number',$this->session->flashdata('merchant_order_id'));
        $this->session->orderid = $id;

        $userFields['accessToken'] = WHATSAPP_API_KEY;
        $userFields['mobile'] = '+918686563135';
        $userFields['text'] = 'Hi Vamshi, we have received your order with reference_number '.$order_details[0]['reference_number'].' and please visit the link for invoice '.base_url('view-invoice/'.base64_encode($order_details[0]['reference_number']));
        
        $this->Common_model->SendWhatsAppNotification($userFields);
        redirect('order-success');
    }  
    public function failed() {
        $data['meta_title'] = "Payment Failed";
        $data['meta_keywords'] = SITENAME;
        $data['meta_description'] = SITENAME;
        $data['txnid'] = $this->session->flashdata('razorpay_payment_id');
        $data['orderid'] = $this->session->flashdata('merchant_order_id');
        $this->frontend_template->load('frontend_template','payment_failed',$data); 
    }
}
?>