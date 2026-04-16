<article class="item">
    <div class="breadcrumbs">
        <div class="container">
            <a href="/mon-compte/mes-sessions-dpc/" class="back">Mes sessions</a> > 
            <?= $mySession->getCourseTitle();?>
        </div>
    </div>            
    <section class="hero" style="background-image:url(<?php echo ($mySession->getCourseBannerUrl()); ?>);">
        <div class="overlay"></div>
        <div class="container nopadding content-wrapper">
            <h1 class="hero-title"><?= $mySession->getCourseTitle();?></h1>
        </div>
    </section>       
    <!-- ICI LE CODE A REPLACER --> 
    <?php 

        $app = new Quiz($mySession->app_form['id']);
        $epp = new Quiz($mySession->epp_form['id']);  
    ?>
    <?php  /* ?>
    <div>
        Type d'évaluation : <?= $mySession->evaluation_type; ?><br><br>
        APP Eval 1: <?= $app->countUserFormEntries(get_current_user_id(), 1); ?> / 1<br>
        EPP Eval 1: <?= $epp->countUserFormEntries(get_current_user_id(), 1); ?> / <?= $mySession->epp_number; ?><br>
        APP Eval 2: <?= $app->countUserFormEntries(get_current_user_id(), 2); ?>/ 1<br>
        EPP Eval 2: <?= $epp->countUserFormEntries(get_current_user_id(), 2); ?> / <?= $mySession->epp_number; ?><br><br>
        Nombre de questions quiz APP : <?= $app->countFormQuizItems(); ?><br>
        Nombre de questions quiz EPP : <?= $epp->countFormQuizItems(); ?><br>

        Total de questions réalisées :<?= $mySession->getSessionEvalTotalDone(get_current_user_id()); ?> / <?= $mySession->getSessionEvalTotalToDo();?> <br><br>
        
        Pourcentage de réalisation : <?= $mySession->getSessionEvalPercentageDone(get_current_user_id()); ?>% <br>
        Eval 1 startdate :   <?= $mySession->eval_1_startdate ; ?><br>
        Today : <?= date('Ymd') ; ?> <br>
        Eval 1 enddate :  <?= $mySession->eval_1_enddate ; ?><br>
        Eval 2 startdate :  <?= $mySession->eval_2_startdate ; ?><br>
        Eval 2 enddate :  <?= $mySession->eval_2_enddate ; ?><br><br>

        APP form (eval 1)  : <a href="/mon-compte/mes-sessions-dpc/?customer_id=<?= get_current_user_id(); ?>&session_id=<?= $mySession->id;?>&session_eval=1&action=eval_show&eval_type=app&qcm_id=<?=  $mySession->app_form['id'];  ?>">Voir</a>  <br>
        EPP form (eval 1) : <a href="/mon-compte/mes-sessions-dpc/?customer_id=<?= get_current_user_id(); ?>&session_id=<?= $mySession->id;?>&session_eval=1&action=eval_show&eval_type=epp&qcm_id=<?=  $mySession->epp_form['id'];  ?>">Voir</a>  <br>
        
        APP form (eval 2)  : <a href="/mon-compte/mes-sessions-dpc/?customer_id=<?= get_current_user_id(); ?>&session_id=<?= $mySession->id;?>&session_eval=2&action=eval_show&eval_type=app&qcm_id=<?=  $mySession->app_form['id'];  ?>">Voir</a>  <br>
        EPP form (eval 2) : <a href="/mon-compte/mes-sessions-dpc/?customer_id=<?= get_current_user_id(); ?>&session_id=<?= $mySession->id;?>&session_eval=2&action=eval_show&eval_type=epp&qcm_id=<?=  $mySession->epp_form['id'];  ?>">Voir</a>  <br>
    </div>
    <!-- FIN DU CODE A REPLACER -->
    <?php  */ ?>
    <section class="bg-white nopadding session-details">
        <div class="container">
            <?php  echo getSessionAlerts($mySession->id, get_current_user_id()); ?>
            <div class="item session-detail">
                <div class="session-date">
                    <span><?php  echo $mySession->getSessionDayName(); ?></span>
                    <span class="session-date-day"><?php echo $mySession->getSessionDayNum(); ?></span>
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
                <div class="session-id">
                    <p class="session-id">Session <?= $mySession->session_id; ?></p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-lightblue session-content">
        <div class="container content">
            <div class="session-description">
                <h2 class="content-title">Résumé de la formation</h2>
                <?php print $mySession->getCourseContent();?>
            </div>
            <aside class="session-progress">
                <header class="session-progress-header">
                    <h3>Votre formation DPC</h3>
                    <p>Complétez les étapes pour valider votre formation</p>
                </header>
                <div class="progressbar-wrapper">
                    <div class="progressbar"><div class="progress" width="<?= $mySession->getSessionEvalPercentageDone(get_current_user_id()); ?>%" style="width:<?= $mySession->getSessionEvalPercentageDone(get_current_user_id()); ?>%"></div></div><?= $mySession->getSessionEvalPercentageDone(get_current_user_id()); ?>%
                </div>
                <?= $mySession->getUserProgressSteps(get_current_user_id()); ?>
            </aside>

        </div>
    </section>

    <section class="bg-white">
        <div class="container" style="width:100%;"> 
            <nav class="tabs-menu container">
                <a href="#" data-target="tab-content-1" class="active">Infos pratiques</a>
                <a href="#" data-target="tab-content-2" >Programme</a>
                <?php if($mySession->getCustomerStatus(get_current_user_id()) == 2) { ?>  
                <a href="#" data-target="tab-content-3">Documents téléchargeables</a> 
                <?php } ?>
                <!-- <a href="#" data-target="tab-content-6">Évaluations</a> -->
                <a href="#" data-target="tab-content-4">Détails</a>
            </nav>
            <section class="tab-content session-info tab-content-flex" id="tab-content-1">
                <div class="content">
                    <address>
                        <h3 class="location-title"><i class="fas fa-map-marker-alt"></i><?= $mySession->location; ?></h3>
                        <p><?= $mySession->address; ?><br/><?= $mySession->zipcode; ?> <?= $mySession->city; ?></p>
                    </address>
                    <?php if( $mySession->venue_subway || $mySession->venue_rer || $mySession->venue_subway || $mySession->venue_bus || $mySession->venue_train || $mySession->venue_airport || $mySession->venue_parking  || $mySession->venue_taxi ) : ?>
                        <ul class="location-transports">
                            <?php if($mySession->venue_subway): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-metro.svg"/> <?= $mySession->venue_subway; ?></li><?php endif; ?>
                            <?php if($mySession->venue_rer): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-rer.svg"/> <?= $mySession->venue_rer; ?></li><?php endif; ?>
                            <?php if($mySession->venue_subway): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-bus.svg"/> <?= $mySession->venue_bus; ?></li><?php endif; ?>
                            <?php if($mySession->venue_bus): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-tram.svg"/> <?= $mySession->venue_tram; ?></li><?php endif; ?>
                            <?php if($mySession->venue_train): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-train.svg"/> <?= $mySession->venue_train; ?></li><?php endif; ?>
                            <?php if($mySession->venue_airport): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-plane.svg"/> <?= $mySession->venue_airport; ?></li><?php endif; ?>
                            <?php if($mySession->venue_parking): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-parking.svg"/> <?= $mySession->venue_parking; ?></li><?php endif; ?>
                            <?php if($mySession->venue_taxi): ?><li><img src="<?= get_template_directory_uri(); ?>/img/icon-taxi.svg"/> <?= $mySession->venue_taxi; ?></li><?php endif; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <img class="" src="<?= $locationImgUrl; ?>" alt=""/>
            </section>
            <section class="container tab-content session-program" id="tab-content-2">
                <?php
                // check if the repeater field has rows of data
                if( have_rows('session_program_item', $mySession->id) ):
                    // loop through the rows of data
                    // loop through the rows of data
                    while ( have_rows('session_program_item', $mySession->id) ) : the_row();
                        // display a sub field value
                        //the_sub_field('session_program_item_time');
                        //the_sub_field('session_program_content');
                        $time = get_sub_field('session_program_item_time');
                        $content = get_sub_field('session_program_content');

                        $i=0;
                        $experts = array();
                        if( have_rows('session_program_expert') ):
                            while ( have_rows('session_program_expert') ) : the_row();
                            $expert = get_sub_field('session_program_expert_member');
                            $experts[$i] = array(
                                "title"  => get_field('team_member_title', $expert->ID),
                                "lastname"  => get_field('team_member_lastname', $expert->ID),
                                "firstname" => get_field('team_member_firstname', $expert->ID),
                                "img" => my_expert_img($expert->ID),
                                "speciality" => get_field('team_member_speciality', $expert->ID),
                                "role" => get_sub_field('session_program_expert_role')
                            );
                            $i++;
                            endwhile;
                        endif;
                        include "loop-session-program-item.php";
                    endwhile;
                endif;
                ?>
            </section>
            <?php if($mySession->getCustomerStatus(get_current_user_id()) == 2) { ?>
            <section class="container tab-content session-content" id="tab-content-3">
                <?php
                    if( have_rows('session_content', $mySession->id) ):
                        echo "<ul>";
                        while ( have_rows('session_content', $mySession->id) ) : the_row();
                            $doc = get_sub_field('session_content_document', $mySession->id);
                            $doc_title = get_sub_field('session_content_title', $mySession->id);
                            echo '<li><a href=" ' .$doc['url']. ' " href="_blank"> '.$doc_title.' <i class="far fa-file-pdf"></i></a></li>';
                        endwhile;
                        echo "</ul>";
                    endif;
                ?>
            </section>
            <?php } ?>
            <!-- <section class="container tab-content session-program" id="tab-content-6">

            </section> -->
            <section class="container tab-content session-details" id="tab-content-4">
                <?php
                    echo get_field('website_session_disclaimer', 'option');
                    echo "<h3>Indemnisation ANDPC</h3>";
                    echo "<p>Indemnisation ANDPC : ".$mySession->indemnisation." euros (dans la limite de votre plafond de prise en charge)</p>";
                    echo get_post_field('post_content', $mySession->id) ;
                ?>
            </section>
            <footer class="session-actions session-footer">
                <a href="./" class=""><i class="fas fa-arrow-left"></i> Retourner à mes formations</a>
                <?php if($mySession->type != 1) : ?>
                <a href="/session-inscription/confirmation/?post_id=<?php echo $mySession->id; ?>&form_action=subscription_confirm&customer_id=<?= get_current_user_id(); ?>" class="session-action-pdf" target="_blank"><i class="fas fa-download"></i> Télécharger ma fiche d'inscription </a>
                <?php endif; ?>
                <a href="<?php echo esc_url( get_permalink($mySession->id) ); ?>" >Voir la page de la session <i class="fas fa-arrow-right"></i>  </a>
            </footer>
        </div>
    </section>
</article>

<script>
    jQuery('#tab-content-1').show();
</script>
