/**
 * Created by savenkoff on 10.01.2015.
 */

$(document).ready(function($) {

    'use strict';

    /* Карусель V.I.P пользователей на главной darkhome */

    $("#vip-users-carousel").owlCarousel({
        autoPlay: 3200,
        items : 4,
        navigation: false,
        itemsDesktopSmall : [1024,3],
        itemsTablet : [768,3],
        itemsMobile : [600,2],
        pagination: true
    });

    /* Настройка fancybox */

    $(".fancybox").fancybox({
        openEffect  : 'elastic',
        closeEffect : 'elastic',

        helpers : {
            title : {
                type : 'inside'
            }
        }
    });

});