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
	
		<div id="footer">
			<div id="footer_wrapper">
				<div class="row">
					<div class="col-sm-4 col-xs-12">
						<div class="footer-column border-right">
						<?php wp_nav_menu(array('menu'=>'footer_menu')); ?>
						</div>
					</div>
					
					<div class="col-sm-4 col-xs-12">
						<div class="footer-column border-right">
						</div>
					</div>
					
					<div class="col-sm-4 col-xs-12">
						<div class="footer-column border-right">
						</div>
					</div>
				</div>
			</div>
			
			<div id="footer_powered_by">
				Powered By xuxoxool (<a href="https://xuxoxool.github.io/" target="_blank">https://xuxoxool.github.io/</a>)
			</div>
		</div>
		
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