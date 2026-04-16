<?php get_header(); ?>
<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; $custom_args = array( 'post_type' => 'post',
    'posts_per_page' => 10,
    'order_by' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$custom_query = new WP_Query($custom_args);
?>
	<section class="bg-lightblue" id="last-news">
		<div class="news-feed container archive-feed">
			<?php if($custom_query->have_posts()): while($custom_query->have_posts()): $custom_query->the_post(); ?>
			<?php include "includes/loops/loop-archive-actu.php"; ?>
			<?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
        <?php  custom_pagination($custom_query->max_num_pages, "", $paged); ?>
			<?php else : ?>
			<?php endif; ?>
		</div>
	</section>
<?php get_footer(); ?>
