<?php get_header(); ?>
<?php
    if(have_posts()): while(have_posts()): the_post();
    $post_id = get_the_ID();
    $banner=get_field('course_banner');
?>
<section class="hero" style="background-image:url(<?= $banner['url'];?>);">
    <div class="overlay"></div>
    <h1 class="container hero-title"><?php the_title();?></h1>
</section>
<div class="breadcrumbs"><div class="container"><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Accueil</a> > <a href="/formations/">Formations</a> > <?php the_title();?></div></div>
<article>
    <section class="container course-summary course-summary-flex" id="">
        <div class="content">
            <h2 class="line-title">LA FORMATION</h2>
            <?php the_content(); ?>
    </section>
    <section class="sessions-list bg-lightblue">
        <div class="container">
            <?php
                $args = array(
                    'post_type' => 'session',
                    'meta_key' => 'session_startdate',
                    'orderby' => 'meta_value',
                    'posts_per_page' => 999999999,
                    'order' => 'DESC',
                );
                $query = new WP_Query($args);
                $i=0;
                if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
                $sessionCourse = get_field('session_course');
                // a priori ce serait un tableau https://stackoverflow.com/questions/44997218/call-post-object-id-in-the-function-acf / https://support.advancedcustomfields.com/forums/topic/get-page-id-array-from-post-object/
                // var_dump($sessionCourse);
                $sessionCourseId = $sessionCourse ;
                //echo $post_id."<br/>";
                $mySession = new Session( get_the_ID(), $post_id);
                // aucune idée du pourquoi de ce bug (ici impossible d'accéder à cette variable..)
                $mySession->eval_1_startdate = get_field('eval_1_startdate', $mySession->id );

                if( ($sessionCourseId == $post_id) && ($mySession->startdate >= date("Y-m-d")))
                {

                    $i++;
                    if($i == 1)
                    echo '<h3 class="section-title left">Prochaines sessions</h3>';
                    include "includes/loops/loop-session-detail.php";

                }
                endwhile;
                endif;
                if($i==0)
                {
                    echo "<p class='center sessions-empty'>Aucune formation programmée pour l'instant,  <a href='#' data-token='2f692fee8832ddb1f479e140880f0516' style='text-decoration:underline' onclick='mjOpenPopin(event, this)'>inscrivez-vous à notre newsletter</a> pour être tenu au courant des prochaines sessions.</p>";
                }
                wp_reset_postdata();
            ?>
        </div>
    </section>
</article>
<?php include "includes/partial/cta-callback.php"; ?>
<section id="next-sessions" class="bg-lightgrey">
    <header class="section-header">
        <h2 class="section-title">NOS AUTRES FORMATIONS DPC</h2>
        <p class="section-subtitle">Des programmes DPC validants conformes aux orientations nationales mais aussi adaptés aux champs de compétence de notre spécialité médico-chirurgicale.</p>
    </header>
    <div class="slick-sessions sessions-feed container nopadding">
        <?php
            $args = array(
                'post_type' => 'course',
                //'category_name' => 'films',
                'posts_per_page' => 10,
                'order' => 'ASC',
            );
            $query = new WP_Query($args);
            if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
            if( get_the_ID() != $post_id)
            include "includes/loops/loop-archive-course.php";
            endwhile;
            endif;
            wp_reset_postdata();
        ?>
    </div>
</section>
<?php endwhile; endif; ?>
<?php get_footer(); ?>
<script>
    jQuery(document).ready(function(){
    jQuery('.slick-sessions').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3,
        responsive: [
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
