<?php
/**
* Template Name: Quiz results
*/
?>

<?php wp_head(); 
$start = microtime(true);
$paging = array( 'offset' => 0, 'page_size' => 500 );
$search_criteria = array( 'status' => 'active' );
?>
<main class="container page-form">
    <!-- EVALUATION 1 -->
    <style>
        #wpadminbar{display:none;}
        .correct{
            font-weight:bold;
        }
        h3{
            margin:2em 0 1em !important;
            font-size:1.5em;
        }
        .block-answer{
            padding:1em 0;
        }
        .histogram-container{
            height:20px;
            width:100%;
            background-color:#dce0e8;
        }
        .histogram-color
        {
            height:20px;
            position:relative;
            background-color:#9DBC4D;
        }
        .correct .histogram-color{
            background-color:#9DBC4D;
        }
        .incorrect .histogram-color{
            background-color:#E04F5F;
        }
    </style>
    <?php 
        remove_all_shortcodes();    
    ?>
    <?php if ( current_user_can('administrator') ) : 

            $quiz = $_GET['quiz'];
            $post_id = $_GET['post_id'];
            $eval_step = substr($_GET['quiz'],-1);
            $eval_type ="";

            $myshortcode = get_field($quiz, $post_id, false );
            //echo "sc : ".$myshortcode;
            //Extract the numbers using the preg_match_all function.
            preg_match_all('!\d+!', $myshortcode, $matches);
            //Any matches will be in our $matches array
            //var_dump($matches);
            $quiz_id = $matches[0][0];
            $mySession = new Session($post_id);
            $titre = "Résultats de l'évaluation";

            if( ($mySession->evaluation_type == "app")|| ($mySession->evaluation_type == "epp") || ($mySession->evaluation_type == "app+epp")){
                $eval_type = $_GET['eval_type'];
                $app = new Quiz($mySession->app_form['id']);
                $epp = new Quiz($mySession->epp_form['id']);

                if($eval_type == "app"){
                    $quiz_id = $mySession->app_form['id'];
                    $titre="Résultats de l'analyse";
                }
                if($eval_type == "epp"){
                    $quiz_id = $mySession->epp_form['id'];
                }
            }


            // echo "<pre>".$myshortcode."</pre>";
            $allform = GFAPI::get_form( $quiz_id );
            


        ?>
    <section class="container session-admin" id="">

    <h1><?= $titre;?> <?= $allform['title'] ?> n°<?= $eval_step ?></h1>
    <?php 

    // objet quiz
    $form = GFFormsModel::get_form_meta($quiz_id);
    // récupération des questions
    $form = $form['fields'];
    // objet réponses
    $entries = GFAPI::get_entries( $quiz_id, $search_criteria, null, $paging );

    // echo "<pre>".var_export($entries, true)."</pre>";
    echo count($entries)." réponses";
    
    // on parse les questions
    foreach ($form as $value) {
        //var_dump($value);
        // filtre quiz
       

        if( ($value['type'] == "quiz")  ){
            // getting vars
            $id = $value['id'];
            $type=$value['gquizFieldType']; // type de question 
            
            $title = $value['label'];       // titre de la question
            $answers = $value['inputs'];    // tableau de champs multiples
            $choices = $value['choices'];   // tableau de réponses


            echo '<h3>' . $title. '</h3>';
            
            // choix unique
            if( $type == "radio" )
            {
                
                if (is_array($choices) || is_object($choices))
                {
                    $entries_tab = [];
                    foreach ($choices as $choice){
                        $value = $choice['value'];
                        $text = $choice['text'];
                        //var_dump($choice);
                        // réponses correctes / incorrectes
                        $isCorrect = $choice['gquizIsCorrect'];  
                        $classes="incorrect";   
                        if ($isCorrect ==  true)  
                        $classes = "correct";
                        if ($eval_type ==  "epp")  
                        $classes = "correct";
                        // on compte le nombre de réponses pour chaque item
                        $cpt=0;
                       
                        foreach($entries as $entry){
                            $entry_customer_id = $entry['created_by'];
                            if( ($eval_type == "epp") && ($entry[$id] != "")  && ($entry[8] == $eval_step) ){
                                $cpt++;
                                array_push($entries_tab, $entry_customer_id);
                            }
                            elseif ( ($entry[$id] == $value ) 
                            && (!in_array($entry_customer_id, $entries_tab, true)) 
                            && ($entry[8] == $eval_step) 
                            && ($entry[5] == $post_id )) 
                            {
                                $cpt++;
                                array_push($entries_tab, $entry_customer_id);
                            }
                        }
                        $percentage = ($cpt * 100) / count($entries) ;
                        echo '<div class="block-answer '.$classes.'">
                        <div class="histogram-container"><div class="histogram-color" style="width:'.$percentage.'%"></div></div>'
                        . $text . ' - '. round($percentage).'% ('. $cpt.' réponses)
                        </div>';  
                        ///var_dump($entries_tab);   
                    }
                }
            }

            // choix multiples
            if( $type  == "checkbox" )
            {
               

                if (is_array($choices) || is_object($choices))
                {
                    $i=0;
                    $entries_tab = [];
                    //var_dump($choices);
                    foreach ($answers as $answer){
                        $id = $answer['id'];
                        $text = $choices[$i]['text'];
                        // réponses correctes / incorrectes
                        $isCorrect = $choices[$i]['gquizIsCorrect'];  
                        $classes="incorrect";   
                        if ($isCorrect ==  true)  
                        $classes = "correct";
                        if ($eval_type ==  "epp")  
                        $classes = "correct";

                        // on compte le nombre de réponses pour chaque item
                        $cpt=0;
                        foreach($entries as $entry)
                        {
                           
                            $entry_customer_id = $entry['created_by'];

                            if( ($eval_type == "epp") 
                            && ($entry[$answer['id']] != "")  
                            && ($entry[8] == $eval_step) 
                            && ($entry[5] == $post_id ) ){
                                $cpt++;
                                array_push($entries_tab, $entry_customer_id);
                            }

                            elseif ( ($entry[$answer['id']] != "") 
                            && (!in_array($entry_customer_id, $entries_tab, true)) 
                            && ($entry[8] == $eval_step)        )   
                            {
                                $cpt++;
                                array_push($entries_tab, $entry_customer_id);
                               
                            }
                        }
                        
                        $percentage= ($cpt * 100) / count($entries) ;
                        echo '<div class="block-answer '.$classes.'">
                        <div class="histogram-container"><div class="histogram-color" style="width:'.$percentage.'%"></div></div>'
                        . $text . ' - '. round($percentage).'% ('. $cpt.' réponses)</div>';    
                        $i++;  
                        //var_dump($entries_tab);   
                    }
                    
                }
            }
        }
        
    }

    

    ?>
    </section>
    <?php endif; 
    // $time_elapsed_secs = microtime(true) - $start;
    // echo "Temps écoulé : ".$time_elapsed_secs;
    ?>
</main>
<?php wp_footer(); ?>
