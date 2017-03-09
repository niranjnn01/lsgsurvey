
var base_url = '<?php echo $base_url;?>';

$(document).ready(function(){

  $( "form" ).on( "submit", function( event ) {
    event.preventDefault();

    var search_url = base_url + 'search/do_search?' + $( this ).serialize()

    $.ajax({
      url:search_url,
      type:"GET",
      success:function (data) {

        $('#search_message').html('');
        $('#search_message').append(data.message);

        $('#result_container').html('');

        if(data.result) {

          $.each(data.result, function (index, item) {

            $('#result_container').append(
              $(
                '<div class="row">' +
                  '<div class="col-md-3">' +
                    '<b>Name :</b>' + item.user_name +
                  '</div>' +
                  '<div class="col-md-3">' +
                    '<b>Ward  :</b>' + item.ward_id +
                  '</div>' +
                  '<div class="col-md-6">' +
                  '</div>' +
                '</div>'
              )
            );

          });
        }

        $('html, body').animate({scrollTop: '0px'}, 300);

      },
      dataType : "json"
    });

  });

});
