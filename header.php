<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="fr"> <!--<![endif]-->
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?php bloginfo('name') ?><?php if ( is_404() ) : ?> | <?php _e('Not Found') ?><?php elseif ( is_front_page() ) : ?> | <?php bloginfo('description') ?><?php else : ?> | <?php wp_title() ?><?php endif ?></title>
    <?php wp_head();?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= get_template_directory_uri(); ?>/img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= get_template_directory_uri(); ?>/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri(); ?>/img/favicon-16x16.png">
    <link rel="manifest" href="<?= get_template_directory_uri(); ?>/img/site.webmanifest">
    <link rel="mask-icon" href="<?= get_template_directory_uri(); ?>/img/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-157015381-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-157015381-1');
    </script>
</head>
<body <?php body_class(); ?> >
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    <header class="site-header">
        <a class="hamburger-link"  href="#">
        <i class="fas fa-bars"></i>
    </a>
        <a class="logo" href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?= get_template_directory_uri(); ?>/img/logo.svg" alt="ORL-DPC" /></a>
        <nav class="main-navigation">
            <ul>
                <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="active">Accueil</a></li>
                <li><a href="#">Formations</a><i class="fas fa-chevron-down toggle-submenu"></i>
                     <ul>
                        <li><a href="/sessions/">Prochaines sessions</a></li>
                        <!--<li><a href="/nos-experts/">Nos experts</a></li>-->
                        <li><a href="/formations/">Catalogue de formations</a></li>
                    </ul>
                </li>
                <li><a href="#">À propos</a><i class="fas fa-chevron-down toggle-submenu"></i>
                     <ul>
                        <li><a href="/a-propos-dorl-dpc/">À propos d'ORL-DPC</a></li>
                        <!--<li><a href="/nos-experts/">Nos experts</a></li>-->
                        <li><a href="/contact/">Contactez-nous</a></li>
                        <li><a href="/nos-experts/">Nos experts</a></li>
                    </ul>
                </li>
                <li><a href="/faq/">Faq</a></li>
                <li><a href="/le-dpc-ses-principes-et-ses-financements">Le DPC</a>
                  <ul>
                    <li><a href="/le-dpc-ses-principes-et-ses-financements">Principes et financements</a></li>
                    <li><a href="/regles-de-prise-en-charge-financement-dpc">Règles de prise en charge</a></li>
                  </ul>
                </li>
                <li><a href="/actualites/">Actualités</a></li>
                <li><a href="#">Accréditation HAS</a><i class="fas fa-chevron-down toggle-submenu"></i>
                     <ul>
                        <li><a href="/accreditation-has/">S'engager</a></li>
                        <!--<li><a href="/nos-experts/">Nos experts</a></li>-->
                        <li><a href="/accreditation-has/programme-daccreditation-en-orl-et-ccf/">Programme d'accréditation</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    <?php if ( is_user_logged_in() ) : ?>
        <?php $customer = new User(get_current_user_id()); ?>
        <a href="#" class="user-link logged-in"><img src="<?= get_template_directory_uri(); ?>/img/ico-login.svg"/><i class="fas fa-caret-down"></i></a>
        <nav class="user-navigation">
            <div class="user-navigation-infos">
                <img src="<?= get_template_directory_uri(); ?>/img/ico-login.svg"/>
                <span>
                    <span class="user-name"><?= $customer->firstname." ".$customer->lastname; ?>
                        <span class="user-email"><?= $customer->email; ?></span>
                        <a href="/mon-compte/" class="">Modifier mon profil</a>
                    </span>
                </span>
            </div>
            <div class="user-navigation-menu">
                <a href="/mon-compte/mes-sessions-dpc/">Mes formations</a>
                <a href="/mon-compte/mes-infos/">Informations personnelles</a>
                <a href="<?php echo wp_logout_url( home_url() ); ?> ">Déconnexion</a>
            </div>
        </nav>
    <?php else : ?>

        <a href="/connexion-login" class="btn btn-green user-link"><span class="hidden-tablet">Mon compte</span> <i class="fas fa-user"></i></a>
    <?php endif; ?>

    </header>
