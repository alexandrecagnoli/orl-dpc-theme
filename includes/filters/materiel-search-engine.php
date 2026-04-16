<div id="materiel-search-engine">
      <div id="materiel-searchform" class="search-form emboss greygradient">
      <?php get_search_form('my_search_form'); ?>
      </div><a href="#show-criteria" class="show-more-criteria-link closed">Plus de critères</a>
  </div>
  <div id="materiel-search-criteria">
<?php 
$args = array( 'hide_empty' => 0 , 'parent' => 0);

$terms = get_terms('type-produit', $args);

$count = count($terms); $i=0;
if ($count > 0) {
    $term_list = '<ul class="my_term-archive" id="my_term_archive_container">';

    foreach ($terms as $term) {
        $i++;
    	$term_list .= '<li class="my_term-archive_link"><a href="/type-produit/' . $term->slug . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $term->name) . '">' . $term->name . '</a>';

	    $subterms = get_terms('type-produit', array( 'parent' => $term->term_id ));
	    $count2 = count($subterms);
	    if ($count2 > 0)
	    {
		  $term_list .= '<ul class="my_subterm-archive">';  
		  foreach ($subterms as $subterm)
		  {
			$term_list .= '<li><a href="/type-produit/' . $subterm->slug . '" title="' . sprintf(__('View all post filed under %s', 'my_localization_domain'), $subterm->name) . '">' . $subterm->name . '</a></li>';
		  }
		  $term_list .= '</ul>';  
	    }

    	$term_list .= '</li>';
    }

    echo $term_list;
}
?>
</div>