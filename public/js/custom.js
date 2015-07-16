jQuery( function( $ ) {

    $('#new-widget-tabs a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    });

    $('.widget-type-choose').on('click','input[type=radio]',function() {
        $('.widget-subtype-choose').addClass('hide');
        if ( $(this).val() == 'rate' )
            $('.widget-subtype-choose').removeClass('hide');
    });

    $('.widget-type-choose').find('input[type=radio]:checked').trigger('click');

    $('.rating-set-star').each(function() {
        var rating = parseInt( $(this).data('rating') );
        var dec = $(this).data('rating') - rating;
        var i = 0;
        $(this).find('.rating-icons').each(function(){
            if(++i > rating) {
                if ( dec != 0 && i == (rating + 1) )
                    $(this).find('i').addClass('rating-icon-star-half');
                else
                    $(this).find('i').addClass('rating-icon-star-empty');
            }
        });
    });

});