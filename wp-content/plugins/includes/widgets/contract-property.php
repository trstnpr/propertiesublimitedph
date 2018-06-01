<?php 
class Contract_widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'contract_widget',
			'description' => 'Rent/Sale Widget',
		);
		parent::__construct( 'contract_widget', 'Rent/Sale Widget', $widget_ops );

	}

	public static function init(){

		add_action('widgets_init', array( __CLASS__ , 'register_contract_widget'));
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
	$nprop =  $instance[ 'nproperties' ];
	$contract = $instance[ 'contract'];

	echo $args['before_widget'] . $args['before_title'] . $title . $args['after_title'];

	$args = array(
		'post_type'=>'property',
		'posts_per_page'  => $nprop,
		    'meta_query' => array(
                    array(
                        'key' => '_realest_contract',
                        'value' => array($contract),
                        'compare' => 'IN',
                    )
                )
		);
	$wp_query = new WP_Query( $args );
		
	if( $wp_query->have_posts()){
		echo '<ul class="property-widget">';
		while($wp_query->have_posts()) {
			$wp_query->the_post(); ?>

			<li class="cleared">

			<div class="col-4-12">
			<?php echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">';
			the_post_thumbnail('thumbnail'); 
			echo '</a>';
			?> </div>

			<div class="col-8-12 details">
			<?php the_title( '<h4 class="title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>');

			 $rooms = get_post_meta( get_the_ID(), '_realest_rooms', true );
            if ( ! empty( $rooms ) ) :
               echo  esc_attr( 'Rooms: ', 'pt-real-estate-proffesional' ), '<span>' . esc_attr( $rooms ) . '</span>';
            endif; 

            $bedrooms = get_post_meta( get_the_ID(), '_realest_bedrooms', true );
            if ( ! empty( $bedrooms ) ) :
               echo  esc_attr( 'Beds: ', 'pt-real-estate-proffesional' ), '<span>' .esc_attr( $bedrooms ) .'</span>';
            endif;

            $baths = get_post_meta( get_the_ID(), '_realest_baths', true );
            if ( ! empty( $baths ) ) :
               echo  esc_attr( 'Baths: ', 'pt-real-estate-proffesional' ), '<span>' . esc_attr( $baths ) .'</span>';
            endif;

          $price = get_post_meta( get_the_ID(), '_realest_price', true ); ?>
        <?php if ( ! empty( $price ) ) : ?>
          <span class="price"><?php echo get_theme_mod('realest_currency') ;  echo wp_kses( $price, wp_kses_allowed_html( 'post' ) ); echo get_post_meta( get_the_ID(), '_realest_suffix', true );?></span>
        <?php endif;
            ?>

			</div>
			</li>
			<?php
		}
		echo '</ul>';
	}
	wp_reset_postdata();

	echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin

	  $title = ! empty( $instance['title'] ) ? $instance['title'] : '';
	  $nproperties = ! empty( $instance['nproperties'] ) ? $instance['nproperties'] : '';
	  $contract = ! empty( $instance['contract'] ) ? $instance['contract'] : '';
	   ?>
  <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label><br/>
    <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="Latest Properties" />
  </p>
  <p>
    <label for="<?php echo $this->get_field_id( 'nproperties' ); ?>">Number Of Properties:</label><br/>
    <input type="text" id="<?php echo $this->get_field_id( 'nproperties' ); ?>" name="<?php echo $this->get_field_name( 'nproperties' ); ?>" value="4" />
  </p>

  <p>
  <label for="<?php echo $this->get_field_id( 'contract' ); ?>">Contract Type:</label><br/>

  <select id="<?php echo $this->get_field_name( 'contract' ); ?>" name="<?php echo $this->get_field_name( 'contract' ); ?>">
  <option value="rental" selected="selected">Rental</option>
  <option value="sale">Sale</option>
  <option value="sold">Sold</option>
</select>
  </p>
  <?php 
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
  $instance[ 'nproperties' ] = strip_tags( $new_instance[ 'nproperties' ] );
  $instance['contract'] = $new_instance['contract'];
  return $instance;
	}

	public static function register_contract_widget() {
    register_widget('Contract_widget');
}

}

Contract_widget::init();