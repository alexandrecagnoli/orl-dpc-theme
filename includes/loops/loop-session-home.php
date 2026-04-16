<article class="item">
    <header class="item-header">
        <div class="badges">
            <span class="badge badge-blue"><?= $mySession->getSessionTypeNiceName(); ?></span>
            <span class="badge badge-green"><?= $mySession->evaluation_type; ?></span> 
            <?php if($mySession->accreditation) : ?> <span class="badge badge-red">Accréditante</span> <?php endif; ?>

        </div>
        <span class="item-dpc">DPC n°<?= $mySession->dpc_id; ?></span>
    </header>
	<a href="<?php the_permalink(); ?>"><?= get_the_post_thumbnail( $mySession->course_id, 'session-thumb', array( 'class' => 'item-img' ) ); ?></a>
    <div class="item-content">
        <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?= get_the_title($mySession->course_id); ?></a></h3>
        <?php /* ?><p class="item-excerpt"><?= get_the_excerpt($mySession->course_id); ?></p><?php */ ?>
        <p class="item-meta"><span class="item-location"><i class="fas fa-map-marker-alt"></i> <?= $mySession->city; ?></span><span class="item-date"><i class="far fa-calendar-alt"></i> <?= getNiceDateHome($mySession->startdate); ?></span><span class="item-location"><i class="fa fa-users"></i> <?= $mySession->getCustomersCount();?>/<?= $mySession->capacity; ?></span></p>
    </div>
</article>


