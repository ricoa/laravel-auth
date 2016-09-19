$(function () {
    $("input[data-role=search-item]").keypress(function(event){
        if(event.keyCode==13) {
            $("[data-role=search]").click();
        }
    });
    $("[data-role=search]").click(function(){
        var search=[];
        var search_field=[];
        $("[data-role=search-item]").each(function(){
            if($(this).val()){
                search.push($(this).data("name")+":"+$(this).val());
                search_field.push($(this).data("name")+":"+$(this).data("express"));
            }

        });
        $("[type=hidden][name=search]").val(search.join(";"));
        $("[type=hidden][name=searchFields]").val(search_field.join(";"));
        if($(this).data('action')){
            $(this).parent().attr("action",$(this).data('action'));
        }
        $(this).parent().submit();
        $(this).parent().attr("action","");
    });
})