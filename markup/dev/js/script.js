(function(global, $){
    var bodyContainer = $("body"),
        mainMenuContainer = $("#main-menu-js"),
        mainMenuLinks = mainMenuContainer.find(".main-menu__item"),
        showMenuButton = $("#show-menu-js"),
        menuAnimationOn = true;

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
        bodyContainer.addClass('mobile')
    }else{
        bodyContainer.addClass('desktop')
    }

    showMenuButton.on('click', function(){
        mainMenuContainer.toggleClass("active");
    });

    mainMenuLinks.hover(function(){
            var currentDesc = $(this).children(".main-menu__desc");
            console.log(menuAnimationOn);
            currentDesc.slideDown(300, function(){
                menuAnimationOn = true;
            });
            //if(menuAnimationOn){
            //    menuAnimationOn = false;
            //    currentDesc.slideDown(300, function(){
            //        menuAnimationOn = true;
            //    });
            //}

        }
        ,function(){
            var currentDesc = $(this).children(".main-menu__desc");
            currentDesc.slideUp(300, function(){
                menuAnimationOn = true;
            });
            //if(menuAnimationOn){
            //    menuAnimationOn = false;
            //    currentDesc.slideUp(300, function(){
            //        menuAnimationOn = true;
            //    });
            //}
        }
    );


}(window, window.jQuery));