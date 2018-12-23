<?php 
/*
Plugin Name: 	Custom Widget Custom Grid
Plugin URI: 	
Description: 	This Plugin Only Demo
Version: 		1.0
Author: 		Tushar Imran
Author URI: 	tusharimran9909@gmail.com
*/


// Register and load the widget
function cwcg_load_widget() {
    register_widget( 'cwcg_test_grid_widget' );
}
add_action( 'widgets_init', 'cwcg_load_widget' );


// Creating the widget 
class cwcg_test_grid_widget extends WP_Widget {
 
	function __construct() {
		parent::__construct(
		'cwcg_grid_test_widget',
		esc_html__('Grid Testing Widget', 'listinger'),
		array( 'description' => esc_html__( 'This widget only develop for testing widget grid', 'listinger' ), ) 
		);
	}

	 
	// Creating widget front-end
	public function widget( $args, $instance ) {
	    extract($args);
	    // get grid name from instance
	    $grid_name = (isset($instance[ 'grid_name' ]) ? $instance[ 'grid_name' ] : '');

	    $widget_width = !empty($instance['widget_width']) ? $instance['widget_width'] :  $grid_name;
	    /* Add the class name from $widget_width to the class from the $before widget */
	    // no 'class' attribute - add one with the value of width
	    if( strpos($before_widget, 'class') === false ) {
	      // include closing tag in replace string
	      $before_widget = str_replace('>', 'class="'. $widget_width . '">', $before_widget);
	    }
	    // there is 'class' attribute - append width value to it
	    else {
	      $before_widget = str_replace('class="', 'class="'. $widget_width . ' ', $before_widget);
	    }
	    /* Before widget */
	    echo $before_widget;
	    ?>
	    <div style="
		    height: 300px;
		    justify-content: center;
		    background: #444444;
		    color: #ffffff;
		    display: flex;
		    align-items: center;" 
		class="grid-simple">
	    	<?php print  $grid_name; ?>
	    </div>
	    <?php
      echo $after_widget;
	}
	         
	// Widget Backend 
	public function form( $instance ) {
    	$grid_name = (isset($instance[ 'grid_name' ]) ? $instance[ 'grid_name' ] : '');
    ?>
      <p>
        <label for="<?php echo $this->get_field_id( 'grid_name' ); ?>"><?php _e( 'Grid Class Name: ' ); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id( 'grid_name' ); ?>" name="<?php echo $this->get_field_name( 'grid_name' ); ?>" type="text" value="<?php echo esc_attr( $grid_name ); ?>" />
      </p>
    <?php
	}
	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
      $instance['grid_name'] = ( ! empty( $new_instance['grid_name'] ) ) ? strip_tags( $new_instance['grid_name'] ) : '';
		return $instance;
	}
} 