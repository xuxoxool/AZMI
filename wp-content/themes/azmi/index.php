<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

$searchKeyword = (!empty($_GET) && isset($_GET['s']) && trim($_GET['s'])) ? trim($_GET['s']) : NULL;
get_header();
$url=strtok($_SERVER["REQUEST_URI"],'?');
?>

	<div id="primary" class="site-content">
		<div id="content" role="main">
			<div id="blog">
				<header id="blog_header">
					<h1>List of Articles</h1>
				</header>

				<div id="blog_content">
					<form action="blog-page" method="get" id="blog_search">
						<h3>Search</h3>
						
						<input type="text" id="search_keyword" name="s" value="<?php echo $searchKeyword; ?>" placeholder="Keyword..." />
						
						<button type="submit" id="search_button"><i class="fa fa-search"></i>&nbsp;Search</button>
						<a href="<?php echo $url; ?>" id="search_clear"><i class="fa fa-undo"></i>&nbsp;Reset</a>
					</form>
					
					<div id="blog_list">
					<?php if ( have_posts() ) : ?>
						<?php
							while ( have_posts() ) : the_post();
							$post = obj_to_array(get_post());
							$url = get_permalink($post['ID']);
							$title = $post['post_title'];
							$image = get_the_post_thumbnail_url($post['ID'], 'full');
							$date = get_the_date('l, j/m/Y',$post['ID']);
							?>
							<div class="blog-article">
								<a class="blog-article-link" href="<?php echo $url; ?>">
									<div class="blog-article-image" style="background-image: url(<?php echo $image; ?>);"></div>
									<div class="blog-article-info">
										<h3><?php echo $title; ?></h3>
										<span><?php echo $date; ?></span>
									</div>
								</a>
							</div>
						<?php endwhile; ?>
					<?php else : ?>
						<h1>No entry found</h1>
					<?php endif;?>
					</div>

					<?php get_content_nav(); ?>
				</div>
			</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
