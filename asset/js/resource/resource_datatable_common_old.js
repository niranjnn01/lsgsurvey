
$(document).ready(function() {
    
    var selected_resources_array = new Array();
    
    // populate array with selected resource ids.
    // done this way, so that we can use this same code for program, campaigns, projects etc etc
    if( $('#selected_resources').val() != '' ) {
        
        selected_resources_array = $.makeArray(
                                               $.parseJSON(
                                                           $('#selected_resources').val()
                                                           )
                                               );
    }
    
    
    $('#selected_resources').val( JSON.stringify(selected_resources_array) );
    
    //initialize the context
    var datatable_context = '';
    
    
    
    $('#include_resource').click(function (event) {
        
        event.preventDefault();
        datatable_context = 'include_resource';
        $.fancybox( '#resource_table_cnt' );
    });
    
    $('#select_display_image').click(function (event) {
        
        event.preventDefault();
        datatable_context = 'assign_display_image';
        $.fancybox( '#resource_table_cnt' );
    });


    $('#resource_table').show().dataTable({
        "sDom": "<'row'<'col-xs-8'l><'col-xs-8'f>r>t<'row'<'col-xs-8'i><'col-xs-8'p>>",
        "sPaginationType": "bootstrap"
    });
    
    
    $('#resource_table').on('click', '.insert', function (event){
        
        event.preventDefault();
        
        
        var resource_id = $(this).attr('id');
        
        switch( datatable_context ) {
            
            case 'include_resource':
                //console.log(JSON.stringify(selected_resources_array));
                if( $.inArray(resource_id, selected_resources_array) < 0 ) {
                    
                    selected_resources_array.push( resource_id );
                    
                    $('#selected_resources_cnt').append(
                                                    '<div class="alert alert-success" style="float:left;margin-right: 10px;">' +
                                                    '<button class="close" id="' + $(this).attr('id') + '" data-dismiss="alert" type="button">&times;</button>' +
                                                    $(this).parent().prev().prev().prev().html() +
                                                    '</div>'
                                                );
                    
                    $('#selected_resources').val( JSON.stringify( selected_resources_array ) );
                    //console.log(selected_resources_array);
                }
                break;
            
            
            
            case 'assign_display_image':
                
                //get the corresponding display image
                $('#display_image_cnt').load(base_url + 'resource/get_thumbnail/' + resource_id);
                $('#display_image').val(resource_id);
                break;
        }
        
    });
    
    
    $('#selected_resources_cnt').on('click', '.close', function (event) {
        
        var resource_id = $(this).attr('id');
        
        //remove from the array
        for (var key in selected_resources_array) {
            if (selected_resources_array[key] == resource_id) {
                selected_resources_array.splice(key, 1);
            }
        }
        
        $('#selected_resources').val( JSON.stringify(selected_resources_array) );
        
    });
    

});