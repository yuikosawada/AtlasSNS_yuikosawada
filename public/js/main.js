$(function(){
    //クリックで動く
    $('.nav-open').click(function(){
        $(this).toggleClass('active');
        $('nav').slideToggle();
    });
   
});