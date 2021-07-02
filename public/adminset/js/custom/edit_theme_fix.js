// kijavítja a gallery-carousel popup-gallery owl-carousel owl-theme owl-loaded lapozós popup galléria képeinek
// updatelését. alapból ha update történik, akkor a link nem frissül. így viszont, már jól működik!
function correct_link_imgs(){
    $('[data-effect="mfp-zoom-in"]').each(function(){
        $(this).attr('href', $(this).find('img').attr('src'));
    });
}
$(document).ready(function () {

});