<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in Twenty Twelve consists of a page content area for adding text, images, video --
 * anything you'd like -- followed by front-page-only widgets in one or two columns.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header();
?>
<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php
		if(is_front_page()) {
			echo "<div id=\"banner\">\n";
			echo do_shortcode('[slide-anything id="5"]'); 
			echo "</div>\n";
			
			require_once('front-page/services.php');
			
			require_once('front-page/listing.php');
			
			require_once('front-page/articles.php');			
			
			require_once('front-page/contact.php');	
			
		} else {
			while ( have_posts() ) : the_post();
				echo "<div class=\"single-entry\">\n";
				$post = obj_to_array(get_post());
				get_template_part( 'content', 'page' );
				echo "</div>\n";
			endwhile;
		}
		?>
	</div>
</div>
<?php get_footer(); ?>