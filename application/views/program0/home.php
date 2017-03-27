<?php showMessage();?>

<h3>Programs</h3>


<?php if($aAllPrograms):?>


    <?php foreach($aAllPrograms AS $oProgram):?>

        <div class="media">
            
            <a href="<?php echo $c_base_url, 'program/view/' , $oProgram->seo_name;?>" class="pull-left">
                <img src="<?php echo getResourceThumbnailUrl($oProgram->display_image, 'small');?>"
                    alt="<?php echo $oProgram->title?>"
                    class="media-object pull-left  img-thumbnail"
                />    
            </a>
            
          <div class="media-body">
            <h3 class=""><?php echo $oProgram->title;?></h3>
                    <p>
                        <?php echo $oProgram->excerpt;?> ... 
                        <a href="<?php echo $c_base_url, 'program/view/' , $oProgram->seo_name;?>">Know More <i class="fa fa-long-arrow-right"></i></a>
                    </p>
          </div>
        </div>


    <?php endforeach;?>
    

<?php else:?>
    <div class="no_data">There are no programs</div>
<?php endif;?>

