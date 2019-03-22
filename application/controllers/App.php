<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Useraccount', 'user');
	}

	public function index(){
		$this->check_access();
		$data['pagename'] = 'Login';
		$data['contents'] = 'login';
		$this->load->view('templates/headerlogin');
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');
	}

	public function register(){
		$data['pagename'] = 'Register';
		$data['contents'] = 'registration';	
		$this->load->view('templates/header');	
		$this->load->view('templates/main', $data);
		$this->load->view('templates/footer');
	}


	public function login(){
		$data = $this->input->post();
		$result = $this->user->check_account($data);

		if(count($result) && $result[0]->accesslevel == 1){
			$this->setSession($result);			
			redirect('dashboard');
		}else if(count($result) && $result[0]->accesslevel == 3){
			$this->setSession($result);			
			redirect('Shop');
		}else{
			$this->setFlashData(array('alertType' => 'danger'));
			$this->setFlashData(array('system_msg' => array("Account doesn't Exist!")));
		}

		redirect('app');

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('app');
	}

	public function registration(){

		$data = $this->input->post(); // return $_POST global array

		$result = $this->validate($data); // return array of error messages

		$this->setFlashData(array('alertType' => 'danger'));

		if(count($result) == 0){
			if($this->user->create($data)){
				$this->setFlashData(array('alertType' => 'success'));
				$this->setFlashData(array('system_msg' => array("Successfully Registered!")));
			}else{
				$this->setFlashData(array('system_msg' => array("Failed to create!")));
			}
		}else{
			$this->setFlashData(array('system_msg' => $result));
		}
		
		redirect('app/register');
	}

	private function setSession($data){
		$sessionData = array(
		    'username'  => $data[0]->username,
		    'accesslevel' => $data[0]->accesslevel,
		    'logged_in' => TRUE
		);

		$this->session->set_userdata($sessionData);
	}

	private function setFlashData($data){
		$this->session->set_flashdata($data);
	}

	private function check_access(){
		if($this->session->has_userdata('logged_in')){
			if($this->session->userdata('accesslevel') == 1){
				redirect('dashboard');
			}else if($this->session->userdata('accesslevel') == 3){
				redirect('shop');
			}
		}else{
			return true;
		}
	}

	private function validate($data){

		$sudlanan_sa_error = []; 

		if($data['username'] == ''){
			array_push($sudlanan_sa_error, "Username is not define");
		}

		if(strlen($data['password']) < 6){
			array_push($sudlanan_sa_error, "Password should be atleast 6 characters");
		}

		if($data['password'] == ''){
			array_push($sudlanan_sa_error, "Password is not define");
		}

		if($data['repassword'] == ''){
			array_push($sudlanan_sa_error, "Please confirm your password");
		}

		if($data['password'] != $data['repassword']){
			array_push($sudlanan_sa_error, "Password doesn't match");
		}

		return $sudlanan_sa_error; // array size is zero if no errors
	}

}
