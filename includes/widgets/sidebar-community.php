<?php

/**
 * Tabs derniers articles et derniers portfolios
 */

class Sidebar_Community_Widget extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */

	public function __construct() {
		parent::__construct
		(
	 		'sidebar_community_widget', // Base ID
			'Rejoignez notre communauté', // Name
			array( 'description' => __( 'Affiche les liens pour s\'inscrire ou se connecter' , 'text_domain'), ) // Args
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
		$texte = apply_filters( 'widget_texte', $instance['texte'] );
		echo $before_widget;
		if ( ! empty( $title ) )
			echo $before_title . $title . $after_title;
		?>

		<?php if ( ! empty( $texte ) )
			echo "<p>".$texte."</p>" ;
		?>

		<p class="orange community-widget-links"><a href="" class="orange">S'inscrire</a> | <a href="" class="orange">Se connecter</a></p>
                   
                    
                <?php
		echo $after_widget;
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
		$instance['texte'] = strip_tags( $new_instance['texte'] );
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

		if ( isset( $instance[ 'texte' ] ) ) {
		$texte = $instance[ 'texte' ];
		}
		else {
			$title = __( 'Insérer texte', 'text_domain' );
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
			<label for="<?php echo $this->get_field_id( 'texte' ); ?>"><?php _e( 'Texte:' ); ?></label> 
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'texte' ); ?>" name="<?php echo $this->get_field_name( 'texte' ); ?>" type="text" ><?php echo esc_attr( $texte ); ?></textarea>
		</p>

		<?php 
	}

}
