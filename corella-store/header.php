<?php
/** Header template */
if (!defined('ABSPATH')) { exit; }
?><!doctype html>
<html <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<?php wp_body_open(); ?>
<header class="header">
	<div class="container header__inner">
		<a href="<?php echo esc_url(home_url('/')); ?>" class="brand" aria-label="<?php bloginfo('name'); ?>">
			<?php if (function_exists('the_custom_logo') && has_custom_logo()) : ?>
				<?php the_custom_logo(); ?>
				<span class="screen-reader-text">Corella Store</span>
			<?php else : ?>
				<span class="brand__logo">CS</span>
				<span class="brand__name">Corella Store</span>
			<?php endif; ?>
		</a>
		<div class="nav">
			<?php if (function_exists('pll_the_languages')) : ?>
				<div class="u-hide-mobile">
					<?php pll_the_languages(['dropdown'=>0,'show_flags'=>1,'show_names'=>1]); ?>
				</div>
			<?php elseif (function_exists('do_action')) : ?>
				<?php do_action('wpml_add_language_selector'); ?>
			<?php endif; ?>
			<a class="u-hide-mobile" href="<?php echo esc_url(wc_get_cart_url()); ?>" aria-label="Cart">🛒</a>
			<button class="nav__toggle" aria-expanded="false" aria-controls="primary-nav">☰ <?php esc_html_e('Menu', 'corella-store'); ?></button>
		</div>
	</div>
	<nav id="primary-nav" class="nav nav--primary" aria-label="<?php esc_attr_e('Primary', 'corella-store'); ?>">
		<?php
			wp_nav_menu([
				'theme_location' => 'primary',
				'menu_class' => 'menu',
				'container' => false,
				'fallback_cb' => function () {
					echo '<ul class="menu">';
						$pages = get_pages(['sort_column' => 'menu_order']);
						foreach ($pages as $page) {
							printf('<li><a href="%s">%s</a></li>', esc_url(get_permalink($page->ID)), esc_html($page->post_title));
						}
					echo '</ul>';
				}
			]);
		?>
	</nav>
</header>
<main class="site-main">