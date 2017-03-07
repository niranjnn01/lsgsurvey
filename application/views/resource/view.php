<?php showMessage();?>
<?php //p($oResource);?>
<div class="row">
    
    <div class="col-md-8">
        <h3><?php echo $oResource->title;?></h3>
        
        <div class="row">
            <?php if( $oResource->thumbnail == 1 ):?>
                <img class="thumbnail" src="<?php echo getResourceThumbnailUrl($oResource->uid, 'small');?>"
                    style="margin:0px 10px 10px 0px;float:left;"/>
            <?php endif;?>
            
            <?php echo $oResource->description;?>
        </div>

        <?php // GOOGLE DOCUMENT VIEWER?>
        <?php if( $oResource->type == $aResourceType['document'] ):?>
            <iframe src="http://docs.google.com/viewer?url=<?php echo urlencode($sUrl);?>&embedded=true"
                    width="100%" height="780"
                    style="border: none;"></iframe>
        <?php endif;?>
        <?php //echo $oResource->type;?>
        <?php if( $oResource->type == $aResourceType['youtube_video'] ):?>
           <div class="embed-responsive embed-responsive-16by9">
						
                <iframe width="420"
                        height="315"
                        src="//www.youtube.com/embed/<?php echo $oResource->file_name;?>"
                        frameborder="0"
                        allowfullscreen></iframe>
                
                
            </div>
        <?php endif;?>
        
        <?php // FACEBOOK COMMENTS ?>
        <div class="row">
            <div class="col-md-12">
                <div class="fb-comments"
                    data-href="http://thanal.co.in/resource/view/<?php echo $oResource->uid;?>"
                    data-width="740"
                    data-order_by="reverse_time"
                    data-num-posts="10"></div>
            </div>
        </div>
        
    </div>
    <div class="col-md-4 p-t-20">
        
			<?php if( $oResource->type == $aResourceType['youtube_video'] ):?>
            
                <a href="<?php echo getYouTubeVideoURL_browser($oResource->file_name);?>" target="_blank">
                    <i class="glyphicon glyphicon-share"></i>
                    <?php echo '&nbsp;', $oResource->title;?>
                </a>
			<?php elseif( $oResource->type == $aResourceType['web_link'] ):?>
                <a href="<?php echo $oResource->url;?>" target="_blank">
                    <i class="glyphicon glyphicon-share"></i>
                    <?php echo '&nbsp;', $oResource->title;?>
                </a>
			<?php else:?>
                
                    <?php
                    // moved to controller
                    // $sUrl = $aResourceTypeUrl[$oResource->type] . $oResource->file_name;
                    ?>
                    <a
                        href="<?php echo $sUrl;?>"
                        class="btn btn-default btn btn-default-large btn btn-default-primary pull-center"
                        download="<?php echo $sUrl;?>"
                    >
                    <i class="glyphicon glyphicon-download-alt"></i>
                    &nbsp;Download
                    </a>
                
			<?php endif;?>



            <table class="table table-condensed m-t-20">
                
                <?php if( $oResource->type == $aResourceType['youtube_video'] ):?>
                    <tr>
                        <td>Type</td>
                        <td>Youtube video link</td>
                    </tr>
					
				<?php elseif( $oResource->type == $aResourceType['web_link'] ):?>
                    <tr>
                        <td>Type</td>
                        <td>Web link</td>
                    </tr>
				<?php else:?>
                    <tr>
                        <td>Type</td>
                        <td><?php echo $oResource->extension;?></td>
                    </tr>
                    <tr>
                        <td>Size</td>
                        <td><?php echo $oResource->file_size;?> MB</td>
                    </tr>                
				<?php endif;?>
                


            </table>


        
    </div>
    
</div>