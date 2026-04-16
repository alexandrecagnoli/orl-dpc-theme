<?php
/**
* Template Name: Page CONTACT
*/
?>
<?php get_header(); ?>
<?php 
if(have_posts()): while(have_posts()): the_post(); 
?>
<section class="page-header">
    <h1 class="container page-title"><?php the_title();?></h1>
</section>
<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a> > <?php the_title();?></div></div>
<section class="page-content container ">
	<section class=""><?php the_content(); ?>
	</section>
</section>
<section class="address-block">
	<address><i class="fas fa-map-marker-alt"></i><strong>ORL-DPC</strong> <br/>7 rue Ernest Cresson,<br/>75014 Paris</address>
	<a href="tel:0033143220834" ><i class="fas fa-phone"></i> 01 43 22 08 34</a>
</section>	
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2626.3456657653915!2d2.329625366472099!3d48.83254496568178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e671b73c2b7775%3A0x6420143e59254761!2s7%20Rue%20Ernest%20Cresson%2C%2075014%20Paris!5e0!3m2!1sfr!2sfr!4v1642692081374!5m2!1sfr!2sfr" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
<?php endwhile; endif; ?>
<?php get_footer(); ?>