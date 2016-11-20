<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->data['rdays'] = array();
		$this->data['rmonths'] = array();
		$this->data['ryears'] = array();
		$year_end = date("Y");
		$year_start = $year_end - 100;
		for($index = 1;$index < 32;$index++){
			$this->data['rdays'][$index] = $index;
		}
		for($index = 1;$index < 13;$index++){
			$this->data['rmonths'][$index] = $index;
		}
		for($index = $year_start;$index < $year_end;$index++){
			$this->data['ryears'][$index] = $index;
		} 
		$this->data['lusername'] = array(
			'name' => 'username',
			'type' => 'text',
			'placeholder' => 'Username/Email',
			'value' => $this->input->post('username')
		);
		$this->data['lpassword'] = array(
			'name' => 'password',
			'type' => 'password',
			'placeholder' => 'Password',
			'value' => $this->input->post('password')
		);
		$this->data['lsubmit'] = array(
			'type' => 'submit',
			'class' => 'right buttonAlt2',
			'content' => 'Login'
		);
		$this->data['rusername'] = array(
			'name' => 'username',
			'type' => 'text',
			'placeholder' => 'Username'
		);
		$this->data['rfirstname'] = array(
			'name' => 'firstname',
			'type' => 'text',
			'placeholder' => 'First Name'
		);
		$this->data['rsurname'] = array(
			'name' => 'surname',
			'type' => 'text',
			'placeholder' => 'Surname'
		);
		$this->data['remail'] = array(
			'name' => 'email',
			'type' => 'email',
			'placeholder' => 'Email'
		);
		$this->data['rpassword'] = array(
			'name' => 'password',
			'type' => 'password',
			'placeholder' => 'Password'
		);
		$this->data['rconfirm_password'] = array(
			'name' => 'confirm_password',
			'type' => 'password',
			'placeholder' => 'Confirm Password'
		);
		$this->data['rsubmit'] = array(
			'type' => 'submit',
			'class' => 'right buttonAlt2',
			'style' => '',
			'content' => 'Register'
		);
		$this->data['frontpage'] = true;
		$this->load->template('auth/auth',$this->data);
	}
	public function login()
	{
		if(!$this->ion_auth->logged_in()){
			$errors = '';
			$this->data = array();
			$this->load->library('form_validation');
			$this->load->helper('security');
			$this->form_validation->set_rules(array(
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'required|xss_clean'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'required|xss_clean'
				)
			));
			if($this->form_validation->run()){
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				if($this->ion_auth->login($username,$password,true))
				{
					redirect('dashboard');
				}else{
					$errors .= $this->ion_auth->errors();
				}
			}
			$errors .= validation_errors();
			$this->session->set_flashdata('errors',$errors);	
			redirect('auth');
		}else{
			redirect('dashboard');
		}
	}
	public function reset_password(){
		$this->data = array();
		$this->load->library('form_validation');
		$this->load->helper('security');
		if($code = $this->uri->segment(3,0)){
			if($user = $this->ion_auth->forgotten_password_check($code)){
				$this->form_validation->set_rules(array(
				array(
						'field' => 'password',
						'label' => 'Password',
						'rules' => 'required|xss_clean'
					),
				),
				array(
						'field' => 'confirm_password',
						'label' => 'Confirm Password',
						'rules' => 'required|xss_clean'
				));
				if($this->form_validation->run()){
					if($this->_valid_csrf_nonce()){
						if($this->ion_auth->reset_password($user->{$this->config->item('identity','ion_auth')},$this->input->post('password'))){
							$this->data['status'] = 'success';
							$this->data['message'] = 'Password reset successful, redirecting... <script>setTimeout(function(){window.location.href = "' . site_url('auth/login') . '"},3000);</script>';
							$this->load->template('auth/messages/message',$this->data);
						}else{
							$this->data['status'] = 'alert';
							$this->data['message'] = 'Password reset failed!';
							$this->load->template('auth/messages/message',$this->data);
						}
					}else{
						$this->data['status'] = 'alert';
						$this->data['message'] = 'Password reset failed!';
						$this->load->template('auth/messages/message',$this->data);
					}
				}else{
					$this->data['password'] = array(
						'name' => 'password',
						'id'   => 'password',
						'type' => 'password',
						'value' => $this->input->post('password')
					);
					$this->data['confirm_password'] = array(
						'name' => 'confirm_password',
						'id'   => 'confirm_password',
						'type' => 'password',
						'value' => $this->input->post('confirm_password')
					);
					$this->data['csrf'] = $this->_get_csrf_nonce();
					$this->data['user_id'] = array(
						'name'  => 'user_id',
						'id'    => 'user_id',
						'value' => $user->id,
					);
					$this->load->template('auth/reset_password',$this->data);
				}
			}else{
				$this->data['status'] = 'alert';
				$this->data['message'] = 'Password reset code is invalid!';
				$this->load->template('auth/messages/message',$this->data);
			}
			
		}else{
			$this->form_validation->set_rules(array(
				array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'required|xss_clean'
				),
			));
			if($this->form_validation->run()){
				if($this->ion_auth->forgotten_password($this->input->post('email'))){
					$this->data['status'] = 'info';
					$this->data['message'] = 'An password reset email has been sent to ' . $this->input->post('username') . '.';
					$this->load->template('auth/messages/message',$this->data);
				}else{
					$this->data['status'] = 'alert';
					$this->data['message'] = 'Account recovery failed!';
					$this->load->template('auth/messages/message',$this->data);
				}
			}else{
				$this->data['email'] = array(
					'name' => 'email',
					'type' => 'text',
					'placeholder' => 'Email'
				);
				$this->data['submit'] = array(
					'type' => 'submit',
					'class' => 'right',
					'style' => '',
					'content' => 'Email Code'
				);
				$this->load->template('auth/forgot_password',$this->data);
			}
		}
	}
	public function register(){
		$this->data = array();
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->form_validation->set_rules(array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'firstname',
				'label' => 'First Name',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'surname',
				'label' => 'Surname',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'day',
				'label' => 'Day',
				'dob' => 'required|xss_clean'
			),
			array(
				'field' => 'month',
				'label' => 'Month',
				'dob' => 'required|xss_clean'
			),
			array(
				'field' => 'day',
				'label' => 'Day',
				'dob' => 'required|xss_clean'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'required|xss_clean'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'required|matches[confirm_password]|xss_clean'
			),
			array(
				'field' => 'confirm_password',
				'label' => 'Confirm Password',
				'rules' => 'required|xss_clean'
			)
		));
		if($this->input->post()){
			if($this->form_validation->run()){
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$additionalData = array(
					'first_name' => $this->input->post('firstname'),
					'last_name' => $this->input->post('surname'),
					'dob' => $this->input->post('year') . '-' . $this->input->post('month') . '-' . $this->input->post('day')
				);
				$group = array(
					2
				);
				$additional_data = array();
				if($this->ion_auth->register($username,$password,$email,$additionalData,$group)){
					$showForm = false;
					$this->ion_auth->login($email,$password);
					$this->data['success'] = 'alert';
					$this->data['message'] = 'Succesfully registered, redirecting... <script>setTimeout(function(){  
					window.location.href = "' . site_url('dashboard') . '";
				},3000); </script>';
					$this->load->view('auth/messages/message',$this->data);
				}else{
					$this->data['status'] = 'alert';
					$this->data['message'] = $this->ion_auth->errors_array();
					$this->data['message'] = $this->load->view('auth/messages/message',$this->data,true);
				}
			}else{
				if(validation_errors() || $this->session->flashdata('message')){
					$this->data['status'] = 'alert';
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$this->data['message'] = $this->load->view('auth/messages/message',$this->data,true);
				}
			}
		}
		$this->data['message'] = '';
		$this->data['days'] = array();
		$this->data['months'] = array();
		$this->data['years'] = array();
		$this->data['username'] = array(
			'name' => 'username',
			'type' => 'text',
			'placeholder' => 'Username'
		);
		$this->data['firstname'] = array(
			'name' => 'firstname',
			'type' => 'text',
			'placeholder' => 'First Name'
		);
		$this->data['surname'] = array(
			'name' => 'surname',
			'type' => 'text',
			'placeholder' => 'Surname'
		);
		$this->data['email'] = array(
			'name' => 'email',
			'type' => 'email',
			'placeholder' => 'Email'
		);
		$this->data['password'] = array(
			'name' => 'password',
			'type' => 'password',
			'placeholder' => 'Password'
		);
		$this->data['confirm_password'] = array(
			'name' => 'confirm_password',
			'type' => 'password',
			'placeholder' => 'Confirm Password'
		);
		$this->data['submit'] = array(
			'type' => 'submit',
			'class' => 'right buttonAlt2',
			'style' => '',
			'content' => 'Register'
		);
		$year_end = date("Y");
		$year_start = $year_end - 100;
		for($index = 1;$index < 32;$index++){
			$this->data['days'][$index] = $index;
		}
		for($index = 1;$index < 13;$index++){
			$this->data['months'][$index] = $index;
		}
		for($index = $year_start;$index < $year_end;$index++){
			$this->data['years'][$index] = $index;
		} 
		$this->load->helper('form');
		$this->load->template('auth/register',$this->data);
	}
	private function _get_csrf_nonce(){
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);
		return array($key => $value);
	}
	private function _valid_csrf_nonce(){
		if($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')){
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
