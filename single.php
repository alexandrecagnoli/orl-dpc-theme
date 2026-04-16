<?php get_header(); ?>
<?php 
if(have_posts()): while(have_posts()): the_post(); 
?>
<article>
	<section class="page-header">
	    <h1 class="container page-title"><?php the_title();?></h1>
	</section>
	<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a> > <a href="/actualites/">Actualités</a> > <?php the_title();?></div></div>
	<section class="page-content container">
	<?php the_content(); ?>
	</section>
	<section id="next-sessions" class="bg-lightgrey">
	    <header class="section-header">
	        <h2 class="section-title">AUTRES ACTUALITÉS DPC</h2>
	    </header>
	    <div class="slick-sessions sessions-feed container nopadding">
	        <?php 
	            $args = array(
	                'post_type' => 'post',
	                //'category_name' => 'films',
	                'posts_per_page' => 10,
	                'order' => 'DESC'
	            ); 
	            $query = new WP_Query($args);
	            if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
	            include "includes/loops/loop-related-actu.php";
	            endwhile;
	            endif;
	            wp_reset_postdata(); 
	        ?>
	    </div>
	</section>
</article>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
<script>
    jQuery(document).ready(function(){
    jQuery('.slick-sessions').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 769, // tablet breakpoint
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    centerMode: true,
                    centerPadding: '40px',
                }
            },
            {
                breakpoint: 500, // mobile breakpoint
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    centerPadding: '40px',
                }
            }
        ]
    });
});
</script>