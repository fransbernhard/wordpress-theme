<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage HK
 * @since 1.0
 * @version 1.0
 */

get_header();

get_template_part( 'template-parts/navigation/navigation' );?>

<main class="single-main" role="main">
	<div class="single-container">
		<?php
			/* Start the Loop */
		if (have_posts()) : while (have_posts()) : the_post();?>
			<h2><?php the_title(); ?></h2>
			<?php the_content();
			if ( has_post_thumbnail() ) :
				the_post_thumbnail();
			endif;
		endwhile; endif;?>
	</div>

</main><!-- #main -->


<?php get_footer();
