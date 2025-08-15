<?php
/** Home template */
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<section class="section hero">
	<div class="container" style="display: contents">
		<div>
			<h1 class="hero__title fade-in-up"><?php bloginfo('name'); ?> — <?php _e('Luxury basics for every day', 'corella-store'); ?></h1>
			<p class="hero__subtitle fade-in-up" style="animation-delay:.05s"><?php _e('Minimal, elegant and made for Tunisia. Explore our newest arrivals for men and women.', 'corella-store'); ?></p>
			<p class="fade-in-up" style="animation-delay:.1s">
				<?php if (function_exists('wc_get_page_permalink')) : ?>
					<a class="hero__cta" href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"><?php _e('Shop Now', 'corella-store'); ?></a>
				<?php else : ?>
					<a class="hero__cta" href="#shop"><?php _e('Shop Now', 'corella-store'); ?></a>
				<?php endif; ?>
			</p>
		</div>
		<div class="hero__media fade-in-up" style="animation-delay:.15s">
			<?php
				$default = get_theme_file_uri('assets/images/placeholder-hero.svg');
				$path = get_theme_file_path('assets/images/hero.jpg');
				$uri = file_exists($path) ? get_theme_file_uri('assets/images/hero.jpg') : $default;
				echo '<img src="' . esc_url($uri) . '" alt="Corella Store" loading="eager" />';
			?>
		</div>
	</div>
</section>

<section class="section" id="shop">
	<div class="container">
		<h2 class="u-center" style="margin-bottom:20px"><?php _e('Best Sellers', 'corella-store'); ?></h2>
		<?php if (shortcode_exists('products')) { echo do_shortcode('[products limit="8" columns="4" best_selling="true" ]'); } ?>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<h2 class="u-center" style="margin-bottom:20px"><?php _e('New Arrivals', 'corella-store'); ?></h2>
		<?php if (shortcode_exists('products')) { echo do_shortcode('[products limit="8" columns="4" orderby="date" ]'); } ?>
	</div>
</section>

<section class="section">
	<div class="container">
		<h2 class="u-center" style="margin-bottom:20px"><?php _e('Shop by Category', 'corella-store'); ?></h2>
		<div class="grid grid--3">
			<?php
				$cat_fallback = get_theme_file_uri('assets/images/placeholder-category.svg');
				$cats = [
					['slug' => 'men', 'label' => __('Men', 'corella-store'), 'img' => 'assets/images/cat-men.jpg'],
					['slug' => 'women', 'label' => __('Women', 'corella-store'), 'img' => 'assets/images/cat-women.jpg'],
					['slug' => 'accessories', 'label' => __('Accessories', 'corella-store'), 'img' => 'assets/images/cat-accessories.jpg'],
				];
				foreach ($cats as $c) {
					$img_path = get_theme_file_path($c['img']);
					$img = file_exists($img_path) ? get_theme_file_uri($c['img']) : $cat_fallback;
					$link = get_term_link($c['slug'], 'product_cat');
					if (is_wp_error($link)) { $link = '#'; }
					echo '<a class="card" href="' . esc_url($link) . '">';
					echo '<div class="card__media"><img src="' . esc_url($img) . '" alt="' . esc_attr($c['label']) . '"/></div>';
					echo '<div class="card__body"><h3 class="card__title">' . esc_html($c['label']) . '</h3></div>';
					echo '</a>';
				}
			?>
		</div>
	</div>
</section>

<section class="section section--tight">
	<div class="container">
		<h2 class="u-center" style="margin-bottom:20px"><?php _e('Customer Reviews', 'corella-store'); ?></h2>
		<div class="grid grid--3">
			<blockquote class="card"><div class="card__body"><p>“<?php _e('Top quality and fast delivery in Tunis!', 'corella-store'); ?>”</p><footer class="u-muted">— Amal</footer></div></blockquote>
			<blockquote class="card"><div class="card__body"><p>“<?php _e('Elegant designs. I love the fabric.', 'corella-store'); ?>”</p><footer class="u-muted">— Yassine</footer></div></blockquote>
			<blockquote class="card"><div class="card__body"><p>“<?php _e('Great prices and perfect fit.', 'corella-store'); ?>”</p><footer class="u-muted">— Sarra</footer></div></blockquote>
		</div>
	</div>
</section>

<?php get_footer(); ?>