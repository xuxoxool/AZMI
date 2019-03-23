<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>
		</div><!-- #main .wrapper -->
		<footer id="colophon" role="contentinfo">
			<div class="site-info">
				<?php do_action( 'twentytwelve_credits' ); ?>
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'twentytwelve' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'twentytwelve' ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentytwelve' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->
</div><!-- #main_wrapper -->
	
<div id="preloader">
	<div id="preloader_loader">
		<div class="line-scale">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
		</div>
	</div>
</div>

<div id="back_to_top"><i class="fa fa-caret-up"></i></div>

<?php wp_footer(); ?>
</body>
</html>