<?php
$parent = get_page_by_path($postName,'ARRAY_A');
if($parent) {
	$parent['children'] = get_children_by_parent_id($parent['ID']);
	if($parent['children']) {
		$col = count($parent['children']);
		?>
		<div id="children_list" class="children-list">
			<?php
			foreach($parent['children'] as $child) {
				$url = get_site_url() . '/' . $parent['post_name'] . '/' . $child['post_name'];
				$child['post_subtitle'] = get_post_subtitle($child['ID']);
				?>
					<a href="<?php echo $url; ?>" class="children-item">
						<span><?php echo $child['post_title']; ?></span>
						<?php echo (trim($child['post_subtitle'])) ? ("<p>".$child['post_subtitle']."</p>") : ""; ?>
					</a>
				<?php
			}
			?>
		</div>
		<?php
	}
}
?>