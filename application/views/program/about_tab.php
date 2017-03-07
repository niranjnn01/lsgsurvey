<div class="row">
    
    <?php if( $oProgram->program_director ) : ?>
        
        <div class="col-md-6">
            <?php $oUser = $this->user_model->getUserBy('account_no', $oProgram->program_director, 'full');?>
            <?php /*?>
            <div class="pull-left p-r-10">
                <?php echo getCurrentProfilePic($oUser, 'tiny', array('strict_dimensions' => true));?>    
            </div>
            <?php */?>
            <div class="pull-left">
                <div>Contact person</div>
                <div>
                    <?php if( $oProgram->program_director_url ):?>
                        <a href="<?php echo $oProgram->program_director_url;?>" target="_blank">
                            <?php echo $oProgram->program_director;?>
                        </a>
                    <?php else:?>
                        <?php echo $oProgram->program_director;?>
                    <?php endif;?>
                    
                </div>
            </div>
        </div>
        
    <?php endif; ?>
    
    <?php /*?>
    <div class="col-md-6 text-right">
        
        <?php // FACEBOOK stupidity - wont show og_image unless its present in the document ?>
        <!-- 
         <img src="<?php echo $this->thanal_resource->getResourceThumbnailUrl($oProgram->display_image, 'large');?>" alt="<?php echo $oProgram->title?>"/>
        -->
        
        <?php echo getSocialButtons('house');?>
    </div>
    <?php */?>
    
</div>
<hr/>

<?php if ($oProgram->display_image):
//p($oProgram);

?>
    <img src="<?php echo $this->thanal_resource->getResourceThumbnailUrl($oProgram->display_image, 'display_image');?>"
        style="float:left;margin:0px 10px 10px 0px;"
        alt="<?php echo $oProgram->title?>"/>
<?php endif;?>
<?php echo $oProgram->description;?>