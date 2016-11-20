<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cases extends CI_Controller {
	public function index(){
		if($this->input->get() || $this->input->post()){
			$this->load->helper('auth');
			$this->load->helper('case');
			$this->load->helper('capabilities');
			$this->load->helper('form');
			$this->load->model('mcase');
			//$this->load->helper('submission');
			$vars = array();
			$user = $this->ion_auth->user()->row();
			if($this->input->post()){
			}elseif($this->input->get()){
				$vars['id'] = $this->input->get('id');
				$vars['action'] = $this->input->get('action');
				if($vars['action'] == 'edit'){
				}
				elseif($vars['action'] == 'delete'){
					$this->mcase->delete_by_id($vars['id']);
					redirect('dashboard?message=Case was succesfully deleted&level=success');
				}
			}
						
			$user = $this->ion_auth->user()->row();
			$vars['userID'] = $user->id;
			$case = getCase($vars['id']);
			$this->load->model('mfile');
			$data = array(
				'case' => $case,
				'files' => $this->mfile->attached_files($case->id),
				'user_id' => $case->author,
				'defense' => $this->mcase->get_defendant($case->id),
				'prosecutor' => $this->mcase->get_prosecutor($case->id),
				'author' => $this->ion_auth->user($case->author)->row(),
                'thumbnail' => $this->mfile->thumbnail($case->id)
			);
			$vars = array_merge($data,$vars);
			//$vars['creationDate'] = date('dS M Y',$case->creation);
			$vars['submissions'] = array();
			$vars['creationDate'] = '';
			$vars['authorName'] = '';
			$this->load->template('pages/case/case',$vars);
		}
	}
    //first submission of case by prosecutor or pleb law user (not necessarily always a prosecutor submitting)
	public function create(){
		$this->load->helper('auth');
		if(!loginOrRedirect()){
			$vars = array();
			if($this->input->post()){
				$this->load->library('form_validation');
				$this->load->helper('security');
				$this->form_validation->set_rules(array(
					array(
						'field' => 'title',
						'label' => 'Title',
						'rules' => 'required|xss_clean'
					),
					array(
						'field' => 'subject',
						'label' => 'Case Subject',
						'rules' => 'required|xss_clean'
					),
				));
				if($this->form_validation->run()){
					//need to validate if can create also need to convert line spaces in description to html
					$this->load->model('mcase');
					$user = $this->ion_auth->user()->row();
					$author_prosecuting = 0;
					if($this->input->post('prosecuting') == 'on'){
						$author_prosecuting = 1;
					}
					$caseID = $this->mcase->create(array(
						'title' => $this->input->post('title'),
						'evidence' =>  json_encode($this->input->post('urls')),
						'subject' => $this->input->post('subject'),
						'reason' => $this->input->post('reason'),
						'claim' => $this->input->post('claim'),
						'grounds' => $this->input->post('grounds'),
						'precedence' => $this->input->post('precendence'),
						'incident_start' => $this->input->post('start_of_incident'),
						'incident_end' => $this->input->post('end_of_incident'),
						'author_prosecuting' => $author_prosecuting,
						'status' => 'judge_moderation',
						'author' => $user->id,
					));
					if($caseID != false){
						if($author_prosecuting){
							$this->mcase->add_prosecutor($caseID,$user->id,'prosecutor');
						}
						$this->load->model('mfile');
						$this->mfile->upload_files('thumbnail','thumbnail',$caseID);
						if(is_array($this->input->post('file_ids'))){
							foreach($this->input->post('file_ids') as $key => $fileID){
								$this->mfile->attach_file($fileID,$caseID);
							}
						}
						$this->load->template('pages/case/success');
					}	
				}
			}else{
				$this->load->helper('form');
				$this->load->template('pages/case/form',$vars);
			}		
		}		
	}
    //displays list of cases up for moderation
    public function moderate(){
        $this->load->model('mcase');
        $this->load->helper('text_helper');
        $cases = $this->mcase->get();
        $vars['content'] = '';
        foreach($cases as $case){
            $content = array(
                'id' => $case->id,
                'title' => $case->title,
                'subject' => ShortenText($case->subject,256),
                'date' => $case->creation,
                'user' => $case->author,
            );
           $vars['content'] .= $this->load->view('templates/cases/moderate',$content,true);
        }
        $this->load->template('templates/pages/moderation',$vars);
    }
    //displays list of cases that need prosecutor
    public function prosecution(){
        
    }
    //displays list of cases that need defence
    public function defence(){
        
    }
	public function defend(){
		$this->load->helper('auth');
		if(!loginOrRedirect()){
			if($this->input->get()){
				$caseID = $this->input->get('caseid');
				$user = $this->ion_auth->user()->row();
				$this->load->helper('capabilities');
				//overide authentication
				//if(canDefend()){
				if(true){
					$this->db->where('id',$caseID);
					$this->db->update('cases',array(
						'defendant' => $user->id
					));
				}
			}
			redirect(site_url('dashboard') . '?id=' . $caseID . '&action=defending');
		}
	}
	public function moderateSubmission(){
		$this->load->helper('auth');
		if(!loginOrRedirect()){
			$this->load->helper('capabilities');
			//overide authentication
			//if(canModerate()){
			if(true){
				if($this->input->get()){
					$submissionID = $this->input->get('id');
					$this->db->where('id',$submissionID);
					$this->db->update('submissions',array(
						'status' => 2
					));
					redirect(site_url('dashboard'));
				}
			}
		}
	}
}
