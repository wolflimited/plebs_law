<?php
	function nice_name($id = ''){
		$ci =& get_instance();
		if($id != ''){
			$user = $ci->ion_auth->user($id)->row();
		}else{
			$user = $ci->ion_auth->user()->row();
		}
		if($user->first_name == '' && $user->last_name == ''){
			$name = $user->username;
		}else{
			$name = $user->first_name . ' ' . $user->last_name;
		}
		return $name;
	}
	function dont_show_getting_started(){
		$ci =& get_instance();
		$user = $ci->ion_auth->user()->row();
		$data = array(
			'tutorial' => 1
		);
		$ci->ion_auth->update($user->id,$data);
		redirect('dashboard');
	}
	function show_getting_started(){
		$ci =& get_instance();
		$user = $ci->ion_auth->user()->row();
		if($user->tutorial == 1){
			return false;
		}
		return true;
	}