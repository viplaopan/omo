$(function() {
    $(function(){
        $(window).scroll(function(event) {
             var spead = 1100;
             var sHeight = $(document).scrollTop();
             console.log(sHeight)
             var b = 1-sHeight/spead;
             if(b<0){
                b = 0;
             }

             var Inheight = (sHeight)*b*0.9;


             $(".inBanner").css('transform','translate3d(0px, ' + Inheight + 'px, 0px)');
        });
       
    })
});