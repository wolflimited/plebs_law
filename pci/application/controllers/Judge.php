<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Judge extends CI_Controller{
		public function index(){
			$this->load->helper('auth');
			if(!loginOrRedirect()){
				$this->load->model('mcase');
				$this->load->model('mfile');
				$this->load->helper('format');
				$this->load->helper('user');
				$this->load->library('form_validation');
				$this->load->helper('security');
				if($this->input->post()){
					$this->form_validation->set_rules(array(
						array(
							'field' => 'reason',
							'label' => 'Reason',
							'rules' => 'required|xss_clean'
						),
						array(
							'field' => 'id',
							'label' => 'Case ID',
							'rules' => 'required|xss_clean'
						)
					));
					if($this->form_validation->run()){
						$this->mcase->decline($this->input->post('id'),$this->input->post('reason'));
					}
				}elseif($this->input->get()){
					if($this->input->get('action')){
						if($this->input->get('action') == 'approve'){
							$this->mcase->approve($this->input->get('id'));
						}
					}
				}
				$cases = $this->mcase->get_case_by_status();
				$vars['content'] = '';
				if(is_array($cases)){
					foreach($cases as $case){
						$case->subject = ShortenText($case->subject,256);
						$content = array(
							'case' => $case,
							'files' => $this->mfile->attached_files($case->id),
							'user_id' => $case->author,
							'defence' => $this->mcase->get_defendant($case->id),
							'prosecutor' => $this->mcase->get_prosecutor($case->id)
						);
						$vars['content'] .= $this->load->view('templates/cases/moderation',$content,true);
					}
				}else{
					$vars['content'] .= '
						<div data-alert class="alert-box info">
							There are no judge notifications.
						</div>
					';
				}
				$this->load->template('pages/dashboard/blank',$vars);
			}
		}
		public function application(){
			$this->load->helper('auth');
			if(!loginOrRedirect()){
				$vars = array();
				$vars['message'] = '';
				$vars['level'] = '';
				$this->load->library('form_validation');
				$this->load->helper('security');
				if($this->input->post()){
					$this->load->model('mapplication');
					$application_id = $this->mapplication->create(array(
						'content' => $this->input->post('message'),
						'type' => 'judge_application',
						'status' => 'pending'
					));
					if($application_id != false){
						$vars['message'] = 'Application received.';
						$vars['level'] = 'success';
					}
				}
				$this->load->template('pages/judge/application',$vars);
			}
		}
		public function applications(){
			$this->load->helper('auth');
			if(!loginOrRedirect()){
				$vars = array();
				$vars['content'] = '';
				$vars['title'] = 'Judge Applications';
				$this->load->model('mapplication');
				$applications = $this->mapplication->get_applications_by_status();
				if(is_array($applications)){
					foreach($applications as $application){
						$vars['application'] = $application;
						$vars['content'] .= $this->load->view('templates/application/preview',$vars,true);
					}
					
				}else{
					$vars['content'] .= '
						<div data-alert class="alert-box info">
							There are no judge application.
						</div>
					';
				}
				$this->load->template('pages/bare',$vars);
			}
		}
	}