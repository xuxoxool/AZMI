<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
$image = (has_post_thumbnail()) ? get_the_post_thumbnail_url(get_the_ID(), 'full') : NULL;
$subtitle = get_post_subtitle(get_the_ID());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(('article-entry'.($image?' has-image':''))); ?>>

	<header class="entry-header" <?php echo ($image) ? " style=\"background-image: url(".$image.");\"" : ""; ?>>
		<div class="entry-title">
			<h1><?php the_title(); ?></h1>
			<?php
			if($subtitle) {
				?><h3><?php echo $subtitle; ?></h3><?php
			}
			?>
		</div>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>
	
	<div class="entry-footer">
		<div class="nav-post nav-post-left">
		<?php
		if($prevPost = get_previous_post()) {
			$prevPost = obj_to_array($prevPost);
			$prevPostUrl = get_permalink($prevPost['ID']);
			$prevPostTitle = $prevPost['post_title'];
			$prevPostImage = get_the_post_thumbnail_url($prevPost['ID'], 'full');
			?>
			<a href="<?php echo $prevPostUrl; ?>" class="nav-post-item">
				<div class="nav-post-img" style="background-image: url(<?php echo ($prevPostImage); ?>);"></div>
				<div class="nav-post-title"><span><?php echo $prevPostTitle; ?></span></div>
			</a>
			<?php
		}
		?>
		</div>
		<div class="nav-post nav-post-right">
		<?php
		if($nextPost = get_next_post()) {
			$nextPost = obj_to_array($nextPost);
			$nextPostUrl = get_permalink($nextPost['ID']);
			$nextPostTitle = $nextPost['post_title'];
			$nextPostImage = get_the_post_thumbnail_url($nextPost['ID'], 'full');
			?>
			<a href="<?php echo $nextPostUrl; ?>" class="nav-post-item">
				<div class="nav-post-img" style="background-image: url(<?php echo ($nextPostImage); ?>);"></div>
				<div class="nav-post-title"><span><?php echo $nextPostTitle; ?></span></div>
			</a>
			<?php
		}
		?>
		</div>
		<div class="nav-see-all">
			<a class="" href="<?php echo get_site_url(); ?>/blog-page/">See All</a>
		</div>
	</div>
</article>
