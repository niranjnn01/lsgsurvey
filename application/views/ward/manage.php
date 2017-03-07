
<div class="row">
	<div class="col-md-12">
		<a href="<?php echo $c_base_url;?>ward/choose" class="btn btn-primary pull-right">
			+ Add a new ward
		</a>
	</div>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">

		<?php showMessage();?>
		
		
			<ul>
				<?php foreach($aWards AS $oItem):?>
				<li>
				
					<?php echo $oItem->title; ?>
					&nbsp;
					<a href="#" class="remove" id="<?php echo $oItem->id;?>">x</a>
				
				</li>
				<?php endforeach;?>
			</ul>
		

	</div>
</div>
