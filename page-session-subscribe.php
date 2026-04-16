<?php
/**
* Template Name: Page SESSION SUBSCRIBE
*/
?>
<?php get_header(); ?>
<?php
// getting variables
$customer = new User(get_current_user_id());
if(isset($_REQUEST['post_id']))
{
	$sessionPostId=$_REQUEST['post_id'];
	$mySession = new Session($sessionPostId);

}
if(isset($_REQUEST['post_id']))
{
	$customer = new User($_REQUEST['user_id']);

}
else
{
	wp_redirect( home_url() );
}
?>



<nav class="user-nav">
    <ul class="progress">
    	<li <?php if( !isset($_REQUEST['step']) ) : ?> class="active" <?php endif; ?> ><span>1</span>VOTRE FORMATION</li>
    	<li <?php if(isset($_REQUEST['step']) && $_REQUEST['step']==2 ) : ?> class="active"<?php endif; ?>><span>2</span>VOS INFOS PERSONNELLES</li>
    	<li <?php if(isset($_REQUEST['step']) && $_REQUEST['step']==3 ) : ?> class="active"<?php endif; ?>><span>3</span>VOTRE INSCRIPTION</li>
    </ul>
</nav>
<main class="container">

<?php
// USER DEJA INSCRIT
$tab = $mySession->getCustomers();
if( in_array(get_current_user_id(), $tab) && !isset($_REQUEST['step'])) : ?>
    <section class="session-detail-wrapper nopadding center">
		<p>Vous êtes déjà inscrit à cette formation</p>
		<p><a href="/mon-compte/mes-sessions-dpc/" class="btn btn-turquoise">ACCÉDER À MON ESPACE PERSONNEL <i class="fas fa-arrow-right"></i></a></p>
    </section>
	<?php
// SESSION COMPLETE
elseif( $mySession->getSessionCountdown() == 0 && $_REQUEST['step'] == 1 ) : ?>
    <section class="session-detail-wrapper nopadding center">
		<p>La session est complète</p>
		<p><a href="/mon-compte/mes-sessions-dpc/" class="btn btn-turquoise">ACCÉDER À MON ESPACE PERSONNEL <i class="fas fa-arrow-right"></i></a></p>
    </section>
<!-- ETAPE 1 -->
<?php elseif(!isset($_REQUEST['step'])) : ?>
    <h1 class="page-title"><?= $mySession->getCourseTitle();?></h1>
    <section class="session-detail-wrapper">
        <div class="item session-detail">
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
                <p><strong>Session <?= $mySession->session_id; ?></strong><br/>DPC n°<?= $mySession->dpc_id; ?> - Session n°<?= $mySession->dpc_number; ?></p>
                <p><?= $mySession->duration; ?></p>
            </div>
        </div>
    </section>
    <section>
    	<?= $mySession->getCourseContent(); ?>
		<?= get_field('website_session_disclaimer', 'option'); ?>
        <?= get_post_field('post_content', $mySession->id) ?>
		<?php gravity_form( 7, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, 0, $echo = true ); ?>
    </section>
<!-- ETAPE 2 -->
<?php elseif($_REQUEST['step'] == 2) : ?>
	 	<h1 class="page-title">Vos informations personnelles</h1>
 	    <p class="page-subtitle">Nous vous remercions de vérifier attentivement si les informations ci-dessous sont à jour, modifiez-les si nécessaire.</p>
	 	<?php gravity_form( 6, $display_title = false, $display_description = false, $display_inactive = false, $field_values = null, $ajax = false, 0, $echo = true ); ?>
<!-- ETAPE 3 -->
<?php elseif($_REQUEST['step'] == 3) : ?>
	<section class="subscription-tutorial">
		<h1 class="page-title">Votre préinscription est terminée</h1>
		<p>Un mail de confirmation de votre préinscription a été envoyé à votre adresse mail. Merci de vérifier dans le dossier "indésirables" si vous ne l'avez pas reçu. <br> Afin d'être certain(e) de recevoir nos emails correctement, merci d'ajouter l'adresse nepasrepondre@orl-dpc.fr à vos contacts.</p>
		<?php if( ($mySession->getDPC($customer->id) != 1) && ($customer->paycheck_IsValid() != 2) ) : ?><p class="page-subtitle">Suivez les étapes ci-dessous pour finaliser votre inscription</p><?php endif; ?>
		 <?php
    // Ne s'affiche que si l'user n'est pas inscrit sur mon DPC'
    if( $mySession->getDPC($customer->id) != 1) :
    ?>

			 <h2>Inscrivez-vous sur mondpc.fr</h2>
 	    	<div class="info-tip">
 	    		<p class="info-tip-title"><i class="fas fa-info-circle"></i> Conseil</p>
 	    		<p>Afin de pouvoir bénéficier du financement DPC, <strong>vous devez impérativement être enregistré sur le site de l’Agence Nationale du DPC</strong> en suivant la procédure ci-dessous.</p>
 	    	</div>
			<ul>
				<li><strong>Vous avez déjà un  compte :</strong>  vérifiez systématiquement en vous connectant avec vos identifiants que vos informations professionnelles et financières soient à jour en cliquant sur <a href="https://www.agencedpc.fr/professionnel">le lien suivant</a></li>
				<li><strong>Vous n’avez pas de compte :</strong>  créez le en quelques minutes en cliquant sur <a href="https://www.agencedpc.fr/professionnel/compte/etape0">le lien suivant</a></li>
			</ul>
 	    	<p><span class="bullet-number">1</span>Connectez-vous à votre espace personnel sur le site <strong><a href="https://www.agencedpc.fr/professionnel/" target="_blank">http://www.agencedpc.fr</a></strong> puis cliquer sur l’onglet  <strong>« Actions DPC » </strong> et « rechercher une action/s’inscrire »</p>
    		<p><span class="bullet-number">2</span>A gauche de votre écran, rendez-vous dans la rubrique <strong>« Rechercher une action »</strong></p>
    		<p><span class="bullet-number">3</span>Saisissez la référence de l'action <strong><?= $mySession->dpc_id; ?></strong> et sélectionnez <strong>« Rechercher »</strong></p>
    		<p><span class="bullet-number">4</span>Cliquez sur le bouton <strong>« Détail »</strong> à droite</p>
            <p><span class="bullet-number">5</span>Allez dans la rubrique <strong>« Liste sessions »</strong> choisissez <strong>session N°<?= $mySession->dpc_number; ?></strong> puis cliquer sur le bouton <strong>« s’inscrire » </strong>et valider.</p>
	<?php endif; ?>
    <?php
    // Ne s'affiche que si le chèque de caution n'est pas valide
    if( ($customer->paycheck_IsValid() != 2) && ($mySession->type != 1) ) :
    ?>

 	    	<h2>Envoyez nous votre bulletin d'inscription et votre chèque de caution</h2>
 	    	<p><span class="bullet-number">1</span>Imprimez le PDF de votre bulletin de formation </p>
 	    	<p><span class="bullet-number">2</span>Signez-là et apposez votre tampon professionnel</p>
 	    	<p><span class="bullet-number">3</span>Joignez-y votre chèque de caution de <?php the_field('website_paycheck_amount', 'option'); ?>€ à l'ordre d'ORL-DPC</p>
 	    	<div class="info-tip">
 	    		<p class="info-tip-title"><i class="fas fa-info-circle"></i> Pourquoi un chèque de caution ?</p>
				 <p>ORL-DPC encaissera le chèque de caution formation, en cas d’annulation du participant <b>(quel qu’en soit le motif)</b> moins de 15 jours calendaires avant la formation ou en cas de non-participation à la totalité de la formation.</p>
 	    		<p>Nous conserverons ce chèque durant l’année en cours pour toutes inscriptions. Il sera détruit en fin d’année sauf en cas d’annulation tardive voir modalités ci-dessous</p>
 	    	</div>
 	    	<p><span class="bullet-number">4</span>Faîtes-nous parvenir votre bulletin accompagné de votre chèque de caution complet à l’adresse suivante :</p>
			<address>ORL-DPC <br/>7 rue Ernest Cresson, <br> 75014 Paris.</address>
    		<p class="center"><a href="/session-inscription/confirmation/?post_id=<?php echo $mySession->id; ?>&form_action=subscription_confirm&customer_id=<?= get_current_user_id(); ?>" class="btn btn-darkblue" target="_blank">Télécharger mon bulletin d'inscription <i class="fas fa-download"></i></a></p>

    <?php endif; ?>
 	    	<?php if($_REQUEST['step'] != 3) : ?><a href="#" class="back"> <i class="fas fa-arrow-left"></i> Retour</a><?php endif ;?>
 	    	<a href="/mon-compte/mes-sessions-dpc/" class="btn btn-turquoise">ACCÉDER À MON ESPACE <i class="fas fa-arrow-right"></i></a>
 	    </section>


<!-- FAIL -->
<?php else : ?>
	<? wp_redirect( home_url()); exit; ?>
<?php endif; ?>



</main>
<?php get_footer(); ?>
