<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class MFile extends CI_Model{
		public function insert_file($url,$name,$type = 'file',$caseid = ''){
			$data = array(
				'url' => $url,
				'name' => $name,
				'type' => $type
			);
			$this->db->insert('file',$data);
			$fileID = $this->db->insert_id();
			if($caseid != ''){
				$this->attach_file($fileID,$caseid);
			}
        	return $fileID;
		}
		public function attach_file($fileID,$attachmentID)
        {
			$data = array(
				'attachment_id' => $attachmentID
			);
			$this->db->where('id',$fileID);
			$this->db->update('file',$data); 
		}
		public function attached_files($id)
        {
			$results = $this->db->get_where('file',array('attachment_id' => $id))
			->result();
			if(count($results) > 0){
				return $results;
			}
			return false;
		}
		public function thumbnail($id)
        {
			$result = $this->db->get_where('file',array('attachment_id' => $id,'type' => 'thumbnail'))
			->row();
            return $result;
		}
		public function get_file_url($id)
        {
            $result = $this->db->get_where('file',array('attachment_id' => $id,'type' => 'thumbnail'))
                ->row();
            if($result){
                return $this->config->base_url() . $result['url'];
            }
            return false;
        }
		public function upload_files($name,$type = 'file',$caseid = '')
        {
			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf';
			$config['max_size'] = 1024 * 8;
			$config['encrypt_name'] = TRUE;
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload($name)){
				print_r(array('error' => $this->upload->display_errors()));
			}else{
				$data = $this->upload->data();
				return $this->mfile->insert_file('uploads/' . $data['file_name'],$data['orig_name'],$type,$caseid);
			}
		}
	}