<?php
/** Page template */
if (!defined('ABSPATH')) { exit; }
get_header();
?>
<section class="section">
	<div class="container">
		<?php while (have_posts()) : the_post(); ?>
			<article <?php post_class(); ?>>
				<?php the_title('<h1>','</h1>'); ?>
				<?php the_content(); ?>
			</article>
		<?php endwhile; ?>
	</div>
</section>
<?php get_footer(); ?>