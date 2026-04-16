<?php
/**
 * Tabs derniers articles et derniers portfolios
 */
class Sidebar_Three_Tabs_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'sidebar_three_tabs_widget', // Base ID
			'Agendas, concours et tournois', // Name
			array( 'description' => __( 'Affiche un flux des derniers agendas, concours et tournois sous forme de tabs', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', $instance['title'] );

		
		if ( ! empty( $title ) )
			 
		?>
                    <div class="sidebar-tabs three-tabs">
                    
                        <ul class="sidebar-tabs-nav">
				<li class="sidebar-tab-first"><h2 class="sidebar-tabs-title" ><a href="#tabs-1">L'agenda photo</a></h2></li>
				<li class="sidebar-tab-middle"><h2 class="sidebar-tabs-title" class="sidebar-tabs-title2"><a href="#tabs-2">Les concours</a></h2></li>
				<li class="sidebar-tab-last"><h2 class="sidebar-tabs-title" class="sidebar-tabs-title2"><a href="#tabs-3">Les tournois</a></h2></li>
                        </ul>

                        <div class="sidebar-tabs-container round-corner-bottom">
                            <div class="sidebar-tabs-content">
                                
				<section id="tabs-1">
				    <article>
					<header>
					    <p class="post-meta"><time datetime="2012-02-02" class="post-date">9/01/2013</time> — Posté par <a href="#" class="author-link">Photo-reporter</a></p>
					    <h3><a href="">Les voyages de Lukas Kozmus</a></h3>
					</header>
					    <p class="post-excerpt">Coup de coeur pour le talent du jeune photographe Lukas Kozmus originaire de Berlin. Il a réalisé plusieurs longs voyages…</p>
					    <a href="#" class="readmore-link">Lire la suite</a>
				    </article>
				    <article>
					<header>
					    <p class="post-meta"><time datetime="2012-02-02" class="post-date">9/01/2013</time> — Posté par <a href="#" class="author-link">Photo-reporter</a></p>
					    <h3><a href="">Les voyages de Lukas Kozmus</a></h3>
					</header>
					    <p class="post-excerpt">Coup de coeur pour le talent du jeune photographe Lukas Kozmus originaire de Berlin. Il a réalisé plusieurs longs voyages…</p>
					    <a href="#" class="readmore-link">Lire la suite</a>
				    </article>
				</section>
              
               
				<section id="tabs-2">
				    <article>
				    <header>
					<p class="post-meta"><time datetime="2012-02-02" class="post-date">9/01/2013</time> — Posté par <a href="#" class="author-link">Photo-reporter</a></p>
					<h3>Les voyages deeee Lukas Kozmus</h3>
				    </header>eeee
					<p class="post-excerpt">Coup de coeur pour le talent du jeune photographe Lukas Kozmus originaire de Berlin. Il a réalisé plusieurs longs voyages…</p>
					<a href="#" class="readmore-link">Lire la suite</a>
				    </article>
				</section>

				<section id="tabs-3">
                                        <article>
                                        <header>
                                            <p class="post-meta"><time datetime="2012-02-02" class="post-date">9/01/2013</time> — Posté par <a href="#" class="author-link">Photo-reporter</a></p>
                                            <h3>Les voyages deeee Lukas Kozmus</h3>
                                        </header>eeee
                                            <p class="post-excerpt">Coup de coeur pour le talent du jeune photographe Lukas Kozmus originaire de Berlin. Il a réalisé plusieurs longs voyages…</p>
                                            <a href="#" class="readmore-link">Lire la suite</a>
                                        </article>
                                    </section>



                            </div>
			</div>
                    </div>

                <?php
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'Insérer titre', 'text_domain' );
		}
		?>

		<?php 
	}

} // class Foo_Widget
