<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Test extends CI_Controller{
		public function index(){
			$this->load->model('mjury');
			$jurors = $this->mjury->get_avaliable();
			var_dump($jurors);
		}
	}