<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Front_Page extends CI_Controller{
		public function index(){
			//redirect('dashboard');
			$this->load->model('mcase');
			$this->load->model('mfile');
			$cases = $this->mcase->get();
			foreach($cases as $key => $case){
				$case->attachments = $this->mfile->attached_files($case->id);
				if($thumbnail = $this->mfile->thumbnail($case->id)){
					$case->thumbnail = $thumbnail->url;
				}else{
					$case->thumbnail = '';
				}
				$cases[$key] = $case;
			}
            $this->load->template('frontpage/frontpage',array('frontpage' => true,'cases' => $cases));
		}
	}