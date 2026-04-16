
<?php $youAreHere = "Vous êtes ici :"; ?>


<!-- FIL D ARIANE DES PAGES SINGLE -->


<?php if (is_single() ) : ?>
<?php
    $title = get_the_title();
    $category = get_the_category();
    $firstCategory = $category[0]->cat_name;
    $secondCategory = $category[1]->cat_name; 
    $firstCategoryId = $category[0]->term_id ;
    $secondCategoryId = $category[1]->term_id ;
    $firstCategoryLink = get_category_link($firstCategoryId);
    $secondCategoryLink = get_category_link($secondCategoryId);

?>
<div id="breadcrumbs">
    <span class="breadcrumb-item"><?php echo $youAreHere; ?></span>
    <span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Accueil</a></span>
    <?php if(isset($firstCategory)) : ?><span class="breadcrumb-item"><a href="<?php echo $firstCategoryLink;?>"><?php echo $firstCategory;?></a></span><?php endif;?>
    <?php if(isset($secondCategory)) : ?><span class="breadcrumb-item"><a href="<?php echo $secondCategoryLink;?>"><?php echo $secondCategory; ?></a></span><?php endif;?>
    <?php if(isset($title)) : ?><span class="breadcrumb-item current"><?php echo $title; ?></span><?php endif;?>
</div>
<?php endif;?>



<!-- FIL D ARIANE DES PAGES CATEGORIES -->

<?php if (is_category())  : ?>
<?php
    $cat = get_query_var('cat');
    $currentCat = get_category ($cat);
    $currentCatName = $currentCat->name;
    $currentCatLink = get_category_link($currentCat->term_id);

    $parentCatId = $currentCat->parent;
    if ($parentCatId != 0)
    {
        $parentCat = get_category ($parentCatId);
        $parentCatName = $parentCat->cat_name;
        $parentCatLink = get_category_link($parentCat);
    }
?>
<div id="breadcrumbs"><span class="breadcrumb-item"><?php echo $youAreHere; ?></span>
<span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Accueil</a></span>
<?php if ($parentCatId != 0): ?><span class="breadcrumb-item"><a href="<?php echo $parentCatLink;?>"><?php echo $parentCatName;?></a></span><?php endif;?>
<span class="breadcrumb-item"><a href="<?php echo $firstCategoryLink;?>"><?php echo $currentCatName; ?></a></span>
</div>
<?php endif;?>


<!-- FIL D ARIANE DES PAGES DE RECHERCHE -->

<?php if ( is_search() ) : ?>
<div id="breadcrumbs"><span class="breadcrumb-item"><?php echo $youAreHere; ?></span>
<span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Accueil</a></span>
<span class="breadcrumb-item">Résultats de recherche</span>
</div>
<?php endif;?>



<!-- FIL D ARIANE DES PAGES DE TAXONOMIES PERSONNALISÉES -->

<?php if (is_tax('marque'))  : ?>
<?php
    $currentCatName = $currentCat->name;
    $currentCatLink = get_category_link($currentCat->term_id);
?>
<div id="breadcrumbs"><span class="breadcrumb-item"><?php echo $youAreHere; ?></span>
<span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Accueil</a></span>
<span class="breadcrumb-item"><?php echo $currentCatName; ?></span>
</div>
<?php endif;?>


<?php if (is_tax('focus'))  : ?>
<?php
    $currentTermName = $currentTerm->name;
    $currentTermLink =  get_term_link( $currentTerm->slug, $currentTaxonomy->slug );
?>
<div id="breadcrumbs"><span class="breadcrumb-item"><?php echo $youAreHere; ?></span>
<span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Accueil</a></span>
<span class="breadcrumb-item"><?php echo $currentTermName; ?></span>
</div>
<?php endif;?>



<!-- FIL D ARIANE DES PAGES DE TAXONOMIES PERSONNALISÉES -->

<?php if( is_post_type_archive('evenement' )) : ?>
<?php
    $currentCatName = $currentCat->name;
    $currentCatLink = get_category_link($currentCat->term_id);
?>
<div id="breadcrumbs"><span class="breadcrumb-item"><?php echo $youAreHere; ?></span>
<span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Accueil</a></span>
<span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Évènements</a></span>
<span class="breadcrumb-item">Agenda</span>
</div>
<?php endif;?>


<?php if(is_404()) : ?>
<div id="breadcrumbs"><span class="breadcrumb-item"><?php echo $youAreHere; ?></span>
<span class="breadcrumb-item"><a href="<?php bloginfo("home")?>">Accueil</a></span>
<span class="breadcrumb-item">Erreur 404</span>
</div>
<?php endif;?>

