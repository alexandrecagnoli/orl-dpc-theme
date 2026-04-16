<article class="item">
    <?php the_post_thumbnail('actu-big'); ?>
    <div class="item-content">
        <p class="item-category"><?php the_category(', #'); ?></p>
        <h4 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
        <div class="item-excerpt">
            <a href="<?php the_permalink(); ?>" class="btn btn-line-grey">Lire la suite <i class="fas fa-arrow-right"></i></a>
        </div>
    </div>
</article>