<?php
/** Index fallback */
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<section class="section">
	<div class="container">
		<?php if (have_posts()) : ?>
			<div class="grid grid--3">
				<?php while (have_posts()) : the_post(); ?>
					<article <?php post_class('card'); ?>>
						<a href="<?php the_permalink(); ?>" class="card__media">
							<?php if (has_post_thumbnail()) { the_post_thumbnail('large'); } ?>
						</a>
						<div class="card__body">
							<h2 class="card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<div class="card__meta"><?php the_time(get_option('date_format')); ?></div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p><?php _e('No content found.', 'corella-store'); ?></p>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>