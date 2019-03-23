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
		<?php the_content(); ?>
		
		<?php
		if(strtolower($post['post_name']) === 'about-us' || strtolower($post['post_name']) === 'our-services') {
			$postName = strtolower($post['post_name']);
			include(locate_template( 'content-childpage.php', false, false));
		} else if (strtolower($post['post_name']) === 'contact-us') {
			include(locate_template('content-pages/contact-us.php',false,false));
		}
		?>
	</div>
</article>
