<?php showMessage();?>



<div class="row">
    <div class="col-md-6">
        <?php /*?>

        <h3>Previous Events</h3>
        <?php */?>
    </div>
    <div class="col-md-6 p-t-10">
        Showing Category : <?php echo form_dropdown('event_type', $aEventTypesTitle, $iType, 'class="type"');?>
    </div>
</div>

<div  class="row">
    <?php if($aAllEvents):?>

        <?php foreach($aAllEvents AS $oEvent):?>

            <div class="row m-b-10">
                    <div class="col-xs-1 text-center thumbnail" style="background-color:#78CB78;color:#FFF;">
                        <span class="h3">
                            <?php echo date('M', strtotime($oEvent->starting_on));?><br/>
                            <?php echo date('d', strtotime($oEvent->starting_on));?><sup><?php echo date('S', strtotime($oEvent->starting_on));?></sup>
                        </span>

                    </div>
                    <div class="col-xs-11" style="">
                        <h4 style="margin-top:0px;">
                            <a href="<?php echo $c_base_url, 'event/view/', $oEvent->seo_name?>">
                                <?php echo $oEvent->title?>
                            </a>
                        </h4>
                        <div>
                            <b>Event Type</b> : <?php echo $aEventTypesTitle[$oEvent->type]?>
                        </div>
                        <div>
                            <i class="glyphicon glyphicon-time"></i> &nbsp;
                            From : <?php echo date('j M Y (g A)', strtotime($oEvent->starting_on));?>
                             -- To : <?php echo date('j M Y (g A)', strtotime($oEvent->ending_on));?>
                        </div>
                        <div>
                            <i class="glyphicon glyphicon-map-marker"></i> &nbsp;
                            <?php echo $oEvent->venue;?>
                        </div>
                    </div>
            </div>

            <p>
                <?php echo $oEvent->excerpt;?>
            </p>
            <p class="text-right">
                <a href="<?php echo $c_base_url, 'event/view/', $oEvent->seo_name?>">View details <i class="fa fa-long-arrow-right"></i></a>
            </p>
            <hr/>


        <?php endforeach;?>

        <?php echo $sPagination;?>

    <?php else:?>
        <div class="no_data">There are no events</div>
    <?php endif;?>
</div>
