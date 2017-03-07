
$(document).ready(function() {
    
    var selected_resources_array = new Array();
    
    // populate array with selected resource ids.
    // done this way, so that we can use this same code for program, campaigns, projects etc etc
    if( $('#selected_resources').val() != '' ) {
        /*
        selected_resources_array = $.makeArray(
                                               $.parseJSON(
                                                           $('#selected_resources').val()
                                                           )
                                               );
        */
    }
    
    
    $('#selected_resources').val( JSON.stringify(selected_resources_array) );
    
    //initialize the context
    var datatable_context = '';
    var resource_cnt_id = '';
    var hidden_field_id = '';
    
    
    $('.resource_target .add_resource').click(function (event) {
        
        event.preventDefault();
        
        datatable_context = 'add_resource';
        
        resource_cnt_id = $(this).attr('data-resource-cnt-id');
        hidden_field_id = $(this).attr('data-hidden-field-id');
        
        $.fancybox( '#resource_table_cnt' );
    });
    
    $('#select_display_image').click(function (event) {
        
        event.preventDefault();
        datatable_context = 'assign_display_image';
        $.fancybox( '#resource_table_cnt' );
    });

  
    $('#resource_table')
    .show()
    .dataTable({
        "sDom": "<'row'<'col-xs-6 text-left'l><'col-xs-6 text-right'f>r>t<'row'<'col-xs-12'i><'col-xs-12 text-center'p>>",
        "sPaginationType": "full_numbers"
    });
    
    
    $('#resource_table').on('click', '.insert', function (event){
        
        event.preventDefault();
        
        
        var resource_id = $(this).attr('id');
        
        switch( datatable_context ) {
            
            case 'add_resource':
                
            
                resource_cnt_selector = '#' + resource_cnt_id;
                hidden_field_selector = '#' + hidden_field_id;
            console.log(resource_cnt_selector);        
            console.log(hidden_field_selector);
            
            //hidden field value
            var hidden_field_value = '[]';
            
            if( $(hidden_field_selector).val() != '' ) {
                hidden_field_value = $(hidden_field_selector).val();
            }
            
            // array holding the values
            selected_resources_array = $.makeArray(
                                           $.parseJSON(
                                                       hidden_field_value
                                                       )
                                           );
            
            
            
            
            console.log(JSON.stringify(selected_resources_array));
            
                //console.log(JSON.stringify(selected_resources_array));
                if( $.inArray(resource_id, selected_resources_array) < 0 ) {
                    
                    
                    
                    selected_resources_array.push( resource_id );
                    
                    $(resource_cnt_selector).append(
                                                    '<div class="alert alert-success" style="float:left;margin-right: 10px;">' +
                                                    '<button class="close" id="close_' + $(this).attr('id') + '" data-dismiss="alert" type="button">&times;</button>' +
                                                    $(this).parent().prev().prev().prev().html() +
                                                    '</div>'
                                                );
                    
                    $(hidden_field_selector).val( JSON.stringify( selected_resources_array ) );
                    console.log(selected_resources_array);
                }
                break;
            
            
            
            case 'assign_display_image':
                
                //get the corresponding display image
                $('#display_image_cnt').load(base_url + 'resource/get_thumbnail/' + resource_id);
                $('#display_image').val(resource_id);
                break;
        }
        
    });
    
    
    $('.resource_target').on('click', '.close', function (event) {
        
        var element_id = $(this).attr('id');
        var resource_id = element_id.substring(
                                                (element_id.indexOf('_') + 1),
                                                element_id.length
                                            );
        
        //hidden field value
        var hidden_field_value = '[]';
        
        var hidden_field = $(this).parent().parent().parent().find('input[type=hidden]');
        
        var hidden_field_id = $(this).parent().parent().find('input[type=hidden]');
        var hidden_field_selector = '#' + hidden_field_id;
        
        if( hidden_field.val() != '' ) {
            hidden_field_value = $(hidden_field).val();
        }
        
        // array holding the values
        selected_resources_array = $.makeArray(
                                       $.parseJSON(
                                                   hidden_field_value
                                                   )
                                       );
        
        //remove from the array
        for (var key in selected_resources_array) {
            if (selected_resources_array[key] == resource_id) {
                selected_resources_array.splice(key, 1);
            }
        }
        
        $(hidden_field).val( JSON.stringify(selected_resources_array) );
        
    });
    

});