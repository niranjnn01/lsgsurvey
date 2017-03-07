<?php showMessage();?>



<h3><?php echo $oEvent->title;?></h3>
<div class="row">

    <div class="col-md-8">


            <div class="col-md-12">
                From <?php echo date('j M Y (g A)', strtotime($oEvent->starting_on));?>&nbsp;
                To <?php echo date('j M Y (g A)', strtotime($oEvent->ending_on));?>
            </div>

            <div class="col-md-12">
                <i class="glyphicon glyphicon-map-marker m-r-5"></i><?php echo $oEvent->venue;?>
            </div>

            <div class="col-md-12"><b>Event Type</b> : <?php echo $aEventTypesTitle[$oEvent->type];?></div>

            <div class="col-md-12">
                <b>Admission</b> : <?php echo $aEventAdmissionTypesTitle[$oEvent->admission_type];?>
                <?php if($oEvent->admission_comment):?>
                    ( <i><?php echo $oEvent->admission_comment;?></i> )
                <?php endif;?>
            </div>



            <div class="col-md-12">
                <?php echo $oEvent->description;?>
            </div>



    </div>


</div>
