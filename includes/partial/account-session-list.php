    <section class="sessions-list">
        	<h2 class="section-title">Formations à venir</h2>
            <?php
                $args = array(
                    'post_type' => 'session',
                    'meta_key'          => 'session_startdate',
                    'orderby'           => 'meta_value',
                    'meta_key'          => 'session_customers',
                    'posts_per_page' => 10,
                    'order' => 'ASC',
					'meta_query'	=> array(
							'relation'		=> 'AND',
							array(
								'key'	  	=> 'session_customers',
								'value'	  	=> get_current_user_id(),
								'compare' 	=> '=',
							)
						)
                ); 
                $query = new WP_Query($args);
                if($query->have_posts()) : while ($query->have_posts() ) : $query->the_post();
                $mySession = new Session(get_the_ID()); 
                include "../loops/loop-session-account.php";          
                endwhile;
            	else :  echo "<p class='center sessions-empty'>Aucune formation à venir. </p><p class='center'><a href='#' class='btn btn-light btn-blue'>Voir la liste des formations DPC</a></p>";
                endif;
                wp_reset_postdata(); 
            ?>
    </section>