<?php
// getting variables
$mySession = new Session(get_the_ID());
if(isset($mySession->location_img['url']))
$locationImgUrl= $mySession->location_img['url'];

?>

<?php get_header(); ?>

<article>
    <section class="hero" style="background-image:url(<?php echo ($mySession->getCourseBannerUrl()); ?>);">
        <div class="overlay"></div>
        <div class="container nopadding content-wrapper">
            <h1 class="hero-title"><?= $mySession->getCourseTitle();?></h1>
            <p class="session-id">Session <?= $mySession->session_id; ?></p>
        </div>
    </section>
    <div class="breadcrumbs">
        <div class="container">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a> >
            <a href="/formations/">Formations</a> >
            <a href="<?= $mySession->getCoursePermalink();?>"><?= $mySession->getCourseTitle();?></a> > Session <?= $mySession->session_id; ?>
        </div>
    </div>
    <section class="session-detail-wrapper nopadding">
        <div class="item session-detail container">
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
                <p><?= $mySession->duration; ?><br/><?= $mySession->moment; ?> (<?= $mySession->starttime; ?> - <?= $mySession->endtime; ?>)</p>
            </div>
            <div class="session-subscribe">
                <?php if( $mySession->canSubscribe() == true )  : ?>
                    <?php if(( $mySession->getSessionCountdown() > 0)  ): ?>
                        <a href="<?php echo esc_url( home_url( '/?form_action=session_subscribe&user_id='.get_current_user_id().'&post_id='.get_the_ID().'&session_id='.$mySession->session_id.'' ) );  ?>" class="btn btn-orange">INSCRIPTION EN LIGNE <i class="fas fa-arrow-right"></i></a>
                    <?php endif; ?>
                    <p class="session-remaining"><?= $mySession->getSessionCountdownNiceName();?></p>
                <?php else : ?>
                    <?php // echo wp_date('Ymd', strtotime($mySession->eval_1_startdate))." / ".date("Ymd") ;?>
                    <p class="session-remaining">Inscriptions terminées</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <nav class="tabs-menu container">
        <a href="#" data-target="tab-content-1" class="active">Description</a>
        <a href="#" data-target="tab-content-2">Infos pratiques</a>
        <?php if ( current_user_can('administrator') ) : ?> 
        <a href="#" data-target="tab-content-3"><i class="fas fa-lock"></i> Programme</a>
        <a href="#" data-target="tab-content-4"><i class="fas fa-lock"></i> Admin</a> 
        <?php endif; ?>
    </nav>
    <section class="container course-summary tab-content tab-content-flex active" id="tab-content-1" >
        <div class="content">
            <div class="content-box">
                <?php print $mySession->getCourseContent();?>
                <?php the_content(); ?>
            </div>
            <div class='faculty-box'>
                <h3>Experts et animateurs</h3>
                   <?php
                   $members = $mySession->getExpertsList();
                   $experts=array();
                   $i=0;
                   include "includes/loops/loop-expert-list.php"; echo "</div>";
                   ?>
            </div>
        </div>
    </section>
    <!-- Si la formation est en distanciel -->
    <?php if ($mySession->type == 1) : ?>
    <section class="container tab-content session-info tab-content-flex" id="tab-content-2">
        <div class="content">
            <h3 class="location-title"><i class="fas fa-video"></i> Classe virtuelle synchrone par internet, système de visioconférence utilisant ZOOM</h3>
            <?= get_field('website_session_conference', 'options'); ?>
        </div>
        <img class="" src="https://orl-dpc.fr/wp-content/uploads/2020/04/zoom-logo.jpg" alt="Logo Zoom"/>
    </section>
     <!-- Si la formation est en présentiel -->
    <?php else : ?>
    <section class="container tab-content session-info tab-content-flex" id="tab-content-2">
        <div class="content">
            <address>
                <h3 class="location-title"><i class="fas fa-map-marker-alt"></i><?= $mySession->location; ?></h3>
                <p><?= $mySession->address; ?><br/><?= $mySession->zipcode; ?> <?= $mySession->city; ?>
                </p>
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
    <?php endif; ?>


 <?php if ( current_user_can('administrator') ) : ?>

    <section class="container tab-content session-program" id="tab-content-3">
        <?php

        // check if the repeater field has rows of data
        if( have_rows('session_program_item') ):
            // loop through the rows of data
            while ( have_rows('session_program_item') ) : the_row();
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
                    $expert_img = 
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

                include "includes/loops/loop-session-program-item.php";

            endwhile;

        else :

            // no rows newt_form_set_background(from, background)

        endif;

        ?>
    </section>


    <section class="container tab-content session-admin" id="tab-content-4">
        <?php 
            $allfields = get_fields($mySession->id);
             // var_dump($allfields);
        ?>
        <header class="center" style="padding:1em 0;text-align:left">
        <?php if($mySession->evaluation_type == "app" || $mySession->evaluation_type == "app+epp") : ?>
            <a class="btn btn-turquoise btn-small" target="_blank" href="/resultats-du-quiz-2/?quiz=session__eval_1&eval_type=app&post_id=<?= $mySession->id ?>">Résultats APP PRE</a>
            <a class="btn btn-turquoise btn-small" target="_blank" href="/resultats-du-quiz-2/?quiz=session__eval_2&eval_type=app&post_id=<?= $mySession->id ?>">Résultats APP POST</a>
        <?php endif; ?>
        <?php if($mySession->evaluation_type == "epp" || $mySession->evaluation_type == "app+epp") : ?>
            <a class="btn btn-turquoise btn-small" target="_blank" href="/resultats-du-quiz-2/?quiz=session__eval_1&eval_type=epp&post_id=<?= $mySession->id ?>">Résultats EPP PRE</a>
            <a class="btn btn-turquoise btn-small" target="_blank" href="/resultats-du-quiz-2/?quiz=session__eval_2&eval_type=epp&post_id=<?= $mySession->id ?>">Résultats EPP POST</a>
        <?php endif; ?>
        </header>

        <?php
    
            include "includes/loops/loop-admin-session-customers.php";
        ?>
    </section>
    <?php endif; ?>

   
</article>
<?php include "includes/partial/cta-callback.php"; ?>
<section id="next-sessions" class="bg-lightgrey">
    <header class="section-header">
        <h2 class="section-title">NOS PROCHAINES SESSIONS</h2>
        <p class="section-subtitle">Des programmes DPC validants conformes aux orientations nationales mais aussi adaptés aux champs de compétence de notre spécialité médico-chirurgicale.</p>
    </header>
    <div class="slick-sessions sessions-feed container nopadding">
        <?php
            $today= date('Ymd');
            $excludePosts[] = get_the_ID();
            $args = array(
                'post_type' => 'session',
                'post__not_in' => $excludePosts,
                //'category_name' => 'films',
                'posts_per_page' => 10,
                'meta_key' => 'session_startdate',
                'orderby' => 'meta_value',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'session_startdate',
                        'compare' => '>=',
                        'value' => $today,
                    ),
                ),
            );
            $query = new WP_Query($args);
            if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
            $mySession = new Session(get_the_ID());
            include "includes/loops/loop-session-home.php";
            endwhile;
            endif;
            wp_reset_postdata();
        ?>
    </div>
</section>
<?php get_footer(); ?>
<script>
    jQuery(document).ready(function(){
    jQuery('.slick-sessions').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1279, // tablet breakpoint
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    centerMode: true,

                }
            },
            {
                breakpoint: 769, // tablet breakpoint
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    centerMode: true,
                    centerPadding: '40px',
                }
            },
            {
                breakpoint: 500, // mobile breakpoint
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerMode: true,
                    centerPadding: '40px',
                }
            }
        ]
    });
});
</script>
