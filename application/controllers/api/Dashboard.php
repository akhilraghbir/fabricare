<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
    public function __construct()
	{
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        parent::__construct();
        
        $check = checkAuth($this->input->server('HTTP_AUTHORIZATION'));
        if(!$check){
            $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => 'Invalid Authorization Headers');
            $this->response($message);exit;
        }
	} 

    public function get_banners()
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else{
                $banners = $this->Common_model->getDataFromTable('tbl_banners','*', $whereField='status', $whereValue='Active',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $banners];
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }

    public function get_zipcodes()
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else{
                $zipcodes = $this->Common_model->getDataFromTable('tbl_zipcodes','*', $whereField='status', $whereValue='Active',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $zipcodes];
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    



    /// old function need to remove for prod

    public function get_new_in($user_id)
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else if($user_id == ''){
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'User id is mandatory']));
            }else{
                
                $newin = $this->Common_model->getDataFromTable('products','*',  $whereField=array('product_status'=>'Active','stock_status'=>'In Stock'), $whereValue='',$orderBy='id', $order='desc', $limit='8', $offset='0', true);
                if(!empty($newin)){
                    foreach($newin as $new){
                        $rgetprice = $this->Common_model->getDataFromTable('product_variants','weight_in_grams,variant_id',  $whereField=array('product_id'=>$new['id'],'status'=>'In Stock'), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                        if(!empty($rgetprice)){
                            $rvariant_name = $this->Common_model->getDataFromTable('variants','id,variant_name',  $whereField=array('id'=>$rgetprice[0]['variant_id']), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                            $getwishproduct = $this->Common_model->check_exists('wishlist',array('product_id'=>$new['id'],'user_id'=>$user_id),'','',''); 
                            $res['product_id'] = $new['id'];
                            $res['product_name'] = $new['product_name'];
                            $res['product_description'] = $new['product_description'];
                            $res['product_weight'] = $rgetprice[0]['weight_in_grams'];
                            $res['product_size'] = $rvariant_name[0]['variant_name'];
                            $res['product_image'] = base_url($new['product_thumbnail']);
                            if($getwishproduct == 1){
                                $res['wishlist'] = true;
                            }else{
                                 $res['wishlist'] = false;
                            }
                            $resp[] = $res;
                        }
                        
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                }else{
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                }
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function get_best_selling($user_id)
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else{
                $bestselling = $this->Common_model->getDataFromTable('products','*',  $whereField=array('product_status'=>'Active','stock_status'=>'In Stock','best_selling'=>'Yes'), $whereValue='',$orderBy='id', $order='desc', $limit='8', $offset='0', true);
                if(!empty($bestselling)){
                    foreach($bestselling as $best){
                        $rgetprice = $this->Common_model->getDataFromTable('product_variants','weight_in_grams,variant_id',  $whereField=array('product_id'=>$best['id'],'status'=>'In Stock'), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                        if(!empty($rgetprice)){
                            $rvariant_name = $this->Common_model->getDataFromTable('variants','id,variant_name',  $whereField=array('id'=>$rgetprice[0]['variant_id']), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                            $getwishproduct = $this->Common_model->check_exists('wishlist',array('product_id'=>$best['id'],'user_id'=>$user_id),'','',''); 
                            $res['product_id'] = $best['id'];
                            $res['product_name'] = $best['product_name'];
                            $res['product_description'] = $best['product_description'];
                            $res['product_weight'] = $rgetprice[0]['weight_in_grams'];
                            $res['product_size'] = $rvariant_name[0]['variant_name'];
                            $res['product_image'] = base_url($best['product_thumbnail']);
                            if($getwishproduct == 1){
                                $res['wishlist'] = true;
                            }else{
                                 $res['wishlist'] = false;
                            }
                            $resp[] = $res;
                        }
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                }else{
                  $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];  
                }
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function get_featured_categories()
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else{
                $fcategories = $this->Common_model->getDataFromTable('categories','id,category_name,category_image',  $whereField=array('category_status'=>'Active','featured_category'=>'Yes'), $whereValue='',$orderBy='id', $order='desc', $limit='6', $offset='0', true);
                if(!empty($fcategories)){
                    foreach($fcategories as $categories){
                        $res['category_id'] = $categories['id'];
                        $res['category_name'] = $categories['category_name'];
                        $res['category_image'] = base_url($categories['category_image']);
                        $resp[] = $res;
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                }else{
                  $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];  
                }
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function get_category_products()
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else{
                $categoryId = $this->input->post('category_id');
                $user_id = $this->input->post('user_id');
                $products = $this->Common_model->getDataFromTable('products','id,product_name,product_thumbnail',  $whereField=array('category_id'=>$categoryId,'product_status'=>'Active'), $whereValue='',$orderBy='id', $order='ASC', $limit='20', $offset='0', true);
                if(!empty($products)){
                    foreach($products as $product){
                        $rgetprice = $this->Common_model->getDataFromTable('product_variants','weight_in_grams,variant_id',  $whereField=array('product_id'=>$product['id'],'status'=>'In Stock'), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                        $rvariant_name = $this->Common_model->getDataFromTable('variants','id,variant_name',  $whereField=array('id'=>$rgetprice[0]['variant_id']), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                        $getwishproduct = $this->Common_model->check_exists('wishlist',array('product_id'=>$product['id'],'user_id'=>$user_id),'','',''); 
                        $res['product_id'] = $product['id'];
                        $res['product_name'] = $product['product_name'];
                        $res['weight_in_grams'] = $rgetprice[0]['weight_in_grams'];
                        $res['variant_name'] = $rvariant_name[0]['variant_name'];
                        $res['product_image'] = base_url($product['product_thumbnail']);
                        if($getwishproduct == 1){
                            $res['wishlist'] = true;
                        }else{
                             $res['wishlist'] = false;
                        }
                        $resp[] = $res;
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                }else{
                  $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];  
                }
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function get_all_variants()
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else{
                $variants = $this->Common_model->getDataFromTable('variants','id,variant_name',  $whereField=array('variant_status'=>'Active'), $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
                if(!empty($variants)){
                    foreach($variants as $variant){
                        $res['variant_id'] = $variant['id'];
                        $res['variant_name'] = $variant['variant_name'];
                        $resp[] = $res;
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                }else{
                  $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];  
                }
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function get_products_variants_category(){
         try{
            if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }else{
                $categoryId = $this->input->post('category_id');
                $user_id = $this->input->post('user_id');
                $varaintId = $this->input->post('variant_id');
                if(!empty($categoryId) && !empty($varaintId)){
                    $getproductidbyvariant = $this->Common_model->getDataFromTable('product_variants','product_id',  $whereField=array('variant_id'=>$varaintId), $whereValue='',$orderBy='id', $order='ASC', $limit='20', $offset='0', true);
                        if(!empty($getproductidbyvariant)){
                            foreach($getproductidbyvariant as $productvariants){
                                $productids[] = $productvariants['product_id'];
                            }
                            $idString = convertArrayIntoAuotedAtring($productids);
                            $products = $this->db->query("select id,product_name,product_thumbnail from products where id in ('$idString') and category_id='$categoryId' and product_status='Active'")->result_array();
                            if(!empty($products)){
                                foreach($products as $product){
                                    $rgetprice = $this->Common_model->getDataFromTable('product_variants','weight_in_grams,variant_id',  $whereField=array('product_id'=>$product['id'],'status'=>'In Stock'), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                                    $rvariant_name = $this->Common_model->getDataFromTable('variants','id,variant_name',  $whereField=array('id'=>$rgetprice[0]['variant_id']), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                                    $getwishproduct = $this->Common_model->check_exists('wishlist',array('product_id'=>$product['id'],'user_id'=>$user_id),'','',''); 
                                    $res['product_id'] = $product['id'];
                                    $res['product_name'] = $product['product_name'];
                                    $res['weight_in_grams'] = $rgetprice[0]['weight_in_grams'];
                                    $res['variant_name'] = $rvariant_name[0]['variant_name'];
                                    $res['product_image'] = base_url($product['product_thumbnail']);
                                    if($getwishproduct == 1){
                                    $res['wishlist'] = true;
                                    }else{
                                    $res['wishlist'] = false;
                                    }
                                    $resp[] = $res;
                                }
                            $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                            }
                        }else{
                            $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];  
                        }
                    }else{
                     throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Category Id and Variant Id are mandatory']));
                    }
                }
                $this->response($response);
            }catch(Exception $e){
                $data = unserialize($e->getMessage());
                if(is_array($data)){
                    $this->response($data);exit;
                }else{
                    $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                    $this->response($message);exit;
                }
            }
        
    }
    
    public function product_wishlist(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
             $productId = $this->input->post('product_id');
             $userId = $this->input->post('user_id'); 
             if(!empty($productId) && !empty($userId)){
                    $getwishproduct = $this->Common_model->check_exists('wishlist',array('product_id'=>$productId,'user_id'=>$userId),'','','');
                    if($getwishproduct == 1)
                    {
                        $res['product_id'] = $productId;
                        $res['user_id'] = $userId;
                        $delete = $this->Common_model->deleteRowFromTable('wishlist',array('product_id'=>$productId,'user_id'=>$userId),'','');
                         if($delete)
                         {
                           $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Product Removed From Wishlist'];    
                         }
                    }
                    else
                    {
                       $insert = $this->Common_model->addDataIntoTable('wishlist',array('product_id'=>$productId,'user_id'=>$userId)); 
                       $res['product_id'] = $productId;
                        $res['user_id'] = $userId;
                       if(!empty($insert))
                       {
                          $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Product Added To Wishlist'];  
                       }
                        
                    }
             }else{
                     throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Product Id and User Id are mandatory']));
                }
          }
          $this->response($response);
        }
        catch(Exception $e){
            $data = unserialize($e->getMessage());
                if(is_array($data)){
                    $this->response($data);exit;
                }else{
                    $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                    $this->response($message);exit;
                }
        }
    }
    
    public function get_userwishlist()
    {
         try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
             $userId = $this->input->post('user_id'); 
             if(!empty($userId)){
                    $getwishlist = $this->Common_model->getDataFromTable('wishlist','product_id',  $whereField=array('user_id'=>$userId), $whereValue='',$orderBy='id', $order='ASC', $limit='20', $offset='0', true);
                    if(!empty($getwishlist)){
                            foreach($getwishlist as $productlist){
                                $wproductids[] = $productlist['product_id'];
                            }
                            $idString = convertArrayIntoAuotedAtring($wproductids);
                            $products = $this->db->query("select id,product_name,product_thumbnail from products where id in ('$idString') and product_status='Active'")->result_array();
                            if(!empty($products)){
                                foreach($products as $product){
                                    $rgetprice = $this->Common_model->getDataFromTable('product_variants','weight_in_grams,variant_id',  $whereField=array('product_id'=>$product['id'],'status'=>'In Stock'), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                                    $rvariant_name = $this->Common_model->getDataFromTable('variants','id,variant_name',  $whereField=array('id'=>$rgetprice[0]['variant_id']), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                                    $res['product_id'] = $product['id'];
                                    $res['product_name'] = $product['product_name'];
                                    $res['weight_in_grams'] = $rgetprice[0]['weight_in_grams'];
                                    $res['variant_name'] = $rvariant_name[0]['variant_name'];
                                    $res['product_image'] = base_url($product['product_thumbnail']);
                                    $resp[] = $res;
                                }
                            $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                            }
                        }else{
                            $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];  
                        }
                    }else{
                     throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'User Id Is mandatory']));
                    }
                }
                $this->response($response);
        }
        catch(Exception $e){
            $data = unserialize($e->getMessage());
                if(is_array($data)){
                    $this->response($data);exit;
                }else{
                    $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                    $this->response($message);exit;
                }
        }
    }
    
    public function get_live_prices(){
        try{
          if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $apiprice = $this->Common_model->getLivesilverPrice();
                $buyprice = $this->Common_model->oursilverprice(round($apiprice,2)) / 100;
                $data['apiprice'] = number_format($apiprice,2);
                $data['buyprice'] = number_format($buyprice,2);
                $data['sellprice'] = number_format($this->Common_model->oursilveroldprice($apiprice/100),2);
                $this->response($data);
            }
        }
        catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function get_product_details(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $productid = $this->input->post('product_id');
                $user_id = $this->input->post('user_id');
                if(!empty($productid)){
                        $products = $this->Common_model->getDataFromTable('products','*',  $whereField=array('id'=>$productid,'product_status'=>'Active'), $whereValue='',$orderBy='id', $order='ASC', $limit='', $offset='', true);
                        $checkreview = $this->Common_model->check_exists('product_reviews',array('product_id'=>$products[0]['id'],'user_id'=>$user_id),'','',''); 
                        
                        if(!empty($products[0])){
                            $product_variants = $this->db->query("select * from product_variants left join variants on variants.id = product_variants.variant_id where product_id='".$products[0]['id']."' and product_variants.status='In Stock'")->result_array();
                            $product_images = $this->Common_model->getDataFromTable('product_images','*',  $whereField=array('product_id'=>$products[0]['id']), $whereValue='',$orderBy='id', $order='ASC', $limit='', $offset='', true);
                            $product_reviews = $this->Common_model->getDataFromTable('product_reviews','*',  $whereField=array('product_id'=>$products[0]['id']), $whereValue='',$orderBy='id', $order='DESC', $limit='10', $offset='0', true);
                            $avgreview = $this->db->query("SELECT avg(rating) as rating FROM product_reviews where product_id='".$products[0]['id']."'")->row();
                            $res['product_name'] = $products[0]['product_name'];
                            $res['product_description'] = $products[0]['product_description'];
                            $res['item_details'] = $products[0]['item_details'];
                            $res['video'] = $products[0]['product_video_url'];
                            $res['product_url'] = base_url('product-url/'.$this->input->post('product_id'));
                            $res['product_images'][] = base_url($products[0]['product_thumbnail']);
                            foreach($product_images as $images){
                                $res['product_images'][] = base_url($images['product_image']);
                            }
                            foreach($product_variants as $variants){
                                $v['variant_id'] = $variants['variant_id'];
                                $v['weight_in_grams'] = $variants['weight_in_grams'];
                                $v['variant_name'] = $variants['variant_name'];
                                $res['variants'][] = $v;
                            }
                            $res['rating'] = $avgreview->rating;
                            if($checkreview>0){
                                $res['is_review'] = 'yes';
                            }else{
                                $res['is_review'] = 'no';    
                            }
                            $res['reviews'] = $this->Common_model->getProductReviews($this->input->post('product_id'));
                            $res['similar_products'] = $this->Common_model->getSimilarProducts($this->input->post('product_id'));
                         $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $res];
                        }else{
                            $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                        }
                        $this->response($response);
                }else{
                    throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Product Id Is mandatory']));
                }
            }
        }
        catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
	public function getpricebyweight(){
	    try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $grams = $this->input->post('grams');
                if(!empty($grams)){
                $res = $this->Common_model->getDataFromTable('silver_api_log','response',  $whereField='status', $whereValue='success',$orderBy='id', $order='desc', $limit='1', $offset='0', true);
                $api = json_decode($res[0]['response']);
                $apiprice = $api->silvermcx;
                $profit_margins = $this->db->get_where('profit_margins',['id' => 1])->row();
                if($profit_margins->profit_type=='Less'){
                    $resp = $apiprice-$profit_margins->profit;
                }else if($profit_margins->profit_type=='Add'){
                    $resp = $apiprice+$profit_margins->profit;
                }
                $making = $this->db->get_where('making_charges',['id'=>1])->row();
                $makingaddon = round(($resp*$making->profit)/100,2);
                $gram = round(($resp+$makingaddon)/1000,2);
                $variantprice = $gram*$grams;
                if(is_numeric($variantprice)){
                    $r['status'] = 'success';
                    $r['price'] = round($variantprice,2);
                }else{
                    $r['status'] = 'error';
                    $r['msg'] = 'Something Went Wrong';
                }
                // $gram = $apiprice/1000;
                // $variantprice = $gram*$grams;
                // if(is_numeric($variantprice)){
                //     $resp['status'] = 'success';
                //     $resp['price'] = round($variantprice,2);
                // }else{
                //     $resp['status'] = 'error';
                //     $resp['msg'] = 'Something Went Wrong';
                // }
                 $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $r];
                 $this->response($response);
                }else{
                    throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Grams Is mandatory']));
                }
            }
        }
        catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
	}
    
    public function postCart(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $errmsg = '';
                $mandatoryFields = ['product_id','qty','user_id','variant_id','price','type'];
                foreach($mandatoryFields as $row){
                	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
                	$this->form_validation->set_rules($row, $fieldname, 'required'); 
                }
                if($this->form_validation->run() == FALSE){
                    
                    $errorMessage = strip_tags(validation_errors());
                    throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
                }else{
                    $ins  = json_decode($this->Common_model->add_to_cart());
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $ins->msg];
                    if(isset($ins->cartcount)){
                        $response['cart_quantity'] = $ins->cartcount;
                    }
                    $this->response($response);
                }
            }
        }
        catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function getCart(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $userid = $this->input->post('user_id');
                $cart_products = $this->Common_model->getDataFromTable('cart','*',  $whereField=array('cart_session_id'=>$this->input->post('cart_id')), $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
                if(!empty($cart_products)){
                foreach($cart_products as $products){
                    $product_details = $this->Common_model->getDataFromTable('products','product_name,product_thumbnail',  $whereField=array('id'=>$products['product_id']), $whereValue='',$orderBy='id', $order='desc', $limit='1', $offset='0', true);
                    $availableQty = $this->Common_model->getDataFromTable('product_variants','available_quantity',  $whereField=['product_id'=>$products['product_id'],'variant_id' => $products['variant_id']], $whereValue='',$orderBy='id', $order='desc', $limit='1', $offset='0', true);
                    $cart['product_name'] = $product_details[0]['product_name'];
                    $cart['product_thumbnail'] = base_url($product_details[0]['product_thumbnail']);
                    $cart['product_id'] = $products['product_id'];
                    $cart['variant_id'] = $products['variant_id'];
                    $cart['qty'] = $products['quantity'];
                    $cart['available_quantity'] = $availableQty[0]['available_quantity'];
                    $cart['price'] = $products['price'];
                    $cart['variant'] = $products['variant'];
                    $c[] =  $cart; 
                }
                 $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found', 'Data' => $c];
                }else{
                  $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                }
                $this->response($response);
            }
        }
        catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function addAddress(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $errmsg = '';
                $mandatoryFields = ['user_id','address_title','address1','name','email_address','phone_number','city','state','country','postal_code'];
                foreach($mandatoryFields as $row){
                	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
                	$this->form_validation->set_rules($row, $fieldname, 'required'); 
                }
                if($this->form_validation->run() == FALSE){
                    
                    $errorMessage = strip_tags(validation_errors());
                    throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
                }else{
                    foreach($this->input->post() as $fieldname=>$fieldvalue){
                        $insdata[$fieldname]= $this->input->post($fieldname);
                    }
                    
                    if(!isset($_POST['address_id'])){
                        $insdata['created_on'] = date('Y-m-d h:i:s');
                        $ins = $this->Common_model->addDataIntoTable('addresses',$insdata);
                    }else{
                        unset($insdata['address_id']);
                        $ins = $this->Common_model->updateDataFromTabel('addresses',$insdata,'id',$_POST['address_id']);
                    }
                    if($ins){
                     $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Recorded Successfully'];
                     $this->response($response);
                    }
                }
          }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function getCountries(){
        try{
          if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $countries = $this->Common_model->getDataFromTable('country','*',  $whereField='', $whereValue='',$orderBy='id', $order='asc', $limit='', $offset='0', true);
                $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','Data' =>  $countries];
                $this->response($response);
          }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function getAddress(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
              if(!empty($this->input->post('address_id'))){
                $address = $this->Common_model->getDataFromTable('addresses','*',  $whereField='id', $whereValue=$this->input->post('address_id'),$orderBy='id', $order='asc', $limit='', $offset='0', true);
                $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','Data' =>  $address];
              }else{
                  $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Address Id is mandatory']; 
              }
                $this->response($response);
          }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function getAllAddress(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
              if(!empty($this->input->post('user_id'))){
                $address = $this->Common_model->getDataFromTable('addresses','*',  $whereField='user_id', $whereValue=$this->input->post('user_id'),$orderBy='id', $order='asc', $limit='', $offset='0', true);
                if(!empty($address)){
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','Data' =>  $address]; 
                }else{
                     $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                }
              }else{
                  $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'User Id is mandatory']; 
              }
                $this->response($response);
          }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function getCoupons(){
        try{
          if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $whr['offer_from<='] = date('Y-m-d');
                $whr['offer_to>='] = date('Y-m-d');
                $whr['coupon_type'] = 'public';
                $coupons = $this->Common_model->getDataFromTable('coupons','*',  $whereField=$whr, $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
                if(!empty($coupons)){
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','Data' =>  $coupons]; 
                }else{
                     $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                }
              }
            $this->response($response);
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function getShippingCharge(){
        try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
              if(!empty($this->input->post('address_id'))){
                $addressData = $this->Common_model->getDataFromTable('addresses','country',  $whereField='id', $whereValue=$this->input->post('address_id'),$orderBy='id', $order='ASC', $limit='', $offset='', true);
                $getshipping = $this->Common_model->getDataFromTable('shipping_charges','*',  $whereField='', $whereValue='',$orderBy='id', $order='ASC', $limit='', $offset='', true);
                if(!empty($addressData[0]) && $addressData[0]['country'] != 99){
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','Data' => $getshipping[0]['shipping_charge']]; 
                }else{
                     $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Free Shipping','Data' => "0.00"];
                }
                $this->response($response);
              }else{
                  throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Address id required']));
              }
          }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function getTax(){
        try{
          if($this->input->server('REQUEST_METHOD')!='GET'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $gstp = $this->Common_model->getDataFromTable('tax','*',  $whereField=array('currency'=>'INR'), $whereValue='',$orderBy='id', $order='ASC', $limit='', $offset='', true);
                if(!empty($gstp)){
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','Data' => $gstp]; 
                }else{
                     $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                }
              }
            $this->response($response);
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function applyCoupon(){
	   try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
            $mandatoryFields = ['coupon','subtotal','shipping','taxper','wallet'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                $errorMessage = strip_tags(validation_errors());
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
                }else{
                    if($this->input->post('subtotal')>0){
            	        $coupon = $this->input->post('coupon');
            	        $subtotal = $this->input->post('subtotal');
            	        $shipping = $this->input->post('shipping');
            	        $taxper = $this->input->post('taxper');
            	        $wallet = $this->input->post('wallet');
            	        $giftwrap_pr = 0;
            	        $whr['coupon_code'] = $coupon;
            	        $whr['offer_from<='] = date('Y-m-d');
            	        $whr['offer_to>='] = date('Y-m-d');
            	        $coupondata = $this->Common_model->getDataFromTable('coupons','*',  $whereField=$whr, $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
            	        if(!empty($coupondata[0])){
            	            if($coupondata[0]['min_cart']=='Yes'){
                                if($subtotal<$coupondata[0]['minimum_cart_value_inr']){
                                    $res['status'] = 'error';
                                    $res['message'] = 'Cart Value must be greater than '.$coupondata[0]['minimum_cart_value_inr'];
                                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $res]; 
                                }else{
                                    $couper = $coupondata[0]['coupon_percentage_inr'];
                                    $couponamount = $subtotal*$couper/100;
                                    $subtotalco = $subtotal-$couponamount-$wallet;
                                    $taxamt = $subtotalco*$taxper/100;
                                    $grandtotal = $subtotalco+$taxamt+$shipping+$giftwrap_pr;
                                    if($grandtotal > 0 && $couponamount>0){
                                        $res['status'] = 'success';
                                        $res['message'] = '<span class="text-success">Coupon applied with '.$couper.'%</span>';
                                        $res['subtotal'] = $subtotal;
                                        $res['tax'] = number_format($taxamt,2);
                                        $res['grandtotal'] = number_format($grandtotal,2);
                                        $res['coupon_amt'] = number_format($couponamount,2);
                                        $res['couper'] = $couper;
                                        $res['coupon_id'] = $coupondata[0]['id'];
                                        $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $res]; 
                                    }else{
                                        $res['status'] = 'error';
                                        $res['message'] = 'Something Went wrong.,Please try again later';
                                        $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $res];
                                    }
                                }
            	            }else{
        	                    $couper = $coupondata[0]['coupon_percentage_inr'];
                                $couponamount = $subtotal*$couper/100;
                                $subtotalco = $subtotal-$couponamount-$wallet;
                                $taxamt = $subtotalco*$taxper/100;
                                $grandtotal = $subtotalco+$taxamt+$shipping+$giftwrap_pr;
                                if($grandtotal>0 && $couponamount>0){
                                    $res['status'] = 'success';
                                    $res['message'] = '<span class="text-success">Coupon applied with '.$couper.'%</span>';
                                    $res['subtotal'] = $subtotal;
                                    $res['tax'] = number_format($taxamt,2);
                                    $res['grandtotal'] = number_format($grandtotal,2);
                                    $res['coupon_amt'] = number_format($couponamount,2);
                                    $res['couper'] = $couper;
                                    $res['coupon_id'] = $coupondata[0]['id'];
                                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $res];
                                }else{
                                    $res['status'] = 'error';
                                    $res['message'] = 'Something Went wrong.,Please try again later';
                                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $res]; 
                                }
            	            }
            	        }else{
            	            $res['status'] = 'error';
            	            $res['message'] = 'Invalid Coupon';
            	            $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $res]; 
            	        }
                    }
                    else{
                        $res['status'] = 'error';
                        $res['message'] = 'Insufficient Data';
                        $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => $res]; 
                    }
                }
            }
             $this->response($response);
            }catch(Exception $e){
                $data = unserialize($e->getMessage());
                if(is_array($data)){
                    $this->response($data);exit;
                }else{
                    $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                    $this->response($message);exit;
                }
            }
	    }
	
	
        public function getWalletCheckout(){
	    try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
            $mandatoryFields = ['user_id'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                
                $errorMessage = strip_tags(validation_errors());
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
                }else{
                    $refer = $this->Common_model->getDataFromTable('referal_options','*', $whereField='id', $whereValue='1',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                    $user_id = $this->input->post('user_id');
                    $added_amount = $this->db->query("select sum(points) as total_add from user_referals where user_id='".$user_id."' and status='Added' ")->result_array();
                    $debit_amount = $this->db->query("select sum(points) as total_add from user_referals where user_id='".$user_id."' and status='Deducted' ")->result_array();
                    $refer_points = $added_amount[0]['total_add'] - $debit_amount[0]['total_add'];
                    if($refer_points>0){
                        $data['redeem_percentage'] = $refer[0]['redeem_percentage'];
                        $data['walletdis'] = round(($refer_points*$refer[0]['redeem_percentage'])/100);
                    }else{
                        $data['redeem_percentage'] = 0;
                        $data['walletdis'] = 0;
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'Data' => $data]; 
                    $this->response($response);
                }
          }
	    }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
	}
	
	public function getWallet(){
	    try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
            $mandatoryFields = ['user_id'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                 $errorMessage = strip_tags(validation_errors());
                 throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
            }else{
                    $data['refer'] = $this->Common_model->getDataFromTable('referal_options','*', $whereField='id', $whereValue='1',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                    $user_id = $this->input->post('user_id');
                    $added_amount = $this->db->query("select sum(points) as total_add from user_referals where user_id='".$user_id."' and status='Added' ")->result_array();
                    $debit_amount = $this->db->query("select sum(points) as total_add from user_referals where user_id='".$user_id."' and status='Deducted' ")->result_array();
                    $data['refer_points'] = $added_amount[0]['total_add'] - $debit_amount[0]['total_add'];
                    if($data['refer_points']>0){
                        $res['wallet'] = $data['refer_points'];
                    }else{
                        $res['wallet'] = 0;
                    }
                    $res['referal_points'] = $data['refer'][0]['referal_points'];
                    $response = ['response_code' => 0, 'statuscode' => 200, 'Data' => $res]; 
                    $this->response($response);
                }
            }
	    }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
	}
	
	public function getAccount(){
	    try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
            $mandatoryFields = ['user_id'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                
                $errorMessage = strip_tags(validation_errors());
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
                }else{
        
                    $user_id = $this->input->post('user_id');
                    $account = $this->Common_model->getDataFromTable('users','id,name,username,phone_number,referal_code', $whereField='id', $whereValue=$user_id,$orderBy='id', $order='DESC', $limit='', $offset=0, true);
                    
                    if($account[0]!=''){
                         $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','Data' => $account[0]]; 
                    }else{
                        $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Invalid User Id']; 
                    }
                    $this->response($response);
                }
          }
	    }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
	}
    
    public function updateAccount(){
	    try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
            $mandatoryFields = ['user_id','name','username','phone_number'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                $errorMessage = strip_tags(validation_errors());
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
            }else{
                    $user_id = $this->input->post('user_id');
                    foreach($this->input->post() as $fieldname=>$fieldvalue){
                        $insdata[$fieldname]= $this->input->post($fieldname);
                    }
                    unset($insdata['user_id']);
                    if($insdata['password'] == ''){
                       unset($insdata['password']);
                    }else if($insdata['password']!=''){
                        $insdata['password'] = md5($insdata['password']);
                    }
                    $ins = $this->Common_model->updateDataFromTabel('users',$insdata,'id',$user_id);
                    if($ins){
                     $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Account Updated Successfully'];
                     $this->response($response);
                    }
                    $this->response($response);
                }
          }
	    }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
	}
	
	public function getSearchProducts()
    {
        try{
            if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }
            $mandatoryFields = ['user_id','search_string'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                $errorMessage = strip_tags(validation_errors());
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
            }else{
                $user_id = $this->input->post('user_id');
                $newin = $this->db->query("select * from products where product_name like '%".$this->input->post('search_string')."%' and product_status='Active' and stock_status = 'In Stock'")->result_array();
                if(!empty($newin)){
                    foreach($newin as $new){
                        $rgetprice = $this->Common_model->getDataFromTable('product_variants','weight_in_grams,variant_id',  $whereField=array('product_id'=>$new['id'],'status'=>'In Stock'), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                        $rvariant_name = $this->Common_model->getDataFromTable('variants','id,variant_name',  $whereField=array('id'=>$rgetprice[0]['variant_id']), $whereValue='',$orderBy='id', $order='ASC', $limit='1', $offset='0', true);
                        $getwishproduct = $this->Common_model->check_exists('wishlist',array('product_id'=>$new['id'],'user_id'=>$user_id),'','',''); 
                        $res['product_id'] = $new['id'];
                        $res['product_name'] = $new['product_name'];
                        $res['product_description'] = $new['product_description'];
                        $res['product_weight'] = $rgetprice[0]['weight_in_grams'];
                        $res['product_size'] = $rvariant_name[0]['variant_name'];
                        $res['product_image'] = base_url($new['product_thumbnail']);
                        if($getwishproduct == 1){
                            $res['wishlist'] = true;
                        }else{
                             $res['wishlist'] = false;
                        }
                        $resp[] = $res;
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $resp];
                }else{
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                }
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function placeOrder(){
        try{
            if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }
            $mandatoryFields = ['user_id','cart_id','delivery_id','taxper','taxamt','couponid','shipping','wallet','payment_id'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                $errorMessage = strip_tags(validation_errors());
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
            }else{
                $insdata['status'] = 'Pending';	
    			$insdata['payment_status'] = 'Paid';	
    			$insdata['user_id'] = $this->input->post('user_id');	
    			$insdata['delivery_address_id'] = $this->input->post('delivery_id');;
    			$insdata['insert_dt'] = date("Y-m-d h:i:s");
                $insdata['order_number'] = "KTS-".rand(9999,100000).'-'.time();
                $insdata['currency'] = 'INR';
                $insdata['tax_percentage'] = $this->input->post('taxper');
                $insdata['tax'] = $this->input->post('taxamt');
                $insdata['shipping'] = $this->input->post('shipping');
                $insdata['wallet'] = $this->input->post('wallet');
                $insdata['payment_response'] =  $this->input->post('payment_id');
                $couponamount = 0;
    			$insertorder = $this->db->insert('orders',$insdata);
    			$orderid = $this->db->insert_id();
    			$cart = $this->db->get_where('cart',array('user_id'=>$this->input->post('user_id'),'cart_session_id'=>$this->input->post('cart_id')))->result();
    			$grandtotal = $total = $coupon_id = 0;
    			foreach($cart as $order_items)
    			{
    				$orderitems['order_id'] = $orderid;
    				$orderitems['product_id'] = $order_items->product_id;
    			    $orderitems['price'] = $order_items->price;
    				$orderitems['quantity'] = $order_items->quantity;
    				$orderitems['variant_id'] = $order_items->variant_id;
    				$orderitems['variant'] = $order_items->variant;
    				$orderitems['subtotal'] = ($order_items->quantity*$orderitems['price']);
    				$orderitems['insert_dt'] = date("Y-m-d h:i:s");
    				$total+= ($orderitems['price']*$order_items->quantity);
    				$insertorderitems = $this->db->insert('order_items',$orderitems);
    				$variantD = $this->Common_model->getDataFromTable('product_variants','available_quantity',  $whereField=array('product_id'=>$orderitems['product_id'],'variant_id'=>$orderitems['variant_id']), $whereValue='',$orderBy='id', $order='desc', $limit='1', $offset='0', true);
    				$updateStockQ['available_quantity'] = $variantD[0]['available_quantity'] - $orderitems['quantity'];
    				if($updateStockQ['available_quantity'] == 0){
    				    $updateStockQ['status'] = 'Out Stock';
    				}
    		    	$this->Common_model->updateDataFromTabel('product_variants',$updateStockQ,array('product_id'=>$orderitems['product_id'],'variant_id'=>$orderitems['variant_id']),'');	
    			}
    			if(!empty($this->input->post('couponid'))){
    			    $whr['id'] = $this->input->post('couponid');
    			    $coupondata = $this->Common_model->getDataFromTable('coupons','*',  $whereField=$whr, $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
                    $couper = $coupondata[0]['coupon_percentage_inr'];
                    $couponamount = $total*$couper/100;
                    $total = $total-$couponamount;
                    $coupon_id = $this->input->post('couponid');
    			}
    			$grandtotal = $total+$insdata['tax']+$insdata['shipping']-$insdata['wallet'];
    			$upd =	$this->db->query("update orders set subtotal='".$total."', grand_total='".$grandtotal."',coupon_discount='".$couponamount."',coupon_id='".$coupon_id."' where id='".$orderid."'");
    			$del = $this->db->query("delete from cart where cart_session_id='".$this->input->post('cart_id')."'");
    			if($insdata['wallet']>0){
    			    $dedwallet['points'] = $insdata['wallet'];
    			    $dedwallet['status'] = 'Deducted';
    			    $dedwallet['order_id'] = $orderid;
    			    $dedwallet['user_id'] = $this->input->post('user_id');
    			    $dedwallet['created_on'] = date("Y-m-d h:i:s");
    			    $this->db->insert('user_referals',$dedwallet);
    			}
    			if($del){
    			    $this->sendInvoiceCustomer($insdata['order_number']);
    			    $this->sendInvoiceAdmin($insdata['order_number']);
                    $res['order_number'] = $insdata['order_number'];
                    $res['status'] = 'success';
                    $res['order_id'] = $orderid;
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $res];
                    $this->response($response);
    			}
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
    
    public function myOrders(){
        try{
            if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
            }
            $mandatoryFields = ['user_id'];
            foreach($mandatoryFields as $row){
            	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
            	$this->form_validation->set_rules($row, $fieldname, 'required'); 
            }
            if($this->form_validation->run() == FALSE){
                $errorMessage = strip_tags(validation_errors());
                throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
            }else{
                $orders = $this->Common_model->getDataFromTable('orders','id,order_number,grand_total,status,insert_dt',$whereField=['user_id'=>$this->input->post('user_id')], $whereValue='',$orderBy='id', $order='desc', $limit='', $offset='0', true);
                if(!empty($orders[0])){
                    foreach($orders as $order){
                        $orderdt['order_id'] = $order['id'];
                        $orderdt['order_number'] = $order['order_number'];
                        $orderdt['grand_total'] = $order['grand_total'];
                        $orderdt['status'] = $order['status'];
                        $orderdt['ordered_on'] = $order['insert_dt'];
                        $orderdt['cancel'] = ($order['status'] == 'Pending') ? true : false;
                        $curdate = date_create(date('Y-m-d'));
                        $ordate = date_create($order['insert_dt']);
                        $days = date_diff($ordate,$curdate);
                        $orderdt['return'] = ($days->format('%a')<20 && $order['status'] == 'Completed') ? true : false;
                        $orderres[] = $orderdt;
                        
                    }
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Found','data' => $orderres];
                }else{
                    $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Data Not Found'];
                }
                $this->response($response);
            }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
    }
	
	public function sendInvoiceCustomer($order_number){
	    if($order_number!=''){
    	    $odata['order_details'] = $this->Common_model->getDataFromTable('orders','*',  $whereField='order_number', $whereValue=$order_number,$orderBy='id', $order='desc', $limit='', $offset='0', true);
            $odata['order_items'] = $this->db->query("select order_items.*,products.product_name from order_items left join products on products.id = order_items.product_id where order_id='".$odata['order_details'][0]['id']."'")->result();
            $odata['user_details'] = $this->Common_model->getDataFromTable('users','*',  $whereField='id', $whereValue=$odata['order_details'][0]['user_id'],$orderBy='id', $order='desc', $limit='', $offset='0', true);
            $odata['address'] = $this->Common_model->getDataFromTable('addresses','*',  $whereField='id', $whereValue=$odata['order_details'][0]['delivery_address_id'],$orderBy='id', $order='desc', $limit='', $offset='0', true);
            $enduserHTML = $this->load->view('invoice',$odata,true);
            $Subject  = "Your ".SITENAME." Order Recieved - ".$odata['order_details'][0]['order_number'];
            $send = $this->Email_model->send($odata['user_details'][0]['username'],$Subject,$enduserHTML,$otherCC='');
            return true;
	    }
	}
	
	public function sendInvoiceAdmin($order_number){
	    if($order_number!=''){
    	    $contactD = $this->Common_model->getDataFromTable('contact_details','*',  $whereField='', $whereValue='',$orderBy='id', $order='DESC', $limit='', $offset=0, true);
    	    $odata['order_details'] = $this->Common_model->getDataFromTable('orders','*',  $whereField='order_number', $whereValue=$order_number,$orderBy='id', $order='desc', $limit='', $offset='0', true);
            $odata['order_items'] = $this->db->query("select order_items.*,products.product_name from order_items left join products on products.id = order_items.product_id where order_id='".$odata['order_details'][0]['id']."'")->result();
            $odata['user_details'] = $this->Common_model->getDataFromTable('users','*',  $whereField='id', $whereValue=$odata['order_details'][0]['user_id'],$orderBy='id', $order='desc', $limit='', $offset='0', true);
            $odata['address'] = $this->Common_model->getDataFromTable('addresses','*',  $whereField='id', $whereValue=$odata['order_details'][0]['delivery_address_id'],$orderBy='id', $order='desc', $limit='', $offset='0', true);
            $enduserHTML = $this->load->view('invoice',$odata,true);
            $Subject  = "New Order Recieved - ".$odata['order_details'][0]['order_number']." From ".$odata['user_details'][0]['name'];
            //$contactD[0]['contact_email']
            $send = $this->Email_model->send($contactD[0]['contact_email'],$Subject,$enduserHTML,$otherCC='');
            return true;
	    }
	}
	
	
	public function contactForm(){
	    try{
          if($this->input->server('REQUEST_METHOD')!='POST'){
                throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
          }else{
                $errmsg = '';
                $mandatoryFields = ['first_name','last_name','email_subject','email','mobile'];
                foreach($mandatoryFields as $row){
                	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
                	$this->form_validation->set_rules($row, $fieldname, 'required'); 
                }
                if($this->form_validation->run() == FALSE){
                    
                    $errorMessage = strip_tags(validation_errors());
                    throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
                }else{
                    foreach($this->input->post() as $fieldname=>$fieldvalue){
                        $insdata[$fieldname]= $this->input->post($fieldname);
                    }
                        $insdata['created_on'] = date('Y-m-d h:i:s');
                        $ins = $this->Common_model->addDataIntoTable('enquiry',$insdata);
                    if($ins){
                     $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Enquiry Submitted Successfully'];
                     $this->response($response);
                    }
                }
          }
        }catch(Exception $e){
            $data = unserialize($e->getMessage());
            if(is_array($data)){
                $this->response($data);exit;
            }else{
                $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
                $this->response($message);exit;
            }
        }
	}
	
	
	// public function cancelOrder(){
	//     try{
    //       if($this->input->server('REQUEST_METHOD')!='POST'){
    //             throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
    //       }else{
    //             $errmsg = '';
    //             $mandatoryFields = ['message','orderid'];
    //             foreach($mandatoryFields as $row){
    //             	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
    //             	$this->form_validation->set_rules($row, $fieldname, 'required'); 
    //             }
    //             if($this->form_validation->run() == FALSE){
    //                 $errorMessage = strip_tags(validation_errors());
    //                 throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
    //             }else{
    //                 $getorder = $this->Common_model->getDataFromTable('orders','status',  $whereField='id', $whereValue=$this->input->post('orderid'),$orderBy='id', $order='DESC', $limit='', $offset=0, true);
    //                 if($getorder[0]['status'] == 'Pending'){
    //                     $data['cancelled_by'] = 'User';
    //                     $data['reason'] = $this->input->post('message');
    //                     $data['status'] = 'Cancelled';
    //                     $upd = $this->Common_model->updateDataFromTabel('orders',$data,'id',$this->input->post('orderid'));
    //                     if($upd){
    //                      $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Order Cancelled Successfully'];
    //                      $this->response($response);
    //                     }
    //                 }else{
    //                     $response = ['response_code' => 1, 'statuscode' => 200, 'response_desc' => 'Invalid order Id'];
    //                      $this->response($response);
    //                 }
    //             }
    //       }
    //     }catch(Exception $e){
    //         $data = unserialize($e->getMessage());
    //         if(is_array($data)){
    //             $this->response($data);exit;
    //         }else{
    //             $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
    //             $this->response($message);exit;
    //         }
    //     }
	// }
	
	// public function returnOrder(){
	//     try{
    //       if($this->input->server('REQUEST_METHOD')!='POST'){
    //             throw new Exception(serialize(['response_code' => 1, 'statuscode' => 405, 'response_desc' => 'Invalid HTTP Request Method']));
    //       }else{
    //             $errmsg = '';
    //             $mandatoryFields = ['orderid'];
    //             foreach($mandatoryFields as $row){
    //             	$fieldname = ucwords(strtolower(str_replace("_", " ", $row)));
    //             	$this->form_validation->set_rules($row, $fieldname, 'required'); 
    //             }
    //             if($this->form_validation->run() == FALSE){
    //                 $errorMessage = strip_tags(validation_errors());
    //                 throw new Exception(serialize(['response_code' => 0, 'statuscode' => 200, 'response_desc' => $errorMessage]));
    //             }else{
    //                 $getorder = $this->Common_model->getDataFromTable('orders','status,insert_dt',  $whereField='id', $whereValue=$this->input->post('orderid'),$orderBy='id', $order='DESC', $limit='', $offset=0, true);
    //                 $curdate = date_create(date('Y-m-d'));
    //                 $ordate = date_create($getorder[0]['insert_dt']);
    //                 $days = date_diff($ordate,$curdate);
    //                 if($getorder[0]['status'] != 'Completed'){
    //                     $response = ['response_code' => 1, 'statuscode' => 200, 'response_desc' => 'Order status is '.$getorder[0]['status']];
    //                      $this->response($response);
    //                 }else if($days->format('%a')>20){
    //                     $response = ['response_code' => 1, 'statuscode' => 200, 'response_desc' => 'You cant return the order now'];
    //                      $this->response($response);
    //                 }else{
    //                     $data['cancelled_by'] = 'User';
    //                     $data['reason'] = $this->input->post('message');
    //                     $data['status'] = 'Cancelled';
    //                     $upd = $this->Common_model->updateDataFromTabel('orders',$data,'id',$this->input->post('orderid'));
    //                     if($upd){
    //                      $response = ['response_code' => 0, 'statuscode' => 200, 'response_desc' => 'Order Cancelled Successfully'];
    //                      $this->response($response);
    //                     }
    //                 }
    //             }
    //       }
    //     }catch(Exception $e){
    //         $data = unserialize($e->getMessage());
    //         if(is_array($data)){
    //             $this->response($data);exit;
    //         }else{
    //             $message = array('response_code' => 1, 'statuscode' => 422, 'block' => 'Exception', 'response_desc' => $e->getMessage());
    //             $this->response($message);exit;
    //         }
    //     }
	// }
	
    public function response($responseArray){
        $statuscode = '200';
        $message = 'OK';
        if($statuscode != '200'){
            $message = 'Error';
        }
        header("HTTP/1.1 ". $statuscode . " ". $message);
        header("Content-Type: application/json");
        echo json_encode($responseArray);
        unset($responseArray['statuscode']);
        exit;
    }
}
?>