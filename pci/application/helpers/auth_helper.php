<?php
	function loginOrRedirect()
	{
		$CI =& get_instance();
		if(!$CI->ion_auth->logged_in()){
			redirect('auth/login');
		}
	}