<div class="row">
    
    
    <div class="col-md-9">
        <h3><?php echo $oProgram->title;?></h3>
        <div class="row">
            
            <div class="col-md-6 text-right">
                
                <?php // FACEBOOK stupidity - wont show og_image unless its present in the document ?>
                <!-- 
                 <img src="<?php echo getResourceThumbnailUrl($oProgram->display_image, 'large');?>" alt="<?php echo $oProgram->title?>"/>
                -->
                
                <?php echo getSocialButtons('house');?>
            </div>
            
            
        </div>
        
        <div class="row">
            <div class="col-md-12">
            
                <img src="<?php echo getResourceThumbnailUrl($oProgram->display_image, 'display_image');?>"
                    class="thumbnail"
                    style="float:right;margin:0px 10px 10px 10px;"
                    alt="<?php echo $oProgram->title?>"/>
                
                <?php echo $oProgram->description;?>
        
            </div>
        </div>
        
        
        
        
        <?php /* Google Groups Embed - Start */?>
        
        <?php if($bShowGoogleGroup): ?>
        
            <?php $sGroupName = 'infothanal';?>
            <?php //$sGroupName = 'aapideas';?>
            <h4>
                Join Info-Thanal - an information exchange network based on email list.
            </h4>
            
<iframe id="forum_embed" src="javascript:void(0)"
  scrolling="no" frameborder="0"  width="746" height="1200">
</iframe>
<script type="text/javascript">
  document.getElementById('forum_embed').src =
     "https://groups.google.com/forum/embed/?place=forum/<?php echo $sGroupName;?>"
     + "&parenturl=" + encodeURIComponent(window.location.href);
</script>
            
            
            <?php /*?>
            
            <iframe id="forum_embed"
                    src="https://groups.google.com/forum/embed/?place=forum/<?php echo $sGroupName;?>"
                    scrolling="no" frameborder="0"
                    width="100%" height="700"></iframe>
            <?php */?>
            
            
        <?php endif;?>
        
        <?php /* Google Groups Embed - End */?>
        
        
        
        
        <?php if( $aRelatedCampaigns || $aRelatedProjects || $aRelatedPolicyAdvocacy ):?>
        <hr>
        <?php endif;?>
        
        
        
        <div class="row">
            
            <?php if( $aRelatedCampaigns ):?>
            <div class="col-md-4">
                <h4>Campaigns</h4>
                <?php echo $sRelatedCampaigns;?>
            </div>
            <?php endif;?>
            
            <?php if($aRelatedProjects):?>
            
            <div class="col-md-4">
                <h4>Projects</h4>
                <?php echo $sRelatedProjects;?>
            </div>
            <?php endif;?>
            
            <?php if($aRelatedPolicyAdvocacy):?>
            
            <div class="col-md-4">
                <h4>Policy Advocacy</h4>
                <?php echo $sRelatedPolicyAdvocacy;?>
            </div>
            <?php endif;?>
            
        </div>
        
    </div>
    
    
    
    <div class="col-md-3">
        
        <?php if( $oProgram->program_director ) : ?>
            
            <h3>Director</h3>
            
            <?php $oUser = $this->user_model->getUserBy('account_no', $oProgram->program_director, 'full');?>
            
            <div class="media">
                <a href="<?php echo $c_base_url, $oUser->username;?>" class="pull-left">
                <?php echo getCurrentProfilePic($oUser, 'tiny', true, array('attributes' => array('class' => 'thumbnail', 'style' => 'margin-bottom:0px;')));?>    
                </a>
                <div class="media-body">
                    <a href="<?php echo $c_base_url, $oUser->username;?>">
                        <h4 class="media-heading"><?php echo $oProgram->program_director_name;?></h4>    
                    </a>
                </div>
            </div>
            
            <hr/>    
        <?php endif; ?>
        
        
        <?php if( $oProgram->uid == 35960028 ):?>
            <?php $sLink = $c_base_url . 'widget/scrap_dealer_directory?pb=threee';?>
            <iframe width="250" height="410" class="embed-responsive-item thumbnail" style="margin:auto;"
                    src="<?php echo $sLink; ?>"
                    scrolling="no"
                    frameborder="0"></iframe>
        <?php endif;?>
        
        
        <h4>Resource Files</h4>
        <?php echo $sRelatedResources;?>
    </div>
    
    
</div>