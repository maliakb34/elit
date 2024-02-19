class ConsultingPortfolio extends elementorModules.frontend.handlers.Base {
	onInit() {
		let $ = jQuery;

		$('.filter_item').on('click', function (e) {
			e.preventDefault();
			let parent = $('.category_filter');
			let load_by = $(parent).attr("data-load");
			let style = $(parent).attr('data-style');
			let category = $(this).data('slug');
			$('.filter_item').removeClass('active');
			$(this).addClass('active');
			$(this).parents('.consulting_portfolio_box').find('.portfolio_load_more_button').attr('data-category', category);

			$.ajax({
				type: 'POST',
				url: ajaxurl,
				dataType: 'json',
				data: "&portfolio_load_by=" + load_by + "&portfolio_category=" + category + "&portfolio_style=" + style + "&action=portfolio_category_filter&security=" + stm_ajax_load_portfolio,
				beforeSend: function () {
					$('.consulting_portfolio_grid .portfolio_item').animate({
						'opacity': 0,
					}, 300);
					$('.consulting_portfolio_box .load_more_button_box').hide();
				},
				success: function (res) {
					$('.consulting_portfolio_grid').html(res.html).children('.portfolio_item').css({
						'opacity': 0,
					});
					$('.consulting_portfolio_grid .portfolio_item').animate({
						'opacity': 1,
					}, 300);
					if (res.posts_count > parseInt(load_by)) {
						$('.consulting_portfolio_box .load_more_button_box').show();
					}
				}
			})
		});

		$('.portfolio_load_more_button').on("click", function (e) {
			e.preventDefault();
			let page = $(this).attr("data-page");
			let load_by = $(this).attr("data-load");
			let category = $(this).attr('data-category');
			let style = $(this).attr('data-style');
			let data_count = $(this).attr('data-count');
			let style_number = parseInt(style.replace(/[^\d]/g, ''));

			$.ajax({
				url: ajaxurl,
				type: "POST",
				dataType: "json",
				data: "&page=" + page + "&load_by=" + load_by + "&category=" + category + "&style=" + style_number + "&data-count=" + data_count + "&action=stm_ajax_load_portfolio_elementor&security=" + stm_ajax_load_portfolio,
				context: this,
				beforeSend: function (data) {
					$(this).addClass("portfolio_posts_loading");
				},
				success: function (data) {
					$(this).removeClass("portfolio_posts_loading");
					if (data.html) {
						let $items = $(data.html);
						$(".consulting_portfolio_grid").append($items);
					}
					$(this).attr("data-page", data.new_page);
					if (false == data.load_more) {
						$(this).remove();
						$(".load_more_button_box").remove();
					}
				}
			});
		});
	}
}

jQuery(window).on('elementor/frontend/init', () => {
	const addHandler = ($element) => {
		elementorFrontend.elementsHandler.addHandler(ConsultingPortfolio, {
			$element,
		});
	};
	elementorFrontend.hooks.addAction('frontend/element_ready/stm_portfolio.default', addHandler);
});
