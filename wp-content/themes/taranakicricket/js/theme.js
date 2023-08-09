jQuery(function($) {
    var $ = jQuery;
    partnersSlick = $(".sponsor").slick({
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        nextArrow: '<i class="fa fa-angle-right"></i>',
        prevArrow: '<i class="fa fa-angle-left"></i>',
        autoplay: true,
        autoplaySpeed: 8000,
        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
    if($(window).width()> 991) {
        var waypoint = new Waypoint({
            element: document.getElementById('page'),
            handler: function () {
                $(".wrapper").toggleClass('addpadding');
                $("#header").toggleClass('sticky');
            },
            offset: -10
        });
    }
    if($(window).width() <= 991) {
        $('.top').click(function(event){
            $('html, body').animate({
                scrollTop: 0
            }, 500);
            return false;
        });
        var waypoint = new Waypoint({
            element: document.getElementById('header'),
            handler: function () {
                $(".top").toggleClass('show');
            },
            offset: -500
        });
    }
    $(".search").keyup(function () {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

        $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }
        });

        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','false');
        });

        $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).attr('visible','true');
        });

        var jobCount = $('.results tbody tr[visible="true"]').length;
        $('.counter').text(jobCount + ' item');

        if(jobCount == '0') {$('.no-result').show();}
        else {$('.no-result').hide();}
    });
    $(".filter-bat").click(function() {
        $(this).addClass('selected');
        $(".filter-bowl").removeClass('selected');
    });
    $(".filter-bowl").click(function() {
        $(this).addClass('selected');
        $(".filter-bat").removeClass('selected');
    });
});
function filterRecords(filter_in) {
    //alert(e);
    var $ = jQuery;

    $.ajax({
        url: ajaxurl + "?action=ajax&call=filterRecords&filter=" + filter_in,
        cache: false,
        success: function (response) {
            $(".table-responsive").html(response).fadeIn();
        }
    });
}