<?php
/**
* Template Name: Page FAQ
*/
?>

<?php get_header(); ?>
<?php 
if(have_posts()): while(have_posts()): the_post(); 
?>
<section class="page-header">
    <h1 class="container page-title">Foire aux questions</h1>
</section>
<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a> > FAQ</div></div>
<section class="page-content container">

<?php 
	if( have_rows('faq_item') ): 
	$i=0; 
	?>
	<dl class="faq accordion">
		<?php while ( have_rows('faq_item') ) : the_row(); ?>
		  <dt class="accordion-title">
		    <button aria-expanded="false" aria-controls="faq<?= $i; ?>_desc">
		      <?php the_sub_field('faq_item_q'); ?>
		    </button>
		    <i class="fas fa-chevron-down toggle-submenu" aria-expanded="false" aria-controls="faq<?= $i; ?>_desc"></i>
		  </dt>
		  <dd class="accordion-desc" id="faq<?= $i; ?>_desc">
		    <p  class="desc">
		    	<?php the_sub_field('faq_item_a'); ?>
		    </p>
		  </dd>
	<?php 
$i++;
endwhile; ?>
	</dl>
<?php
else :
endif;
?>
</section>

<?php endwhile; endif; ?>
<?php get_footer(); ?>