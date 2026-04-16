<?php get_header(); ?>
<?php 
    if(have_posts()): while(have_posts()): the_post(); 
?>
<section class="page-header">
    <h1 class="container page-title"><?php the_title();?></h1>
</section>
<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a> > <?php the_title();?></div></div>
<section class="page-content container">
    <?php the_content(); ?>
</section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>