<article class="item">
    <figure>
         <?php the_post_thumbnail('actu-big'); ?>
    </figure>
   
    <div class="item-content">
        <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <div class="item-excerpt">
            <p><?php // the_excerpt(); ?></p>
            
        </div>
    </div>
</article>