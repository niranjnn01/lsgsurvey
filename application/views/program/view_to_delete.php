<?php showMessage();?>
<?php //p($oProgram);?>
<div class="inner_page_left">
    
    <div class="program_cnt">
        <h3><?php echo $oProgram->title;?></h3>
        <?php /* <div>Last updated on <?php echo date('jS F, Y', strtotime($oProgram->updated_on));?></div> */?>
        
        <div class="program_description m-t-10">
            <?php echo $oProgram->description;?>
        </div>
        
        
    </div>
    
</div>



<div class="inner_page_right">
    

    
    <div class="m-b-20">
        
        <h3>Related Campaigns</h3>
        
        <?php if( $aRelatedCampaigns ):?>
            <ul>
                <?php foreach( $aRelatedCampaigns AS $oItem ): ?>
                    <li>
                        
                        <a href="<?php echo $c_base_url, 'campaign/view/', $oItem->seo_name;?>" >
                            <?php echo $oItem->title;?>
                        </a>
                        
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else:?>
            There are no related campaigns
        <?php endif;?>
        
    </div>
    
    <div class="m-b-20">
        
        <h3>Related Resources</h3>
        
        <?php if( $aResources ):?>
            <ul>
                <?php foreach( $aResources AS $oItem ): ?>
                    <li>
                        
                        <?php if( $oItem->type == $aResourceType['youtube_video'] ):?>
                            <a href="<?php echo getYouTubeVideoURL_browser($oItem->file_name);?>"><?php echo $oItem->title;?></a>
                        <?php else:?>
                            <a href="<?php echo $aResourceTypeUrl[$oItem->type], $oItem->file_name;?>" >
                                <?php echo $oItem->file_name;?>
                            </a>
                        <?php endif;?>

                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else:?>
            There are no related resources
        <?php endif;?>
        
    </div>
        
    <h3>Other Programs</h3>
    <?php if( $aOtherPrograms ):?>
        <ul>
        <?php foreach( $aOtherPrograms AS $oItem ):?>
            <li><a href="<?php echo $c_base_url, 'program/view/', $oItem->seo_name;?>"><?php echo $oItem->title?></a></li>
        <?php endforeach;?>
        </ul>
    <?php else:?>
        <p>There are no other programs</p>
    <?php endif;?>
</div>