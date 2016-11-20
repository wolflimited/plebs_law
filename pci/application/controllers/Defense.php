<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Defense extends CI_Controller{
        public function index(){

        }
		public function apply(){
			if($this->input->get() && $this->input->get('defend')){
				$this->load->model('mcase');
				$user = $this->ion_auth->user()->row();
				$type = 'defendant';
				if($this->input->get('type')){
					$type = $this->input->get('type');
				}
				if($this->mcase->add_defense($this->input->get('defend'),$user->id,$type)){
					redirect(site_url() . '?message=You\'ve been added as ' . $type . '.&status=success');
				}else{
					redirect(site_url() . '?message=Something went wrong adding you as ' . $type . '.&status=alert');
				}
			}
		}
    }