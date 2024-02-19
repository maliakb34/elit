<?php
/**
 * Plugin Name: Consulting Elementor Widgets
 * Description: Consulting Elementor Widgets.
 * Plugin URI:  https://consulting.stylemixthemes.com/
 * Version:     1.2.7
 * Author:      StylemixThemes
 * Author URI:  https://stylemixthemes.com/
 * Text Domain: consulting-elementor-widgets
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'CONSULTING_ELEMENTOR_PATH', dirname( __FILE__ ) );
define( 'CONSULTING_ELEMENTOR_URL', plugin_dir_url( __FILE__ ) );
define( 'CONSULTING_ELEMENTOR_VERSION', '1.2.7' );
define( 'STM_PATCH_VAR', 'patched8' );

require_once CONSULTING_ELEMENTOR_PATH . '/patch/main.php';
require_once CONSULTING_ELEMENTOR_PATH . '/patch-api/api.php';

final class Consulting_Elementor_Widgets {

	public static $consulting_layout = '';

	const VERSION = '1.0.0';

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	private static $instance = null;

	public static function instance() {

		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;

	}

	public function __construct() {

		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'register_widget_category' ) );

		add_filter( 'consulting_main_container_class', array( $this, 'container_class' ) );

		add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( $this, 'preview_scripts' ) );

		$this->add_default_controls();

		self::$consulting_layout = get_option( 'consulting_layout', 'layout_1' );

	}

	public function preview_styles() {
		wp_enqueue_style( 'cew_pie_chart', get_template_directory_uri() . '/assets/css/layouts/global_styles/pie_chart.css', array(), time() );
		wp_enqueue_style( 'cew_cta', get_template_directory_uri() . '/assets/css/layouts/global_styles/el_tta.css', array(), time() );
	}

	public function preview_scripts() {
		wp_enqueue_script( 'cew_script_preview', CONSULTING_ELEMENTOR_URL . '/assets/js/elementor-preview.js', array(), time(), true );
	}

	public function container_class( $class ) {

		$obj = get_queried_object();

		if ( empty( $obj->ID ) ) {
			return $class;
		}
		$item_id = $obj->ID;

		if ( ! in_array( get_post_type( $item_id ), get_option( 'elementor_cpt_support', array() ), true ) ) {
			return $class;
		}

		$elementor_status = get_post_meta( $item_id, '_elementor_edit_mode', true );
		$elementor_status = ( ! empty( $elementor_status ) && 'builder' === $elementor_status );

		return ( $elementor_status ) ? '' : $class;
	}

	public function i18n() {

		load_plugin_textdomain( 'consulting-elementor-widgets' );

	}

	public function init() {

		// Check if Elementor installed and activated
		if ( function_exists( 'stm_admin_notices_init' ) ) {
			if ( ! did_action( 'elementor/loaded' ) ) {
				self::admin_notice_missing_main_plugin();

				return;
			}

			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				self::admin_notice_minimum_elementor_version();

				return;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				self::admin_notice_minimum_php_version();

				return;
			}
		}
		// Add Plugin actions
		add_action( 'elementor/widgets/register', array( $this, 'init_widgets' ) );

		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'widget_scripts' ) );
	}

	public function widget_scripts() {
		wp_register_script( 'countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.js', array( 'jquery' ), CONSULTING_THEME_VERSION, true );
		wp_enqueue_style( 'editor-styles', CONSULTING_ELEMENTOR_URL . '/assets/css/elementor-editor.css', '', '1.1.2' );
		wp_enqueue_style( 'consulting-elementor-icons', CONSULTING_ELEMENTOR_URL . '/assets/fonts/icons/style.css', '', '1.0' );
		wp_enqueue_script( 'countdown' );
	}

	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'consulting-elementor-widgets' ),
			'<strong>' . esc_html__( 'Consulting Elementor widgets', 'consulting-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'consulting-elementor-widgets' ) . '</strong>'
		);

		$init_data = array(
			'notice_type'          => 'animate-triangle-notice only-title without-btn',
			'notice_logo'          => 'attent_triangle.svg',
			'notice_title'         => wp_kses_post( $message ),
		);

		stm_admin_notices_init( $init_data );
	}

	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'consulting-elementor-widgets' ),
			'<strong>' . esc_html__( 'Consulting Elementor widgets', 'consulting-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'consulting-elementor-widgets' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		$init_data = array(
			'notice_type'          => 'animate-triangle-notice only-title without-btn',
			'notice_logo'          => 'attent_triangle.svg',
			'notice_title'         => wp_kses_post( $message ),
		);

		stm_admin_notices_init( $init_data );
	}

	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'consulting-elementor-widgets' ),
			'<strong>' . esc_html__( 'Consulting Elementor widgets', 'consulting-elementor-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'consulting-elementor-widgets' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		$init_data = array(
			'notice_type'          => 'animate-triangle-notice only-title without-btn',
			'notice_logo'          => 'attent_triangle.svg',
			'notice_title'         => wp_kses_post( $message ),
		);

		stm_admin_notices_init( $init_data );
	}

	public function register_widget_category( $elements_manager ) {
		$new_categories = array(
			'consulting-widgets' => array(
				'title' => __( 'Consulting', 'consulting-elementor-widgets' ),
				'icon'  => 'eicon-font',
			),
		);

		$categories = array_merge( $new_categories, $elements_manager->get_categories() );

		$set_categories = function( $categories ) {
			$this->categories = $categories;
		};

		$set_categories->call( $elements_manager, $categories );
	}

	public function include_widgets() {
		include_once __DIR__ . '/includes/widgets/header/cart.php';
		include_once __DIR__ . '/includes/widgets/header/contact_info.php';
		include_once __DIR__ . '/includes/widgets/header/icon_box.php';
		include_once __DIR__ . '/includes/widgets/header/logo.php';
		include_once __DIR__ . '/includes/widgets/header/menu.php';
		include_once __DIR__ . '/includes/widgets/header/search.php';
		include_once __DIR__ . '/includes/widgets/header/wpml.php';
		include_once __DIR__ . '/includes/widgets/footer/menu.php';
		include_once __DIR__ . '/includes/widgets/about_vacancy.php';
		include_once __DIR__ . '/includes/widgets/anchors_link.php';
		include_once __DIR__ . '/includes/widgets/anchors_text.php';
		include_once __DIR__ . '/includes/widgets/company-history/company_history.php';
		include_once __DIR__ . '/includes/widgets/contact.php';
		include_once __DIR__ . '/includes/widgets/contacts_widget.php';
		include_once __DIR__ . '/includes/widgets/cost_calculator.php';
		include_once __DIR__ . '/includes/widgets/countdown.php';
		include_once __DIR__ . '/includes/widgets/event_lessons.php';
		include_once __DIR__ . '/includes/widgets/mydoc.php';
		include_once __DIR__ . '/includes/widgets/events.php';
		include_once __DIR__ . '/includes/widgets/events_form.php';
		include_once __DIR__ . '/includes/widgets/events_information.php';
		include_once __DIR__ . '/includes/widgets/events_map.php';
		include_once __DIR__ . '/includes/widgets/gmap.php';
		include_once __DIR__ . '/includes/widgets/gmap_l14.php';
		include_once __DIR__ . '/includes/widgets/icon_box.php';
		include_once __DIR__ . '/includes/widgets/iconboxes_with_tabs.php';
		include_once __DIR__ . '/includes/widgets/image_carousel.php';
		include_once __DIR__ . '/includes/widgets/info_box.php';
		include_once __DIR__ . '/includes/widgets/news/news.php';
		include_once __DIR__ . '/includes/widgets/newsletter.php';
		include_once __DIR__ . '/includes/widgets/partner.php';
		include_once __DIR__ . '/includes/widgets/portfolio/portfolio.php';
		include_once __DIR__ . '/includes/widgets/portfolio_carousel.php';
		include_once __DIR__ . '/includes/widgets/portfolio_information.php';
		include_once __DIR__ . '/includes/widgets/portfolio_pagination.php';
		include_once __DIR__ . '/includes/widgets/post_about_author.php';
		include_once __DIR__ . '/includes/widgets/post_bottom.php';
		include_once __DIR__ . '/includes/widgets/post_comments.php';
		include_once __DIR__ . '/includes/widgets/post_details.php';
		include_once __DIR__ . '/includes/widgets/post_tags.php';
		include_once __DIR__ . '/includes/widgets/pricing_plan.php';
		include_once __DIR__ . '/includes/widgets/quote.php';
		include_once __DIR__ . '/includes/widgets/services.php';
		include_once __DIR__ . '/includes/widgets/services_tabs.php';
		include_once __DIR__ . '/includes/widgets/share_buttons.php';
		include_once __DIR__ . '/includes/widgets/sidebar.php';
		include_once __DIR__ . '/includes/widgets/spacing.php';
		include_once __DIR__ . '/includes/widgets/staff_bottom.php';
		include_once __DIR__ . '/includes/widgets/staff_list.php';
		include_once __DIR__ . '/includes/widgets/stats_counter.php';
		include_once __DIR__ . '/includes/widgets/steps.php';
		include_once __DIR__ . '/includes/widgets/stocks_carousel.php';
		include_once __DIR__ . '/includes/widgets/stocks_chart.php';
		include_once __DIR__ . '/includes/widgets/stocks_table.php';
		include_once __DIR__ . '/includes/widgets/testimonials.php';
		include_once __DIR__ . '/includes/widgets/testimonials_carousel.php';
		include_once __DIR__ . '/includes/widgets/testimonials_pager.php';
		include_once __DIR__ . '/includes/widgets/vacancies.php';
		include_once __DIR__ . '/includes/widgets/vacancy_bottom.php';
		include_once __DIR__ . '/includes/widgets/works.php';
		include_once __DIR__ . '/includes/widgets/consulting_heading.php';
		include_once __DIR__ . '/includes/widgets/consulting_cta.php';
		include_once __DIR__ . '/includes/widgets/contact_form_7.php';
		include_once __DIR__ . '/includes/widgets/charts.php';
		include_once __DIR__ . '/includes/widgets/consulting_pie_chart.php';
	}

	public function init_widgets() {

		// Include Widget files
		self::include_widgets();

		// Register widget
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Header_Cart() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Header_Contact_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Header_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Header_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Header_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Header_Search() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Header_Wpml() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_Footer_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_About_Vacancy() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Anchors_Link() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Anchors_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Company_History() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Contact() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Contacts_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Cost_Calculator() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Countdown() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Event_Lessons() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_MyDoc() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Events() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Events_Form() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Events_Information() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Events_Map() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Gmap() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Gmap_L14() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Iconboxes_With_Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Image_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Info_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_News() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Newsletter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Partner() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Portfolio() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Portfolio_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Portfolio_Information() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Portfolio_Pagination() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Post_About_Author() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Post_Bottom() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Post_Comments() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Post_Details() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Post_Tags() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Pricing_Plan() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Quote() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Services() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Services_Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Share_Buttons() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Sidebar() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Spacing() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Staff_Bottom() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Staff_List() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Stats_Counter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Steps() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Stocks_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Stocks_Chart() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Stocks_Table() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Testimonials_Carousel() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Testimonials_Pager() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Vacancies() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Vacancy_Bottom() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Works() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_VC_Custom_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_VC_CTA() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Contact_Form_7() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Charts() );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Elementor_STM_Pie_Chart() );

	}

	public static function get_post_type( $args = array() ) {
		$query = new WP_Query( $args );
		$r     = array();
		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) {
				$query->the_post();
				$r[ get_the_ID() ] = get_the_title();
			}
			wp_reset_postdata();
		}

		return $r;
	}

	public static function get_image_url( $image_id, $size ) {

		include_once ELEMENTOR_PATH . 'includes/libraries/bfi-thumb/bfi-thumb.php';

		$attachment_size = $size;

		/*Check if custom size*/
		$custom_size = explode( 'x', $size );

		if ( ! empty( $custom_size[0] ) && ! empty( $custom_size[1] ) ) {
			if ( is_numeric( $custom_size[0] ) && is_numeric( $custom_size[1] ) ) {
				$attachment_size = array(
					// Defaults sizes
					0           => $custom_size[0], // Width.
					1           => $custom_size[1], // Height.

					'bfi_thumb' => true,
					'crop'      => true,
				);
			}
		}

		$image_src = wp_get_attachment_image_src( $image_id, $attachment_size );

		if ( ! empty( $image_src[0] ) ) {
			$image_src = $image_src[0];
		}

		if ( empty( $image_src[0] ) && 'thumbnail' !== $attachment_size ) {
			$image_src = wp_get_attachment_image_src( $image_id );
		}

		return $image_src;

	}

	public static function get_cropped_image( $image_id, $size ) {
		$image_url = self::get_image_url( $image_id, $size );
		$image_url = ( is_array( $image_url ) ) ? $image_url[0] : $image_url;
		$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );

		return "<img src='{$image_url}' alt='{$image_alt}' />";
	}

	public static function add_text_field( $vm, $id, $title, $default = '', $adds = array() ) {

		$args = array(
			'label' => $title,
			'type'  => \Elementor\Controls_Manager::TEXT,
		);

		$args = wp_parse_args( $adds, $args );

		if ( ! empty( $default ) ) {
			$args['default'] = $default;
		}

		$vm->add_control( $id, $args );

	}

	public static function add_query_builder( $vm, $prefix, $title = '' ) {

		$title = ( empty( $title ) ) ? esc_html__( 'Query Builder', 'plugin-domain' ) : $title;

		$post_types = get_post_types( array( 'public' => true ) );
		$taxonomies = get_taxonomies();

		$vm->start_controls_section(
			"{$prefix}_query_builder_section",
			array(
				'label' => $title,
			)
		);

		$vm->add_control(
			"{$prefix}_query_builder_post_type",
			array(
				'label'    => __( 'Select post type', 'plugin-domain' ),
				'type'     => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => $post_types,
			)
		);

		$vm->add_control(
			"{$prefix}_query_builder_posts_per_page",
			array(
				'label' => __( 'Post count', 'plugin-domain' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$vm->add_control(
			"{$prefix}_query_builder_order_by",
			array(
				'label'   => __( 'Order by', 'plugin-domain' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					'date'          => __( 'Date', 'plugin-domain' ),
					'ID'            => __( 'ID', 'plugin-domain' ),
					'author'        => __( 'Author', 'plugin-domain' ),
					'title'         => __( 'Title', 'plugin-domain' ),
					'modified'      => __( 'Modified', 'plugin-domain' ),
					'rand'          => __( 'Rand', 'plugin-domain' ),
					'comment_count' => __( 'Comment count', 'plugin-domain' ),
					'menu_order'    => __( 'menu_order', 'plugin-domain' ),
				),
			)
		);

		$vm->add_control(
			"{$prefix}_query_builder_sort_order",
			array(
				'label'   => __( 'Sort order', 'plugin-domain' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => array(
					'ASC'  => __( 'Ascending', 'plugin-domain' ),
					'DESC' => __( 'Descending', 'plugin-domain' ),
				),
			)
		);

		$vm->add_control(
			"{$prefix}_query_builder_post_ids",
			array(
				'label'       => __( 'Post IDs', 'plugin-domain' ),
				'description' => __( 'Enter post IDs separated by comma. Ex.: 45,46,47', 'plugin-domain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);

		$vm->add_control(
			"{$prefix}_query_builder_taxonomy",
			array(
				'label'    => __( 'Select taxonomy', 'plugin-domain' ),
				'type'     => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options'  => $taxonomies,
			)
		);

		$vm->add_control(
			"{$prefix}_query_builder_categories",
			array(
				'label'       => __( 'Categories IDs', 'plugin-domain' ),
				'description' => __( 'Enter category IDs separated by comma. Ex.: 45,46,47', 'plugin-domain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			)
		);

		$vm->end_controls_section();
	}

	public static function get_query_builder( $settings, $prefix ) {
		/**
		 * "{$prefix}_query_builder_post_type"
		 * "{$prefix}_query_builder_posts_per_page"
		 * "{$prefix}_query_builder_order_by"
		 * "{$prefix}_query_builder_sort_order"
		 * "{$prefix}_query_builder_post_ids"
		 * "{$prefix}_query_builder_taxonomy"
		 * "{$prefix}_query_builder_categories"
		 */

		$post_type      = $settings[ "{$prefix}_query_builder_post_type" ];
		$posts_per_page = $settings[ "{$prefix}_query_builder_posts_per_page" ];
		$order_by       = $settings[ "{$prefix}_query_builder_order_by" ];
		$sort_order     = $settings[ "{$prefix}_query_builder_sort_order" ];
		$post_ids       = $settings[ "{$prefix}_query_builder_post_ids" ];
		$taxonomy       = $settings[ "{$prefix}_query_builder_taxonomy" ];
		$categories     = $settings[ "{$prefix}_query_builder_categories" ];

		$args = array();

		if ( ! empty( $post_type ) ) {
			$args['post_type'] = $post_type;
		}
		if ( ! empty( $posts_per_page ) ) {
			$args['posts_per_page'] = $posts_per_page;
		}
		if ( ! empty( $order_by ) ) {
			$args['order_by'] = $order_by;
		}
		if ( ! empty( $sort_order ) ) {
			$args['order'] = $sort_order;
		}
		if ( ! empty( $post_ids ) ) {
			$args['post__in'] = explode( ',', trim( $post_ids ) );
		}
		if ( ! empty( $taxonomy ) && ! empty( $categories ) ) {
			$args['tax_query'] = array(
				'relation' => 'AND',

			);

			foreach ( $taxonomy as $tax ) {
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field'    => 'id',
					'terms'    => explode( ',', trim( $categories ) ),
				);
			}
		}

		$q = new WP_Query( $args );

		return $q;

	}

	public static function add_font_settings( $vm, $prefix, $defaults = array(), $selector = '' ) {

		$tag_default = ( ! empty( $defaults['tag'] ) ) ? $defaults['tag'] : 'h2';

		$vm->add_control(
			"{$prefix}_tag",
			array(
				'label'   => __( 'Element tag', 'plugin-domain' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => $tag_default,
				'options' => array(
					'h1'  => 'h1',
					'h2'  => 'h2',
					'h3'  => 'h3',
					'h4'  => 'h4',
					'h5'  => 'h5',
					'h6'  => 'h6',
					'p'   => 'p',
					'div' => 'div',
				),
			)
		);

		$vm->add_control(
			"{$prefix}_text_align",
			array(
				'label'   => __( 'Text align', 'plugin-domain' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'    => __( 'Left', 'plugin-domain' ),
					'right'   => __( 'Right', 'plugin-domain' ),
					'center'  => __( 'Center', 'plugin-domain' ),
					'justify' => __( 'Justify', 'plugin-domain' ),
				),
			)
		);

		if ( ! empty( $selector ) ) {
			$vm->add_control(
				"{$prefix}_font_size",
				array(
					'label'     => __( 'Font size (px)', 'plugin-domain' ),
					'type'      => \Elementor\Controls_Manager::TEXT,
					'selectors' => array(
						"{{WRAPPER}} {$selector}" => 'font-size: {{VALUE}}px;',
					),
				)
			);

			$vm->add_control(
				"{$prefix}_line_height",
				array(
					'label'     => __( 'Line height (px)', 'plugin-domain' ),
					'type'      => \Elementor\Controls_Manager::TEXT,
					'selectors' => array(
						"{{WRAPPER}} {$selector}" => 'line-height: {{VALUE}}px;',
					),
				)
			);

			$vm->add_control(
				"{$prefix}_color",
				array(
					'label'     => __( 'Color', 'plugin-domain' ),
					'type'      => \Elementor\Controls_Manager::COLOR,
					'selectors' => array(
						"{{WRAPPER}} {$selector}" => 'color: {{VALUE}};',
					),
				)
			);
		} else {
			$vm->add_control(
				"{$prefix}_font_size",
				array(
					'label' => __( 'Font size (px)', 'plugin-domain' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);

			$vm->add_control(
				"{$prefix}_line_height",
				array(
					'label' => __( 'Line height (px)', 'plugin-domain' ),
					'type'  => \Elementor\Controls_Manager::TEXT,
				)
			);
			$vm->add_control(
				"{$prefix}_color",
				array(
					'label' => __( 'Color', 'plugin-domain' ),
					'type'  => \Elementor\Controls_Manager::COLOR,
				)
			);
		}

	}

	public static function get_font_settings( $settings, $prefix ) {

		$options = array(
			'tag',
			'text_align',
			'font_size',
			'line_height',
			'color',
		);

		$r = array();

		foreach ( $options as $option ) {
			$option_name  = "{$prefix}_{$option}";
			$r[ $option ] = ( ! empty( $settings[ $option_name ] ) ) ? $settings[ $option_name ] : '';
		}

		return $r;

	}

	public static function build_font_styles( $styles ) {
		$r = array();
		if ( ! empty( $styles['font_size'] ) ) {
			$r[] = "font-size : {$styles['font_size']}px;";
		}
		if ( ! empty( $styles['line_height'] ) ) {
			$r[] = "line-height : {$styles['line_height']}px;";
		}
		if ( ! empty( $styles['text_align'] ) ) {
			$r[] = "text-align : {$styles['text_align']};";
		}
		if ( ! empty( $styles['color'] ) ) {
			$r[] = "color : {$styles['color']};";
		}

		return $r;
	}

	public static function build_link( $settings, $param_name = 'link' ) {
		$url = array(
			'url' => $settings[ $param_name ]['url'],
		);

		$url['target'] = ( 'on' === $settings[ $param_name ]['is_external'] ) ? '_blank' : '';
		$url['title']  = '';
		$url['rel']    = ( 'on' === $settings[ $param_name ]['nofollow'] ) ? 'nofollow' : '';

		if ( ! empty( $settings[ "{$param_name}_label" ] ) ) {
			$url['title'] = $settings[ "{$param_name}_label" ];
		}

		return $url;
	}

	public static function parse_settings( $settings, $prefix ) {
		$r = array();

		foreach ( $settings as $key => $setting ) {

			$key_prefix = substr( $key, 0, strlen( $prefix ) );

			if ( $key_prefix !== $prefix ) {
				continue;
			}

			$r[ substr( $key, strlen( $prefix ) ) ] = $setting;

		}

		return $r;
	}

	public function add_default_controls() {
		add_action(
			'elementor/element/progress/section_progress/before_section_end',
			function ( $element, $args ) {
				// add a control
				$element->add_control(
					'customcolor', // update the control
					array(
						'label'     => __( 'Fill Background color', 'elementor-stm-widgets' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .elementor-progress-bar' => 'background-color: {{VALUE}}',
						),
					)
				);

				$element->add_control(
					'customtxtcolor', // update the control
					array(
						'label'     => __( 'Fill Background color', 'elementor-stm-widgets' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .elementor-progress-text' => 'color: {{VALUE}}',
						),
					)
				);

			},
			10,
			2
		);

		add_action(
			'elementor/element/image/section_image/before_section_end',
			function ( $element, $args ) {

				$element->add_control(
					'source',
					array(
						'label'        => __( 'Show Post thumbnail', 'plugin-domain' ),
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'return_value' => 'featured_image',
						'default'      => '',
					)
				);

			},
			10,
			2
		);

		add_action(
			'elementor/element/button/section_style/before_section_end',
			function ( $element, $args ) {

				// add a control

				$element->add_control(
					'more_options',
					array(
						'label'     => __( 'Button extra colors', 'plugin-name' ),
						'type'      => \Elementor\Controls_Manager::HEADING,
						'separator' => 'before',
					)
				);

				$element->start_controls_tabs( 'tabs_button_border_style' );

				$element->start_controls_tab(
					'tab_button_border_normal',
					array(
						'label' => __( 'Normal', 'elementor' ),
					)
				);

				$element->add_control(
					'vc_border_color', // update the control
					array(
						'label'     => __( 'Border color', 'elementor-stm-widgets' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} a.elementor-button' => 'border-color: {{VALUE}}',
						),
					)
				);

				$element->add_control(
					'vc_icon_color', // update the control
					array(
						'label'     => __( 'Icon color', 'elementor-stm-widgets' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} a.elementor-button .elementor-button-icon i' => 'color: {{VALUE}} !important',
						),
					)
				);

				$element->end_controls_tab();

				$element->start_controls_tab(
					'tab_button_border_hover',
					array(
						'label' => __( 'Hover', 'elementor' ),
					)
				);

				$element->add_control(
					'vc_border_color_hover', // update the control
					array(
						'label'     => __( 'Border color', 'elementor-stm-widgets' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} a.elementor-button:hover' => 'border-color: {{VALUE}}',
						),
					)
				);

				$element->add_control(
					'vc_icon_color_hover', // update the control
					array(
						'label'     => __( 'Icon color', 'elementor-stm-widgets' ),
						'type'      => \Elementor\Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} a.elementor-button:hover .elementor-button-icon i' => 'color: {{VALUE}} !important',
						),
					)
				);

				$element->end_controls_tab();

				$element->end_controls_tabs();

			},
			10,
			2
		);

		add_action(
			'elementor/element/button/section_button/before_section_end',
			function ( $element, $args ) {
				// add a control
				$element->add_control(
					'color_link',
					array(
						'label'        => __( 'Color Link', 'plugin-name' ),
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'separator'    => 'before',
						'return_value' => 'yes',
					)
				);

				$element->add_control(
					'button_block',
					array(
						'label'        => __( 'Set full width button?', 'plugin-name' ),
						'type'         => \Elementor\Controls_Manager::SWITCHER,
						'separator'    => 'before',
						'return_value' => 'yes',
					)
				);

			},
			10,
			2
		);

		add_filter(
			'widget_text',
			function ( $content ) {
				return wpautop( $content );
			}
		);

		if ( get_option( 'consulting_layout' ) === 'layout_20' ) {
			add_action(
				'elementor/element/video/section_image_overlay/before_section_end',
				function ( $element ) {
					$element->add_control(
						'play_icon_text',
						array(
							'label'     => __( 'Play Icon Title', 'elementor' ),
							'type'      => \Elementor\Controls_Manager::TEXT,
							'condition' => array(
								'show_play_icon' => 'yes',
							),
							'separator' => 'before',
						)
					);
				},
				10,
				2
			);
		}

		add_filter(
			'consulting_secondary_font_classes',
			function ( $classes ) {
				$classes[] = '.elementor-progress-text, .elementor-tab-title a, .consulting_heading_font';
				$classes[] = '.elementor-widget-wp-widget-nav_menu ul li, .elementor-button-text, .elementor-tab-title,';

				return $classes;
			}
		);

		add_action(
			'elementor/widget/render_content',
			function ( $content, $widget ) {

				$settings = $widget->get_settings();

				if ( 'wp-widget-search' === $widget->get_name() ) {
					$content = "<aside class='widget widget_search'>{$content}</aside>";
				}

				if ( 'wp-widget-categories' === $widget->get_name() ) {
					$content = "<aside class='widget widget_categories'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-archives' === $widget->get_name() ) {
					$content = "<aside class='widget widget_archive'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-tag_cloud' === $widget->get_name() ) {
					$content = "<aside class='widget widget_tag_cloud'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-pages' === $widget->get_name() ) {
					$content = "<aside class='widget widget_pages'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-nav_menu' === $widget->get_name() ) {
					$content = "<aside class='widget widget_nav_menu'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-text' === $widget->get_name() ) {
					$content = "<aside class='widget widget_text'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-recent-posts' === $widget->get_name() ) {
					$content = "<aside class='widget widget_recent_entries'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-meta' === $widget->get_name() ) {
					$content = "<aside class='widget widget_meta'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-recent-comments' === $widget->get_name() ) {
					$content = "<aside class='widget widget_recent_comments'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'wp-widget-calendar' === $widget->get_name() ) {
					$content = "<aside class='widget widget_calendar'>{$content}</aside>";
					$content = str_replace( '<h5>', '<h5 class="widget_title">', $content );
				}

				if ( 'button' === $widget->get_name() ) {
					$settings   = $widget->get_settings();
					$icon_align = ( ! empty( $settings['icon_align'] ) ) ? $settings['icon_align'] : '';
					if ( empty( $settings['selected_icon']['value'] ) ) {
						$icon_align = '';
					}
					$color_link         = $settings['color_link'];
					$color_link_class   = 'yes' === $color_link ? 'color_link' : '';
					$button_block_class = 'yes' === $settings['button_block'] ? 'button_block' : '';

					$content = str_replace( 'elementor-button-wrapper', "elementor-button-wrapper icon_align_{$icon_align} {$color_link_class} {$button_block_class}", $content );
				}

				if ( 'image' === $widget->get_name() ) {
					$settings = $widget->get_settings();

					$post_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

					if ( ! empty( $settings['source'] ) && ! empty( $post_image_url ) ) {
						$content = str_replace( $settings['image']['url'], $post_image_url[0], $content );
					}
				}

				if ( 'video' === $widget->get_name() ) {
					$settings = $widget->get_settings();
					if ( ! empty( $settings['play_icon_text'] ) && 'yes' === $settings['show_play_icon'] ) {
						$find        = array(
							'elementor-custom-embed-play',
							'<span class="elementor-screen-only">Play Video</span>',
						);
						$replaceWith = array(
							'elementor-custom-embed-play has-play-icon-text',
							"<span>{$settings['play_icon_text']}</span>",
						);
						$content     = str_replace( $find, $replaceWith, $content );
					}
				}

				return $content;

			},
			10,
			2
		);

		add_action(
			'elementor/element/icon-box/section_icon/before_section_end',
			function ( $element, $args ) {

				// add a control
				$element->add_control(
					'rotate_icon_box',
					array(
						'label' => __( 'Rotate element', 'consulting-elementor-widgets' ),
						'type'  => \Elementor\Controls_Manager::SWITCHER,
					)
				);

			},
			10,
			2
		);

		function before_render_content( $counter ) {
			if ( 'icon-box' === $counter->get_name() ) {
				$settings = $counter->get_settings();
				if ( $settings['rotate_icon_box'] ) {
					$counter->add_render_attribute(
						'_wrapper',
						array(
							'class' => 'rotate_icon_box',
						)
					);
				}
			}
		}

		add_action( 'elementor/widget/before_render_content', 'before_render_content', 101 );
	}

}

Consulting_Elementor_Widgets::instance();

require CONSULTING_ELEMENTOR_PATH . '/includes/helpers.php';
