<?php get_header(); ?>
<section class="hero" style="background-image:url(<?= get_template_directory_uri(); ?>/img/bg-hero.jpg);">
    <h1><span class="darkblue">L’organisme de formation</span> <span class="orange">en ORL, pour les ORL</span></h1>
</section>
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
<section class="bg-darkblue-grad">
        <div class="container key-numbers">
            <div class="key-number">
                <span><?php the_field('bloc_stats_1', 'option'); ?></span>
                participants <br> depuis 2020
            </div>
            <div class="key-number">
                <span><?php the_field('bloc_stats_2', 'option'); ?><span class="small">%</span></span>
                ont trouvé l’encadrement <br>des formations efficace
            </div>
            <div class="key-number">
                <span><?php the_field('bloc_stats_3', 'option'); ?><span class="small">%</span></span>
                déclarent les formations  <br>utiles dans leur pratique
            </div>
            <div class="key-number">
                <span><?php the_field('bloc_stats_4', 'option'); ?><span class="small">%</span></span>
                trouvent la formation  <br>indépendante et éthique
            </div>
        </div>
</section>
<section class="bg-lightgrey iconbox" id="arguments" >
    <h2 class="section-title">Nos programmes DPC sont validants, et 100% adaptés<br/> aux champs de compétence de notre spécialité médico-chirurgicale.</h2>
    <div class="container col-3">
        <div class="item">
            <img class="item-img" src="<?= get_template_directory_uri(); ?>/img/orl-2@2x.png" alt="blabla"/>
            <h3 class="item-title">Des formations 100% ORL</h3>
            <p class="item-subtitle">Tout ce que vous avez toujours voulu partager sur les sujets les plus divers : les références de la connaissance et les « trucs » de l’expérience.</p>
        </div>
        <div class="item">
            <img class="item-img" src="<?= get_template_directory_uri(); ?>/img/doctor-2@2x.png" alt="blabla"/>
            <h3 class="item-title">Un organisme reconnu par ses pairs</h3>
            <p class="item-subtitle">Organisme sous l’égide du Collège français d’ORL, de la Société Française d’ORL et CCF et du Syndicat National d’ORL et CCF</p>
        </div>
        <div class="item">
            <img class="item-img" src="<?= get_template_directory_uri(); ?>/img/scholarship-1@2x.png" alt="blabla"/>
            <h3 class="item-title">Des formateurs qualifiés</h3>
            <p class="item-subtitle">Ce sont Les Experts de votre sujet. Ils sont entrainés à une pédagogie innovante basée sur le partage des expériences et la réfléxivité.</p>
        </div>
    </div>
</section>

<section class="bg-lightblue" id="last-news">
    <h2 class="section-title">Toute l'actualité ORL-DPC</h2>
    <div class="slick-news news-carousel container nopadding">
        <?php
            $args = array(
                'post_type' => 'post',
                //'category_name' => 'films',
                'posts_per_page' => 10,
                'order' => 'DESC',
            );
            $query = new WP_Query($args);
            if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
            include "includes/loops/loop-actu-big.php";
            endwhile;
            endif;
            wp_reset_postdata();
        ?>
    </div>
    <footer class="center section-footer">
        <a href="/actualites/" class="btn btn-lightblue">TOUS LES ACTUALITÉS ORL-DPC <i class="fas fa-chevron-right"></i></a>
    </footer>
</section>



<?php /* ?>

<section id="next-sessions" class="bg-lightgrey">
    <header class="section-header">
        <h2 class="section-title">Nos formations</h2>
        <p class="section-subtitle">Des programmes DPC validants conformes aux orientations nationales mais aussi adaptés aux champs de compétence de notre spécialité médico-chirurgicale.</p>
    </header>
    <div class="slick-sessions sessions-feed container nopadding">
        <?php
            $args = array(
                'post_type' => 'course',
                'posts_per_page' => 10,
                'order' => 'ASC',
            );
            $query = new WP_Query($args);
            if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
            include "includes/loops/loop-archive-course.php";
            endwhile; else :
            echo "<p>Pas de formations disponibles pour l'instant</p>" ;
            endif;
            wp_reset_postdata();
        ?>
    </div>
</section>
<?php */ ?>
<section id="mission" class="col-2 nopadding section-mission">
    <div class="content">
        <?php the_content();?>
    </div>
    <picture>
        <source srcset="<?= get_template_directory_uri(); ?>/img/mission@2x.jpg" media="(min-width: 800px)">
        <img src="<?= get_template_directory_uri(); ?>/img/mission.jpg" />
    </picture>
</section>
<section id="testimonials" class="overlay-quote" style="background-image:url(<?= get_template_directory_uri(); ?>/img/bg-hero.jpg);">
    <div class="section-content">
        <picture >
            <source srcset="https://orl-dpc.fr/wp-content/uploads/2020/02/jmk-andpc-300x300.jpg" media="(min-width: 800px)">
            <img src="https://orl-dpc.fr/wp-content/uploads/2020/02/jmk-andpc-300x300.jpg" class="img-circle"/>

        </picture>
        <blockquote class="container">
            <p>Il est important que notre spécialité garde son autonomie sur ces orientations qui rentrent dans ce qu’il est convenu de nommer « la formation tout au long de la vie professionnelle ».</p>
            <cite>Dr Jean-Michel Klein, Président</cite>
        </blockquote>
    </div>
    <div class="overlay"></div>
</section>
<section id="team" class="section-team bg-lightgrey">
    <header class="section-header">
        <h3 class="section-title">Nos experts et animateurs</h3>
        <!-- <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi orci lacus, venenatis sit amet fringilla eget, placerat sed urna.</p> -->
    </header>
    <div class="container nopadding slick-team">
        <?php
            $args = array(
                'post_type' => 'team_member',
                'posts_per_page' => 30,
                'order' => 'DESC',
                'orderby'        => 'rand'
            );
            $query = new WP_Query($args);
            if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
            include "includes/loops/loop-team-member.php";
            endwhile;
            endif;
            wp_reset_postdata();
        ?>
    </div>
    <footer class="center section-footer">
        <a href="/nos-experts/" class="btn btn-lightblue">TOUS LES EXPERTS ET ANIMATEURS <i class="fas fa-chevron-right"></i></a>
    </footer>
</section>
<section id="sponsors" class="bg-lightblue">
    <h3 class="section-title">ILS CERTIFIENT ORL-DPC</h3>
   <!-- <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
    Morbi orci lacus, venenatis sit amet fringilla eget, placerat sed urna.</p>-->
    <div class="wrapper-sponsors">
        <div class="item"><img src="<?= get_template_directory_uri(); ?>/img/logo-has.jpg" class="item-img"/></div>
        <!--<div class="item"><img src="<?= get_template_directory_uri(); ?>/img/logo-cnu.jpg" class="item-img"/></div>
        <div class="item"><img src="<?= get_template_directory_uri(); ?>/img/logo-dd.jpg" class="item-img"/></div>-->
        <div class="item"><img src="<?= get_template_directory_uri(); ?>/img/logo-odpc.jpg" class="item-img"/></div>
        <div class="item"><img src="<?= get_template_directory_uri(); ?>/img/logo-direccte.jpeg" class="item-img"/></div>
        <div class="item"><img src="<?= get_template_directory_uri(); ?>/img/logo-qualiopi.png" class="item-img"/></div>
    </div>
</section>

<script>
    jQuery(document).ready(function(){
    jQuery('.slick-news').slick({
        infinite: true,
      slidesToShow: 5,
      slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1600, // tablet breakpoint
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2,
                    centerMode: true,

                }
            },
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
    jQuery('.slick-team').slick({
      infinite: true,
      slidesToShow: 8,
      slidesToScroll: 8,

        responsive: [
            {
                breakpoint: 1600, // tablet breakpoint
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    centerMode: true,
                    centerPadding: '20px',
                }
            },
            {
                breakpoint: 1280, // tablet breakpoint
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    centerMode: true,
                    centerPadding: '20px',
                }
            },
            {
                breakpoint: 1024, // tablet breakpoint
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 5,
                    centerMode: true,
                    centerPadding: '20px',
                }
            },
            {
                breakpoint: 769, // tablet breakpoint
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    centerMode: true,
                    centerPadding: '20px',
                }
            },
            {
                breakpoint: 500, // mobile breakpoint
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    centerMode: true,
                    centerPadding: '20px',
                }
            }
        ]
    });
});
</script>
<?php get_footer(); ?>
