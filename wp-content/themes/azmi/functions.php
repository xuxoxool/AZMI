<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );
         
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_separate', trailingslashit( get_stylesheet_directory_uri() ) . 'ctc-style.css', array( 'chld_thm_cfg_parent','twentytwelve-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css' );

// END ENQUEUE PARENT ACTION

////////////////////////////////////////
// ADMIN PANEL EXTEND : START
function editor_remove_formats() {
	remove_theme_support('post-formats');
}
add_action('after_setup_theme', 'editor_remove_formats', 100);

function admin_style() {
  wp_enqueue_style('admin-bootstrap-styles', get_stylesheet_directory_uri().'/assets/css/bootstrap.grid.css');
  wp_enqueue_style('admin-extension-styles', get_stylesheet_directory_uri().'/assets/css/extension.admin.css');
}
add_action('admin_enqueue_scripts', 'admin_style');

function add_featured_post_box() {
	add_meta_box('feature_meta_box', 'Featured Post', 'draw_feature_box', 'post', 'side' );
}
add_action('add_meta_boxes', 'add_featured_post_box');

function draw_feature_box($post) {
	wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
	
	$isFeatured = get_post_meta($post->ID,'post_featured',true);
	
	include( locate_template('admin/post-feature.php', false, false) );
}

function save_post_featured($post_id) {
	if (array_key_exists('post_featured', $_POST)) {
		$args = array(
			'posts_per_page'   => -1,
			'meta_key'         => 'post_featured',
			'meta_value'       => '1',
			'post_type'        => 'post'
		);
		$posts_array = get_posts( $args );
		if(count($posts_array)) {
			for($i = 0; $i < count($posts_array); $i++) {
				$post = obj_to_array($posts_array[$i]);
				$postID = $post['ID'];
				
				delete_post_meta($postID, 'post_featured');
			}
		}
	
		update_post_meta($post_id, 'post_featured', '1');
	} else {
		$isFeatured = get_post_meta($post_id,'post_featured',true);
		if($isFeatured) delete_post_meta($post_id, 'post_featured');
	}
}
add_action('save_post', 'save_post_featured');

function featured_columns_head($defaults) {
	$defaults['featured_image'] = 'Image';
	$defaults['post_featured'] = 'Featured?';
	return $defaults;
}
add_filter('manage_posts_columns', 'featured_columns_head');
 
function featured_columns_content($column_name, $post_ID) {
	if ($column_name == 'featured_image') {
		$postImage = get_the_post_thumbnail($post_ID);
		if ($postImage) echo "<div class=\"column-featured_image-item\">".($postImage)."</div>";
	}
	if ($column_name == 'post_featured') {
		$isFeatured = get_post_meta($post_ID,'post_featured',true);
		if ($isFeatured) echo "<div style=\"text-align:center; font-size: 10px; font-weight: bold;\">YES</div>";
	}
}
add_action('manage_posts_custom_column', 'featured_columns_content', 10, 2);

function df_disable_comments_post_types_support() {
// Disable support for comments and trackbacks in post types
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'df_disable_comments_post_types_support');

function df_disable_comments_status() {
	// Close comments on the front-end
	return false;
}
add_filter('comments_open', 'df_disable_comments_status', 20, 2);
add_filter('pings_open', 'df_disable_comments_status', 20, 2);

function df_disable_comments_hide_existing_comments($comments) {
// Hide existing comments
	$comments = array();
	return $comments;
}
add_filter('comments_array', 'df_disable_comments_hide_existing_comments', 10, 2);

function df_disable_comments_admin_menu() {
// Remove comments page in menu
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'df_disable_comments_admin_menu');

function df_disable_comments_admin_menu_redirect() {
// Redirect any user trying to access comments page
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'df_disable_comments_admin_menu_redirect');

function df_disable_comments_dashboard() {
// Remove comments metabox from dashboard
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'df_disable_comments_dashboard');

function df_disable_comments_admin_bar() {
// Remove comments links from admin bar
	if (is_admin_bar_showing()) {
		remove_action('admin_bar_menu', 'wp_admin_bar_comments_menu', 60);
	}
}
add_action('init', 'df_disable_comments_admin_bar');

function wporg_register_taxonomy_location() {
	$labels = [
		'name'      				=> _x('Locations', 'taxonomy general name'),
		'singular_name'     => _x('Location', 'taxonomy singular name'),
		'search_items'      => __('Search Locations'),
		'all_items'         => __('All Locations'),
		'parent_item'       => __('Parent Location'),
		'parent_item_colon' => __('Parent Location:'),
		'edit_item'         => __('Edit Location'),
		'update_item'       => __('Update Location'),
		'add_new_item'      => __('Add New Location'),
		'new_item_name'     => __('New Location Name'),
		'menu_name'         => __('Location'),
	];
	
	$args = [
		'hierarchical'      => true, // make it hierarchical (like categories)
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => ['slug' => 'location'],
	];
	
	register_taxonomy('location', ['post'], $args);
}
add_action('init', 'wporg_register_taxonomy_location');
// ADMIN PANEL EXTEND : END
////////////////////////////////////////

///////////////////////////////////////
// CUSTOM FUNCTIONS : START

if(!function_exists( 'get_content_nav' )) {
	function get_content_nav() {
		global $wp_query;

		if ( $wp_query->max_num_pages > 1 ) {
			?>
			<nav id="blog_nav" class="navigation" role="navigation">
				<div id="blog_nav_prev"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?></div>
				<div id="blog_nav_next"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?></div>
			</nav>
			<?php
		}
	}
}

if(!function_exists('get_list_of_locations')) {
	function get_list_of_locations() {
		$list = get_terms( array(
			'taxonomy' => 'location',
			'hide_empty' => false,
		));
		
		$locations = NULL;
		if(!empty($list)) {
			foreach($list as $key=>$value) {
				$location = obj_to_array($value);
				
				if($location['parent']) {
					if(!isset($locations[$location['parent']])) {
						$locations[$location['parent']]['id'] = $location['term_id'];
						$locations[$location['parent']]['name'] = $location['name'];
						$locations[$location['parent']]['slug'] = $location['slug'];
						$locations[$location['parent']]['children'] = array();
					}
						
					$c = count($locations[$location['parent']]['children']);
					$locations[$location['parent']]['children'][$c]['id'] = $location['term_id'];
					$locations[$location['parent']]['children'][$c]['name'] = $location['name'];
					$locations[$location['parent']]['children'][$c]['slug'] = $location['slug'];
				} else {
					$locations[$location['term_id']]['id'] = $location['term_id'];
					$locations[$location['term_id']]['name'] = $location['name'];
					$locations[$location['term_id']]['slug'] = $location['slug'];
					
					if(!isset($locations[$location['term_id']]['children'])) {
						$locations[$location['term_id']]['children'] = array();
					}
				}
			}
		}
		
		if($locations) {
			foreach($locations as &$location) {
				$location['isParent'] = (count($location['children'])) ? TRUE : FALSE;
			}
		}
		
		return $locations;
	}
}

if(!function_exists('get_children_by_parent_id')) {
	function get_children_by_parent_id($parent) {
		$my_wp_query = new WP_Query();
		$all_wp_pages = $my_wp_query->query(array('post_type' => 'page', 'posts_per_page' => '-1'));
		$children = get_page_children( $parent, $all_wp_pages );
		$children = ($children) ? obj_to_array($children) : NULL;
		return $children;
	}
}

if(!function_exists('get_post_subtitle')) {
	function get_post_subtitle($post) {
		return get_post_meta($post, 'wps_subtitle', true);
	}
}

if(!function_exists('obj_to_array')) {
	function obj_to_array($obj) {
		return ($obj) ? json_decode(json_encode($obj),true) : NULL;
	}
}

if(!function_exists('debug')) {
	function debug($item) {
		echo "<pre>";
		print_r($item);
		echo "</pre>";
	}
}
// CUSTOM FUNCTIONS : END
///////////////////////////////////////
