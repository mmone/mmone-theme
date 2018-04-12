<?php
/**
 * @package WordPress
 * @subpackage Twenty_Seventeen_mm
 * @since 1.0
 * @version 1.0
 * @author Martin Muehlhaeuser
 */
?>

<div class="tag-cloud"><!-- tag-cloud -->
	<h1 class="frontpage-heading"><?php _e( 'Tags', 'twentyseventeen' ); ?></h1>
	<?php
		$args = array(
		'smallest'                  => 0.9, 
		'largest'                   => 1.9,
		'unit'                      => 'em', 
		'number'                    => 200,  
		'format'                    => 'flat',
		'orderby'                   => 'name', 
		'order'                     => 'RND',
		'exclude'                   => null, 
		'include'                   => null, 
		'link'                      => 'view', 
		'taxonomy'                  => 'post_tag', 
		'echo'                      => true );
	
		wp_tag_cloud( $args );
	?> 
</div><!-- .tag-cloud -->