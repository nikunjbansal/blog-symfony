/**
 * Created by nikunjbansal on 9/6/17.
 */

var like = (function () {
    var isLiked = false;
    var toggle_like_blog = function (blog_id) {

        this.isLiked = !this.isLiked;
    };

    return {
        isLiked: this.isLiked,
        toggle_like_blog: this.toggle_like_blog
    };

})();

var toggle_like_blog = (function () {
    var userLike = {
        Like : 'Unlike',
        Unlike: 'Like'
    };
    var toggleLikeButton = function (blog_id) {
        var likeSpan = $("#"+blog_id+"likeSpan span");
        likeSpan.text(userLike[likeSpan.text()]);
    };
    return function (blog_id) {
        $.ajax({
            type: "POST",
            url: '/blog/like',
            data: {blogId: blog_id},
            success: function (data) {
                document.getElementById(blog_id).innerHTML = data.likes+' likes';
                toggleLikeButton(blog_id);
            }
        });
    }
})();