<?php
// GET LISTING POST
$listingPostsArgs = array(
	'category_name'    => 'senarai',
	'orderby'          => 'date',
	'order'            => 'DESC',
	'post_type'        => 'post',
	'post_status'      => 'publish',
	'suppress_filters' => true
);
$listingPosts = get_posts( $listingPostsArgs );
$listingPosts = ($listingPosts && count($listingPosts)) ? obj_to_array($listingPosts) : NULL;
$hasListingPosts = $listingPosts ? TRUE : FALSE;

if($hasListingPosts) {
	?>
	<div id="listing">
		<div id="listing_header">
			<div id="listing_title">
				<h1>Property Listing</h1>
				<a href="<?php echo get_site_url(); ?>/listing-page/">See All</a>
			</div>
		
			<form action="listing-page" method="get" id="listing_search">
				<input type="text" name="keyword" value="" />
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>
		
		<div id="listing_wrapper">
			<div class="listing-section">
			<?php
			foreach($listingPosts as $post) {
				$url = get_permalink($post['ID']);
				$title = $post['post_title'];
				$image = get_the_post_thumbnail_url($post['ID'], 'full');
				$date = get_the_date('l, j/m/Y',$post['ID']);
				?>
				<div class="listing-item">
					<a class="listing-item-link" href="<?php echo $url; ?>">
						<div class="listing-item-image" style="background-image: url(<?php echo $image; ?>);"></div>
						<div class="listing-item-info">
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
	<?php
}





































?>