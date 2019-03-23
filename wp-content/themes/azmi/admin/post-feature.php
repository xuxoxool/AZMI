<div class="adv-param-meta-box">
	<div class="helper helper-sm">
		<ul>
			<li>Only 1 (ONE) post can be set as a featured post.</li>
			<li>Other featured posts will be set to unfeatured.</li>
		</ul>
	</div>
	
	<div style="margin-top: 12px;">
		<div class="row">
			<label class="col-md-2">
				<input type="checkbox" value="1" name="post_featured" <?php echo ($isFeatured) ? 'checked' : ''; ?> />
			</label>
			<div class="col-md-10">This is a featured post</div>
		</div>
	</div>
</div>