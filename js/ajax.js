function refreshbinds(){
    $('.hide-link').unbind('click');
    $('.hide-link').bind('click', hideandshowlink);
    $('.show-link').unbind('click');
    $('.show-link').bind('click', hideandshowlink);
    $('.follow-link').unbind('click');
    $('.follow-link').bind('click', followunfollowlink);
    $('.unfollow-link').unbind('click');
    $('.unfollow-link').bind('click', followunfollowlink);
    $('.like-link').unbind('click');
    $('.like-link').bind('click', likelink);
    $('.dislike-link').unbind('click');
    $('.dislike-link').bind('click', dislikelink);    
    $('.response-link').unbind('click');
    $('.response-link').bind('click', responselink);
    $('.ignore-link').unbind('click');
    $('.ignore-link').bind('click', ignorelink);
    $('.delete-link').unbind('click');
    $('.delete-link').bind('click', deletelink);
   
}
hideandshowlink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: $(this).parent().get(0),
        success:function(){
             $(this).parent().hide('slow');
        },
        beforeSend:function(){
             $(this).html('...');
        }
    });
};
likelink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: $(this).parent(),
        error:function(){
            $(this).parent().find('.like-num').html(parseInt($(this).parent().find('.like-num').html()) - 1);
            var likehtml = $(this).html();
            likehtml = likehtml.replace('dislike-link', 'like-link').replace('dislike/', 'createlike/').replace('>dislike<', '>like<');
            $(this).html(likehtml);
            refreshbinds();
        },
        beforeSend:function(){
            $(this).parent().find('.like-num').html(parseInt($(this).parent().find('.like-num').html()) + 1);
            var likehtml = $(this).html();
            likehtml = likehtml.replace('like-link', 'dislike-link').replace('createlike', 'dislike').replace('>like<', '>dislike<');
            $(this).html(likehtml);
            refreshbinds();
        }
    });
};
dislikelink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: $(this).parent(),
        error:function(){
            $(this).parent().find('.like-num').html(parseInt($(this).parent().find('.like-num').html()) + 1);
            var likehtml = $(this).html();
            likehtml = likehtml.replace('like-link', 'dislike-link').replace('createlike', 'dislike').replace('>like<', '>dislike<');
            $(this).html(likehtml);
            refreshbinds();
        },
        beforeSend:function(){
            $(this).parent().find('.like-num').html(parseInt($(this).parent().find('.like-num').html()) - 1);
            var likehtml = $(this).html();
            likehtml = likehtml.replace('dislike-link', 'like-link').replace('dislike/', 'createlike/').replace('>dislike<', '>like<');
            $(this).html(likehtml);
            refreshbinds();
        }
    });
};
followunfollowlink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: this,
        success:function(data){
             $(this).parent().append(data);
             $(this).remove();
             refreshbinds();
        }
    });
};
deletelink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: $(this).parent(),
        success: function(){
            $(this).parent().hide('slow');
        },
        beforeSend:function(){
             $(this).html('deleting');
        }
    });
};
ignorelink = function(event){
    event.preventDefault();
    var url = $(this).attr('href');
    $.ajax({
        type:'POST',
        url: url,
        context: $(this).parent(),
        success: function(data){
            $(this).parent().hide('slow');
            $("#question-number").html(parseInt($("#question-number").html()) - 1);
        },
        beforeSend:function(){
             $(this).html('ignoring');
        }
    });
};
responselink = function(event){
    event.preventDefault();
    $('#question-form-div').remove();
    var url = $(this).attr('href');
    var form="";
    form += "<form id=\"question-form\" action=\""+url+"\" method=\"post\">";
    form += " - <br/><textarea rows=\"6\" cols=\"34\" name=\"Question[answer_text]\" id=\"Question_answer_text\"><\/textarea>hide : <input name=\"Question[hide]\" id=\"Question_hide\" value=\"1\" type=\"checkbox\"><input id=\"image_file\" name=\"Question[image]\" type=\"file\">";
    form += "<input type=\"submit\" name=\"yt0\" value=\"Respond\" id=\"respond-submit\">";
    form += "<\/form>";
    $(this).parent().parent().find('span').append('<div id="question-form-div">'+form+'</div>');
    $("#question-form")
        .ajaxForm({
            url: $(this).attr("action"),
            type: 'post',
            context: $(this).parent(),
            success: function(){
                $(this).parent().hide('slow');
                $("#question-number").html(parseInt($("#question-number").html()) - 1);
            }
        });
}
$(function(){
    refreshbinds();
});