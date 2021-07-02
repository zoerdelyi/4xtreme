$(document).ready(function () {

    

    // admin menü asztali nézet esemény
    $(document).on('click','#desktop_menu_toggle',function(){        
		$('.sidebar').toggleClass( "show_hide_menu_sidebar" );
		$('.main-panel').toggleClass( "show_hide_menu_main-panel" );
    });

    // ha mobilról van valaki és megnyomja a menü gombot
    $(document).on('click','#navbar_mobile_toggler',function(){
        $('.sidebar').removeClass( "show_hide_menu_sidebar" );
        $('.main-panel').removeClass( "show_hide_menu_main-panel" );
    });

    // ha átméretezik az ablakot INNEN
    function getBootstrapDeviceSize() {
        return [
            $('#device-size-detector').find('div:visible').first().attr('id'),
            $('#device-size-detector').find('div:visible').first().attr('data-route')
        ];
    }
    
    function checkMenu(){
        var screen_page = getBootstrapDeviceSize();    
        var screen = screen_page[0];
        var page = screen_page[1];
    
        // ha kicsi a képernyő
        // if(page == 'admin/booking' || page == 'admin/booking/calendar'){
        //     if(screen != "lg" && screen != "xl") {
        //         $('.sidebar').removeClass( "show_hide_menu_sidebar" );
        //         $('.main-panel').removeClass( "show_hide_menu_main-panel" );
        //     }
        //     else{
        //         $('.sidebar').addClass( "show_hide_menu_sidebar" );
        //         $('.main-panel').addClass( "show_hide_menu_main-panel" );
        //     }
        // }
    }
    checkMenu();
    $(window).on('resize', checkMenu);
    // ha átméretezik az ablakot EDDIG
});