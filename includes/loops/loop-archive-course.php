<article class="item">
	<a href="<?php the_permalink(); ?>">
		<?php  
			
    if ( has_post_thumbnail() ) {
   the_post_thumbnail( 'session-thumb', array( 'class' => 'item-img' ) );
    }
    else {
    echo '<img src="' . get_template_directory_uri()
    . '/img/default-thumb.jpg" class="item-img" />';
    } 
		?>	
		</a>
    <div class="item-content">
        <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?= get_the_title(); ?></a></h3>
        <?php /* ?><p class="item-excerpt"><?= get_the_excerpt(); ?></p><?php */  ?>
    </div>
</article>


