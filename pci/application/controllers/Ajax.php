<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Ajax extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('mfile');
			$this->load->database();
			$this->load->helper('url');
		}
		public function index(){
		}
		public function upload(){
			$this->load->helper('auth');
			$this->load->helper('url');
			$this->load->helper('text');
			$response = array('error' => 4);
			if(!loginOrRedirect()){
				$config['upload_path'] = './uploads/';
				$config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
				$config['max_size'] = 1024 * 8;
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('files')){
					print_r(array('error' => $this->upload->display_errors()));
				}else{
					$data = $this->upload->data();
					$fileID = $this->mfile->insert_file(site_url('uploads') . '/' . $data['file_name'],$data['orig_name']);
					$thumbnail = '';
					switch($data['file_type']){
							case 'application/pdf':
								$thumbnail = site_url() . "/img/uploader/filepdf.png";
								break;
							default:
								$thumbnail = site_url() . "/img/uploader/file.png";
					}
					$response = array(
						'error' => 0,
						'title' => ShortenText($data['orig_name'],15),
						'image_id' => $fileID,
						'thumbnail' => $thumbnail
					);
				}
			}
			echo json_encode($response);
		}
	}
