<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!-- ASSETS -->
<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.ico">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/bootstrap.grid.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fonts/Font-Awesome/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/fonts/fonts.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/extension.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/main.css">
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/overwrite.css">
<?php
if (is_page_template( 'page-templates/front-page.php' ) ) {
	?><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/template/front-page.css"><?php
}

if (is_page_template( 'page-templates/full-width.php' ) || is_single()) {
	?><link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css/template/full-width.css"><?php
}
?>

<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/jquery-3.1.1.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/vendors/pace/pace.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/vendors/modernizr/modernizr.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/vendors/debounce/debounce.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/vendors/moment/moment-with-locales.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/utils.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/extension.js"></script>
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/main.js"></script>
<!-- ASSETS -->


<?php wp_head(); ?>

<?php
$currPostID = get_queried_object_id();
$currPostImage = is_front_page() ? TRUE : (($currPostID) ? (has_post_thumbnail($currPostID) ? TRUE : FALSE) : FALSE);
?>
</head>

<body <?php body_class("hold-transition roboto"); ?>>
	<div id="main_wrapper">
		<div id="page" class="hfeed loading">
		
		<div id="header" class="<?php echo $currPostImage ? '' : 'solid'; ?>">
			<a id="header_logo" href="<?php echo get_home_url(); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" />
			</a>
			<div id="header_toggle" data-action="menu"><span></span><span></span><span></span></div>
			<div id="header_info">
				<div class="header-info-item"><i class="fa fa-map-marker"></i><strong>A9-3-3 (2nd Floor), Jalan Ampang Utama 2/2,</strong></div>
				<div class="header-info-item"><i></i><strong>One Ampang Business Avenue,</strong></div>
				<div class="header-info-item"><i></i><strong>68000 Ampang, Selangor Darul Ehsan</strong></div>
				<div class="header-info-item"><i class="fa fa-phone"></i>Tel: 03-4256 6666 / Fax: 03-4252 5252</div>
				<div class="header-info-item"><i class="fa fa-envelope"></i>Email: azmico@azmigroup.com.my</div>
			</div>
		</div>
		
		<?php include('menu.php'); ?>
		
		<div id="main" class="wrapper <?php echo (is_front_page()) ? 'front-page' : ''; ?>">