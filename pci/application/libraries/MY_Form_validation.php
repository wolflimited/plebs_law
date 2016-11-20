<?php
	class MY_Form_validation extends CI_Form_validation
	{
		function __construct($rules = array())
		{
		    parent::__construct($rules);
		}
		function valid_pass($candidate) 
		{
			$r1='/[A-Z]/';  //Uppercase
			$r2='/[a-z]/';  //lowercase
			$r3='/[!@#$%&*()^,._;:-]/';  // whatever you mean by 'special char'
			$r4='/[0-9]/';  //numbers
			if(preg_match_all($r1,$candidate, $o)<1 ||
			preg_match_all($r2,$candidate, $o)<1 ||
			preg_match_all($r3,$candidate, $o)<1 ||
			preg_match_all($r4,$candidate, $o)<1)
			{
				$this->CI->form_validation->set_message('valid_pass','The %s must contain and uppercase, lowercase, number and symbol for maximum security.');
				return FALSE;
			}
			return TRUE;
		}
	}