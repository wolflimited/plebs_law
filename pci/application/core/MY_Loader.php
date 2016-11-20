<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	class MY_Loader extends CI_Loader {
	    public function template($template_name,$vars = array(),$return = FALSE,$exclude = array()){
	        $ci =& get_instance();
	        if(!isset($vars['background'])){
				$vars['background'] = '';
			}
			if(!isset($vars['style'])){
				$vars['style'] = '';
			}
			if(!isset($vars['frontpage'])){
				$vars['frontpage'] = '';
			}
			$this->helper('html');
	        $this->helper('url');
	        if($return){
		        $content  = $this->view('head', $vars, $return);
		        $content  = $this->view('header', $vars, $return);
		        $content .= $this->view($template_name, $vars, $return);
		        $content .= $this->view('footer', $vars, $return);
		        return $content;
		    }else{
		       	$vars['exclude'] = $exclude;
		       	$vars['isDashboard'] = false;
		       	$vars['loggedIn'] = $ci->ion_auth->logged_in();
		       	if($ci->uri->segment(1) == 'dashboard'){
			       $vars['isDashboard'] = true;
		       	}
				if(!isset($vars['showSidebar']) || isset($vars['showSidebar']) && $vars['showSidebar'] === ''){
					$vars['showSidebar'] = true;
				}
		        $this->view('head',$vars);
				if($vars['frontpage'] == true){
					$this->view('frontpage/header',$vars);
				}else{
					$this->view('header',$vars);
				}
		        $this->view($template_name,$vars);
		       	$this->view('footer',$vars);
		    }
	    }
	}