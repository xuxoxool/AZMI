<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$image = (has_post_thumbnail()) ? get_the_post_thumbnail_url($post['ID'], 'full') : NULL;
$subtitle = get_post_subtitle($post['ID']);
$locations = get_list_of_locations();

$searchLocation = (!empty($_GET) && isset($_GET['location']) && trim($_GET['location'])) ? trim($_GET['location']) : NULL;
$searchKeyword = (!empty($_GET) && isset($_GET['keyword']) && trim($_GET['keyword'])) ? trim($_GET['keyword']) : NULL;
?>

<article id="post-<?php $post['ID']; ?>" <?php post_class(('article-entry'.($image?' has-image':''))); ?>>

	<header class="entry-header" <?php echo ($image) ? " style=\"background-image: url(".$image.");\"" : ""; ?>>
		<div class="entry-title">
			<h1><?php echo $post['post_title']; ?></h1>
			<?php
			if($subtitle) {
				?><h3><?php echo $subtitle; ?></h3><?php
			}
			?>
		</div>
	</header>

	<div class="entry-content">
		<div id="listing">
			<form action="" method="get" id="listing_search">
				<h3>Search</h3>
				
				<select id="listing_location" name="location">
					<option value="">All Location</option>
					<?php
					if($locations) {
						foreach($locations as $key=>$value) {
							if($value['isParent']) {
								?>
								<optgroup label="<?php echo $value['name']; ?>">
								<?php
								foreach($value['children'] as $children) {
									?>
									<option value="<?php echo $children['id']; ?>" <?php ($searchLocation == $children['id']) ? 'selected' : ''; ?>><?php echo $children['name']; ?></option>
									<?php
								}
								?>
								</optgroup>
								<?php
							} else {
								?>
								<option value="<?php echo $value['id']; ?>" <?php ($searchLocation == $children['id']) ? 'selected' : ''; ?>><?php echo $value['name']; ?></option>
								<?php
							}
							?>
							<?php
						}
					}
					?>
				</select>
				
				<input type="text" id="listing_keyword" name="keyword" value="<?php echo $searchKeyword; ?>" placeholder="Keyword..." />
				
				<button type="submit" id="listing_button"><i class="fa fa-search"></i>&nbsp;Search</button>
			</form>
			
			<div id="listing_result">
			<?php
			$listingPostsArgs = array(
				'category_name'    => 'senarai',
				'orderby'          => 'date',
				'order'            => 'DESC',
				'post_type'        => 'post',
				'post_status'      => 'publish',
				'suppress_filters' => true,
				
			);
			
			if($searchLocation) {
				$listingPostsArgs['tax_query'] = array(
						array(
								'taxonomy' => 'location',
								'field' => 'term_id',
								'terms' => $searchLocation
						)
				);
			}
			
			if($searchKeyword) {
				$listingPostsArgs['s'] = $searchKeyword;
			}
			
			$listingPosts = get_posts( $listingPostsArgs );
			$listingPosts = ($listingPosts && count($listingPosts)) ? obj_to_array($listingPosts) : NULL;
			$hasListingPosts = $listingPosts ? TRUE : FALSE;
			
			if($hasListingPosts) {
				foreach($listingPosts as $property) {
					$url = get_permalink($property['ID']);
					$title = $property['post_title'];
					$image = get_the_post_thumbnail_url($property['ID'], 'full');
					$date = get_the_date('l, j/m/Y',$property['ID']);
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
			} else {
				?><h1>No property found</h1><?php
			}
			?>
			</div>
		</div>
	</div>
</article>
