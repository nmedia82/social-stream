<?php foreach ($settings as $net_data) { ?>
	<div class="col-sm-3 mix <?php echo $network; ?>">
		<div class="nm-<?php echo $network; ?>">
			<div class="panel panel-default">
				<div class="panel-body">
					<p class="text-justify">
			  			<?php echo (isset($net_data->text)) ? $net_data->text : '' ; ?>	
					</p>
				</div>
			  <div class="panel-footer">
			  	<i class="fa fa-twitter"></i>
			  	<a target="<?php echo $links_target; ?>" href="https://twitter.com/statuses/<?php echo $net_data->id; ?>">
			  		<?php echo ($stream_settings->$network->intro != '') ? $stream_settings->$network->intro : 'Tweeted'; ?>
			  	</a>
			  	<?php echo $pagescontroller->time_elapsed_string($net_data->created_at) ; ?>
			  </div>
			</div>
		</div>
	</div>
<?php } ?>