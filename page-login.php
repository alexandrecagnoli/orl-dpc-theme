<?php
/**
* Template Name: Page LOGIN
*/
?>
<?php 

wp_redirect( 'https://orl-dpc.fr/connexion-login/', 301 ); 
exit; 

?>
<?php get_header(); ?>
<main class="container">
    <section class="subscribe bg-white roundcorners-15">
        <h2 class="section-title">Vous êtes un médecin diplômé ?</h2>
        <img src="<?= get_template_directory_uri(); ?>/img/ico-doctor-big.svg" alt="Connectez-vous" class="alignleft"/>
        <p><strong>Créez votre compte ORL-DPC en quelques minutes, c'est gratuit !</strong><br/><br/>
        Bénéficiez de formations DPC indemnisées 100% adaptées
aux champs de compétence de notre spécialité médico-chirurgicale</p>
        <a href="/inscription" class="btn btn-turquoise wide">JE CRÉE MON COMPTE ORL-DPC <i class="fas fa-arrow-right"></i></a>
    </section>
    <section class="login bg-white roundcorners-15">
        <?php if ( is_active_sidebar( 'login_form' ) ) : ?>=:;=:;=;
            <div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
                <?php dynamic_sidebar( 'login_form' ); ?>
            </div><!-- #primary-sidebar -->
        <?php endif; ?>
    </section>
</main>
<?php get_footer(); ?>
