
    <div class="col-md-8">
    
        <h3>Edit Resource</h3>
        <?php showMessage();?>
        
        
        <?php echo form_open_multipart('resource/edit/'.$oResource->uid, array('id' => 'resourceCreateForm'))?>
        
        <?php echo $sTabbedContent?>
        
        <?php echo form_close(); ?>
    
    </div>
