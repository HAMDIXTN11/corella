<?php
/** Product archive */
if (!defined('ABSPATH')) { exit; }
get_header('shop');
?>
<section class="section">
	<div class="container">
		<header class="u-center" style="margin-bottom:24px">
			<h1><?php woocommerce_page_title(); ?></h1>
			<?php do_action('woocommerce_before_shop_loop'); ?>
		</header>
		<?php if (woocommerce_product_loop()) : ?>
			<?php woocommerce_product_loop_start(); ?>
				<?php if (wc_get_loop_prop('total')) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<?php wc_get_template_part('content', 'product'); ?>
					<?php endwhile; ?>
				<?php endif; ?>
			<?php woocommerce_product_loop_end(); ?>
			<?php do_action('woocommerce_after_shop_loop'); ?>
		<?php else : ?>
			<?php do_action('woocommerce_no_products_found'); ?>
		<?php endif; ?>
	</div>
</section>
<?php get_footer('shop'); ?>