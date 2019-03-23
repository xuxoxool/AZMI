<?php
// GET FEATURED POST
$featuredPostsArgs = array(
	'posts_per_page'   => 1,
	'category_name'    => 'artikel',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'meta_key'         => 'post_featured',
	'meta_value'       => '1',
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true
);
$featuredPosts = get_posts( $featuredPostsArgs );
$featuredPosts = ($featuredPosts && count($featuredPosts)) ? obj_to_array($featuredPosts[0]) : NULL;
$hasFeaturedPosts = $featuredPosts ? TRUE : FALSE;

// GET POSTS WITH IMAGES
$postWithImagesArgs = array(
	'posts_per_page'   => (!$hasFeaturedPosts ? 8 : 4),
	'category_name'    => 'artikel',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'meta_query' 			 => array(
													'relation' => 'AND',
													array('key' => '_thumbnail_id'),
													array('key'     => 'post_featured', 'compare' => 'NOT EXISTS')
												),
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true
);
$postWithImages = get_posts( $postWithImagesArgs );
$postWithImages = ($postWithImages && count($postWithImages)) ? obj_to_array($postWithImages) : NULL;
$hasPostWithImages = $postWithImages ? TRUE : FALSE;

// GET POSTS WITHOUT IMAGES
$postWithoutImagesArgs = array(
	'posts_per_page'   => (($hasFeaturedPosts || $hasPostWithImages) ? 12 : 8),
	'category_name'    => 'artikel',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'meta_query' 			 => array(
													'relation' => 'AND',
													array('key' => '_thumbnail_id', 'compare' => 'NOT EXISTS'),
													array('key'     => 'post_featured', 'compare' => 'NOT EXISTS')
												),
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true
);
$postWithoutImages = get_posts( $postWithoutImagesArgs );
$postWithoutImages = ($postWithoutImages && count($postWithoutImages)) ? obj_to_array($postWithoutImages) : NULL;
$hasPostWithoutImages = $postWithoutImages ? TRUE : FALSE;

if($hasFeaturedPosts || $hasPostWithImages || $hasPostWithoutImages) {
	?>
	<div id="articles">
		<div id="articles_header">
			<div id="articles_title">
				<h1>Latest News</h1>
				<a href="<?php echo get_site_url(); ?>/blog-page/">See All</a>
			</div>
			
			<form action="blog-page" method="get" id="articles_search">
				<input type="text" name="s" value="" />
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
		
		<div id="articles_wrapper">
			<div id="articles_<?php echo (!$hasPostWithoutImages) ? 'full' : 'left'; ?>">
				<div id="articles_<?php echo (!$hasPostWithoutImages) ? 'full' : 'left'; ?>_<?php echo (!$hasPostWithoutImages) ? 'left' : 'top'; ?>" class="<?php echo (!$hasFeaturedPosts) ? 'hidden' : ''; ?>">
					<?php
					$url = get_permalink($featuredPosts['ID']);
					$title = $featuredPosts['post_title'];
					$subtitle = get_post_subtitle($featuredPosts['ID']);
					$image = get_the_post_thumbnail_url($featuredPosts['ID'], 'full');
					$date = get_the_date('l, j/m/Y',$featuredPosts['ID']);
					?>
					<div class="articles-featured">
						<a class="articles-item-link" href="<?php echo $url; ?>" style="background-image: url(<?php echo $image; ?>);">
							<div class="articles-item-info">
								<h3><?php echo $title; ?> | <span><?php echo $date; ?></span></h3>
								<p><?php echo $subtitle; ?></p>
							</div>
						</a>
					</div>
				</div>
				<div id="articles_left_<?php echo (!$hasPostWithoutImages) ? 'right' : 'bottom'; ?>" class="<?php echo (!$hasPostWithImages) ? 'hidden' : ''; ?>">
					<div class="articles-section articles-withimage">
					<?php
					foreach($postWithImages as $post) {
						$url = get_permalink($post['ID']);
						$title = $post['post_title'];
						$image = get_the_post_thumbnail_url($post['ID'], 'full');
						$date = get_the_date('l, j/m/Y',$post['ID']);
						?>
						<div class="articles-item">
							<a class="articles-item-link" href="<?php echo $url; ?>">
								<div class="articles-item-image" style="background-image: url(<?php echo $image; ?>);"></div>
								<div class="articles-item-info">
									<h3><?php echo $title; ?></h3>
									<span><?php echo $date; ?></span>
								</div>
							</a>
						</div>
						<?php
					}
					?>
					</div>
				</div>
			</div>
			<div id="articles_right" class="<?php echo (!$hasPostWithoutImages) ? 'hidden' : ''; ?>">
				<div class="articles-section articles-withoutimage">
				<?php
				foreach($postWithoutImages as $post) {
					$url = get_permalink($post['ID']);
					$title = $post['post_title'];
					$date = get_the_date('l, j/m/Y',$post['ID']);
					?>
					<div class="articles-item">
						<a class="articles-item-link" href="<?php echo $url; ?>">
							<div class="articles-item-info">
								<span><?php echo $date; ?></span>
								<h3><?php echo $title; ?></h3>
							</div>
						</a>
					</div>
					<?php
				}
				?>
				</div>
			</div>
		</div>
	</div>
	<?php
}





































?>