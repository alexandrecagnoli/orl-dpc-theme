<?php get_header(); ?>
<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; $custom_args = array( 'post_type' => 'course',
    'posts_per_page' => 60,

    'order_by' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$custom_query = new WP_Query($custom_args);
?>
<section id="list-sessions" class="bg-lightgrey">
    <header class="section-header">
        <h1 class="section-title">NOS FORMATIONS QUALIFIANTES ORL</h1>
        <p class="section-subtitle">Des programmes DPC validants conformes aux orientations nationales mais aussi adaptés aux champs de compétence de notre spécialité médico-chirurgicale.</p>
    </header>
    <div class="sessions-feed container">
     <?php if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
        <?php require 'includes/loops/loop-archive-course.php'; ?>
     <?php endwhile; ?>
     </div>
     <div class="container">
        <?php wp_reset_postdata(); ?>
        <?php custom_pagination($custom_query->max_num_pages, "", $paged);
        ?>
     </div>
     <?php else: ?>
     <p>Sorry, no posts matched your criteria.</p>
     <?php endif; ?>

</section>
<?php include "includes/partial/cta-callback.php"; ?>
<?php get_footer(); ?>
