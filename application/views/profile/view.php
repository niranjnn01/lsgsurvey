<div class="row">&nbsp;</div>
<div class="row">

	<div class="col-xs-3" style="border-right:1px dashed #CCC;">
		<?php echo getCurrentProfilePic($oUser, 'normal',true, array('attributes'=>array(
																		'class' => 'thumbnail',
																		'style' => 'margin-left:auto;margin-right:auto;',
																		)
																	 ));?>

	</div>

	<div class="col-md-9">
		<div class="row">
			<div class="col-md-12">

				<h2><?php echo $oUser->full_name;?></h2>

				<div><?php echo $oUser->about_me;?></div>


			</div>

		</div>
	</div>

</div>
