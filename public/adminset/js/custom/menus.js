$(document).ready(function() {
    $(".dd").nestable({
        maxDepth: "2"
    });

    $('#order_save').click(function(){
        var json_menus_order = get_menu_order();

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/menus/menus_order",
            data: {
                new_order: json_menus_order
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
                            message : "<strong>Sikeres mentés!</strong> Az oldal menürendszerének elrendezése frissítésre került az adatbázisban."
                        },{
                            type: 'success'
                        });
                    }
                }
            }
        });
    });
    
    // kinyeri a menük elrendezését
    function get_menu_order(){
        var json_menus_order = [];
        $('.dd-item').each(function(index, element){
            var l_index = $(this).attr('data-menu_order');
            var data_menu_order = index + 1;
            // var l_index = index + 1;
            // var data_menu_order = $(this).attr('data-menu_order');
            var parent = 0;
            if($(this).parents('ol.dd-list').siblings('.dd-collapse').length !== 0){
                parent = $(this).parents('li.dd-item').attr('data-menu_order');
            }
            var is_parent = 0;
                if($(this).find('ol.dd-list').length !== 0){
            is_parent = 1;
            }

            json_menus_order.push({
                'id' : l_index,
                'menu_order' : data_menu_order,
                'parent' : parent,
                'is_parent' : is_parent
            });
        });
        return json_menus_order;
    }

    // menüelem beállításának lehívása
    $(document).on('change', '#menu_items', function() {
        var menu_id = $(this).val();
        get_actual_menu_item(menu_id);
    });

    function get_actual_menu_item(menu_id){
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/menus/menu_settings",
            data: {
                menu_id: menu_id
            },
            dataType: "text",
            success: function(data) {
                data = JSON.parse(data);
                var menus = data.menus;
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
                        // $('#menu_seoname').val(menus.seoname);
                        // $('#menu_page').val(menus.page_id);
                        $('#menu_active').val(menus.active);
                        $('#menu_highlighted').val(menus.highlighted);
                    }
                }
            }
        });
    }

    // menüelem beállításának mentése
    $(document).on('change', '.menu_live_change', function() {
        var menu_id = $('#menu_items').val();
        // var menu_seoname = $('#menu_seoname').val();
        // var menu_page = $('#menu_page').val();
        var menu_active = $('#menu_active').val();
        var menu_highlighted = $('#menu_highlighted').val();
        
        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            type: "POST",
            url: "/admin/ajax/menus/menu_save",
            // data: {
            //     menu_id: menu_id,
            //     menu_seoname: menu_seoname,
            //     menu_page: menu_page
            // },
            data: {
                menu_id: menu_id,
                menu_active: menu_active,
                menu_highlighted: menu_highlighted
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

                        // aktív - inaktív menüelem háttérszín módosítása (az elrendezésnél)
                        var changed_element = $('#menu_items').val();
                        if( $('#menu_active').val() == 0 ){
                            $("#menu_order").find("[data-menu_order='" + changed_element + "']").children(".dd-handle").addClass("menu_inactive");
                        }else{
                            $("#menu_order").find("[data-menu_order='" + changed_element + "']").children(".dd-handle").removeClass("menu_inactive");
                        }

                        // kiemelt - nem kiemelt menüelem keret módosítása (az elrendezésnél)
                        if( $('#menu_highlighted').val() == 1 ){
                            $("#menu_order").find("[data-menu_order='" + changed_element + "']").children(".dd-handle").addClass("menu_highlighted");
                        }else{
                            $("#menu_order").find("[data-menu_order='" + changed_element + "']").children(".dd-handle").removeClass("menu_highlighted");
                        }

                        // ne mutassuk a mentést
                        // $.notify({
                        //     message : "<strong>Sikeres módosítás!</strong> Az aktuális menüelem sikeresen frissítve."
                        // },{
                        //     type: 'success'
                        // });
                    }
                }
            }
        });
    });
});
