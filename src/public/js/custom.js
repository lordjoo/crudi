$(document).ready(function () {
    $('.mdb-select').materialSelect();
    $(".overlay-nav").click(function () {
        $(".sidebar-fixed").css({
            'transform':"translateX(-300px)",
        }).removeClass('sidebar-active')
        $(".overlay-nav").hide(100)

    })
    $(".sideNavToggle").click(function () {
        if ($('.sidebar-fixed').hasClass('sidebar-active')){
            $(".sidebar-fixed").css({
                'transform':"translateX(-300px)",
            }).removeClass('sidebar-active')
            $(".overlay-nav").hide(100)
        } else {
            $(".overlay-nav").show(100)
            $(".sidebar-fixed").show(100,function () {
                $(this).css({
                    'transform':"translateX(0)",
                }).toggleClass('sidebar-active')
            });
        }
    })
})
