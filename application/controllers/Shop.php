<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('Product','prod');		
	}	

	public function index(){
		$this->check_access();
		$data['latest_products'] = $this->prod->read_latest_product();		
		$data['products'] = $this->prod->read_all_products();
		$data['pagename'] = 'Shop';
		$data['contents'] = 'contents/shop/home';
		$this->load->view('templates/header');		
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');
	}
	public function details(){
		$this->check_access();
		$productid = $this->input->get('product');
		$data['product_detail']=$this->prod->read_product_by_id($productid);
		// $data['stock']=$this->prod->read_stocks_by_id($productid);
		//echo var_dump($data);
		$data['pagename'] = 'Details';
		$data['contents'] = 'contents/shop/single';
		$this->load->view('templates/header');		
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');		

	}

	private function check_access(){
		if($this->session->has_userdata('logged_in')){
			if($this->session->userdata('accesslevel') == 3){
				return true;
			}else{
				redirect('app');
			}
	    }else{
	    	redirect('app');
	    }
    }
}