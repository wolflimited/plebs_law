<?php
    //template for preview item
    ?>
    <div class="caseContainerAlt2">
        <h6><?php echo $case->title; ?></h6>
        <div class="caseBody">
          <?php echo $case->subject; ?>
        </div><br>
        <div class="caseDetails">
            <div class="row">
                <div class="medium-6 columns">
                    <p>
                        Case Number: <b><?php echo $case->id; ?></b>
                    </p>
                    <p>
                        Prosecutor: <b><?php if($prosecutor != ''){ echo $prosecutor; }else{ echo 'Waiting Prosecutor'; }  ?></b>
                    </p>
                    <p>
                        Defence: <b><?php if($defence != ''){ echo $defence; }else{ echo 'Waiting Defence'; } ?></b>
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
                        Status: <b><?php echo $case->status; ?></b>
                    </p>
                </div>
            </div>
        </div>
        <?php
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
        <footer class="row details">
            <div class="medium-8 columns">
                Submitted on <time datetime="<?php echo $case->creation; ?>"><?php echo $case->creation; ?></time> by <?php echo nice_name($user_id); ?>
            </div>
            <div class="medium-4 columns">
                <?php echo anchor('cases?id=' . $case->id,'View More',array('class' => 'right button buttonAlt2 smallButton','style' => 'margin-bottom: 0;')); ?>
            </div>
        </footer>
    </div>