<section class="title">
	<!-- We'll use $this->method to switch between download.create & download.edit -->
	<h4><?php echo lang('download:'.$this->method); ?></h4>
</section>

<section class="item">

	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>
		
		<div class="form_inputs">
	
		<ul>
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="title"><?php echo lang('download:title'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('title', set_value('title', $title), 'class="width-15"'); ?></div>
			</li>

			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="title"><?php echo lang('download:slug'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('slug', set_value('slug', $slug), 'class="width-15"'); ?></div>
			</li>
			
			<!--
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="url"><?php echo lang('download:source'); ?> <span>*</span></label>
				<div class="input"><?php echo form_dropdown('source', array('external' => 'External', 'internal' => 'Internal'), set_value('source', $source));?></div>
			</li>
			-->
			
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="url"><?php echo lang('download:url'); ?> <span>*</span></label>
				<div class="input"><?php echo form_input('url', set_value('url', $url), 'class="width-15"'); ?></div>
			</li>
			
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="url"><?php echo lang('download:status'); ?> <span>*</span></label>
				<div class="input"><?php echo form_dropdown('status', array('active' => lang('download:active'), 'inactive' => lang('download:inactive')), set_value('status', $status));?></div>
			</li>
			
			<li class="<?php echo alternator('', 'even'); ?>">
				<label for="url"><?php echo lang('download:memberonly'); ?> <span>*</span></label>
				<div class="input"><?php echo form_dropdown('memberonly', array(0 => lang('download:no'), 1 => lang('download:yes')), set_value('memberonly', $memberonly));?></div>
			</li>
		</ul>
		
		</div>
		
		<div class="buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
		</div>
		
	<?php echo form_close(); ?>

</section>

<script type="text/javascript">
	jQuery(function($) {
		$('form input[name="title"]').keyup($.debounce(200, function(){

			var slug = $('input[name="slug"]');

			$.post(SITE_URL + 'ajax/url_title', { title : $(this).val() }, function(new_slug){
				slug.val( new_slug );
			});
		}));
	});
</script>