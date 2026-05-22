<?php

/**
 * The file for header all actions
 *
 *
 * @package XShop
 */

/**
 * Mobile Menu Output
 * 
 * Displays responsive mobile navigation with:
 * - Topbar with site logo and hamburger menu button
 * - Full-screen slide-in menu panel with focus trap
 * - ARIA labels and keyboard accessibility support
 * - Proper focus management and screen reader compatibility
 * - Semantic HTML structure for accessibility
 * - Keyboard focus trapped inside menu when open
 * 
 * @since 1.0.0
 */
function xshop_mobile_menu_output()
{
?>
	<div id="wsm-menu" class="mobile-menu-bar wsm-menu">
		<div class="container">
			<div class="mobile-topbar">
				<div class="mobile-topbar-logo">
					<?php
					if (has_custom_logo()) {
						the_custom_logo();
					} else {
					?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-site-title" rel="home">
							<?php bloginfo('name'); ?>
						</a>
					<?php } ?>
				</div>
				<button id="mmenu-btn" class="menu-btn" aria-expanded="false" aria-controls="mobile-menu-panel" aria-label="<?php esc_attr_e('Open mobile menu', 'xshop'); ?>">
					<span class="mopen" aria-hidden="true">
						<svg class="hamburger-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
							<path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
						</svg>
					</span>
					<span class="mclose" aria-hidden="true">
						<svg class="close-icon" width="26" height="26" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
							<path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
						</svg>
					</span>
					<span class="sr-only"><?php esc_html_e('Menu', 'xshop'); ?></span>
				</button>
			</div>
		</div>

		<!-- Overlay backdrop -->
		<div id="mobile-menu-overlay" class="mobile-menu-overlay" aria-hidden="true"></div>

		<!-- Slide-in menu panel -->
		<nav id="mobile-menu-panel" class="mobile-menu-panel" role="navigation" aria-label="<?php esc_attr_e('Mobile Menu', 'xshop'); ?>" aria-hidden="true">
			<div class="mobile-panel-header">
				<div class="mobile-panel-logo">
					<?php
					if (has_custom_logo()) {
						the_custom_logo();
					} else {
					?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="mobile-site-title" rel="home">
							<?php bloginfo('name'); ?>
						</a>
					<?php } ?>
				</div>
				<button id="mmenu-close-btn" class="menu-close-btn" aria-label="<?php esc_attr_e('Close mobile menu', 'xshop'); ?>">
					<svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" focusable="false">
						<path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
					</svg>
				</button>
			</div>
			<div id="mobile-navigation" class="mobile-navigation">
				<?php
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'menu_id'        => 'wsm-menu-ul',
					'menu_class'     => 'wsm-menu-has',
					'container'      => false,
				));
				?>
			</div>
		</nav>
	</div>

<?php
}
add_action('xshop_header_top', 'xshop_mobile_menu_output', 5);

function xshop_header_top_output()
{
	$xshop_header_address1 = get_theme_mod('xshop_header_address1');
	$xshop_header_address2 = get_theme_mod('xshop_header_address2');
?>
	<header id="masthead" class="site-header <?php if (has_header_image()) : ?>has-head-img<?php endif; ?>">
		<?php if (has_header_image()) : ?>
			<?php if (has_header_image()) : ?>
				<div class="header-img">
					<?php the_header_image_tag(); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="container">
			<div class="head-logo-sec">
				<?php
				if (has_custom_logo() || display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
					<div class="site-branding brand-logo">
						<?php
						if (has_custom_logo()) :
							the_custom_logo();
						endif;
						?>
					</div>
					<div class="site-branding brand-text">
						<?php if (display_header_text() == true || (display_header_text() == true && is_customize_preview())) : ?>
							<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
							<?php
							$xshop_description = get_bloginfo('description', 'display');
							if ($xshop_description || is_customize_preview()) :
							?>
								<p class="site-description"><?php echo $xshop_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
															?></p>
							<?php endif; ?>
						<?php endif; ?>

					</div><!-- .site-branding -->
					<?php if ($xshop_header_address1 || $xshop_header_address2) : ?>
						<div class="head-info">
							<?php if ($xshop_header_address1) : ?>
								<div class="mobile"><?php echo esc_html($xshop_header_address1) ?></div>
							<?php endif; ?>
							<?php if ($xshop_header_address2) : ?>
								<div class="xmail"><?php echo esc_html($xshop_header_address2) ?></div>
							<?php endif; ?>
						</div>
					<?php endif; ?>
			</div>
		</div>
	<?php endif; ?>

	<div class="menu-bar text-center">
		<div class="container">
			<div class="xshop-container menu-inner">
				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'main-menu',
						'menu_id'        => 'xshop-menu',
						'menu_class'        => 'xshop-menu',
					));
					?>
				</nav><!-- #site-navigation -->
			</div>
		</div>
	</div>




	</header><!-- #masthead -->


<?php
}
add_action('xshop_header_top', 'xshop_header_top_output');
