<?php
/** Footer template */
if (!defined('ABSPATH')) { exit; }
?>
	</main>
	<footer class="footer">
		<div class="container">
			<div class="footer__top">
				<section>
					<h3>Corella Store</h3>
					<p class="u-muted"><?php bloginfo('description'); ?></p>
				</section>
				<?php if (is_active_sidebar('footer-1')) : ?>
					<?php dynamic_sidebar('footer-1'); ?>
				<?php endif; ?>
				<?php if (is_active_sidebar('footer-2')) : ?>
					<?php dynamic_sidebar('footer-2'); ?>
				<?php endif; ?>
			</div>
			<div class="footer__bottom">
				<nav aria-label="<?php esc_attr_e('Footer', 'corella-store'); ?>">
					<?php wp_nav_menu([
						'theme_location' => 'footer',
						'menu_class' => 'menu',
						'container' => false
					]); ?>
				</nav>
				<p class="u-muted">© <?php echo date('Y'); ?> Corella Store — <?php _e('All rights reserved', 'corella-store'); ?>.</p>
			</div>
		</div>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>