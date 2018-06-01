<?php 
class Agent_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'agent_widget',
			'description' => 'Display Property assigned agent',
		);
		parent::__construct( 'agent_widget', 'Agents', $widget_ops );

	}

	public static function init(){

		add_action('widgets_init', array( __CLASS__ , 'register_agent_widget'));
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		$title = apply_filters( 'widget_title', $instance[ 'title' ] );
			global $post;
			$queried_object = get_queried_object();		
			
			$attached = get_post_meta( $queried_object->ID, 'attached_cmb2_attached_posts', true );
			if (is_array($attached) || is_object($attached)) {
			foreach ( $attached as $attached_post ) {
			echo "<div class='agent-widget'>";
   			 $post = get_post( $attached_post );

   			 /* Call the metabox here */
   			 $title = get_post_meta( get_the_ID(), 'agent_title', true );
   			 $tel =  get_post_meta( get_the_ID(), 'agent_telephone', true );
   			 $mobile =  get_post_meta( get_the_ID(), 'agent_mobile', true );
   			 $email = get_post_meta( get_the_ID(), 'agent_email', true );
   			 $address = get_post_meta( get_the_ID(), 'agent_address', true );

   			 the_post_thumbnail('medium');
   			 /*
   			  * Displays or returns the title of the current post
   			  * codex: https://codex.wordpress.org/Function_Reference/the_title
   			  */
   			 echo '<div class="agent-title">';
   			 the_title("<h3 class='entry-title'>","</h3>");
   			 if(!empty( $title )) { echo "<span>" . $title . "</span>"; }

   			 echo "</div><ul class='agent-list'>";
   			 if(!empty( $tel )) { echo "<li class='tel'>" . $tel . "</li>"; }
   			 if(!empty( $mobile )) { echo "<li class='mobile'>" . $mobile . "</li>"; }
   			 if(!empty( $email )) { echo "<li class='email'>" . $email . "</li>"; }
   			 if(!empty( $address )) { echo "<li class='address'>" . $address . "</li>"; }
   			 echo "</ul> </div>";
			}}

	
		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin

	  $title = ! empty( $instance['title'] ) ? $instance['title'] : ''; ?>
  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $title ); ?>" />
  </p><?php 
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
  $instance = $old_instance;
  $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
  return $instance;
	}

	public static function register_agent_widget() {
    register_widget('Agent_Widget');
}

}

Agent_Widget::init();