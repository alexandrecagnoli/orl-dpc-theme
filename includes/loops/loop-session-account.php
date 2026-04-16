<article class="item session-detail">
    <header class="item-header">
        <h2 class="item-title"><?= $mySession->getCourseTitle();?></h2>
    </header>
    <div class="session-date">
        <span><?php  echo $mySession->getSessionDayName(); ?></span>
        <span class="session-date-day"><?php  echo $mySession->getSessionDayNum(); ?></span>
        <span><?php  echo $mySession->getSessionMonthName(); ?> <?php  echo $mySession->getSessionYear(); ?></span>
    </div>
    <address class="session-location">
        <p><?= $mySession->location; ?><br/><?= $mySession->address; ?></p>
        <p class="section-location-town"><strong><?= $mySession->zipcode; ?> <?= $mySession->city; ?></strong></p>
    </address>
    <div class="session-meta">
        <p><strong>Session <?= $mySession->session_id; ?></strong><br/>DPC n°<?= $mySession->dpc_id; ?> - Session n°<?= $mySession->dpc_number; ?></p>
        <p><?= $mySession->duration; ?><br/><?= $mySession->moment; ?></p>
    </div>
    <footer class="session-actions session-footer">
        <a href="./?post_id=<?php  echo $mySession->id; ?>&action=view" class="session-action-program"><strong><i class="fas fa-info-circle"></i> Accéder à ma session</strong></a>
    </footer>
</article>
