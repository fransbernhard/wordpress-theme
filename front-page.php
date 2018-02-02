<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage HK2
 * @since 1.0
 * @version 1.0
 */

get_header();

get_template_part( 'template-parts/navigation/navigation' );
$images = get_field('gallery');
$size = 'thumbnail';
?>

<div class="page-container">
  <div class="page-wrapper">
    <h1><?php the_field('home_header_text') ?></h1>
    <p><?php the_field('home_header_desc')?></p>
    <img src="<?php the_field('home_header_img')?>" alt="imagez" width="400">
    <?php if( $images ): ?>
      <ul class="gallery">
        <?php foreach( $images as $image ): ?>
          <li class="galleryItem">
          	<?php echo wp_get_attachment_image( $image['ID'], $size ); ?>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>
  </div>
</div>

<?php get_footer();
