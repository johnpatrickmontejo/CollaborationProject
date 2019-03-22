<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Useraccount', 'user');
		$this->load->model('Product','prod');		
	}

	public function index(){
		$this->check_access();
		$data['users'] = $this->user->read();

		$data['pagename'] = 'Dashboard';
		$data['contents'] = 'dashboard';
		$this->load->view('templates/header');		
		$this->load->view('templates/sbadmin'), $data);
		$this->load->view('templates/footer');
	}

	public function update(){
		$this->check_access();
		$userid = $this->input->get('userid');

		$data['useraccount'] = $this->user->read($userid);

		$data['pagename'] = 'Dashboard';
		$data['contents'] = 'contents/admin/update';		
		$this->load->view('templates/main', $data);

	}

	public function updateAccount(){

		$data = $this->input->post();
		$userid = $this->input->post('userid');

		if($this->user->update($data, $userid)){
			redirect('dashboard');
		}else{
			echo "Failed to update! <a href='".base_url('dashboard')."'>Go back</a>";
		}

	}

	public function disable(){

		$userid = $this->input->get('userid');

		if($this->user->disable($userid)){
			redirect('dashboard');
		}else{
			echo "Failed to disable! <a href='".base_url('dashboard')."'>Go back</a>";
		}

	}

	private function check_access(){
		if($this->session->has_userdata('logged_in')){
			if($this->session->userdata('accesslevel') == 1){
				return true;
			}else{
				redirect('app');
			}
	    }else{
	    	redirect('app');
	    }
    }

}