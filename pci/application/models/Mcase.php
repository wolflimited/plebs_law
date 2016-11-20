<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class MCase extends CI_Model{
		public function create($values){
            $presets = array(
                'creation' => date('Y-m-d H:i:s',now()),
            );
            $parameters = array_replace($presets,$values);
			if($this->db->insert('case',$parameters)){
				$case_id = $this->db->insert_id();
				$this->load->model('mjury');
				$jurors = $this->mjury->get_avaliable(50);
				if(is_array($jurors)){
					foreach($jurors as $juror){
						$this->mjury->add_juror($case_id,$juror->user_id,'request_sent');
					}
				}
        		return $case_id;
			}
            return false;
		}
        public function get(){
            $results = $this->db->get('case')->result();
            if(count($results) > 0){
                return $results;
            }
            return false;
        }
		public function get_by_id($id){
			$results = $this->db->get_where('case',array('id' => $id))
			->result();
            if(count($results) > 0){
                return $results;
            }
            return false;
		}
		public function delete_by_id($id){
			$this->db->delete('case',array('id' => $id));
		}
		public function attach_file($fileID,$attachmentID){
			$data = array(
				'attachment_id' => $attachmentID
			);
			$this->db->where('id',$fileID);
			$this->db->update('files',$data); 
		}
        public function add_prosecutor($caseID,$userID,$type){
            if($this->db->insert('prosecutor',array(
                'case_id' => $caseID,
                'user_id' => $userID,
                'type' => $type
            ))){
                return $this->db->insert_id();
            }
            return false;
        }
		public function add_defense($caseID,$userID,$type){
            if($this->db->insert('defendant',array(
                'case_id' => $caseID,
                'user_id' => $userID,
                'type' => $type
            ))){
                return $this->db->insert_id();
            }
            return false;
        }
        public function get_user_cases($id = ''){
            if($id == ''){
                $id = $this->ion_auth->user()->row()->id;
            }
            $results = $this->db->from('case')
            ->where('author',$id)
			->order_by('creation','DESC')
            ->get()
            ->result();
            if(count($results) > 0){
                return $results;
            }
            return false;
        }
        public function get_defendant($id){
            $results = $this->db->from('defendant')
            ->where('case_id',$id)
            ->get()
            ->result();
            if(count($results) > 0){
				$users = array();
				foreach($results as $result){
					array_push($users,$this->ion_auth->user($result->user_id)->row()->username);
				}
                return $users;
            }
            return false;
        }
        public function get_prosecutor($id){
            $results = $this->db->from('prosecutor')
            ->where('case_id',$id)
            ->get()
            ->result();
            if(count($results) > 0){
                return $this->ion_auth->user($results[0]->user_id)->row()->username;
            }
            return false;
        }
		//redudant?
        public function get_cases_need_jury(){
            $results = $this->db->from('case')
            ->join('jury_service','case.id = jury_service.case_id')
            ->get()
			->result();
        }
		public function get_case_by_status($status = 'judge_moderation'){
			$results = $this->db->order_by('creation','DESC')
			->get_where('case',array('status' => $status))
			->result();
			if(count($results) > 0){
				return $results;
			}
			return false;
		}
		public function get_latest_cases(){
			$user_id = $this->ion_auth->user()->row()->id;
			if($this->ion_auth->is_admin()){
				$this->db->where('status','judge_moderation');
			}else{
				$this->db->where('status !=','judge_moderation');
			}
			$this->db->where('author !=',$user_id);
			$this->db->order_by('creation','DESC');
			$this->db->from('case'); 
			$results = $this->db->get()
			->result();
			if(count($results) > 0){
				return $results;
			}
			return false;
		}
		public function decline($id,$reason,$status = 'declined_by_judge'){
			$this->db->where('id',$id)
			->update('case',array(
				'status' => $status,
				'reason' => $reason
			));
		}
		public function approve($id){
			$case = $this->db->get_where('case',array('id' => $id))
			->result()[0];
			$status = 'approved';
			if($case->author_prosecuting == 1){
				$status = 'awaiting_prosecutor';
			}
			$this->db->where('id',$id)
			->update('case',array(
				'status' => $status
			));
		}
	}