<article class="item session-user-card" style="background-image:url(<?php echo ($mySession->getCourseBannerUrl()); ?>);">
    <div class="card-content">
        <header class="item-meta">
            <div class="badges">
                <span class="badge badge-blue"><?= $mySession->getSessionTypeNiceName(); ?></span>
                <span class="badge badge-green"><?= $mySession->evaluation_type; ?></span>  
                <?php if($mySession->accreditation) : ?> <span class="badge badge-orange">Accréditation HAS</span> <?php endif; ?>
            </div>
            <span class="item-dpc">DPC n°<?= $mySession->dpc_id; ?></span>
        </header>
        <div class="item-main">
            <h2 class="item-title"><?= $mySession->getCourseTitle();?></h2>
            <div class="item-steps">
                <h3>Votre formation DPC</h3>
                <p>Complétez les étapes pour valider votre formation</p>
                <div class="progressbar-wrapper">
                    <div class="progressbar"><div class="progress" width="<?= $mySession->getSessionEvalPercentageDone(get_current_user_id()); ?>%" style="width:<?= $mySession->getSessionEvalPercentageDone(get_current_user_id()); ?>%"></div></div><?= $mySession->getSessionEvalPercentageDone(get_current_user_id()); ?>%
                </div>
                <?= $mySession->getSessionEvalNextStepCta(get_current_user_id()); ?>
            </div>
        </div>
        <footer class="item-footer">
            <span class="item-location">
                <span class="dashicons dashicons-location"></span> <?= $mySession->city; ?>
            </span>
            <span class="item-date">
                <span class="dashicons dashicons-clock"></span>
                <span><?php  echo $mySession->getSessionDayName(); ?></span>
                <span class="session-date-day"><?php  echo $mySession->getSessionDayNum(); ?></span>
                <span><?php  echo $mySession->getSessionMonthName(); ?> <?php  echo $mySession->getSessionYear(); ?></span>
            </span>
            <span>
                <a href="./?post_id=<?php  echo $mySession->id; ?>&action=view"><span>Accéder à ma formation </span><span class="dashicons dashicons-arrow-right-alt"></span></a>
            </span>
        </footer>
    </div>

</article>
