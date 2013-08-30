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
    $('button[type="submit"]')
     .click(function () {
         var btn = $(this)
         btn.button('loading')
         setTimeout(function () {
             btn.button('reset')
         }, 5000)
     });
}

var empty="";
empty += "              <span class=\"empty\">";
empty += "                  <div align=\"center\">";
empty += "                    <div class=\"card\" style=\"padding-top:0;display:inline-block;margin-top:30px;\">";
empty += "                        <h3 class=\"card-heading simple\">No new questions found<\/h3>";
empty += "                    <\/div>";
empty += "                <\/div>";
empty += "                <\/span>";

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
        context: $(this).parent().parent(),
        success: function(){
            $(this).parent().hide('slow', function() {
                    if($('.items .card:not(:hidden)').length === 0)
                    { 
                        $('.items').html(empty)
                    }
                });
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
    form += "<textarea rows=\"4\" cols=\"34\" name=\"Question[answer_text]\" id=\"Question_answer_text\"><\/textarea><input id=\"image_file\" name=\"Question[image]\" type=\"file\"><label class=\"checkbox\" style=\"display:inline-block;\" for=\"Question_hide\"><input name=\"User[hide]\" id=\"Question_hide\" value=\"1\" type=\"checkbox\">hide</label>";
    form += "<div style=\"float:right\"> <button type=\"submit\" name=\"yt0\" data-loading-text=\"responding...\" id=\"respond-submit\" class=\"btn btn-primary\">Respond</button></div>";
    form += "<\/form>";
    $(this).parent().parent().parent().find('.response-wrapper').append('<div id="question-form-div">'+form+'</div>');
    refreshbinds();
    $("#question-form")
        .ajaxForm({
            url: $(this).attr("action"),
            type: 'post',
            context: $(this).parent().parent(),
            success: function(){
                $(this).parent().hide('slow', function() {
                    if($('.items .card:not(:hidden)').length === 0)
                    { 
                        $('.items').html(empty)
                    }
                });
                $("#question-number").html(parseInt($("#question-number").html()) - 1);
            }
        });
}
$(function(){
    refreshbinds();
    $(document).skylo({
        state: 'info'
    });
});