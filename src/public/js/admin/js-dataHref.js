//trをリンク形式に
$(function(){
    $('tr[data-href]').click(function(e) {
        if(!$(e.target).is('a')){
            let href = $(e.target).closest('tr').data('href');
            if($(this).is('[data-target]')){
              window.open(href, "_blank");
            }else {
              window.location = href;
            }
        };
    });
});

//liをリンク形式に
$(function(){
    $('li[data-href]').click(function(e) {
        if(!$(e.target).is('a')){
            window.location = $(e.target).closest('li').data('href');
        };
    });
});