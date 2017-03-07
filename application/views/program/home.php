<?php showMessage();?>

<h3>Programs</h3>


<?php if($aAllPrograms):?>
    <div class="row">
    
    <?php $iColumns = 4;?>
    <?php for($i=0; $i < $iColumns; ++$i):?>
    
    <div class="col-md-3">
        <?php
        $j=$i;
        while( isset( $aAllPrograms[$j] ) ):
        $oProgram = $aAllPrograms[$j];
        ?>
            <div class="thumbnail m-t-10">
                

                <?php if( $this->thanal_resource->getResourceThumbnailUrl($oProgram->display_image, 'display_image') ):?>
                <a href="<?php echo $c_base_url, 'program/view/' , $oProgram->seo_name;?>" class="tac">
                <img src="<?php echo $this->thanal_resource->getResourceThumbnailUrl($oProgram->display_image, 'large');?>"
                    style="/*float:right;margin-left:10px;*/"
                    alt="<?php echo $oProgram->title?>"/>
                </a>
                <?php endif;?>
                
                
                <h3><?php echo $oProgram->title;?></h3>
                <p><?php echo $oProgram->excerpt;?></p>
                <p><a href="<?php echo $c_base_url, 'program/view/' , $oProgram->seo_name;?>"
                        class="btn btn-default btn btn-default-primary">Know More</a></p>
            </div>
        <?php
        $j=$j+$iColumns;
        endwhile;?>
    </div>
    <?php endfor;?>
    </div>
    <hr/>

<?php else:?>
    <div class="no_data">There are no programs</div>
<?php endif;?>


<?php /*?>

<?php if($aAllPrograms):?>
<div class="row">    
    <?php
    $i=1;
    foreach ( $aAllPrograms AS $oProgram ): ?>
    
    <div class="col-md-3">
        <div class="thumbnail m-t-10">
            <a href="<?php echo $c_base_url, 'program/view/' , $oProgram->seo_name;?>">
                <img src="<?php echo getResourceThumbnailUrl($oProgram->display_image, 'large');?>" alt="<?php echo $oProgram->title?>"/>
            </a>
            
            <h3><?php echo $oProgram->title;?></h3>
            <p><?php echo $oProgram->excerpt;?></p>
            <p><a href="<?php echo $c_base_url, 'program/view/' , $oProgram->seo_name;?>"
                    class="btn btn-default btn btn-default-primary">Know More</a></p>
        </div>
    </div>
    
    <?php
    if( $i == 4 ):?>

</div>
<div class="row">
    <?php
        $i=1;
    else:
        ++$i;
    endif;
    
    endforeach;?>
</div>
<?php else:?>
<div class="row">   
    <div class="no_data">There are no programs</div>
</div>
<?php endif;?>

<?php */?>










