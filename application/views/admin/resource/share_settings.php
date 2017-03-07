<?php /*?>
<div class="row">
<div class="col-md-8">

	
	<div class="checkbox">
		<div>This resource is shared with the following websites.</div>
        
            <?php
            unset($aClientWebsites['thanal']);
            foreach( $aClientWebsites AS $sKey => $aWebsites ):
            
                $sChecked = '';
                if( in_array($sKey, $aResourceSharedWebsites) ) {
                    $sChecked = 'checked="checked"';
                }
                ?>
                <label class="checkbox">    
                    <input type="checkbox" name="resource_shared_websites[]" id=""
                           <?php echo $sChecked;?>
                           value="<?php echo $sKey;?>"/>
                    <?php echo $aWebsites['domain'];?>
                </label>
            
            <?php endforeach;?>
	</div>
    

	
	<div class="form-group">
			<input type="submit" name="update" value="Update Resource" class="btn btn-default"/>
			<?php echo backButton('', 'Back');?>
	</div>
	
</div>
</div>
<?php echo form_close(); ?>
<?php */?>