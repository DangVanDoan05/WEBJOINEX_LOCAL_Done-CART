<?php

/**
 * About setup
 *
 * @package xshop
 */

require_once trailingslashit(get_template_directory()) . 'inc/about/class.about.php';

if (!function_exists('xshop_about_setup')) :

	/**
	 * About setup.
	 *
	 * @since 1.0.0
	 */
	function xshop_about_setup()
	{
		$theme = wp_get_theme();
		$xtheme_name = $theme->get('Name');
		$xtheme_domain = $theme->get('TextDomain');
		if ($xtheme_domain == 'x-magazine') {
			$theme_slug = $xtheme_domain;
		} else {
			$theme_slug = 'xshop';
		}



		$config = array(
			// Menu name under Appearance.
			'menu_name'               => sprintf(esc_html__('%s Info', 'xshop'), $xtheme_name),
			// Page title.
			'page_name'               => sprintf(esc_html__('%s Info', 'xshop'), $xtheme_name),
			/* translators: Main welcome title */
			'welcome_title'         => sprintf(esc_html__('Welcome to %s! - Version ', 'xshop'), $theme['Name']),
			// Main welcome content
			// Welcome content.
			'welcome_content' => sprintf(esc_html__('%1$s is now installed and ready to use. We want to make sure you have the best experience using the theme and that is why we gathered here all the necessary information for you. Thanks for using our theme!', 'xshop'), $theme['Name']),

			// Tabs.
			'tabs' => array(
				'getting_started' => esc_html__('Getting Started', 'xshop'),
				'recommended_actions' => esc_html__('Recommended Actions', 'xshop'),
				'useful_plugins'  => esc_html__('Useful Plugins', 'xshop'),
				'free_pro'  => esc_html__('Free Vs Pro', 'xshop'),
			),

			// Quick links.
			'quick_links' => array(
				'xmagazine_url' => array(
					'text'   => esc_html__('UPGRADE X SHOP PRO', 'xshop'),
					'url'    => 'https://wpthemespace.com/product/xshop-pro/?add-to-cart=3746',
					'button' => 'danger',
				),
				'update_url' => array(
					'text'   => esc_html__('UPGRADE X BLOG PRO', 'xshop'),
					'url'    => 'https://wpthemespace.com/product/x-blog/?add-to-cart=146',
					'button' => 'danger',
				),

			),

			// Getting started.
			'getting_started' => array(
				'one' => array(
					'title'       => esc_html__('Demo Content', 'xshop'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('Demo content is pro feature. To import sample demo content, %1$s plugin should be installed and activated. After plugin is activated, visit Import Demo Data menu under Appearance.', 'xshop'), esc_html__('One Click Demo Import', 'xshop')),
					'button_text' => esc_html__('UPGRADE For  Demo Content', 'xshop'),
					'button_url'  => 'https://wpthemespace.com/product/xshop-pro/?add-to-cart=3746',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),

				'two' => array(
					'title'       => esc_html__('Theme Options', 'xshop'),
					'icon'        => 'dashicons dashicons-admin-customizer',
					'description' => esc_html__('Theme uses Customizer API for theme options. Using the Customizer you can easily customize different aspects of the theme.', 'xshop'),
					'button_text' => esc_html__('Customize', 'xshop'),
					'button_url'  => wp_customize_url(),
					'button_type' => 'primary',
				),
				'three' => array(
					'title'       => esc_html__('Show Video', 'xshop'),
					'icon'        => 'dashicons dashicons-layout',
					'description' => sprintf(esc_html__('You may show xshop short video for better understanding', 'xshop'), esc_html__('One Click Demo Import', 'xshop')),
					'button_text' => esc_html__('Show video', 'xshop'),
					'button_url'  => 'https://www.youtube.com/watch?v=Cu3eFFQskCs',
					'button_type' => 'primary',
					'is_new_tab'  => true,
				),
				'five' => array(
					'title'       => esc_html__('Set Widgets', 'xshop'),
					'icon'        => 'dashicons dashicons-tagcloud',
					'description' => esc_html__('Set widgets in your sidebar, Offcanvas as well as footer.', 'xshop'),
					'button_text' => esc_html__('Add Widgets', 'xshop'),
					'button_url'  => admin_url() . '/widgets.php',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'six' => array(
					'title'       => esc_html__('Theme Preview', 'xshop'),
					'icon'        => 'dashicons dashicons-welcome-view-site',
					'description' => esc_html__('You can check out the theme demos for reference to find out what you can achieve using the theme and how it can be customized. Theme demo only work in pro theme', 'xshop'),
					'button_text' => esc_html__('View Demo', 'xshop'),
					'button_url'  => 'https://xshop.wpteamx.com/demo-xshop/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
				'seven' => array(
					'title'       => esc_html__('Contact Support', 'xshop'),
					'icon'        => 'dashicons dashicons-sos',
					'description' => esc_html__('Got theme support question or found bug or got some feedbacks? Best place to ask your query is the dedicated Support forum for the theme.', 'xshop'),
					'button_text' => esc_html__('Contact Support', 'xshop'),
					'button_url'  => 'https://wpthemespace.com/support/',
					'button_type' => 'link',
					'is_new_tab'  => true,
				),
			),

			'useful_plugins'        => array(
				'description' => esc_html__('Theme supports some helpful WordPress plugins to enhance your site. But, please enable only those plugins which you need in your site. For example, enable WooCommerce only if you are using e-commerce.', 'xshop'),
				'already_activated_message' => esc_html__('Already activated', 'xshop'),
				'version_label' => esc_html__('Version: ', 'xshop'),
				'install_label' => esc_html__('Install and Activate', 'xshop'),
				'activate_label' => esc_html__('Activate', 'xshop'),
				'deactivate_label' => esc_html__('Deactivate', 'xshop'),
				'content'                   => array(
					array(
						'slug' => 'magical-addons-for-elementor',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-products-display'
					),
					array(
						'slug' => 'magical-posts-display'
					),
					array(
						'slug' => 'click-to-top'
					),
					array(
						'slug' => 'gallery-box',
						'icon' => 'svg',
					),
					array(
						'slug' => 'magical-blocks'
					),
					array(
						'slug' => 'easy-share-solution',
						'icon' => 'svg',
					),
					array(
						'slug' => 'wp-edit-password-protected',
						'icon' => 'svg',
					),
				),
			),
			// Required actions array.
			'recommended_actions'        => array(
				'install_label' => esc_html__('Install and Activate', 'xshop'),
				'activate_label' => esc_html__('Activate', 'xshop'),
				'deactivate_label' => esc_html__('Deactivate', 'xshop'),
				'content'            => array(
					'magical-blocks' => array(
						'title'       => __('Magical Products Display', 'xshop'),
						'description' => __('Now you can add or update your site elements very easily by Magical Products Display. Supercharge your Elementor block with highly customizable Magical Blocks For WooCommerce.', 'xshop'),
						'plugin_slug' => 'magical-products-display',
						'id' => 'magical-products-display'
					),
					'go-pro' => array(
						'title'       => '<a target="_blank" class="activate-now button button-danger" href="https://wpthemespace.com/product/xshop-pro/?add-to-cart=3746">' . __('UPGRADE XSHOP PRO', 'xshop') . '</a>',
						'description' => __('You will get more frequent updates and quicker support with the Pro version.', 'xshop'),
						//'plugin_slug' => 'x-instafeed',
						'id' => 'go-pro'
					),

				),
			),
			// Free vs pro array.
			'free_pro'                => array(
				'free_theme_name'     => $xtheme_name,
				'pro_theme_name'      => $xtheme_name . __(' Pro', 'xshop'),
				'pro_theme_link'      => 'https://wpthemespace.com/product/xshop-pro',
				/* translators: View link */
				'get_pro_theme_label' => sprintf(__('Get %s', 'xshop'), 'X Shop Pro'),
				'features'            => array(
					array(
						'title'       => esc_html__('Daring Design for Devoted Readers', 'xshop'),
						'description' => esc_html__('X Shop\'s design helps you stand out from the crowd and create an experience that your readers will love and talk about. With a flexible home page you have the chance to easily showcase appealing content with ease.', 'xshop'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Mobile-Ready For All Devices', 'xshop'),
						'description' => esc_html__('X Shop makes room for your readers to enjoy your articles on the go, no matter the device their using. We shaped everything to look amazing to your audience.', 'xshop'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Home slider', 'xshop'),
						'description' => esc_html__('X Shop gives you extra slider feature. You can create awesome home slider in this theme.', 'xshop'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Widgetized Sidebars To Keep Attention', 'xshop'),
						'description' => esc_html__('X Shop comes with a widget-based flexible system which allows you to add your favorite widgets over the Sidebar as well as on offcanvas too.', 'xshop'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('One Click Demo install', 'xshop'),
						'description' => esc_html__('You can import demo site only one click so you can setup your site like demo very easily.', 'xshop'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Multiple Header Layout', 'xshop'),
						'description' => esc_html__('X Shop gives you extra ways to showcase your header with miltiple layout option you can change it on the basis of your requirement', 'xshop'),
						'is_in_lite'  => 'true',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Diffrent Style Blog', 'xshop'),
						'description' => esc_html__('X Shop\'s PRO version comes with more blog style to display and filter posts. For instance, you can have far more control on setting the source of the posts or how they are displayed, everything to push the content to the right people and promote it by the blink of an eye.', 'xshop'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Flexible Home Page Design', 'xshop'),
						'description' => esc_html__('X Shop\'s PRO version has more controll available to enable you to place widgets on Footer or Below the Post at the end of your articles.', 'xshop'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Read Time Calculator and total words counter', 'xshop'),
						'description' => esc_html__('Minimal Lit\'s PRO verison has a feature to let your viewer know the read time of the standared article you have posted on the basis of words per minute which you can control on your customizer .', 'xshop'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Customizer Options', 'xshop'),
						'description' => esc_html__('Advance control for each element gives you different way of customization and maintained you site as you like and makes you feel different.', 'xshop'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('Advance Pagination', 'xshop'),
						'description' => esc_html__('Multiple Option of pagination via customizer can be obtained on your site like Infinite scroll, Ajax Button On Click, Number as well as classical option are available.', 'xshop'),
						'is_in_lite'  => 'ture',
						'is_in_pro'   => 'true',
					),

					array(
						'title'       => esc_html__('Premium Support and Assistance', 'xshop'),
						'description' => esc_html__('We offer ongoing customer support to help you get things done in due time. This way, you save energy and time, and focus on what brings you happiness. We know our products inside-out and we can lend a hand to help you save resources of all kinds.', 'xshop'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
					array(
						'title'       => esc_html__('No Credit Footer Link', 'xshop'),
						'description' => esc_html__('You can easily remove the Theme: X Shop by xshop copyright from the footer area and make the theme yours from start to finish.', 'xshop'),
						'is_in_lite'  => 'false',
						'is_in_pro'   => 'true',
					),
				),
			),

		);

		xshop_About::init($config);
	}

endif;

add_action('after_setup_theme', 'xshop_about_setup');



function xshop_pnotice_output()
{
	$current_theme = wp_get_theme();
	$current_theme_name = $current_theme->get('Name');
	$current_user    = wp_get_current_user();
	$demo_link       = 'https://xshop.wpteamx.com/demo-xshop/';
	$pro_link        = 'https://wpthemespace.com/product/xshop-pro/?add-to-cart=3746';
?>
	<div class="xshop-pro-notice">
		<div class="xshop-notice-container">

			<!-- Animated left accent bar -->
			<div class="xshop-accent-bar"></div>

			<!-- Header row -->
			<div class="xshop-notice-header">
				<div class="xshop-notice-title-row">
					<span class="xshop-rocket" aria-hidden="true">🚀</span>
					<h3 class="xshop-notice-title">
						<?php
						/* translators: %s: user display name */
						printf(
							esc_html__('Hey %s — Your Store Deserves Better!', 'xshop'),
							esc_html($current_user->display_name)
						);
						?>
					</h3>
				</div>

				<div class="xshop-social-proof">
					<span class="xshop-stars" aria-hidden="true">★★★★★</span>
					<span><?php esc_html_e('Trusted by 10,000+ store owners worldwide', 'xshop'); ?></span>
				</div>
			</div>

			<!-- Description -->
			<p class="xshop-notice-description">
				<?php printf(
					/* translators: %s: theme name */
					esc_html__('You\'re running %s Free — smart choice! Now unlock the full power: premium templates, advanced customizer controls, one-click demo import, and pro WooCommerce features that turn browsers into buyers.', 'xshop'),
					'<strong>' . esc_html($current_theme_name) . '</strong>'
				); ?>
			</p>

			<!-- Feature highlights -->
			<div class="xshop-features-grid">
				<div class="xshop-feature-item">
					<span class="xshop-feature-icon">🎨</span>
					<span><?php esc_html_e('6+ Premium Templates', 'xshop'); ?></span>
				</div>
				<div class="xshop-feature-item">
					<span class="xshop-feature-icon">⚡</span>
					<span><?php esc_html_e('One-Click Demo Import', 'xshop'); ?></span>
				</div>
				<div class="xshop-feature-item">
					<span class="xshop-feature-icon">🛠️</span>
					<span><?php esc_html_e('Advanced Customizer', 'xshop'); ?></span>
				</div>
				<div class="xshop-feature-item">
					<span class="xshop-feature-icon">📱</span>
					<span><?php esc_html_e('Mobile Optimized', 'xshop'); ?></span>
				</div>
				<div class="xshop-feature-item">
					<span class="xshop-feature-icon">🛒</span>
					<span><?php esc_html_e('WooCommerce Pro Blocks', 'xshop'); ?></span>
				</div>
				<div class="xshop-feature-item">
					<span class="xshop-feature-icon">🎯</span>
					<span><?php esc_html_e('Priority Support', 'xshop'); ?></span>
				</div>
			</div>

			<!-- Offer / Coupon -->
			<div class="xshop-offer-box">
				<div class="xshop-offer-badge">
					<span>⏰ <?php esc_html_e('LIMITED TIME OFFER', 'xshop'); ?></span>
				</div>
				<div class="xshop-offer-content">
					<div class="xshop-offer-left">
						<span class="xshop-discount"><?php esc_html_e('20% OFF', 'xshop'); ?></span>
						<span class="xshop-offer-sub"><?php esc_html_e('on XShop Pro upgrade', 'xshop'); ?></span>
					</div>
					<div class="xshop-coupon">
						<span class="xshop-coupon-label"><?php esc_html_e('Use code:', 'xshop'); ?></span>
						<code class="xshop-coupon-code" title="<?php esc_attr_e('Click to copy', 'xshop'); ?>">SPoff20</code>
					</div>
				</div>
			</div>

			<!-- Action buttons -->
			<div class="xshop-notice-actions">
				<a href="<?php echo esc_url($pro_link); ?>" target="_blank" rel="noopener" class="xshop-btn xshop-btn-primary">
					<span><?php esc_html_e('⚡ Upgrade to Pro Now', 'xshop'); ?></span>
					<span class="xshop-btn-arrow" aria-hidden="true">→</span>
				</a>
				<a href="<?php echo esc_url($demo_link); ?>" target="_blank" rel="noopener" class="xshop-btn xshop-btn-secondary">
					<span><?php esc_html_e('View Live Demo', 'xshop'); ?></span>
				</a>
				<button class="button button-link xshop-btn-dismiss btnend"><?php esc_html_e('Dismiss this notice', 'xshop'); ?></button>
			</div>

			<p class="xshop-risk-free">
				<?php esc_html_e('✅ 30-day money-back guarantee &nbsp;·&nbsp; ✅ Instant download &nbsp;·&nbsp; ✅ Lifetime updates', 'xshop'); ?>
			</p>
		</div>
	</div>
<?php
}


//Admin notice 
function xshop_new_optins_texts()
{
	$hide_date = get_option('xshop_pro_text_info1');
	if (!empty($hide_date)) {
		$clickhide = round((time() - strtotime($hide_date)) / 24 / 60 / 60);
		if ($clickhide < 25) {
			return;
		}
	}


?>
	<div class="mgadin-notice notice notice-success mgadin-theme-dashboard mgadin-theme-dashboard-notice mge is-dismissible meis-dismissible">
		<?php xshop_pnotice_output(); ?>
	</div>
<?php

}
add_action('admin_notices', 'xshop_new_optins_texts');


function xshop_new_optins_texts_init()
{
	$install_date = get_option('xshop_install_date');
	if (empty($install_date)) {
		update_option('xshop_install_date', current_time('mysql'));
	}

	if (isset($_GET['xbnotice']) && $_GET['xbnotice'] == 1) {
		update_option('xshop_pro_text_info1', current_time('mysql'));
	}
}
add_action('init', 'xshop_new_optins_texts_init');
