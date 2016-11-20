<?php
	function getCase($id){
		$ci =& get_instance();
		$results = $ci->db->get_where('case',array('id' => $id));
        if(count($results->result()) > 0){
            return $results->result()[0];
        }else{
            return false;
        }
	}
	function needModeration()
	{
		$ci =& get_instance();
		$results = $ci->db->get_where('case',array('status' => 1));
		return $results->result();
	}
    //redudant
	function userCases(){
		$ci =& get_instance();
		$user = $ci->ion_auth->user()->row();
		$ci->db->from('case')
		->where('author',$user->id);
	    $results = $ci->db->get();
		return $results->result();
	}
	function approveCase($caseID){
		$ci =& get_instance();
		$data = array(
			'status' => 2
		);
		$ci->db->where('id',$caseID);
		$ci->db->update('case', $data); 
	}
	function needDefence(){
		$ci =& get_instance();
		$results = $ci->db->get_where('case',array('defendant' => ''));
		return $results->result();
	}
	function newCases($status = ''){
		$statusQuery = ' AND status != 1'; 
		if($status != ''){
			$statusQuery = ' AND status == ' . $status; 
		}
		$ci =& get_instance();
		$user = $ci->ion_auth->user()->row();
		$ci->db->from('case')
		->limit(10);
		$results = $ci->db->get();
		return $results->result();
	}
	function attachedFiles($id){
		$ci =& get_instance();
		$ci->db->from('file')
		->where('attachment_id',$id);
		$results = $ci->db->get();
		return $results->result();
	}
    //redundant
	function buildCase($object){
		$ci =& get_instance();
		$prosecutorName = '';
		$defenceName = '';
        $prosecutor = $ci->db->from('prosecutor')
        ->where('case_id',$object->id)
        ->get();
        if(count($prosecutor->result())){
            $prosecutor = $prosecutor->result()[0];
            if($prosecutor->user_id != 0){
                $prosecutor = $ci->ion_auth->user($prosecutor->user_id)->row();
                $prosecutorName = $prosecutor->username;
            }
        }
        $defendant = $ci->db->from('defendant')
        ->where('case_id',$object->id)
        ->get();
        if(count($defendant->result())){
            $defendant = $defendant->result()[0];
            if($defendant->user_id != 0){
                $defence = $ci->ion_auth->user($defendant->user_id)->row();
                $defenceName = $prosecutor->username;
            }
        }
		?>
			<div class="caseContainerAlt2">
            	<h6><?php echo $object->title; ?></h6>
                <div class="caseBody">
              	  <?php echo $object->subject; ?>
                </div><br>
				<div class="caseDetails">
                	<div class="row">
                    	<div class="medium-6 columns">
                        	<p>
                            	Case Number: <b><?php echo $object->id; ?></b>
                            </p>
                            <p>
                            	Prosecutor: <b><?php echo $prosecutorName; ?></b>
                            </p>
                            <p>
                            	Defence: <b><?php echo $defenceName; ?></b>
                            </p>
                        </div>
                        <div class="medium-6 columns">
                        	<p>
                            	Judge Appointed: <b>No</b>
                            </p>
                            <p>
                            	Jury Selected: <b>In progress</b>
                            </p>
                            <p>
                            	Status: <b>Pending</b>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="caseFiles">
                	<h6>Files</h6>
                	<?php 
						$files = attachedFiles($object->id);
						foreach($files as $file){
							?>
                            	<a href="<?php echo $file->url; ?>" target="_blank"><?php echo $file->name; ?></a>
                            <?php
						}
					?>
                </div>
            </div>
		<?php
	}
?>