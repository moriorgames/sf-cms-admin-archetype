$(document).ready(function () {

    $("a[href='#']").click(function (event) {
        event.preventDefault();
    });


    /** MAP EDIT TILE BY TILE JAVASCRIPT **/
    var toolId = 1;
    $('.tools a').click(function () {

        $('.tools a').each(function () {
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        toolId = $(this).attr('data-id');

    });

    // Map Tile by tile
    $('.tile-by-tile a').click(function () {

        var form = $('.tile-by-tile form');
        var url = $(form).attr('action');
        var data = {
            id: $('#_map_id').val(),
            x: $(this).attr('data-x'),
            y: $(this).attr('data-y'),
            tileId: toolId
        };

        $(this).removeClass();
        $(this).addClass($('#tool_' + toolId).attr('class'));
        $.post(url, data, function (data) {
            $(".result").html(data);
        });

    });

});
