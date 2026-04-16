<?php get_header(); ?>
<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; 

$today = date('Ymd');
$args = array(
    'post_type' => 'session',
    'meta_key'          => 'session_startdate',
    'meta_query' => array(
            array(
                'key' => 'session_startdate',
                'value' => $today,
                'compare' => '>='
            )
        ),
    'orderby'           => 'meta_value',
    'posts_per_page' => 30,
    'order' => 'ASC',
);
$custom_query = new WP_Query($args);
?>
<section id="list-sessions" class="bg-lightgrey">
    <header class="section-header">
        <h1 class="section-title">NOS SESSIONS FUTURES</h1>
        <p class="section-subtitle">Des programmes DPC validants conformes aux orientations nationales mais aussi adaptés aux champs de compétence de notre spécialité médico-chirurgicale.</p>
    </header>
    <div class="sessions-feed container">
     <?php if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
        <?php
         $mySession = new Session(get_the_ID());
        require 'includes/loops/loop-session-home.php'; ?>
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
