$(function(){

    'use strict';

    // Adjust Slider Height
    var winH   = $(window).height(),
        upperH = $('.upper-bar').innerHeight(),
        navH   = $('.navbar').innerHeight();
    $(".slider,.carousel-item").height(winH - (upperH + navH));

    // $(".item").on('click',function(){
    //     var idBody = $(this).attr("data-show-body");
    //     console.log(idBody);
    //     $(idBody).show();
    // })
});
