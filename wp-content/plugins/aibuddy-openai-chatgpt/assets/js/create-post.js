"use strict";

(function ($) {
  $(document).ready(function () {
    $('.button-create-post').on("click", function (event) {
      event.preventDefault();
      $.ajax({
        method: "POST",
        url: ai_buddy_create_post.api_url,
        data: JSON.stringify({
          "title": $("#post-title").val(),
          "content": $("#post-content").val(),
          "excerpt": $("#post-excerpt").val()
        }),
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        beforeSend: function beforeSend(xhr) {
          xhr.setRequestHeader('X-WP-Nonce', ai_buddy_create_post.nonce);
        },
        success: function success(response) {
          $(".created-post-popup").addClass("active");
          if (response.post_edit_link) {
            $(".button-open-post").attr('href', response.post_permalink);
            $(".button-edit-post").attr('href', response.post_edit_link);
          }
        }
      });
    });
  });
})(jQuery);