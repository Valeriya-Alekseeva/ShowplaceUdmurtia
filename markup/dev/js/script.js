(function(global, $){
    var bodyContainer = $("body"),
        mainMenuContainer = $("#main-menu-js"),
        mainMenuLinks = mainMenuContainer.find(".main-menu__item"),
        showMenuButton = $("#show-menu-js"),
        menuAnimationOn = true,
        mainPageCover = $("#main-page-cover");

    var isMobile = {
        Android: function() {
            return (navigator.userAgent.match(/Android/i) && !navigator.userAgent.match(/IEMobile/i));
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return (navigator.userAgent.match(/iPhone|iPad|iPod/i) && !navigator.userAgent.match(/IEMobile/i) );
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };

    if(isMobile.any()){
        bodyContainer.addClass('mobile');
    }else{
        bodyContainer.addClass('desktop');
        mainMenuLinks.hover(function(){
                var currentDesc = $(this).children(".main-menu__desc");

                currentDesc.slideDown(300, function(){
                    menuAnimationOn = true;
                });


            }
            ,function(){
                var currentDesc = $(this).children(".main-menu__desc");
                currentDesc.slideUp(300, function(){
                    menuAnimationOn = true;
                });

            }
        );
    }

    showMenuButton.on('click', function(){
        mainMenuContainer.toggleClass("active");
    });




    if(mainPageCover.length > 0){
        setTimeout(function(){
            mainPageCover.addClass("disabled");
        }, 2000);
        setTimeout(function(){
            mainMenuContainer.addClass("active");
            mainPageCover.hide();
        },3000);
    }


}(window, window.jQuery));