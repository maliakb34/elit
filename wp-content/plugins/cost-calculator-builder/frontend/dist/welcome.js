jQuery(document).ready((function(c){var o=c("#WelcomeModal");c("#WelcomeModalBtn").on("click",(function(){o.css("display","block")})),c("#welcome_new_form").on("click",(function(){c.ajax({url:window.ajaxurl,method:"GET",data:{action:"calc_create_id",nonce:window.ccb_nonces.ccb_create_id},success:function(c){document.location=document.location.href+"&action=edit&id="+c.id},error:function(c,o,n){console.log(n)}})})),c(window).on("click",(function(n){c(n.target).is(o)&&o.css("display","none")}))}));