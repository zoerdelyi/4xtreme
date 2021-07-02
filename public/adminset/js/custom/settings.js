$(document).ready(function() {

    $('#settings_analtics_save').click(function(){

        var analytics_textarea = $('#analytics_textarea').val();
        var analytics_on_off = $('#analytics_on_off').val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/settings/analytics",
            data: {
                id: 1,
                analytics_textarea: analytics_textarea,
                analytics_on_off: analytics_on_off
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data);
                if (data.errors) { // ha VAN hiba
                    
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: "<strong>Sikertelen mentés!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{
                    if (data.success) { // ha VAN változó / success
                        $.notify({
                            message : "<strong>Sikeres mentés!</strong> A Google Analytics beállítások frissítésre kerültek az adatbázisban."
                        },{
                            type: 'success'
                        });
                    }
                }
            }
        });
    });

    $('#social_settings_save').click(function(){

        var social_fb_on = $('#social_fb_on').val();
        var social_fb_url = $('#social_fb_url').val();
        var social_ig_on = $('#social_ig_on').val();
        var social_ig_url = $('#social_ig_url').val();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/settings/settings_social",
            data: {
                social_fb_on: social_fb_on,
                social_fb_url: social_fb_url,
                social_ig_on: social_ig_on,
                social_ig_url: social_ig_url
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data);
                if (data.errors) { // ha VAN hiba
                    
                    // ez a tipusú notify nem fog eltűnni, csak ha bezárjuk. (hiba esetén ez a forma követendő)
                    $.notify({
                        message: "<strong>Sikertelen mentés!</strong> Hibaüzenet: " + data.errors
                    },{
                        // settings
                        type: 'danger',
                        delay: 0
                    });
                }else{
                    if (data.success) { // ha VAN változó / success
                        $.notify({
                            message : "<strong>Sikeres mentés!</strong> A közösségi ikon beállítások frissítésre kerültek az adatbázisban."
                        },{
                            type: 'success'
                        });
                    }
                }
            }
        });
    });
});