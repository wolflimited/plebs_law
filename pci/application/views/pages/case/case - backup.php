<main class="case row">
	<?php
		if(isJudge()){
			?>
			<section class="medium-12 columns">
				<?php 
					if($case->status == 1){
						?>
							<a class="button buttonAlt3 right" href="<?php echo site_url('cases') . '?id=' . $id . '&action=approve'; ?>">Approve</a>
						<?php
					}
				?>
				<a class="button buttonAlt3 right" href="">Report</a>
			</section>
			<?php
		}
	?>
	<section>
		<article class="medium-12 columns">
			<header>
				<h2 class="title"><?php echo $case->title;?></h2>
				<?php
				?>
			</header>
			<section class="content">
				<?php 
					if($action == 'edit' && isAuthor('',$id)){
						?>
							<div class="row">
								<div class="medium-12 columns">
									<?php
										echo form_open('',array('data-abide' => ''));
											echo form_textarea(array('name' => 'content','placeholder' => 'Content','value' => $case->subject));
											echo form_input(array('name' => 'caseid','type' => 'hidden','value' => $caseID));
											echo form_input(array('name' => 'action','type' => 'hidden','value' => 'edit'));
											echo form_button(array('type' => 'submit','class' => 'right buttonAlt2','content' => 'Update'));
										echo form_close();
									?>
								</div>
							</div>
						<?php
					}else{
                        ?>
                            <h4>Subject</h4>
                            <?php
                                echo nl2br($case->subject); 
                            ?>
                            <h4>Reason</h4>
                            <?php
                                echo nl2br($case->reason); 
                            ?>
                            <h4>Claim</h4>
                            <?php
                                echo nl2br($case->claim); 
                            ?>
                            <h4>Grounds</h4>
                            <?php
                                echo nl2br($case->grounds); 
                            ?>
                            <h4>Precendence</h4>
                            <?php
                                echo nl2br($case->precedence); 
                                if($case->evidence != ''){
                                    ?>
                                        <h4>Evidence Links</h4>
                                    <?php
                                    $links = json_decode($case->evidence);
                                    foreach($links as $link){
                                        ?>
                                            <a style="display: block; margin-bottom: 10px;" href="<?php echo $link->text; ?>"><?php echo $link->text; ?></a>
                                        <?php
                                    }
                                }
                                $files = attachedFiles($id);
                                if(is_array($files) && count($files) > 0){
                                    ?>
                                    <div class="caseFiles"> 
                                        <h6>Files</h6>
                                        <?php 
                                            foreach($files as $file){
                                                ?>
                                                    <a href="<?php echo $file->url; ?>" target="_blank"><?php echo $file->name; ?></a>
                                                <?php
                                            }
                                        ?>
                                    </div>
                                    <?php
                                }
                            ?>
                            <br>
                            <br>
                            <div class="caseDetails">
                                <div class="row">
                                    <div class="medium-6 columns">
                                        <p>
                                            Case Number: <b><?php echo $id; ?></b>
                                        </p>
                                        <p>
                                            Prosecutor: <b></b>
                                        </p>
                                        <p>
                                            Defence: <b></b>
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
                        <?php
					}
				?>
			</section>
			<footer class="details">
				Created by <?php 
					if(isAuthor('',$id)){
						echo 'you';
					}else{
						echo $authorName; 
					}
				?> on the <?php echo $creationDate; ?>.
			</footer>
		</article>
	</section>
	<section class="submissions">
		<?php 
			if(isset($action) && $action == 'submission'){
				?>
					<div class="medium-12 columns" style="padding-top: 10px;">
						<div class="row">
							<div class="medium-12 columns">
								<div class="alert-box success">
									Submission created and is currently in moderation.
								</div>
							</div>
						</div>
					</div>
				<?php
			}
			foreach($submissions as $submission){
					$date = new DateTime($submission->creation);
					$submissionDate = $date->format('dS M Y');
					$type = '';
					if($submission->type == 1){
						$type = 'prosecution';
					}elseif($submission->type == 2){
						$type = 'defence';
					}
				?>
					<div class="medium-12 columns" style="padding-top: 10px;">
						<div class="row">
							<article class="submission <?php echo $type; ?> medium-12 columns">
								<section class="content">
									<?php
										echo $submission->content;
									?>
								</section>
								<footer class="details">
									Submitted by <?php 
										if(isSubmittor('',$submission->id)){
											echo 'you';
										}else{
											echo niceName($submission->author);
										}
									?> on the <?php echo $submissionDate; ?>.
								</footer>
							</article>
						</div>
					</div>
				<?php
			}
//			if(isDefendant($userID) || isProsecutor($userID)){
            if(false){
				echo form_open('',array('class' => 'medium-12 columns','data-abide' => '','style' => 'padding-top: 20px;'));
					?>
						<div class="row">
							<div class="medium-12 columns">
								<label>
									Submission
									<?php echo form_textarea(array('name' => 'content','placeholder' => 'Submission')); ?>
								</label>
							</div>
						</div>
						<div class="row">
							<div class="medium-12 columns">
								<?php echo form_button(array('type' => 'submit','class' => 'right buttonAlt2','content' => 'Submit')); ?>
							</div>
						</div>
					<?php
						echo form_input(array('name' => 'caseid','type' => 'hidden','value' => $caseID));
						echo form_input(array('name' => 'action','type' => 'hidden','value' => 'submission'));
				echo form_close();
			}
		?>
	</section>
</main>