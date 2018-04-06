<div class="featured-posts">
<?php
$sticky = get_option( 'sticky_posts' );
$args = array(
	'posts_per_page' => 1,
	'post__in'  => $sticky,
	'ignore_sticky_posts' => 1
);
$query = new WP_Query( $args );
if ( isset($sticky[0]) ):?>
	<?php $query->the_post(); ?>
	<?php $titlestring=the_title_attribute( 'echo=0' ); ?>
	<div class="featured-title"><?php echo $titlestring?></div>
	<a href="<?php the_permalink(); ?>" title="<?php echo $titlestring?>" rel="bookmark">
		<?php the_post_thumbnail('featured-thumb', array('title' => $titlestring , 'alt' => $titlestring ) );?>
	</a>
	<div class="featured-excerpt">
		<?php $ex = get_the_excerpt(); ?>
		<?php echo $ex ?>
	</div>
<?php endif;?>
</div>