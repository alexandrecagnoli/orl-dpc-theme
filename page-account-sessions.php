
<?php
/**
* Template Name: Mes sessions
*/

?>

<?php get_header(); ?>
<nav class="user-nav">
    <a href="/mon-compte/mes-sessions-dpc/" class="active user-nav-courses">Mes formations</a>
    <a href="/mon-compte/mes-infos/" class=" user-nav-info">Mes infos</a>
    <a href="/mon-compte/" class="user-nav-account">Mon compte</a>
</nav>
    <?php 
if (
    (
        isset($_REQUEST['post_id'], $_REQUEST['action']) 
        && $_REQUEST['action'] === 'view'
    )
) :
    ?>
    <main class="nopadding">
        <!-- Affichage dédié d'une session -->
        <section class="sessions-single nopadding">
            <?php
                $args = array(
                    'post_type' =>      'session',
                    'ID' => $_REQUEST['post_id'],
                    'posts_per_page' => 1
                );
                $query = new WP_Query($args);
                if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
                $mySession = new Session($_REQUEST['post_id']);
                if(isset($mySession->location_img))
                $locationImgUrl = $mySession->location_img['url'];
                include "includes/loops/loop-session-account-single.php";
                endwhile;
                else : echo "<p class='center sessions-empty'>Aucune formation à venir. </p><p class='center'><a href='#' class='btn btn-light btn-blue'>Voir la liste des formations DPC</a></p>";
                endif;
                wp_reset_postdata();
            ?>
        </section>
    </main>
    <!-- Affichage du QCM -->
    <?php 
    elseif( ( isset($_REQUEST['action']) ) && ( $_REQUEST['action'] == "eval_show") && isset( $_REQUEST['qcm_id'] )  ) : ?>
    <main class="container bg-lightblue">
        <section class="evaluation">
            <?php
                $html =  "";
                $mySession = new Session($_REQUEST['session_id']);

                if($_REQUEST['session_eval'] == 1 || $_REQUEST['session_eval'] == 2){
                $startdate='';
                $enddate='';   
                $quiz_max = 0;
                    // on récupère les dates d'ouverture et de cloture de l'eval 1...
                    if($_REQUEST['session_eval'] == 1){
                        $startdate = $mySession->eval_1_startdate;
                        $enddate = $mySession->eval_1_enddate;
                    }

                    // ...puis de l'eval 2
                    elseif($_REQUEST['session_eval'] == 2){
                        $startdate = $mySession->eval_2_startdate;
                        $enddate = $mySession->eval_2_enddate;
                    }

                    $quiz = new Quiz($_REQUEST['qcm_id']);
                    
                    // limite nombre de participation aux quizz APP et EPP 
                    if( $_REQUEST['eval_type'] == 'app'){
                        $quiz_max = 1;
                    }

                    elseif( $_REQUEST['eval_type'] == 'epp'){
                        $quiz_max = $mySession->epp_number;
                    }
                        
                    // nombre de quiz validés par l'user
                    $current = $quiz->countUserFormEntries(get_current_user_id(), $_REQUEST['session_eval'], $mySession->id);

                    // si l'user n'a pas validé tous les quiz 
                    if ( $current  < $quiz_max )
                    {
                        // on vérifie les dates d'ouverture 
                        if( $startdate > date('Ymd'))
                            $html .= "Trop tot ";
                        // et de clôture
                        else if( $enddate < date('Ymd'))
                            $html .= "Trop tard";
                        // et si c'est bon on envoie le formulaire
                        else
                            $html .= gravity_form(
                            (int) $_REQUEST['qcm_id'],
                            false,
                            false,
                            false,
                            null,
                            false,
                            0,
                            false // <- important : echo=false
                            );
                    }
                    // sinon on dit que les quiz ont été déjà réalisés
                    else
                    {
                        $html .= $current.'/'.$quiz_max;
                        $html .= "QCM terminés";
                    }
                }  
                echo $html;
            ?>
        </section>
    </main>
    <!-- Affichage du Questionnaire de satisfaction  -->
    <?php elseif( isset($_REQUEST['satisfaction_eval']) && isset($_REQUEST['session_id']) ) : ?>
    <main class="container bg-lightblue">
        <section class="evaluation">
            <?php $mySession = new Session($_REQUEST['session_id']);  ?>
            <?php
            if( $_REQUEST['satisfaction_eval']==true ) {
                echo gravity_form( 21, false, false, false, '', false );
            }
            else
            echo "QCM terminés";
            ?>
        </section>
    </main>
    <?php else :
        if (!isset($_REQUEST['show'])){
            $show = 'active';
        }
        else 
        $show = $_REQUEST['show'];
        
     ?>
    <!-- Affichage sous forme de liste -->
    <main class="container bg-lightblue">
        <section class="sessions-list">
            <nav class="sessions-nav">
                <a href="./?show=active" <?php  if ($show == 'active') echo "class='active'" ?>>SESSIONS À VENIR</a>
                <a href="./?show=old" <?php  if ($show == 'old') echo "class='active'" ?>>SESSIONS PASSÉES</a>
            </nav>
                <?php

                    $today = date('Ymd');
                    if ($show == 'active')
                    {
                        $args = array(
                            'post_type' => 'session',
                            'meta_query' => array(
                                    array(
                                        'key'       => 'session_customers',
                                        'value'     => get_current_user_id(),
                                        'compare'   => '=',
                                    ),
                                    array(
                                        'key' => 'eval_2_enddate',
                                        'value' => $today,
                                        'compare' => '>='
                                    )
                                ),
                            'meta_key'          => 'session_startdate',
                            'orderby'           => 'meta_value',
                            'posts_per_page'    => 100,
                            'order' => 'DESC'
                        );
                    }
                    elseif ($show == 'old')
                    {
                        $args = array(
                            'post_type' => 'session',
                            'meta_query' => array(
                                    array(
                                        'key'       => 'session_customers',
                                        'value'     => get_current_user_id(),
                                        'compare'   => '=',
                                    ),
                                    array(
                                        'key' => 'eval_2_enddate',
                                        'value' => $today,
                                        'compare' => '<'
                                    )
                                ),
                            'meta_key'          => 'session_startdate',
                            'orderby'           => 'meta_value',
                            'posts_per_page'    => 100,
                            'order' => 'DESC'
                        );
                    }


                    $query = new WP_Query($args);
                    $results=true;
                    if($query->have_posts()) :
                        while ($query->have_posts() ) : $query->the_post();
                            $mySession = new Session(get_the_ID());
                            if ($show == 'active')
                            include "includes/loops/loop-session-card.php";
                            if ($show == 'old')
                            include "includes/loops/loop-session-account.php";
                        endwhile;
                        ?>                         
                    <?php
                    else :  
                        if ($show == 'active')
                        echo "<p class='center' style='padding:3em 0;'>Vous n'êtes inscrit à aucune session</p>";
                        if ($show == 'old')
                        $results=false;                       
                    endif;
                    wp_reset_postdata();
                    if ($show == 'old')
                    {   
                        $args_old = array(
                            'post_type' => 'session',
                            'meta_query' => array(
                                    array(
                                        'key'       => 'session_customers',
                                        'value'     => get_current_user_id(),
                                        'compare'   => '=',
                                    ),
                                    array(
                                        'key' => 'session_startdate',
                                        'value' => 20230101,
                                        'compare' => '<'
                                    )
                                ),
                            'meta_key'          => 'session_startdate',
                            'orderby'           => 'meta_value',
                            'posts_per_page'    => 100,
                            'order' => 'DESC'
                        );
                        $query_old = new WP_Query($args_old);
                        if($query_old->have_posts()) :
                            $results = true;
                            while ($query_old->have_posts() ) : $query_old->the_post();
                                $mySession = new Session(get_the_ID());  
                                include "includes/loops/loop-session-account.php";
                            endwhile;
                        else : 
                            $results=false;
                        endif; 
                    }
                    if (($show == 'old') && ($results == false))
                    echo "<p class='center' style='padding:3em 0;'>Aucune session dans l'historique</p>";
                ?>
        </section>
        <?php
         echo "<h3 class='section-title'>Inscrivez-vous à une de nos sessions de formation DPC</h3>";
         echo '<div class="sessions-feed ">';
         $today = date('Ymd');
         $args = array(
            'post_type' => 'session',
            'meta_key'          => 'session_startdate',
            'meta_query' => array(
                    array(
                        'key' => 'session_startdate',
                        'value' => $today,
                        'compare' => '>='
                    ),
                    'relation'      => 'AND',
                    array(
                        'key'       => 'session_customers',
                        'value'     => get_current_user_id(),
                        'compare'   => '!=',
                    )
                ),
            'orderby'           => 'meta_value',
            'posts_per_page' => 3,
            'order' => 'ASC',
        );
         $query = new WP_Query($args);
         if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
         $mySession = new Session(get_the_ID());
         include "includes/loops/loop-session-home.php";
         endwhile; else :
         echo "<p>Pas de formations disponibles pour l'instant</p>" ;
         endif;
         wp_reset_postdata();
         echo '</div>';
        ?>
    </main>
<?php endif; ?>
</main>
<script>
    jQuery('.slick-sessions').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
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
</script>
<?php get_footer(); ?>
