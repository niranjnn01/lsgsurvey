<div class="row">
  <div class="col-md-12">
    <?php if($aPreviousEvents):?>
        <?php foreach($aPreviousEvents AS $oItem):?>
            <div class="event">
                <h5><a href="<?php echo $c_base_url, 'event/view/', $oItem->seo_name;?>"
                   title="<?php echo $oItem->title?>"><?php echo substr($oItem->title, 0, 100);?></a></h5>
                <div><?php echo $oItem->excerpt;?></div>
            </div>
        <?php endforeach;?>
        <a class="pull-right" href="<?php echo $c_base_url;?>event/previous">View All</a>
    <?php else:?>
    <div>There are no events to show</div>



    <?php endif;?>
  </div>
</div>
