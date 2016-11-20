<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Prosecution extends CI_Controller{
        public function index(){

        }
		public function apply(){
			if($this->input->get() && $this->input->get('prosecute')){
				$this->load->model('mcase');
				$user = $this->ion_auth->user()->row();
				$type = 'prosecutor';
				if($this->input->get('type')){
					$type = $this->input->get('type');
				}
				if($this->mcase->add_prosecutor($this->input->get('prosecute'),$user->id,$type)){
					redirect(site_url() . '?message=You\'ve been added as ' . $type . '.&status=success');
				}else{
					redirect(site_url() . '?message=Something went wrong adding you as ' . $type . '.&status=alert');
				}
			}
		}
    }