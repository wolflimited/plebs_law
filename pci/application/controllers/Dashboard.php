<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller{
	public function index(){
		$this->load->helper('auth');
		if(!loginOrRedirect()){
            $this->load->model('mcase');
			$this->load->model('mfile');
			$this->load->helper('capabilities');
			$this->load->helper('format');
            $cases = $this->mcase->get_user_cases();
			$latest_cases = $this->mcase->get_latest_cases();
			$vars = array();
			$vars['niceName'] = nice_name();
            $vars['showSidebar'] = true;
            $vars['cases'] = '';
			$vars['latest_cases'] = '';
			$vars['message'] = '';
 			if($this->input->get()){
				if($this->input->get('dont_show') && $this->input->get('dont_show') == true){
					dont_show_getting_started();
				}
				$vars['message'] = $this->input->get('message');
				$vars['level'] = $this->input->get('level');
			}
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
            $vars['cases'] = $cases;
            $this->load->template('pages/dashboard/dashboard',$vars);
		}
	}
    public function account(){
        $this->load->helper('auth');
        if(!loginOrRedirect()){
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->load->model('mjury');
			$user = $this->ion_auth->user()->row();
			$vars = array(
				'username' => $user->username,
				'firstname' => $user->first_name,
				'surname' => $user->last_name,
				'email' => $user->email,
				'jury' => false,
				'dob' => ''
			);
			//generates dates
			$vars['days'] = array();
			$vars['months'] = array();
			$vars['years'] = array();
			$year_end = date("Y");
			$year_start = $year_end - 100;
			for($index = 1;$index < 32;$index++){
				$vars['days'][$index] = $index;
			}
			for($index = 1;$index < 13;$index++){
				$vars['months'][$index] = $index;
			}
			for($index = $year_start;$index < $year_end;$index++){
				$vars['years'][$index] = $index;
			} 
			//check if on jury
			if($this->mjury->get_by_userid($user->id) != false){
				$vars['jury'] = 'checked';
			}
			if($user->dob != '' && $user->dob != '0000-00-00'){
				$vars['dob'] = date('d/m/Y',strtotime($user->dob));
			}
			if($this->input->get()){
	
			}elseif($this->input->post()){
				//keep updated details in form
				$vars['firstname'] = $this->input->post('firstname');
				$vars['surname'] = $this->input->post('surname');
				$vars['dob'] = $this->input->post('dob');
				$vars['email'] = $this->input->post('email');
				if($this->form_validation->run() || true){
					if($this->input->post('jury') == 'on' && $this->mjury->get_by_userid($user->id) == false){
						$this->mjury->create(array(
							'user_id' => $user->id,
							'serving' => 0
						));
						$vars['jury'] = 'checked';
					}else{
						$this->mjury->delete_by_userid($user->id);
					}
					$data = array(
						'first_name' => $this->input->post('firstname'),
						'last_name' => $this->input->post('surname'),
						'dob' => $this->input->post('year') . '-' . $this->input->post('month') . '-' . $this->input->post('day'),
						'email' => $this->input->post('email'),
					);
					if($this->input->post('password')){
						$data['password'] = $this->input->post('password');
					}
					$this->ion_auth->update($user->id,$data);
				}
			}
            $this->load->template('pages/dashboard/account',$vars);
        }
    }
	public function logout(){
		$this->ion_auth->logout();
		redirect('auth/login');
	}
}
