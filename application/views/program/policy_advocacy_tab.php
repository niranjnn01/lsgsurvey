<?php if( $aRelatedPolicyAdvocacy ):?>
    <dl>
        <?php foreach( $aRelatedPolicyAdvocacy AS $oItem ): ?>
            
                
                <dt><a href="<?php echo $c_base_url, 'policy_advocacy/view/', $oItem->seo_name;?>" >
                    <?php echo $oItem->title;?>
                </a></dt>
                <dd><?php echo $oItem->excerpt;?></dd>
                
            
        <?php endforeach; ?>
    </dl>
<?php else:?>
    There are no related Policies
<?php endif;?>