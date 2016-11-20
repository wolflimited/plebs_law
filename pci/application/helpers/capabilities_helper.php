<?php
	function is_author($case_author,$author_id = ''){
		$ci =& get_instance();
		if($author_id == ''){
			$user = $ci->ion_auth->user()->row();
			$author_id = $user->id;
		}
		if($case_author == $author_id){
			return true;
		}
		return false;
	}