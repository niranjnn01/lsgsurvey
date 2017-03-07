<?php if ( $aResources ):?>
    <ul>
        <?php foreach( $aResources AS $oItem ) : ?>
            <dl>
                
                <?php if( $oItem->type == $aResourceType['youtube_video'] ):?>
                    <dt><a href="<?php echo getYouTubeVideoURL_browser($oItem->file_name);?>"><?php echo $oItem->title;?></a></dt>
                <?php else:?>
                    <dt><a href="<?php echo $aResourceTypeUrl[$oItem->type], $oItem->file_name;?>" >
                        <?php echo $oItem->file_name;?>
                    </a></dt>
                <?php endif;?>
                <dd><?php echo $oItem->excerpt;?></dd>
            </dl>
        <?php endforeach; ?>
    </ul>
<?php else:?>
    <p>There are no related resources</p>
<?php endif;?>