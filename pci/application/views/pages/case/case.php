<article class="case row" style="background: #fff;">
	<section>
		<article class="medium-12 columns">
			<header class="row">
				<div class="medium-12 columns">
                    <div class="row">
                        <div class="row">
                            <div class="medium-12 columns" style="max-height: 300px; overflow: hidden; margin-bottom: 10px; position: relative;">
                                <h4 class="title" style="position: absolute; top: 0; left: 0.9375rem; padding: 10px; background: #048abb; color: #fff; margin: 0;"><?php echo $case->title; ?></h4>
                                <h4 class="id" style="position: absolute; bottom: 0; left: 0.9375rem; padding: 10px; background: #048abb; color: #fff; margin: 0;">ID <?php echo sprintf('%08d', $id); ?></h4>
                                <img width="100%" src="<?php echo $thumbnail->url; ?>">
                                <div class="buttons" style="position: absolute; top: 0; right: 0.9375rem;">
                                    <?php
                                        
                                        if($author->id == $case->author){
                                            echo anchor('cases?action=delete&id=' . $case->id,'Delete',array('class' => 'right button alert','style' => 'margin: 0;'));
                                        }
                                        echo anchor('','Defend',array('class' => 'right button','style' => 'margin: 0;'));
                                        echo anchor('','Prosecute',array('class' => 'right button','style' => 'margin: 0;'));
                                        echo anchor('','Judge',array('class' => 'right button','style' => 'margin: 0;'));
                                    ?>
                                </div>
                            </div>
                        </div>    
                    </div>
				</div>
			</header>
			<section class="row">
                <div class="content medium-12 columns">
                    <?php 
                        if($action == 'edit' && $author->id == $case->author){
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
                                        if(is_array($links)){
                                            foreach($links as $link){
                                                if($link->text != ''){
                                                    if(preg_match("#https?://#",$link->text) === 0){
                                                        $link->text = 'http://'.$link->text;
                                                    }
                                                    ?>
                                                        <a style="display: block; margin-bottom: 10px;" href="<?php echo $link->text; ?>"><?php echo $link->text; ?></a>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    $files = attachedFiles($id);
                                    if(is_array($files) && count($files) > 0){
                                        ?>
                                        <div class="caseFiles"> 
                                            <h4>Files</h4>
                                            <?php 
                                                foreach($files as $file){
                                                    if(is_object($file)){
                                                        ?>
                                                            <a href="<?php echo $file->url; ?>" target="_blank"><?php echo $file->name; ?></a>
                                                        <?php
                                                    }
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
                                                Case Number: <b><?php echo sprintf('%08d', $id); ?></b>
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
                    <div class="row">
                        <article class="medium-6 columns">
                            <header class="row">
                                <div class="medium-12 columns">
                                    <h4>Prosecution</h4>
                                </div>
                            </header>
                            <section class="row">
                                <div class="medium-12 columns">
                                    <?php
                                        if(!is_array($prosecutor)){
                                            $prosecutor = array($prosecutor);
                                        }
                                        ?>
                                            <?php echo $prosecutor[0]; ?>
                                        <?php
                                           if(count($prosecutor) > 1){
                                               ?>
                                                    <h4>Witnesses</h4>
                                                <?php
                                                for($index = 1;$index < count($prosecutor);$index++){
                                                    if(isset($prosecutor[$index])){
                                                        echo $prosecutor[$index];
                                                    }
                                                }
                                           }
                                    ?>
                                </div>
                            </section>
                            <section>
                                <?php echo anchor('','Become Prosecution',array('class' => 'right button','style' => 'width: 100%;')); ?>
                            </section>
                        </article>
                        <article class="medium-6 columns">
                            <header class="row">
                                <div class="medium-12 columns">
                                    <h4>Defense</h4>
                                </div>
                            </header>
                            <section class="row">
                                <div class="medium-12 columns">
                                    <?php
                                        if(!is_array($defense)){
                                            $defense = array($defense);
                                        }
                                        ?>
                                            <?php echo $defense[0]; ?>
                                        <?php
                                           if(count($defense) > 1){
                                               ?>
                                                    <h4>Witnesses</h4>
                                                <?php
                                                for($index = 1;$index < count($defense);$index++){
                                                    if(isset($defense[$index])){
                                                        echo $defense[$index];
                                                    }
                                                }
                                           }
                                    ?>
                                </div>
                            </section>
                            <section>
                                <?php echo anchor('','Become Defence',array('class' => 'right button','style' => 'width: 100%;')); ?>
                            </section>
                        </article>
                    </div>
                </section>
                <footer class="details">
                    Created by <?php 
                        if(is_author($id)){
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
        </div>    
	</section>
</article>