

    <div id="news-sidebar" class="horizontal-centered">
        <a href="" id="link-1">Catégories</a>
        <a href="" id="link-2">Archives par date</a>
        <a href="" id="link-3">Mots-clés</a>
        <a href="" id="link-4">Rechercher</a>
    </div>
</div>

<section id="news-menu" >
    <div class="toggle horizontal-centered" id="news-menu-1">
<ul>
    <?php wp_list_cats('','');?>
</ul>
    </div>
    <div class="toggle horizontal-centered" id="news-menu-2">
<ul>
    <?php wp_get_archives();?>
</ul>
    </div>
    <div class="toggle horizontal-centered" id="news-menu-3">
    <?php wp_tag_cloud(); ?>
    </div>
    <div class="toggle horizontal-centered" id="news-menu-4">
    <?php get_search_form(); ?>
    </div>
</section>
<div class="clearfloat"></div>


