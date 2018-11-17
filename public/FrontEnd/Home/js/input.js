$("#post-text-area").keydown(function(){
   var counter = $(this).val().length,
        remining_area = 200;


    var still_have = remining_area - counter;

    if(still_have >= 0){
        $("#remining-chars").text(still_have)
    }
    

});

$("#create_post_submit").click(event,function(){


    var textarea = $("#post-text-area"),
        counter = textarea.val().length;
    if(counter <= 0){
        textarea.addClass("error_with_red_border");
        event.preventDefault();

    }

});