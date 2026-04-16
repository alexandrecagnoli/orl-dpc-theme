<?php
/**
 * Tabs derniers articles et derniers portfolios
 */
class Sidebar_Two_Tabs_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'sidebar_two_tabs_widget', // Base ID
			'Derniers articles et portfolios', // Name
			array( 'description' => __( 'Affiche un flux des derniers articles et portfolios sous forme de tabs', 'text_domain' ), ) // Args
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
                    <div class="sidebar-tabs two-tabs">
                    
                        <ul class="sidebar-tabs-nav">
                            <li class="sidebar-tab-first"><h2 class="sidebar-tabs-title" ><a href="#tabs-1">Les derniers articles</a></h2></li>
                            <li class="sidebar-tab-last"><h2 class="sidebar-tabs-title"><a href="#tabs-2">Les derniers portfolios</a></h2></li>
                        </ul>

                        <div class="sidebar-tabs-container">
                            <div class="sidebar-tabs-content">
                                
                                    <section id="tabs-1">

					<?php
					$q = new WP_Query(array( 'posts_per_page' => SIDEBAR_TWO_TABS_LIMIT, 'cat'=> -13));
					while ( $q->have_posts() ) : $q->the_post();
					?>
                                        <article>
                                            <header>
                                                <p class="post-meta"><time datetime="<?php echo the_time('Y-m-d')?>" class="post-date"><?php echo the_time('d/m/Y')?></time> — Rédigé par <a href="<?php the_author_link(); ?>" class="author-link"><?php the_author()?></a></p>
                                                <h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
                                            </header>
                                                <p class="post-excerpt"><?php the_excerpt()?></p>
                                                <a href="<?php the_permalink()?>" class="readmore-link">Lire la suite</a>
                                        </article>
					<?php endwhile; wp_reset_postdata(); ?>
				    </section>
              
               
                                    <section id="tabs-2">

					<?php
					$q2 = new WP_Query(array( 'posts_per_page' => SIDEBAR_TWO_TABS_LIMIT, 'category_name' => 'lectures-de-portfolio'));
					while ( $q2->have_posts() ) : $q2->the_post();
					?>
                                        <article>
                                            <header>
                                                <p class="post-meta"><time datetime="<?php echo the_time('Y-m-d')?>" class="post-date"><?php echo the_time('d/m/Y')?></time> — Rédigé par <a href="<?php the_author_link(); ?>" class="author-link"><?php the_author()?></a></p>
                                                <h3><a href="<?php the_permalink()?>"><?php the_title()?></a></h3>
                                            </header>
                                                <p class="post-excerpt"><?php the_excerpt()?></p>
                                                <a href="<?php the_permalink()?>" class="readmore-link">Lire la suite</a>
                                        </article>
					<?php endwhile; wp_reset_postdata(); ?>
				    </section>
                            </div>
                        </div>


                        <div class="sidebar-tabs-footer round-corner-bottom">
                        <a href="#" class="post-link">Poster un article</a>
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
