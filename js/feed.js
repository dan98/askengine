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
        context: this,
        success:function(data){
            $(this).parent().append(data);
            $(this).parent().parent().find('.like-num').html(parseInt($(this).parent().parent().find('.like-num').html()) + 1);
            $(this).remove();
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
        context: this,
        success:function(data){
            $(this).parent().append(data);
            $(this).parent().parent().find('.like-num').html(parseInt($(this).parent().parent().find('.like-num').html()) - 1);
            $(this).remove();
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

$(function(){
    refreshbinds();
});