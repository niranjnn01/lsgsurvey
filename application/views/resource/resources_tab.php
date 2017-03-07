<div class="row">
    <div class="col-xs-12">
        <?php if ( $aResources ):?>
        <?php $iCount = 5?>
            <ol>
                <?php foreach( $aResources AS $iKey => $oItem ) : ?>
                <?php
                    if( --$iCount < 0) {
                        break;
                    } else {
                        unset($aResources[$iKey]);
                    }
                ?>
                    <li>
                        
                        <a href="<?php echo $c_base_url, 'resource/view/', $oItem->seo_name?>" >
                            <?php echo $oItem->title;?>
                        </a>
                    <p><?php echo $oItem->excerpt;?></p>
                    </li>
                <?php endforeach; ?>
                
                <?php /* reset of the resources are kept hidden */?>
                <span id="hidden_resources" class="collapse">
                <?php foreach( $aResources AS $iKey => $oItem ) : ?>
                
                    <li>    
                        <a href="<?php echo $c_base_url, 'resource/view/', $oItem->seo_name?>" >
                            <?php echo $oItem->title;?>
                        </a>
                        <p><?php echo $oItem->excerpt;?></p>
                    </li>
                    
                <?php endforeach; ?>
                </span>
                
                
            </ol>
            <a href="#" class="pull-right" id="show_more" data-target="#hidden_resources" data-toggle="collapse">Show More</a>
            
        <?php else:?>
            There are no related download materials
        <?php endif;?>
        
  <script type="text/javascript">
    
    
  </script>      
        
        
    </div>
</div>