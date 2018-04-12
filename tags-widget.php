<?php

/**
 * @package WordPress
 * @subpackage Twenty_Seventeen_mm
 * @since 1.0
 * @version 1.0
 * @author Martin Muehlhaeuser
 */

class TagsWidget extends WP_Widget {
 
    public function __construct() {
       parent::__construct(
           'mmone_tags_widget', // Base ID
           'mmone Tags', // Name
           array( 'description' => __( 'A mmone Widget', 'text_domain' ), ) // Args
       );
    }
 
    public function widget( $args, $instance ) {
       extract( $args );
       $title = apply_filters( 'widget_title', $instance['title'] );

       echo $before_widget;
       if ( ! empty( $title ) ) {
           echo $before_title . $title . $after_title;
       } ?>
       <div class="tag-cloud-widget"><!-- tag-cloud -->
       <?php
       $args = array(
       	'smallest'                  => 0.8, 
       	'largest'                   => 2,
       	'unit'                      => 'em', 
       	'number'                    => 100,  
       	'format'                    => 'flat',
       	'orderby'                   => 'name', 
       	'order'                     => 'RND',
       	'exclude'                   => null, 
       	'include'                   => null, 
       	'link'                      => 'view', 
       	'taxonomy'                  => 'post_tag', 
       	'echo'                      => true);
         
       	wp_tag_cloud( $args );
         ?>
         </div><!-- .tag-cloud -->
         <?php
       echo $after_widget;
    }
 
    public function form( $instance ) {
       if ( isset( $instance[ 'title' ] ) ) {
           $title = $instance[ 'title' ];
       }
       else {
           $title = __( 'New title', 'text_domain' );
       }
       ?>
       <p>
       <label for="<?php echo $this->get_field_name( 'title' ); ?>">
			 <?php _e( 'Title:' ); ?>
		 </label>
       <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
       </p>
       <?php
    }
 
    public function update( $new_instance, $old_instance ) {
       $instance = array();
       $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

       return $instance;
    }
 
}
?>
