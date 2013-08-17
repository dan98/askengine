function refreshbinds(){
   $('.delete-link').unbind('click');
   $('.delete-link').bind('click', deletelink);
   $('.response-link').unbind('click');
   $('.response-link').bind('click', responselink);
   $('.ignore-link').unbind('click');
   $('.ignore-link').bind('click', ignorelink);
}
deletelink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: $(this).parent(),
        success:function(data){
            $(this).hide('slow');
            $("#question-number").html(parseInt($("#question-number").html()) - 1);
        },
        beforeSend:function(){
            $(this).html('deleting ...');
        }
    });
};
ingorelink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: this,
        success:function(data){
           $("#question-number").html(parseInt($("#question-number").html()) - 1);
        },
        beforeSend:function(){
             $(this).parent().hide('slow');
        }
    });
};
responselink = function(event){
    event.preventDefault();
    $('#question-form-div').remove();
    var url = $(this).attr('href');
    var form="";
    form += "<form id=\"question-form\" action=\""+url+"\" method=\"post\">";
    form += "<textarea rows=\"6\" cols=\"50\" name=\"Question[answer_text]\" id=\"Question_answer_text\"><\/textarea>hide : <input name=\"Question[hide]\" id=\"Question_hide\" value=\"1\" type=\"checkbox\"><input id=\"image_file\" name=\"Question[image]\" type=\"file\">";
    form += "<input type=\"submit\" name=\"yt0\" value=\"Respond\" id=\"respond-submit\">";
    form += "<\/form>";
    $(this).parent().append('<div id="question-form-div">'+form+'</div>');
    $("#question-form")
        .ajaxForm({
            url: $(this).attr("action"),
            type: 'post',
            
            success: function(){
                $("#question-form-div").parent().hide('slow');
                $("#question-number").html(parseInt($("#question-number").html()) - 1);
            }
        });
}


$(function(){
    refreshbinds();
});