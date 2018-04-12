<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen_mm
 * @since 1.0
 * @version 1.0
 * @author Martin Muehlhaeuser
 */

class RecentPostWidget extends WP_Widget {
 
    public function __construct() {
       parent::__construct(
           'mmone_recent_posts_widget', // Base ID
           'mmone Recent Posts', // Name
           array( 'description' => __( 'A mmone Widget', 'text_domain' ), ) // Args
       );
    }
 
    public function widget( $args, $instance ) {
       extract( $args );
       $title = apply_filters( 'widget_title', $instance['title'] );

       echo $before_widget;
       if ( ! empty( $title ) ) {
           echo $before_title . $title . $after_title;
       }
       $recent_post_args = array(
          'order' => 'DESC',
          'tax_query' => array(
             array(
                'taxonomy' => 'category',
                'terms' => array( 'post'),
                'field' => 'slug',
                'operator' => 'IN',
             ),
          ),
          'no_found_rows' => true,
          'posts_per_page' => 10,
       );

       $posts = new WP_Query( $recent_post_args );
		 
       $recent_notes_args = array(
          'order' => 'DESC',
          'tax_query' => array(
             array(
                'taxonomy' => 'category',
                'terms' => array( 'notes'),
                'field' => 'slug',
                'operator' => 'IN',
             ),
          ),
          'no_found_rows' => true,
          'posts_per_page' => 10,
       );

       $notes = new WP_Query( $recent_notes_args );
		 
       $postCount = 1;
       while ( $postCount < 8	) : 
          if (($postCount % 2) == 0) {
             if($notes->have_posts()) {
                $notes->the_post();
                ?>
                   <div class="widget-note-pane">
                      <p class="widget-post-title">
                         <?php echo twentyseventeen_get_svg( array( 'icon' => 'pencil', 'title' => __( 'Notes post title', 'textdomain' ) ) ); ?>&nbsp;&nbsp;
                         <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>">
                          <?php the_title() ?>
                         </a>
                      </p>
                   </div> 
                </a>
                <?php
             }
          } else {
          	if($posts->have_posts()) {
               $posts->the_post();
               ?>
                  <div class="widget-post-pane">
                     <p class="widget-post-title"><?php the_title() ?></p>
                     <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>">
                     <?php if ( has_post_thumbnail() ) : ?>
                       <?php
                       $titlestring = the_title_attribute('echo=0');
                       the_post_thumbnail('recent-post-thumb', array('title' => $titlestring , 'alt' => $titlestring ) ); 
                       ?>
                      <?php endif ?>
                    </a>
                  </div> 
               <?php
            }
            
          }

       $postCount++;
       endwhile;
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
