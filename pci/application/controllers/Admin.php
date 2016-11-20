<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Admin extends CI_Controller {
		public function index(){
		}
		public function users(){
			$this->load->helper('auth');
			$this->load->helper('url');
			$vars = array();
			if(!loginOrRedirect()){
				if($this->input->get()){
					if($this->input->get('id') && $this->input->get('action')){
						if($this->input->get('action') == 'loginas'){
							$userID = $this->input->get('id');
							$user = $this->ion_auth->user($userID)->row();
							$this->ion_auth->login($user->email,$user->password,FALSE,TRUE);
							$this->session->set_userdata('loginas',TRUE);
							redirect('dashboard');
						}
					}	
				}
				$vars['users'] = $this->ion_auth->users()->result();
				$this->load->template('pages/admin/users',$vars);
			}
		}
	}
