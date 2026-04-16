<div class="item">

    <?php
    if ( has_post_thumbnail() ) {
    the_post_thumbnail('member-square');
    }
    else {
    echo '<img src="' . get_template_directory_uri()
    . '/img/default-square.jpg" class="item-img" />';
    }
    ?>
    <h4 class="item-title"><?php the_field('team_member_title'); ?> <?php the_field('team_member_firstname'); ?> <?php the_field('team_member_lastname'); ?></h4>
    <p class="item-meta"><span><?php the_field('team_member_speciality'); ?></span><br/><span><?php the_field('team_member_city'); ?></span></p>
</div>
