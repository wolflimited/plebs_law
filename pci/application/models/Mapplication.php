<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class MApplication extends CI_Model{
		public function create($parameters){
			//user_id - user id: int legnth 5
			//serving - are they serving on a jury: tinyint true/false
			if($this->db->insert('application',$parameters)){
        		return $this->db->insert_id();
			}
            return false;
		}
		public function get_applications_by_status($status = 'pending',$type = 'judge_application'){
			$results = $this->db->order_by('creation','DESC')
			->where(array('status' => $status))
			->where(array('type' => $type))
			->get('application')
			->result();
			if(count($results) > 0){
				return $results;
			}
			return false;
		}
	}