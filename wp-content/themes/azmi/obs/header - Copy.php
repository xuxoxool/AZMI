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
</head>

<body <?php body_class("hold-transition roboto"); ?>>
	<div id="main_wrapper">
		<div id="page" class="hfeed loading">
		
			
		<div class="header">
			<a class="header-logo" href="<?php echo get_stylesheet_directory_uri(); ?>/hub">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/logo.png" />
			</a>
			<div class="header-toggle"><span></span><span></span><span></span></div>
			<div class="header-info">
				<div class="header-info-item"><i class="fa fa-map-marker"></i><strong>A9-3-3 (2nd Floor), Jalan Ampang Utama 2/2,</strong></div>
				<div class="header-info-item"><i></i><strong>One Ampang Business Avenue,</strong></div>
				<div class="header-info-item"><i></i><strong>68000 Ampang, Selangor Darul Ehsan</strong></div>
				<div class="header-info-item"><i class="fa fa-phone"></i>Tel: 03-4256 6666 / Fax: 03-4252 5252</div>
				<div class="header-info-item"><i class="fa fa-envelope"></i>Email: azmico@azmigroup.com.my</div>
			</div>
		</div>
		
		<?php if(is_front_page()) : ?>
		<div class="banner">
		</div>
		<?php endif; ?>
		
			<header id="masthead" class="site-header" role="banner">
				<hgroup>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
				</hgroup>

				<nav id="site-navigation" class="main-navigation" role="navigation">
					<button class="menu-toggle"><?php _e( 'Menu', 'twentytwelve' ); ?></button>
					<a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to content', 'twentytwelve' ); ?>"><?php _e( 'Skip to content', 'twentytwelve' ); ?></a>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
				</nav><!-- #site-navigation -->

				<?php if ( get_header_image() ) : ?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
				<?php endif; ?>
			</header><!-- #masthead -->

			<div id="main" class="wrapper">