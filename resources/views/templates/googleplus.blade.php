<?php foreach ($settings->items as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php if (isset($net_data->object->attachments[0]->fullImage->url)) { ?>
						<div class="thumbnail">
				    		<img src="<?php echo $net_data->object->attachments[0]->fullImage->url; ?>" class="img-responsive">
				    	</div>
						
					<?php } ?>
					<p class="text-justify">
						<?php echo $net_data->object->content; ?>
					</p>
				</div>
			  <div class="panel-footer">
			  	<i class="fa fa-google-plus"></i>
			  	<a target="<?php echo $links_target; ?>" href="<?php echo $net_data->url; ?>">
					<?php echo ($stream_settings->$network->intro != '') ? $stream_settings->$network->intro : 'Shared'; ?>
			  	</a>
				<?php echo $pagescontroller->time_elapsed_string($net_data->published); ?>
			  </div>
			</div>
		</div>
	</div>
<?php } ?>