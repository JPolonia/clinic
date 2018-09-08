$(document).ready(function () {
    $('#menu_nav').click(function () {
        $('.side-nav').toggleClass('visible');
        $('body').toggleClass('hidden');
    });
    $('.close').click(function () {
        $('.ad').css('display', 'none');
    });


    /*Clear for Presentation*/
    let mynavmenu = document.getElementById("navtrigger");
    mynavmenu.addEventListener("click", toggleNav);
    mynavmenu.style.setProperty("backgroud-color", "#35475e", "important");
    toggleNav();

    function toggleNav() {
        let mynav = document.getElementById('mynav');
        let myheader = document.getElementById('myheader');
        let mycontent = document.getElementsByClassName("main-content");
        let navtrigger = document.getElementById("navtrigger");

        navtrigger.classList.toggle("mt-44px");
        mycontent[0].classList.toggle("ml-0");
        mycontent[0].classList.toggle("pt-0px");
        mynav.classList.toggle("visible");
        mynav.classList.toggle("d-none");
        myheader.classList.toggle("d-none");

        //toggleFullScreen();
    }

    /* Get the documentElement (<html>) to display the page in fullscreen */
    let elem = document.documentElement;



    function toggleFullScreen() {
        if (!document.fullscreenElement &&    // alternative standard method
            !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) {  // current working methods
            if (document.documentElement.requestFullscreen) {
                document.documentElement.requestFullscreen();
            } else if (document.documentElement.msRequestFullscreen) {
                document.documentElement.msRequestFullscreen();
            } else if (document.documentElement.mozRequestFullScreen) {
                document.documentElement.mozRequestFullScreen();
            } else if (document.documentElement.webkitRequestFullscreen) {
                document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }
    }



});

