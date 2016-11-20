<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class MJury extends CI_Model{
		public function create($parameters){
			//user_id - user id: int legnth 5
			//serving - are they serving on a jury: tinyint true/false
			if($this->db->insert('jury_pool',$parameters)){
        		return $this->db->insert_id();
			}
            return false;
		}
		public function get(){
			//gets all jurors
            $results = $this->db->get('jury_pool')
			->result();
            if(count($results) > 0){
                return $results;
            }
            return false;
        }
		public function get_avaliable($limit = ''){
			//gets avaliable jurors (not serving already)
			if($limit != ''){
				$this->db->limit($limit);
			}
			$results = $this->db->get_where('jury_pool',array('serving' => 0))
			->result();
            if(count($results) > 0){
                return $results;
            }
            return false;
		}
		public function get_requests(){
			//get jury service requests
			$user = $this->ion_auth->user()->row();
			$results = $this->db->get_where('jury_service',array('user_id' => $user->id,'status' => 'request_sent'))
			->result();
			if(count($results) > 0){
                return $results;
            }
            return false;
		}
		public function add_juror($case_id,$user_id,$status){
			//adds juror to case
			if($this->db->insert('jury_service',array(
					'case_id' => $case_id,
					'user_id' => $user_id,
					'status' => $status
			))){
				return $this->db->insert_id();
			}
			return false;
		}
		public function submit_juror_application($id,$reason,$accepted = false){
			//updates juror application
			$status = 'declined';
			if($accepted){
				$status = 'accepted_awaiting_selection';
				$service = $this->db->get_where('jury_service',array('id' => $id))
				->result()[0];
				$user_id = $service->user_id;
				$this->db->where('user_id',$user_id)
				->update('jury_pool',array(
					'serving' => 1
				));
			}
			$this->db->where('id',$id)
			->update('jury_service',array(
				'status' => $status,
				'reason' => $reason
			));
		}
		public function get_by_userid($id){
			//gets juror by user id  | user_id - user id: int legnth 5
            $results = $this->db->get_where('jury_pool',array('user_id' => $id))
			->result();
            if(count($results) > 0){
                return $results;
            }
            return false;
        }
		public function delete_by_userid($id){
			//deletes juror by user id  | user_id - user id: int legnth 5
			$this->db->delete('jury_pool',array('user_id' => $id));
		}
	}