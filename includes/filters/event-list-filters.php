
<form>

<input type="text" placeholder="Recherche" id="event-search"/>

      <select class="custom-select" id="event-select-type" placeholder="Type d'évènement" name="type">
	  <option value="">Type d'évènement</option>
	     <?php $event_types = get_terms( 'event_type', 'orderby=count&hide_empty=0' );
	      foreach($event_types as $event_type)
	      {
		echo '<option value="'.$event_type->slug.'" name = "'.$event_type->slug.'">'.$event_type->name.'</option>';
	      }
	     ?>
      </select>
      


      <select id="event-select-date" class="custom-select" placeholder="Date" name="date">
        <option value="">Quand</option>
	    <?php
		  $i=0;
		  $tab = myEventPeriodsPeer();
		  foreach($tab as $elem)
		  {
			echo '<option value="'.$i.'" name = "'.$i.'">'.$elem.'</option>';
			$i++;
		  }
	    ?>
      </select>
      

<?php 
$t_regions_explode = array();

echo '<select id="event-select-place" class="custom-select" placeholder="Ma région" name="place">';
echo '<option value="">Ma région</option>';

$t_departements = myDepartmentsList();


foreach(myRegionsList() as $cle=>$valeur)
{
    $t_regions_explode[$cle] = explode(',', $valeur);   
}


foreach($t_regions_explode as $cle=>$valeur)
{
                       
    echo '<optgroup label="'.$cle.'">';             
    foreach($t_regions_explode[$cle] as $cle=>$valeur){
                           
        echo '<option value="'.$valeur.'">'.$valeur.' - '.$t_departements[$valeur].'</option>';
                           
    }
                       
    echo '</optgroup>';
                       
}

echo "\n".'</select>'."\n";
?>
      <a href="<?php echo myCurrentUrl(); ?>" id="showResults-link" class="greygradient emboss">Voir les résultats</a>
      <span class="ajax-loader">Chargement</span>



</form>

