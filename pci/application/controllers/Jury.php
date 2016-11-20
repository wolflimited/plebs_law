<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Jury extends CI_Controller{
		public function index(){
			$this->load->helper('auth');
			if(!loginOrRedirect()){
				$this->load->model('mjury');
				$this->load->model('mcase');
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
							'label' => 'Request ID',
							'rules' => 'required|xss_clean'
						)
					));
					if($this->form_validation->run()){
						$this->mjury->submit_juror_application($this->input->post('id'),$this->input->post('reason'));
					}
				}elseif($this->input->get()){
					if($this->input->get('id')){
						$this->mjury->submit_juror_application($this->input->get('id'),'',true);
					}
				}
				$requests = $this->mjury->get_requests();
				$vars = array();
				$vars['content'] = '';
				if(is_array($requests)){
					foreach($requests as $request){
						$case = $this->mcase->get_by_id($request->case_id)[0];
						if($case != false || is_object($case)){
							$content = array(
								'id' => $request->id,
								'case' => $case
							);
							$vars['content'] .= $this->load->view('templates/jury/request',$content,true);
						}
					}
				}else{
					$vars['content'] .= '
						<div data-alert class="alert-box info">
							There are no jury requests avaliable.
						</div>
					';
				}
				$this->load->template('pages/dashboard/blank',$vars);
			}
		}
    }