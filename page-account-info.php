<?php
/**
* Template Name: Mes infos
*/
?>

<?php get_header(); ?>
<nav class="user-nav">
    <a href="/mon-compte/mes-sessions-dpc/" class="user-nav-courses">Mes formations</a>
    <a href="/mon-compte/mes-infos/" class="active user-nav-info">Mes infos</a>
    <a href="/mon-compte/" class="user-nav-account">Mon compte</a>
</nav>
<main class="container">
    <h1 class="page-title">Mes informations personnelles</h1>
    <p class="page-subtitle">Nous vous remercions de vérifier attentivement si les informations ci-dessous sont à jour, modifiez-les si nécessaire</p>
    <?php the_content(); ?>
</main>
<?php get_footer(); ?>