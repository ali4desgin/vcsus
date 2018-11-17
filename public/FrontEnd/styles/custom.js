
$(function(){
    $("#add_post").click(function(){


        // get the post content
        var message = $("#post_message").val();



        // check the post content
        if(message==""){

            alert("you can't let the post content empty");
        }else{
            





            $("#post_textarea").removeClass("col-sm-12",1000).addClass("col-sm-9");
            $("#post_preview").css({
                "display":"inline-block"
            });



            $.ajax({

                url:"add_text_post",
                success:function(data){

                    console.log(data);
                    //alert(data);
                },
                error:function(error){

                    console.log(error);
                    //alert(error);
                }

            });


            
        }
        


       


        
});






});
