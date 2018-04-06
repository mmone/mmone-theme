<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen_mm
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="site-content-contain">
	<div class="site-content">
			<div class="wrap">
					<div class="sub-header">
						<?php 
						get_template_part( 'template-parts/frontpage/featured-posts','none');
						get_template_part( 'template-parts/frontpage/tag-cloud','none');
						?>
					</div>
					<!--<div class="recent-posts">-->
					<h1 class="frontpage-heading"><?php _e( 'Recent Posts', 'twentyeleven' ); ?></h1>
					<?php
						// Display our recent posts, showing full content for the very latest, ignoring Aside posts.
					$recent_args = array(
						'order' => 'DESC',
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'terms' => array( 'post'),
								'field' => 'slug',
								'operator' => 'IN',
							),
						),
						'ignore_sticky_posts' => 1,
						'no_found_rows' => true,
						'posts_per_page' => 15,
					);

					// Our new query for the Recent Posts section.
					$recent = new WP_Query( $recent_args );
				
					$postCount = 1;
					?>
					
					<?php while ( $postCount < 13	) : ?>
						<!--
						<?php if ( $postCount == 5 || $postCount == 15 ) : ?>
							<div class="recent-post-pane nohover">
								<span class="ad-caption">Advertising</span>
								<div class="ad">
									<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
									<ins class="adsbygoogle"
										style="display:inline-block;width:200px;height:200px"
										data-ad-client="ca-pub-2100893998876414"
										data-ad-slot="5569392017">
									</ins>
									<script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
								</div>
							</div>
						<?php else: ?> -->
						<?php if ($recent->have_posts()) { $recent->the_post(); }?>
									<div class="recent-post-pane">								
										<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'twentyeleven' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
											<p class="recent-post-title"><?php the_title() ?></p>
											<?php if ( has_post_thumbnail() ) : ?>
												<?php
												$titlestring = the_title_attribute('echo=0');
												the_post_thumbnail('recent-post-thumb', array('title' => $titlestring , 'alt' => $titlestring ) ); 
											?>
											<?php else : ?>
												<div class="recent-post-excerpt"><?php the_excerpt(); ?></div>
											<?php endif; ?>
										</a>					
									</div>
						<?php endif; ?>
						<?php $postCount++; ?>
					<?php endwhile; ?>
					<a href="/category/post/"><div class="recent-post-pane more"><span>MORE ...</span></div></a>
					<!--</div> --><!-- .recent-posts-->
				
				<!--<div class="recent-bookmarks">-->
					<h1 class="frontpage-heading"><?php _e( 'Recent Notes', 'twentyeleven' ); ?></h1>				
					<?php
					$bookmark_args = array(
						'order' => 'DESC',
						'tax_query' => array(
							array(
								'taxonomy' => 'category',
								'terms' => array( 'notes'),
								'field' => 'slug',
								'operator' => 'IN',
							),
						),
						'posts_per_page' => 13,
						'no_found_rows' => true,
					);
					$bookmarks = new WP_Query( $bookmark_args );
					$bookmarkCount = 1;
			
					while ( $bookmarkCount < 14	) : ?>
						<!--
						<?php if ( $bookmarkCount == 0 ) : ?>
							<div class="bookmark-pane nohover">
								<span class="ad-caption">Advertising</span>
								<div class="ad nohover" >
									<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
									<ins class="adsbygoogle"
									style="display:inline-block;width:468px;height:60px"
									data-ad-client="ca-pub-2100893998876414"
									data-ad-slot="2476324812"></ins>
									<script>
									(adsbygoogle = window.adsbygoogle || []).push({});
									</script>
								</div>
							</div>
						<?php else: ?>
							-->
							<?php if ($bookmarks->have_posts()) { $bookmarks->the_post(); }?>
							<?php $posttags =  get_the_tags(); ?>
								<div class="bookmark-pane">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									
									<p class="bookmark-title"><?php the_title(); ?></p>
									<p class="bookmark-tags">
										<?php if ($posttags) {
											foreach($posttags as $tag) {
												echo $tag->name . ' / '; 
											}
										}?>
									</p>
									</a>					
									
								</div>
						<?php endif; ?>
						<?php $bookmarkCount++; ?>
					<?php endwhile; ?>			
					<a href="/category/notes/"><div class="bookmark-pane more"><span>MORE ...</span></div></a>
					<!--</div>--> <!-- .bookmarks --> 
				
			</div> <!-- .wrap-->
	</div> <!-- .site-content-->
</div> <!-- .site-content-contain -->

<?php get_footer();
