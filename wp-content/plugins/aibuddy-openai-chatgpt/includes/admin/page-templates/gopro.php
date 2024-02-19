<?php
define( 'STM_FREEMIUS_CHECKOUT_LINK', 'https://checkout.freemius.com/mode/dialog/plugin/' );
define( 'STM_FREEMIUS_CHECKOUT_UTM_SOURCE', 'utm_source=wpadmin&utm_medium=buynow&utm_campaign=ai-buddy-chatgpt-openai' );
define( 'STM_FREEMIUS_PLUGIN_INFO_URL', 'https://stylemixthemes.com/api/freemius/ai-buddy-chatgpt-openai-pro.json' );

function get_freemius_info() {
	$response = wp_remote_get( STM_FREEMIUS_PLUGIN_INFO_URL );
	$body     = wp_remote_retrieve_body( $response );
	$body     = json_decode( $body );

	if ( empty( $body ) ) {
		return '';
	}

	$freemius_info = array();

	/**
	 * Set to Array Premium Plan's Prices
	 */
	function set_premium_plan_prices( $plans, $plugin_id ) {
		$plan_info = array();

		$plan_data = array(
			'1'    => array(
				'value'     => 'monthly',
				'text'      => esc_html__( 'Single Site', 'aibuddy-openai-chatgpt' ),
				'classname' => '',
				'type'      => '',
			),
			'5'    => array(
				'value'     => 'annual',
				'classname' => 'stm_plan--popular',
				'text'      => esc_html__( 'Up to 5 Sites', 'aibuddy-openai-chatgpt' ),
				'type'      => esc_html__( 'Most Popular', 'aibuddy-openai-chatgpt' ),
			),
			'5000' => array(
				'value'     => 'lifetime',
				'classname' => 'stm_plan--developer',
				'text'      => esc_html__( 'Up to 5000 Sites', 'aibuddy-openai-chatgpt' ),
				'type'      => esc_html__( 'Developer Oriented', 'aibuddy-openai-chatgpt' ),
			),
		);

		foreach ( $plans as $plan ) {
			if ( 'premium' === $plan->name ) {
				if ( isset( $plan->pricing ) ) {
					foreach ( $plan->pricing as $pricing ) {
						$plan_info[ 'licenses_' . $pricing->licenses ]      = $pricing;
						$plan_info[ 'licenses_' . $pricing->licenses ]->url = STM_FREEMIUS_CHECKOUT_LINK . "{$plugin_id}/plan/{$pricing->plan_id}/licenses/{$pricing->licenses}/";

						if ( ! isset( $plan_data[ $pricing->licenses ] ) ) {
							$plan_data[ $pricing->licenses ] = array(
								'text'      => esc_html__( "Unlimited Sites", "cost-calculator-builder" ), // phpcs:ignore
								'classname' => '',
								'type'      => '',
							);
						}
						$plan_info[ 'licenses_' . $pricing->licenses ]->data = $plan_data[ $pricing->licenses ];
					}
				}
				break;
			}
		}

		return array_reverse( $plan_info );
	}

	/**
	 * Set to Array Latest Plugin's Info
	 */
	function set_latest_info( $latest ) {
		$latest_info['version']           = $latest->version;
		$latest_info['tested_up_to']      = $latest->tested_up_to_version;
		$latest_info['created']           = date( "M j, Y", strtotime( $latest->created ) ); // phpcs:ignore
		$latest_info['last_update']       = date( "M j, Y", strtotime( $latest->updated ) ); // phpcs:ignore
		$latest_info['wordpress_version'] = $latest->requires_platform_version;

		return $latest_info;
	}

	if ( isset( $body->plans ) && ! empty( $body->plans ) ) {
		$freemius_info['plan'] = set_premium_plan_prices( $body->plans, $body->id );
	}

	if ( isset( $body->latest ) && ! empty( $body->latest ) ) {
		$freemius_info['latest'] = set_latest_info( $body->latest );
	}

	if ( isset( $body->info ) && ! empty( $body->info ) ) {
		$freemius_info['info']      = $body->info;
		$freemius_info['info']->url = 'https://stylemixthemes.com/aibud-wp/pricing/';
	}

	return $freemius_info;
}

$freemius_info = get_freemius_info();

$deadline     = new DateTime( '08th January 2024' );
$is_promotion = time() < $deadline->format( 'U' );

if ( $is_promotion ) {
	$freemius_info['plan']['licenses_5000']->annual_price   = 399.99;
	$freemius_info['plan']['licenses_5000']->lifetime_price = 799.99;
	$freemius_info['plan']['licenses_5']->annual_price      = 149.99;
	$freemius_info['plan']['licenses_5']->lifetime_price    = 450.99;
	$freemius_info['plan']['licenses_1']->annual_price      = 50.99;
	$freemius_info['plan']['licenses_1']->lifetime_price    = 149.99;
}

?>
<div class="ai-bud-go-pro">
	<section class="stm_go_pro">
		<div class="container">
			<div class="stm_go_pro_plugin">
				<h2 class="stm_go_pro_plugin__title">
					<img src="<?php echo esc_url( AI_BUDDY_FILES_PATH . 'assets/images/ai-buddy.png' ); ?>" width="50" height="50" alt="AiBud WP Plugin with Artificial Intelligence for WordPress" />
					<?php esc_html_e( 'AiBud WP', 'aibuddy-openai-chatgpt' ); ?>
				</h2>
				<p class="stm_go_pro_plugin__content ccb-heading-5 ccb-light">
					<?php if ( isset( $freemius_info['info'] ) ) : ?>
						<?php if ( isset( $freemius_info['info']->short_description ) ) : ?>
							<?php echo esc_html( nl2br( $freemius_info['info']->short_description ) ); ?>
						<?php endif; ?>
						<?php if ( $freemius_info['info']->url ) : ?>
							<a href="<?php echo esc_html( $freemius_info['info']->url . '?utm_source=wpadmin&utm_medium=gopro&utm_campaign=2023' ); ?>">
								<?php esc_html_e( 'Learn more.', 'aibuddy-openai-chatgpt' ); ?>
							</a>
						<?php endif; ?>
					<?php endif; ?>
				</p>
			</div>
			<?php if ( $is_promotion ) : ?>
				<div class="stm-discount">
					<a href="https://stylemixthemes.com/aibud-wp/pricing/?utm_source=wpadmin&utm_medium=newyear&utm_campaign=aibud" target="_blank"></a>
				</div>
			<?php endif; ?>
			<?php if ( isset( $freemius_info['plan'] ) ) : ?>
				<h2 class="pricing-section" style="position: relative; left: -5px"><?php esc_html_e( 'Choose the package that suits your business', 'aibuddy-openai-chatgpt' ); ?></h2>
				<div class="stm-type-pricing">
					<div class="stm-type-pricing-plans active" data-period="annual"><?php esc_html_e( 'Annual', 'aibuddy-openai-chatgpt' ); ?></div>
					<div class="stm-type-pricing-plans" data-period="lifetime"><?php esc_html_e( 'Lifetime', 'aibuddy-openai-chatgpt' ); ?></div>
				</div>
				<div class="row">
					<?php foreach ( $freemius_info['plan'] as $plan ) : ?>
						<div class="col-md-4"
							<?php if ( ! empty( $plan->data['value'] ) ) : ?>
								data-plan="<?php echo esc_attr( $plan->data['value'] ); ?>"<?php endif; ?>>
							<div class="stm_plan <?php echo esc_attr( $plan->data['classname'] ); ?>">
								<?php if ( ! empty( $plan->data['type'] ) ) : ?>
									<div class="stm_plan__type">
										<?php echo esc_attr( $plan->data['type'] ); ?>
									</div>
								<?php endif; ?>
								<div class="stm_price">
									<?php if ( $is_promotion ) : ?>
										<sup>$</sup>
										<span class="stm_price__value"
											data-price-annual="<?php echo esc_attr( number_format( $plan->annual_price * 0.70, 2, '.', '' ) ); ?>"
											data-price-lifetime="<?php echo esc_attr( number_format( $plan->lifetime_price * 0.70, 2, '.', '' ) ); ?>"
											data-price-old-annual="<?php echo esc_attr( $plan->annual_price ); ?>"
											data-price-old-lifetime="<?php echo esc_attr( $plan->lifetime_price ); ?>">
											<?php echo esc_html( number_format( $plan->annual_price * 0.70, 2, '.', '' ) ); ?>
										</span>
										<div class="discount">
											<p>$</p>
											<span>
												<?php echo esc_html( $plan->annual_price ); ?>
											</span>
										</div>
										<small style="float: left; width: 100%; text-align: center; margin-bottom: 8px;">/<?php esc_html_e( 'per month', 'aibuddy-openai-chatgpt' ); ?></small>
									<?php else : ?>
										<sup>$</sup>
										<span class="stm_price__value"
											data-price-annual="<?php echo esc_attr( $plan->annual_price ); ?>"
											data-price-lifetime="<?php echo esc_attr( $plan->lifetime_price ); ?>">
											<?php echo esc_html( $plan->annual_price ); ?>
										</span>
										<small >/<?php esc_html_e( 'per year', 'aibuddy-openai-chatgpt' ); ?></small>
									<?php endif; ?>
								</div>
								<p class="stm_plan__title"><?php echo esc_html( $plan->data['text'] ); ?></p>
								<?php
									$get_now_link = isset( $freemius_info['info']->url ) ? $freemius_info['info']->url . '?' . STM_FREEMIUS_CHECKOUT_UTM_SOURCE . '&licenses=' . $plan->licenses . '&billing_cycle=monthly' : $plan->url;
									$data_url     = isset( $freemius_info['info']->url ) ? $freemius_info['info']->url . '?' . STM_FREEMIUS_CHECKOUT_UTM_SOURCE . '&licenses=' . $plan->licenses : $plan->url;
								?>
								<a href="<?php echo esc_url( $get_now_link ); ?>" class="stm_plan__btn stm_plan__btn--buy" data-checkout-url="<?php echo esc_url( $data_url ); ?>" target="_blank">
									<?php esc_html_e( 'Get now', 'aibuddy-openai-chatgpt' ); ?>
								</a>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="container">
			<p class="stm_terms_content ccb-default-title">
				<?php
				$url       = 'https://stylemixthemes.com/subscription-policy/';
				$span_attr = 'class="stm_terms_content_support" data-support-lifetime="' . esc_attr__( 'Lifetime', 'aibuddy-openai-chatgpt' ) . '" data-support-annual="' . esc_attr__( '1 year', 'aibuddy-openai-chatgpt' ) . '"';
				printf( __( 'You get <a href="%1$s"><span %2$s>1 year</span> updates and support</a> from the date of purchase. We offer 14 days Money Back Guarantee based on <a href="%1$s">Refund Policy</a>.', 'aibuddy-openai-chatgpt' ), $url, $span_attr ); // phpcs:ignore
				?>
			</p>

			<?php if ( ! empty( $freemius_info['latest'] ) ) : ?>
				<ul class="stm_last_changelog_info">
					<li>
						<span class="ccb-default-title ccb-light">
							<?php esc_html_e( 'Version:', 'aibuddy-openai-chatgpt' ); ?>
						</span>
						<span class="ccb-default-title ccb-light">
							<?php echo esc_html( $freemius_info['latest']['version'] ); ?>
							<a href="https://docs.stylemixthemes.com/ai-bud-wp-plugin/release-notes/changelog-pro-version" target="_blank">
								<?php esc_html_e( 'View Changelog', 'aibuddy-openai-chatgpt' ); ?>
							</a>
						</span>
					</li>
					<li>
						<span class="ccb-default-title ccb-light">
							<?php esc_html_e( 'Last Update:', 'aibuddy-openai-chatgpt' ); ?>
						</span>
						<span class="ccb-default-title ccb-light">
							<?php echo esc_html( $freemius_info['latest']['created'] ); ?>
						</span>
					</li>
					<li>
						<span class="ccb-default-title ccb-light">
							<?php esc_html_e( 'Wordpress Version:', 'aibuddy-openai-chatgpt' ); // phpcs:ignore ?>
						</span>
						<span class="ccb-default-title ccb-light">
							<?php echo esc_html( $freemius_info['latest']['wordpress_version'] ); ?> or higher
						</span>
					</li>
					<li>
						<span class="ccb-default-title ccb-light">
							<?php esc_html_e( 'Tested up to:', 'aibuddy-openai-chatgpt' ); ?>
						</span>
						<span class="ccb-default-title ccb-light">
							<?php echo defined( 'CALC_WP_TESTED_UP' ) ? esc_html( CALC_WP_TESTED_UP ) : esc_html( $freemius_info['latest']['tested_up_to'] ); ?>
						</span>
					</li>
				</ul>
			<?php endif; ?>
		</div>
	</section>
</div>

<script>
	jQuery(document).ready(function ($) {
		$('.stm-type-pricing-plans').on('click', function () {
			$('.stm-type-pricing-plans').removeClass('active');
			$(this).addClass('active');
			const period = $(this).data('period');
			let typePrice = 'annual';
			$('.col-md-4').each(function() {
				const price = $(this).find('.stm_price__value');
				const price_label = $(this).find('.stm_price small');
				if (period === 'annual') {
					price.text(price.attr('data-price-annual'));
					price_label.text('/per year');
					typePrice = 'annual';
				} else if (period === 'lifetime') {
					price.text(price.attr('data-price-lifetime'));
					price_label.text('/lifetime');
					typePrice = 'lifetime';
				}
			});

			$('.stm_plan__btn--buy').each(function () {
				let $this = $(this)
				let checkoutUrl = $this.attr('data-checkout-url');
				$this.attr('href', checkoutUrl + '&billing_cycle=' + typePrice);
			})

			$('.stm_price__value').each(function () {
				let $this = $(this);
				$this.text($this.attr('data-price-' + typePrice));

				$(this).next().find('span').text($this.attr('data-price-old-' + typePrice));
			})
		});
	});
</script>
