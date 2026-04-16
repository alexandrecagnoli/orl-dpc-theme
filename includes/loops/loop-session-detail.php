<article class="item session-detail">
    <div class="session-date">
        <span><?php  echo $mySession->getSessionDayName(); ?></span>
        <span class="session-date-day"><?php  echo $mySession->getSessionDayNum(); ?></span>
        <span><?php  echo $mySession->getSessionMonthName(); ?> <?php  echo $mySession->getSessionYear(); ?></span>
    </div>
    <address class="session-location">
        <p><?= $mySession->location; ?><br/><?= $mySession->address; ?></p>
        <p class="section-location-town"><strong><?= $mySession->city; ?></strong></p>
    </address>
    <div class="session-meta">
        <p><strong>Session <?= $mySession->session_id; ?></strong><br/>DPC n°<?= $mySession->dpc_id; ?></p>
        <p><?= $mySession->duration; ?><br/><?= $mySession->moment; ?></p>
    </div>
    <div class="session-subscribe">
                <?php if( $mySession->canSubscribe() == true )  : ?>
                    <?php if(( $mySession->getSessionCountdown() > 0)  ): ?>
                        <a href="<?php echo esc_url( home_url( '/?form_action=session_subscribe&user_id='.get_current_user_id().'&post_id='.get_the_ID().'&session_id='.$mySession->session_id.'' ) );  ?>" class="btn btn-orange">INSCRIPTION EN LIGNE <i class="fas fa-arrow-right"></i></a>
                    <?php endif; ?>
                    <p class="session-remaining"><?= $mySession->getSessionCountdownNiceName();?></p>
                <?php else : ?>
                    <?php //  echo $mySession->eval_1_startdate." / ".date("Ymd") ; ?>
                    <p class="session-remaining">Inscriptions terminées</p>
                <?php endif; ?>
            </div>
    <footer class="session-actions session-footer">
        <?= addToCalendarLink($mySession->id); ?>
        <a href="<?php the_permalink(); ?>" class="session-action-program"><strong><i class="fas fa-info-circle"></i> Plus d’informations sur la session</strong></a>
    </footer>
</article>
