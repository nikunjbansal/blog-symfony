/**
 * Created by nikunjbansal on 9/6/17.
 */

var like = (function () {
    var isLiked = false;
    var toggle_like_blog = function (blog_id) {
        $.ajax({
            type: "POST",
            url: '/blog/like',
            data: {blogId: blog_id},
            success: function (data) {
                document.getElementById(blog_id).innerHTML = data.likes+' likes';
            }
        });
        this.isLiked = !this.isLiked;
    };

    return {
        isLiked: this.isLiked,
        toggle_like_blog: this.toggle_like_blog
    };

})();