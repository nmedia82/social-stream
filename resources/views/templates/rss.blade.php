<?php foreach ($settings->channel->item as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<?php if (isset($net_data->enclosure)) {
						$xml_arr = (array)$net_data->enclosure;
						echo '<img src="'.$xml_arr['@attributes']['url'].'" class="img-responsive" style="margin:0 auto;">';
					} ?>
					<h5><?php echo $net_data->title; ?></h5>
					<p><?php echo $net_data->description; ?></p>
				</div>
			  <div class="panel-footer">
			  	<div class="row">
			  		<div class="col-xs-9 text-left">
				  		<i class="fa fa-rss"></i>
						<a target="<?php echo $links_target; ?>" href="<?php echo $net_data->link; ?>">
							<?php echo ($stream_settings->$network->intro != '') ? $stream_settings->$network->intro : 'Posted'; ?></a>
							
				  		<?php echo $pagescontroller->time_elapsed_string($net_data->pubDate); ?>
			  		</div>
			  	</div>
			  	</div>
			</div>
		</div>
	</div>
<?php } ?>