<?php if( $aRelatedCampaigns ):?>
    <dl>
        <?php foreach( $aRelatedCampaigns AS $oItem ): ?>
            <dt>
                <a href="<?php echo $c_base_url, 'campaign/view/', $oItem->seo_name;?>" >
                    <?php echo $oItem->title;?>
                </a>
            </dt>
            <dd><?php echo $oItem->excerpt;?></dd>
        <?php endforeach; ?>
    </dl>
<?php else:?>
    There are no related campaigns
<?php endif;?>