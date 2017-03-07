<?php if( $aRelatedProjects ):?>
    <ul>
        <?php foreach( $aRelatedProjects AS $oItem ): ?>
            <dl>
                
                <dt><a href="<?php echo $c_base_url, 'project/view/', $oItem->seo_name;?>" >
                    <?php echo $oItem->title;?>
                </a></dt>
                <dd><?php echo $oItem->excerpt;?></dd>
                
            </dl>
        <?php endforeach; ?>
    </ul>
<?php else:?>
    There are no related projects
<?php endif;?>