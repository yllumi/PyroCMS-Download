<section class="title">
	<h4><?php echo lang('download:item_list'); ?></h4>
</section>

<section class="item">
	<div class="content">
	<?php echo form_open('admin/download/delete');?>
	
	<?php if (!empty($items)): ?>
	
		<table>
			<thead>
				<tr>
					<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
					<th><?php echo lang('download:title'); ?></th>
					<th><?php echo lang('download:code'); ?></th>
					<!--<th><?php echo lang('download:source'); ?></th>-->
					<th><?php echo lang('download:status'); ?></th>
					<th><?php echo lang('download:count'); ?></th>
					<th><?php echo lang('download:memberonly'); ?></th>
					<th></th>
				</tr>
			</thead>
			<tfoot>
				<tr>
					<td colspan="7">
						<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
					</td>
				</tr>
			</tfoot>
			<tbody>
				<?php foreach( $items as $item ): ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $item->id); ?></td>
					<td><?php echo '<strong>'.$item->title.'</strong>'; ?></td>
					<td><?php echo '{{ download:link slug="'.$item->slug.'" }}<br />{{ download:count slug="'.$item->slug.'" }}' ?></td>
					<!--<td><?php echo $item->source; ?></td>-->
					<td><?php echo lang('download:'.$item->status); ?></td>
					<td><?php echo $item->count; ?></td>
					<td><?php echo ($item->memberonly == 1)? lang('download:yes') : lang('download:no'); ?></td>
					<td class="actions">
						<?php echo
						//anchor('admin/download/statistics', lang('download:statistics'), 'class="button" target="_blank"').' '.
						anchor('admin/download/edit/'.$item->id, lang('download:edit'), 'class="button"').' '.
						anchor('admin/download/delete/'.$item->id, lang('download:delete'), array('class'=>'button', 'onclick'=>'return confirm(\''.lang('download:confirm_delete').'\')')); ?>
						<input type="text" class="widget-code hide" disabled="disabled" value="{{ download:file id='12' }}" />
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		
		<div class="table_action_buttons">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
		</div>
		
	<?php else: ?>
		<div class="no_data"><?php echo lang('download:no_items'); ?></div>
	<?php endif;?>
	
	<?php echo form_close(); ?>
	</div>
</section>
<script type="text/javaascript">
	$('.codeToggle').live('click', function(){
		$(this).siblings('.widget-code').slideToggle('medium');
		return false;
	});
</script>