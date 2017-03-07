<div class="resource_target">
	<fieldset>
		<legend>
			<?php echo $resource_includer_title;?>
			
			<a class="fancybox btn btn-primary pull-right add_resource" href="#"
				data-resource-cnt-id="<?php echo $resource_container_id;?>"
				data-hidden-field-id="<?php echo $hidden_field_name;?>"
				>
				<i class="fa fa-plus"></i> Add Files
			</a>
		</legend>
	
		<div class="form-group">
			
			<div id="<?php echo $resource_container_id;?>" style="min-height:60px;background-color:#FFF;" class="thumbnail c">
				
			</div>
			
			<input type="hidden" name="<?php echo $hidden_field_name;?>" id="<?php echo $hidden_field_id;?>" value=""/>
		</div>
	</fieldset>
</div>