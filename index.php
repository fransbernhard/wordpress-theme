<?php get_header();

get_template_part( 'template-parts/navigation/navigation' );?>

<div class="page-container">
  <div class="page-wrapper-archive">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
      <?php if ( has_post_thumbnail() ) : ?>
        <?php get_template_part( 'template-parts/post/thumbnail-image' );
      endif; ?>
    <?php endwhile; endif; ?>
  </div>

  <h1>Only Flowers</h1><?php
  $args = array(
      'post_type' =>  'flower_product',
      'orderby'   =>  'date',
      'post_status' => 'publish',
  );
  $loop = new WP_Query( $args ); ?>
  <div class="flower-container"><?php
    if( $loop->have_posts() ) :
      while ( $loop->have_posts() ): $loop->the_post();
        get_template_part( 'template-parts/post/thumbnail-image' );
      endwhile;
    endif; ?>
  </div>
</div>

<?php get_footer(); ?>
