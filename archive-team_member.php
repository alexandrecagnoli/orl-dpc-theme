<?php get_header(); ?>
<?php $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; $custom_args = array( 'post_type' => 'team_member',
    'posts_per_page' => 48,
    'order_by' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$custom_query = new WP_Query($custom_args);
?>
<section id="list-sessions" class="bg-lightgrey">
    <header class="section-header container">
        <h1 class="section-title">NOS EXPERTS</h1>
        <p class="section-subtitle">Nos experts, tant universitaires que libéraux, sont reconnus pour leurs compétences et leurs expériences. <br> Leurs interventions prennent en compte les spécificités des exercices et de la pratique du quotidien.
Ils n’enseignent pas, ils induisent un échange, ils donnent leurs trucs, en utilisant des situations cliniques.</p><p>
Ils s’appuient sur les référentiels des sociétés savantes et de la Haute Autorité de Santé, ils favorisent l’actualisation des pratiques des participants autour du partage d’expériences. <br>
Nos animateurs sont formés à cette pédagogie réflexive spécifique qui respecte la personnalité des participants. Ils sont les garants de la circulation de la parole, du temps et du non-jugement. </p>
    </header>
    <div class=" container section-team archive-team">
     <?php if ( $custom_query->have_posts() ) : while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
        <?php require 'includes/loops/loop-team-member.php'; ?>
     <?php endwhile; ?>
     </div>
     <div class="container">
        <?php wp_reset_postdata(); ?>
        <?php custom_pagination($custom_query->max_num_pages, "", $paged);
        ?>
     </div>
     <?php else: ?>
     <p>Sorry, no posts matched your criteria.</p>
     <?php endif; ?>
</section>
<?php include "includes/partial/cta-callback.php"; ?>
<section id="next-sessions" class="bg-lightgrey">
    <header class="section-header">
        <h2 class="section-title">Nos prochaines sessions</h2>
        <p class="section-subtitle">Des programmes DPC validants conformes aux orientations nationales mais aussi adaptés aux champs de compétence de notre spécialité médico-chirurgicale.</p>
    </header>
    <div class="slick-sessions sessions-feed container nopadding">
        <?php
            $today = date('Ymd');
            $args = array(
                'post_type' => 'session',
                'meta_key'          => 'session_startdate',
                'meta_query' => array(
                        array(
                            'key' => 'session_startdate',
                            'value' => $today,
                            'compare' => '>='
                        )
                    ),
                'orderby'           => 'meta_value',
                'posts_per_page' => 30,
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
        ?>
    </div>
    <footer class="center section-footer">
        <a href="/sessions/" class="btn btn-lightblue">VOIR TOUTES LES SESSIONS À VENIR <i class="fas fa-chevron-right"></i></a>
    </footer>
</section>
<script>
    jQuery(document).ready(function(){

    jQuery('.slick-sessions').slick({
      infinite: true,
      slidesToShow: 4,
      slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1279, // tablet breakpoint
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 2,
                    centerMode: true,

                }
            },
            {
                breakpoint: 769, // tablet breakpoint
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
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
<?php get_footer(); ?>
