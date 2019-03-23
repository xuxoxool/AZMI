<?php
$ourServices = get_page_by_path('our-services','ARRAY_A');
if($ourServices) {
	$ourServices['children'] = get_children_by_parent_id($ourServices['ID']);
	if($ourServices['children']) {
		$col = count($ourServices['children']);
		?>
			<div id="services" <?php echo ($col > 0 && $col < 5) ? 'class="col-'.$col.'" ' : ''; ?>>
				<div id="services_wrapper">
					<?php
					foreach($ourServices['children'] as $service) {
						$url = get_site_url() . '/' . $ourServices['post_name'] . '/' . $service['post_name'];
						$service['post_subtitle'] = get_post_subtitle($service['ID']);
						?>
						<div class="service-item">
							<a href="<?php echo $url; ?>" class="service-item-wrapper">
								<h3><?php echo $service['post_title']; ?></h3>
								<p><?php echo $service['post_subtitle']; ?></p>
							</a>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		<?php
	}
}
?>