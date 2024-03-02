<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function __construct(){
		parent::__construct();
    } 

    public function index(){
        $data = [];
        $this->home_template->load('front_template','home',$data); 
    }

}
?>